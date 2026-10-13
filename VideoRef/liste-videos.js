#!/usr/bin/env node
/**
 * Prépare la vidéothèque : versions web des vidéos (web/), imagettes (imagettes/)
 * et liste lue par index.html (videos.js).
 *
 * Usage : node VideoRef/liste-videos.js            (ne traite que les vidéos nouvelles ou modifiées)
 *         node VideoRef/liste-videos.js --tout     (réencode tout et régénère toutes les imagettes)
 *
 * À relancer après tout ajout, retrait ou renommage de vidéo. Une page HTML ouverte
 * en local (file://) ne peut pas lister son dossier : la liste est donc figée ici.
 * Le nom des fichiers suit REGLES_NOMMAGE.md :
 *   <Type de travail> - <Attaque> - <Technique> [<Forme>] - <Courant> - <Sensei>.mp4
 *
 * Les vidéos de ce dossier sont les originaux (masters, jamais modifiés). La page lit
 * et le déploiement envoie les versions web/ : H.264 720p, une image clé par seconde
 * (ralenti, image par image et boucle A-B fluides), son AAC 96 kb/s, lecture immédiate
 * (faststart). Environ 2,5 fois plus légères que les originaux 1080p.
 *
 * ffmpeg/ffprobe : cherchés dans FFMPEG_DIR, le PATH puis E:\Tools\ffmpeg\bin. Sans
 * ffmpeg, la liste est quand même produite, sans versions web ni imagettes : la page
 * lit alors les originaux.
 */

const fs = require("fs");
const path = require("path");
const { execFile } = require("child_process");

const DOSSIER = __dirname;
const SORTIE = path.join(DOSSIER, "videos.js");
const IMAGETTES = path.join(DOSSIER, "imagettes");
const WEB = path.join(DOSSIER, "web");
const EXTENSIONS = new Set([".mp4", ".webm", ".m4v", ".mov"]);
const LARGEUR_IMAGETTE = 480;
const POSITION_IMAGETTE = 0.4; // fraction de la durée
const EN_PARALLELE = 4; // imagettes et durées
const ENCODAGES_EN_PARALLELE = 2; // x264 utilise déjà plusieurs cœurs
const TOUT = process.argv.includes("--tout");

// Réglages des versions web
const HAUTEUR_WEB = 720;
const IMAGES_PAR_CLE = 25; // une image clé par seconde à 25 i/s
const CRF = 23;

// Les valeurs sont reprises telles qu'écrites dans le nom du fichier, sans interprétation
function analyser(fichier) {
  const base = path.basename(fichier, path.extname(fichier));
  const parties = base.split(" - ").map((p) => p.trim());
  if (parties.length < 5) return null;

  // Buki Waza : une partie de plus (arme), fusionnée avec l'attaque : « Jo Dori · Chudan Tsuki »
  const [type, ...suite] = parties;
  const attaques = suite.length >= 5 ? suite.splice(0, 2) : suite.splice(0, 1);
  const attaque = attaques.join(" · ");
  const [techniqueBrute, courant, ...reste] = suite;
  const sensei = reste.join(" - ");
  const m = techniqueBrute.match(/^(.*?)\s*\[(.+)\]$/);

  return {
    fichier,
    type,
    attaque,
    technique: m ? m[1] : techniqueBrute,
    forme: m ? m[2] : "",
    courant,
    sensei
  };
}

/* ---------- ffmpeg ---------- */

function trouverOutil(nom) {
  const exe = process.platform === "win32" ? `${nom}.exe` : nom;
  const dossiers = [
    process.env.FFMPEG_DIR,
    ...(process.env.PATH || "").split(path.delimiter),
    "E:\\Tools\\ffmpeg\\bin"
  ].filter(Boolean);
  for (const d of dossiers) {
    const p = path.join(d, exe);
    if (fs.existsSync(p)) return p;
  }
  return null;
}

