#!/usr/bin/env node
/**
 * Construit le commit déployé sur Gandi : master + la vidéothèque.
 *
 * Usage (appelé par deploy.sh) : node tools/commit_gandi.js   -> affiche le hash du commit
 *
 * Les vidéos de VideoRef/ ne vont jamais sur GitHub : master les ignore (.gitignore).
 * Ce script fabrique, sans toucher ni à la copie de travail ni aux branches, un commit
 * dont le parent est master et qui ajoute :
 *   htdocs/videotheque/index.html, videos.js, imagettes/*.jpg, web/*.mp4  (repris de VideoRef/)
 *   htdocs/videotheque/.htaccess, connexion.php                            (générés ici)
 * Seules les versions web (720p, produites par VideoRef/liste-videos.js) sont déployées,
 * jamais les originaux 1080p.
 * deploy.sh le pousse ensuite sur la branche master du dépôt Gandi uniquement.
 *
 * Accès : .htaccess refuse tout le dossier sans le cookie déposé par connexion.php
 * après saisie du mot de passe. Mot de passe et jeton du cookie sont dans
 * env/videotheque (non versionné), créé au premier lancement :
 *   VIDEOTHEQUE_MOT_DE_PASSE=aikido
 *   VIDEOTHEQUE_JETON=<64 caractères hexadécimaux aléatoires>
 * Changer le jeton déconnecte tout le monde au déploiement suivant.
 */

import fs from "node:fs";
import os from "node:os";
import path from "node:path";
import crypto from "node:crypto";
import { execFileSync } from "node:child_process";
import { fileURLToPath } from "node:url";

const RACINE = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const SOURCE = path.join(RACINE, "VideoRef");
const CIBLE = "htdocs/videotheque";
const FICHIER_ENV = path.join(RACINE, "env", "videotheque");
const DOSSIER_GIT = path.join(RACINE, ".git");
const INDEX_TEMP = path.join(DOSSIER_GIT, "index-gandi");
const CACHE = path.join(DOSSIER_GIT, "videotheque-cache.json");

function git(args, options = {}) {
  return execFileSync("git", args, { cwd: RACINE, encoding: "utf8", maxBuffer: 64 << 20, ...options }).trim();
}

/* ---------- Configuration ---------- */

function lireEnv() {
  if (!fs.existsSync(FICHIER_ENV)) {
    fs.writeFileSync(
      FICHIER_ENV,
      `VIDEOTHEQUE_MOT_DE_PASSE=aikido\nVIDEOTHEQUE_JETON=${crypto.randomBytes(32).toString("hex")}\n`,
      "utf8"
    );
    console.error(`env/videotheque créé (mot de passe « aikido », nouveau jeton).`);
  }
  const env = {};
  for (const ligne of fs.readFileSync(FICHIER_ENV, "utf8").split(/\r?\n/)) {
    const m = ligne.match(/^\s*([A-Z_]+)\s*=\s*(.*?)\s*$/);
    if (m) env[m[1]] = m[2];
  }
  if (!env.VIDEOTHEQUE_MOT_DE_PASSE || !/^[0-9a-f]{32,}$/.test(env.VIDEOTHEQUE_JETON || "")) {
    throw new Error("env/videotheque incomplet : VIDEOTHEQUE_MOT_DE_PASSE et VIDEOTHEQUE_JETON (hexadécimal) attendus.");
  }
  return env;
}

// Même normalisation que connexion.php : minuscules, sans accent, sans espace autour
function normaliser(s) {
  return s.normalize("NFD").replace(/[̀-ͯ]/g, "").toLowerCase().trim();
}

/* ---------- Fichiers générés ---------- */

function htaccess(jeton) {
  return `# Généré par tools/commit_gandi.js : ne pas modifier sur le serveur.
# Vidéothèque réservée : sans le cookie déposé par connexion.php, la page renvoie vers
# la connexion et tout le reste (vidéos, imagettes, liste) est refusé.

Options -Indexes
DirectoryIndex index.html

<IfModule mod_headers.c>
    Header set X-Robots-Tag "noindex, nofollow"
</IfModule>

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteOptions Inherit

    RewriteRule ^connexion\\.php$ - [L]

    RewriteCond %{HTTP_COOKIE} !(^|;\\s*)videotheque=${jeton}(;|$)
    RewriteRule ^(index\\.html)?$ connexion.php [L]

    RewriteCond %{HTTP_COOKIE} !(^|;\\s*)videotheque=${jeton}(;|$)
    RewriteRule ^ - [F]
</IfModule>
`;
}

