#!/usr/bin/env node
/**
 * Recopie la vidéothèque dans le site et l'habille du menu du site.
 *
 * Usage : node tools/integrer_videotheque.js [dossier source]
 *         (source par défaut : Z:\My Drive\Aikido\Techniques\site, ou VIDEOTHEQUE_SOURCE)
 *
 * La vidéothèque est développée à part (app.js, style.css, donnees.js, imagettes/,
 * index.html). Ce script :
 *   - recopie ces fichiers dans htdocs/videotheque/ (imagettes retirées comprises) ;
 *   - transforme index.html en index.php : en-tête et menu du site
 *     (includes/header.php), feuilles de style du site, puis celles de la vidéothèque
 *     et quelques règles qui placent la vidéothèque sous l'en-tête fixe ;
 *   - numérote les fichiers d'après leur contenu (?v=...) : le navigateur recharge
 *     app.js, style.css et donnees.js dès qu'ils changent, malgré le cache d'une semaine.
 * Les fichiers de la source ne sont jamais modifiés.
 */

import fs from "node:fs";
import path from "node:path";
import crypto from "node:crypto";
import { fileURLToPath } from "node:url";

const RACINE = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const SOURCE = path.resolve(process.argv[2] || process.env.VIDEOTHEQUE_SOURCE || "Z:/My Drive/Aikido/Techniques/site");
const CIBLE = path.join(RACINE, "htdocs", "videotheque");
const FICHIERS = ["app.js", "style.css", "donnees.js"];

// Place la vidéothèque sous l'en-tête fixe du site (hauteur --header-height)
const STYLE_INTEGRATION = `
    /* Intégration dans le site : la vidéothèque se place sous l'en-tête fixe */
    body { padding-top: var(--header-height); background-image: none; }
    .barre { top: var(--header-height); }
    .filtres { top: calc(var(--header-height) + 72px); max-height: calc(100vh - var(--header-height) - 88px); }
    /* Les titres et paragraphes du site (noirs, marges, interligne) écrasaient ceux de la
       vidéothèque, illisibles en mode sombre. Même poids que les règles du site (h2, p),
       placées après elles : les règles à classe de la vidéothèque gardent la main. */
    :where(.barre, .mise, .apropos) :is(h1, h2, h3, h4, h5, h6) { color: inherit; margin: 0; line-height: inherit; font-family: inherit; }
    :where(.barre, .mise, .apropos) p { margin: 0; }
    /* Pas de bouton « À propos » sur le site (app.js en a besoin : on le masque) */
    #ouvrir-apropos { display: none; }
    @media (max-width: 900px) {
      .lecteur { top: var(--header-height); }
    }`;

function lire(f) {
  return fs.readFileSync(path.join(SOURCE, f), "utf8");
}

if (!fs.existsSync(path.join(SOURCE, "index.html"))) {
  console.error(`Source introuvable : ${SOURCE}`);
  process.exit(1);
}

/* ---------- Copie ---------- */

fs.mkdirSync(path.join(CIBLE, "imagettes"), { recursive: true });
for (const f of FICHIERS) fs.copyFileSync(path.join(SOURCE, f), path.join(CIBLE, f));

const imgSource = new Set(fs.readdirSync(path.join(SOURCE, "imagettes")));
for (const f of imgSource) fs.copyFileSync(path.join(SOURCE, "imagettes", f), path.join(CIBLE, "imagettes", f));
let retirees = 0;
for (const f of fs.readdirSync(path.join(CIBLE, "imagettes"))) {
  if (!imgSource.has(f)) {
    fs.rmSync(path.join(CIBLE, "imagettes", f));
    retirees++;
  }
}

/* ---------- index.html -> index.php ---------- */

const version = crypto
  .createHash("sha1")
  .update(FICHIERS.map(lire).join("\0"))
  .digest("hex")
  .slice(0, 10);

let html = lire("index.html");
const tete = html.match(/<head>([\s\S]*?)<\/head>/);
const corps = html.match(/<body[^>]*>([\s\S]*?)<\/body>/);
if (!tete || !corps) {
  console.error("index.html : <head> ou <body> introuvable");
  process.exit(1);
}

// En-tête : métadonnées de la vidéothèque, sans sa feuille de style (rajoutée après celles du site)
const meta = tete[1]
  .split("\n")
  .filter((l) => l.trim() && !/rel="stylesheet"/.test(l) && !/rel="icon"/.test(l))
  .map((l) => "  " + l.trim())
  .join("\n");

const scripts = corps[1].replace(/(src)="(donnees\.js|app\.js)(?:\?v=[^"]*)?"/g, `$1="$2?v=${version}"`);

const php = `<!doctype html>
<!-- Généré par tools/integrer_videotheque.js depuis la vidéothèque (index.html) : ne pas modifier ici. -->
<html lang="fr">
<head>
${meta}
  <link rel="canonical" href="https://kannagara.fr/videotheque/">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
  <link rel="stylesheet" href="style.css?v=${version}">
  <style>${STYLE_INTEGRATION}
  </style>
</head>
<body class="page-videotheque">
<?php $active = 'videotheque'; include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
${scripts.trim()}
<script src="/js/main.js" defer></script>
</body>
</html>
`;

fs.writeFileSync(path.join(CIBLE, "index.php"), php, "utf8");
fs.rmSync(path.join(CIBLE, "index.html"), { force: true });

console.log(
  `Vidéothèque intégrée depuis ${SOURCE} : ${imgSource.size} imagettes` +
    (retirees ? ` (${retirees} retirée(s))` : "") +
    `, version ${version}.`
);