function lancer(exe, args) {
  return new Promise((ok, ko) =>
    execFile(exe, args, { windowsHide: true, maxBuffer: 1 << 20 }, (err, stdout, stderr) =>
      err ? ko(new Error(stderr || err.message)) : ok(stdout)
    )
  );
}

async function duree(ffprobe, chemin) {
  const s = await lancer(ffprobe, ["-v", "error", "-show_entries", "format=duration", "-of", "csv=p=0", chemin]);
  return Math.round(parseFloat(s) * 10) / 10;
}

async function imagette(ffmpeg, chemin, sortie, secondes) {
  await lancer(ffmpeg, [
    "-y", "-v", "error",
    "-ss", String(secondes),
    "-i", chemin,
    "-frames:v", "1",
    "-vf", `scale=${LARGEUR_IMAGETTE}:-2`,
    "-q:v", "5",
    sortie
  ]);
}

// Écrit d'abord un fichier temporaire : une version web interrompue n'est jamais prise
// pour une version terminée
async function versionWeb(ffmpeg, chemin, sortie) {
  const temp = path.join(path.dirname(sortie), "~" + path.basename(sortie));
  await lancer(ffmpeg, [
    "-y", "-v", "error",
    "-i", chemin,
    "-map", "0:v:0", "-map", "0:a:0?",
    "-vf", `scale=-2:'min(${HAUTEUR_WEB},ih)'`,
    "-c:v", "libx264", "-preset", "slow", "-crf", String(CRF),
    "-g", String(IMAGES_PAR_CLE), "-keyint_min", String(IMAGES_PAR_CLE), "-sc_threshold", "0",
    "-pix_fmt", "yuv420p",
    "-c:a", "aac", "-b:a", "96k",
    "-map_metadata", "-1",
    "-movflags", "+faststart",
    "-f", "mp4", temp
  ]);
  fs.renameSync(temp, sortie);
}

async function parLots(elements, n, traiter) {
  let i = 0;
  const ouvriers = Array.from({ length: n }, async () => {
    while (i < elements.length) await traiter(elements[i++]);
  });
  await Promise.all(ouvriers);
}

function aJour(cible, source) {
  return !TOUT && fs.existsSync(cible) && fs.statSync(cible).mtimeMs >= fs.statSync(source).mtimeMs;
}

// Supprime d'un dossier les fichiers qui ne correspondent plus à aucune vidéo
function nettoyer(dossier, attendus) {
  for (const f of fs.readdirSync(dossier)) {
    if (!attendus.has(f)) fs.rmSync(path.join(dossier, f), { force: true });
  }
}

/* ---------- Programme ---------- */

// Durées déjà mesurées : reprises de la liste précédente si le fichier n'a pas changé
function listePrecedente() {
  try {
    const window = {};
    new Function("window", fs.readFileSync(SORTIE, "utf8"))(window);
    return new Map((window.VIDEOS || []).map((v) => [v.fichier, v]));
  } catch {
    return new Map();
  }
}