function connexionPhp(empreinte, jeton) {
  return `<?php
// Généré par tools/commit_gandi.js : ne pas modifier sur le serveur.
// Connexion à la vidéothèque : vérifie le mot de passe et dépose le cookie exigé par
// .htaccess pour tout le dossier. ?sortie déconnecte.

const EMPREINTE = '${empreinte}'; // sha256 du mot de passe normalisé
const JETON = '${jeton}';
const COOKIE = 'videotheque';
const CHEMIN = '/videotheque/';

function normaliser(string $s): string
{
    $s = mb_strtolower(trim($s), 'UTF-8');
    if (class_exists('Normalizer')) {
        $s = preg_replace('/\\p{Mn}/u', '', Normalizer::normalize($s, Normalizer::FORM_D));
    } else {
        $s = strtr($s, ['ï' => 'i', 'î' => 'i', 'é' => 'e', 'è' => 'e', 'ê' => 'e', 'à' => 'a', 'â' => 'a', 'ô' => 'o', 'û' => 'u', 'ù' => 'u', 'ç' => 'c']);
    }
    return $s;
}

function cookie(string $valeur, int $expiration): void
{
    setcookie(COOKIE, $valeur, [
        'expires' => $expiration,
        'path' => CHEMIN,
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}

header('X-Robots-Tag: noindex, nofollow');
header('Cache-Control: no-store');

if (isset($_GET['sortie'])) {
    cookie('', time() - 3600);
    header('Location: ' . CHEMIN, true, 303);
    exit;
}

$erreur = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (hash_equals(EMPREINTE, hash('sha256', normaliser((string) ($_POST['mdp'] ?? ''))))) {
        cookie(JETON, time() + 365 * 24 * 3600);
        header('Location: ' . CHEMIN, true, 303);
        exit;
    }
    $erreur = true;
}
?><!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Vidéothèque Kannagara</title>
<style>
:root { --papier: #f4f0e8; --surface: #fffdf8; --encre: #1c1a17; --encre-2: #625b51; --trait: #dcd3c4; --rouge: #ce3030; }
@media (prefers-color-scheme: dark) {
  :root { --papier: #141312; --surface: #1e1c1a; --encre: #f0ebe3; --encre-2: #a69e92; --trait: #3a3631; --rouge: #e04848; }
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: "Century Gothic", "Avenir Next", "Avenir", "Helvetica Neue", Arial, sans-serif; background: var(--papier); color: var(--encre); min-height: 100vh; display: grid; place-items: center; padding: 16px; }
form { width: min(380px, 100%); background: var(--surface); border: 1px solid var(--trait); border-radius: 18px; padding: 36px 28px 28px; text-align: center; }
.sceau { width: 72px; height: 72px; margin: 0 auto 18px; border-radius: 50%; background: var(--rouge); color: #fff; display: grid; place-items: center; font-size: 26px; font-family: "Yu Mincho", "Hiragino Mincho ProN", "Noto Serif JP", serif; }
h1 { font-size: 1.35rem; margin-bottom: 4px; }
p { color: var(--encre-2); font-size: 0.92rem; }
label { display: block; text-align: left; font-size: 0.8rem; color: var(--encre-2); margin: 22px 0 6px; }
input { width: 100%; padding: 12px 14px; border: 1px solid var(--trait); border-radius: 10px; background: var(--papier); color: inherit; font: inherit; font-size: 1rem; }
button { width: 100%; margin-top: 12px; padding: 12px; border: 0; border-radius: 10px; background: var(--rouge); color: #fff; font: inherit; font-weight: 700; cursor: pointer; }
.erreur { color: var(--rouge); margin-top: 10px; min-height: 1.4em; }
</style>
</head>
<body>
<form method="post" action="<?= CHEMIN ?>connexion.php">
  <div class="sceau" aria-hidden="true">合気</div>
  <h1>Vidéothèque technique</h1>
  <p>Kannagara Aïkido · accès réservé aux membres</p>
  <label for="mdp">Mot de passe</label>
  <input id="mdp" name="mdp" type="password" autocomplete="current-password" required autofocus>
  <button type="submit">Entrer</button>
  <p class="erreur" role="alert"><?= $erreur ? 'Mot de passe incorrect.' : '' ?></p>
</form>
</body>
</html>
`;
}

/* ---------- Objets git ---------- */

// Empreintes déjà calculées (taille + date) : évite de relire 1,2 Go à chaque déploiement
function lireCache() {
  try {
    return JSON.parse(fs.readFileSync(CACHE, "utf8"));
  } catch {
    return {};
  }
}

function hacher(chemins) {
  const cache = lireCache();
  const resultat = new Map();
  const aCalculer = [];
  for (const c of chemins) {
    const st = fs.statSync(c);
    const cle = path.relative(RACINE, c);
    const e = cache[cle];
    if (e && e.taille === st.size && e.date === st.mtimeMs && objetExiste(e.hash)) resultat.set(c, e.hash);
    else aCalculer.push(c);
  }
  if (aCalculer.length) {
    console.error(`Ajout de ${aCalculer.length} fichier(s) aux objets git…`);
    const sortie = git(["-c", "core.safecrlf=false", "hash-object", "-w", "--stdin-paths"], { input: aCalculer.join("\n") + "\n" }).split("\n");
    aCalculer.forEach((c, i) => resultat.set(c, sortie[i]));
  }
  // Le cache ne garde que les fichiers déployés cette fois-ci
  const nouveau = {};
  for (const [c, hash] of resultat) {
    const st = fs.statSync(c);
    nouveau[path.relative(RACINE, c)] = { taille: st.size, date: st.mtimeMs, hash };
  }
  fs.writeFileSync(CACHE, JSON.stringify(nouveau), "utf8");
  return resultat;
}

function objetExiste(hash) {
  try {
    git(["cat-file", "-e", hash]);
    return true;
  } catch {
    return false;
  }
}

function hacherTexte(contenu) {
  const tmp = path.join(os.tmpdir(), `videotheque-${process.pid}-${crypto.randomBytes(4).toString("hex")}`);
  fs.writeFileSync(tmp, contenu, "utf8");
  try {
    return git(["-c", "core.safecrlf=false", "hash-object", "-w", tmp]);
  } finally {
    fs.unlinkSync(tmp);
  }
}

/* ---------- Programme ---------- */

const env = lireEnv();
const jeton = env.VIDEOTHEQUE_JETON;
const empreinte = crypto.createHash("sha256").update(normaliser(env.VIDEOTHEQUE_MOT_DE_PASSE)).digest("hex");

if (!fs.existsSync(path.join(SOURCE, "videos.js"))) {
  throw new Error("VideoRef/videos.js absent : lancer d'abord node VideoRef/liste-videos.js");
}

// La liste (videos.js) fait foi : chaque vidéo doit avoir sa version web et son imagette
const window = {};
new Function("window", fs.readFileSync(path.join(SOURCE, "videos.js"), "utf8"))(window);
const videos = window.VIDEOS || [];
const manquantes = videos.filter((v) => !v.web || !v.imagette || !fs.existsSync(path.join(SOURCE, v.web)) || !fs.existsSync(path.join(SOURCE, v.imagette)));
if (!videos.length || manquantes.length) {
  throw new Error(
    `${manquantes.length || "Aucune"} vidéo(s) sans version web ou sans imagette : lancer d'abord node VideoRef/liste-videos.js` +
      manquantes.slice(0, 5).map((v) => `\n  - ${v.fichier}`).join("")
  );
}

const fichiers = [
  path.join(SOURCE, "index.html"),
  path.join(SOURCE, "videos.js"),
  ...videos.map((v) => path.join(SOURCE, v.web)),
  ...videos.map((v) => path.join(SOURCE, v.imagette))
];

const hashes = hacher(fichiers);
const entrees = fichiers.map((c) => `100644 ${hashes.get(c)}\t${CIBLE}/${path.relative(SOURCE, c).split(path.sep).join("/")}`);
entrees.push(`100644 ${hacherTexte(htaccess(jeton))}\t${CIBLE}/.htaccess`);
entrees.push(`100644 ${hacherTexte(connexionPhp(empreinte, jeton))}\t${CIBLE}/connexion.php`);

// Index temporaire : ni l'index de travail ni les branches ne sont touchés
const envGit = { ...process.env, GIT_INDEX_FILE: INDEX_TEMP };
try {
  git(["read-tree", "master"], { env: envGit });
  git(["update-index", "--add", "--index-info"], { env: envGit, input: entrees.join("\n") + "\n" });
  const arbre = git(["write-tree"], { env: envGit });
  const nbVideos = fichiers.filter((f) => /\.mp4$/i.test(f)).length;
  const commit = git(["commit-tree", arbre, "-p", "master", "-m", `Déploiement Gandi : vidéothèque (${nbVideos} vidéos)`]);
  console.error(`Commit Gandi ${commit.slice(0, 7)} : master + ${CIBLE}/ (${nbVideos} vidéos).`);
  process.stdout.write(commit + "\n");
} finally {
  fs.rmSync(INDEX_TEMP, { force: true });
}