(async () => {
  const debut = Date.now();
  const fichiers = fs
    .readdirSync(DOSSIER)
    .filter((f) => EXTENSIONS.has(path.extname(f).toLowerCase()))
    .sort((a, b) => a.localeCompare(b, "fr"));

  const videos = [];
  const ignores = [];
  for (const f of fichiers) {
    const v = analyser(f);
    if (v) videos.push(v);
    else ignores.push(f);
  }

  const ffmpeg = trouverOutil("ffmpeg");
  const ffprobe = trouverOutil("ffprobe");
  const avant = listePrecedente();
  let nbImagettes = 0;
  let nbEncodages = 0;
  const echecs = [];

  if (ffmpeg && ffprobe) {
    fs.mkdirSync(IMAGETTES, { recursive: true });
    fs.mkdirSync(WEB, { recursive: true });

    // Durées et imagettes (rapide)
    await parLots(videos, EN_PARALLELE, async (v) => {
      const chemin = path.join(DOSSIER, v.fichier);
      const stat = fs.statSync(chemin);
      const ancien = avant.get(v.fichier);
      const nomImg = path.basename(v.fichier, path.extname(v.fichier)) + ".jpg";
      const cheminImg = path.join(IMAGETTES, nomImg);
      try {
        v.duree = ancien && ancien.taille === stat.size && ancien.duree ? ancien.duree : await duree(ffprobe, chemin);
        if (!aJour(cheminImg, chemin)) {
          await imagette(ffmpeg, chemin, cheminImg, (v.duree * POSITION_IMAGETTE).toFixed(2));
          nbImagettes++;
        }
        v.imagette = "imagettes/" + nomImg;
      } catch (e) {
        echecs.push(`${v.fichier} (imagette) : ${e.message.trim().split("\n")[0]}`);
      }
      v.taille = stat.size;
    });

    // Versions web (lent : une fois par vidéo nouvelle ou modifiée)
    const aEncoder = videos.filter((v) => !aJour(path.join(WEB, v.fichier), path.join(DOSSIER, v.fichier)));
    if (aEncoder.length) console.log(`Encodage de ${aEncoder.length} version(s) web…`);
    let n = 0;
    await parLots(aEncoder, ENCODAGES_EN_PARALLELE, async (v) => {
      try {
        await versionWeb(ffmpeg, path.join(DOSSIER, v.fichier), path.join(WEB, v.fichier));
        nbEncodages++;
        console.log(`  [${++n}/${aEncoder.length}] ${v.fichier}`);
      } catch (e) {
        n++;
        echecs.push(`${v.fichier} (version web) : ${e.message.trim().split("\n")[0]}`);
      }
    });
    for (const v of videos) {
      if (fs.existsSync(path.join(WEB, v.fichier))) v.web = "web/" + v.fichier;
    }

    // Fichiers orphelins (vidéo retirée ou renommée, encodage interrompu)
    nettoyer(IMAGETTES, new Set(videos.filter((v) => v.imagette).map((v) => path.basename(v.imagette))));
    nettoyer(WEB, new Set(videos.filter((v) => v.web).map((v) => v.fichier)));
  } else {
    console.warn("ffmpeg/ffprobe introuvable (FFMPEG_DIR, PATH, E:\\Tools\\ffmpeg\\bin) : ni versions web, ni imagettes, ni durées.");
  }

  const contenu =
    "// Fichier généré par liste-videos.js : ne pas modifier à la main.\n" +
    `// ${videos.length} vidéos, générées le ${new Date().toISOString().slice(0, 10)}.\n` +
    `window.VIDEOS = ${JSON.stringify(videos, null, 1)};\n`;
  fs.writeFileSync(SORTIE, contenu, "utf8");

  const taille = (dossier) =>
    fs.existsSync(dossier) ? fs.readdirSync(dossier).reduce((t, f) => t + fs.statSync(path.join(dossier, f)).size, 0) : 0;
  const originaux = videos.reduce((t, v) => t + (v.taille || 0), 0);
  console.log(
    `${videos.length} vidéos écrites dans ${path.relative(process.cwd(), SORTIE)} : ` +
      `${nbEncodages} version(s) web et ${nbImagettes} imagette(s) produites en ${Math.round((Date.now() - debut) / 1000)} s.`
  );
  if (ffmpeg) {
    console.log(`Originaux ${(originaux / 1e6).toFixed(0)} Mo, versions web ${(taille(WEB) / 1e6).toFixed(0)} Mo.`);
  }
  if (echecs.length) {
    console.warn(`\n${echecs.length} échec(s) :`);
    for (const e of echecs) console.warn(`  - ${e}`);
  }
  if (ignores.length) {
    console.warn(`\n${ignores.length} fichier(s) ignoré(s), nom non conforme :`);
    for (const f of ignores) console.warn(`  - ${f}`);
  }
})();
