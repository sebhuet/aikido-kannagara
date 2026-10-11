#!/usr/bin/env node
/**
 * Génère videos.js (liste lue par index.html) et les imagettes du dossier imagettes/.
 *
 * Usage : node VideoRef/liste-videos.js            (ne traite que les vidéos nouvelles ou modifiées)
 *         node VideoRef/liste-videos.js --tout     (régénère toutes les imagettes)
 *
 * À relancer après tout ajout, retrait ou renommage de vidéo. Une page HTML ouverte
 * en local (file://) ne peut pas lister son dossier : la liste est donc figée ici.
 * Le nom des fichiers suit REGLES_NOMMAGE.md :
 *   <Type de travail> - <Attaque> - <Technique> [<Forme>] - <Courant> - <Sensei>.mp4
 *
 * Imagettes et durées : ffmpeg/ffprobe, cherchés dans FFMPEG_DIR, le PATH puis
 * E:\Tools\ffmpeg\bin. Sans ffmpeg, la liste est quand même produite, sans imagettes.
 */

const fs = require("fs");
const path = require("path");
const { execFile } = require("child_process");

const DOSSIER = __dirname;
const SORTIE = path.join(DOSSIER, "videos.js");
const IMAGETTES = path.join(DOSSIER, "imagettes");
const EXTENSIONS = new Set([".mp4", ".webm", ".m4v", ".mov"]);
const LARGEUR_IMAGETTE = 480;
const POSITION_IMAGETTE = 0.4; // fraction de la durée
const EN_PARALLELE = 4;
const TOUT = process.argv.includes("--tout");

// Les valeurs sont reprises telles qu'écrites dans le nom du fichier, sans interprétation
function analyser(fichier) {
  const base = path.basename(fichier, path.extname(fichier));
  const parties = base.split(" - ").map((p) => p.trim());
  if (parties.length < 5) return null;

  const [type, attaque, techniqueBrute, courant, ...reste] = parties;
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

async function parLots(elements, n, traiter) {
  let i = 0;
  const ouvriers = Array.from({ length: n }, async () => {
    while (i < elements.length) await traiter(elements[i++]);
  });
  await Promise.all(ouvriers);
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
  const echecs = [];

  if (ffmpeg && ffprobe) {
    fs.mkdirSync(IMAGETTES, { recursive: true });
    await parLots(videos, EN_PARALLELE, async (v) => {
      const chemin = path.join(DOSSIER, v.fichier);
      const stat = fs.statSync(chemin);
      const ancien = avant.get(v.fichier);
      const nomImg = path.basename(v.fichier, path.extname(v.fichier)) + ".jpg";
      const cheminImg = path.join(IMAGETTES, nomImg);
      try {
        v.duree = ancien && ancien.taille === stat.size && ancien.duree ? ancien.duree : await duree(ffprobe, chemin);
        const aJour = fs.existsSync(cheminImg) && fs.statSync(cheminImg).mtimeMs >= stat.mtimeMs;
        if (TOUT || !aJour) {
          await imagette(ffmpeg, chemin, cheminImg, (v.duree * POSITION_IMAGETTE).toFixed(2));
          nbImagettes++;
          process.stdout.write(".");
        }
        v.imagette = "imagettes/" + nomImg;
      } catch (e) {
        echecs.push(`${v.fichier} : ${e.message.trim().split("\n")[0]}`);
      }
      v.taille = stat.size;
    });
    if (nbImagettes) process.stdout.write("\n");

    // Imagettes orphelines (vidéo retirée ou renommée)
    const attendues = new Set(videos.filter((v) => v.imagette).map((v) => path.basename(v.imagette)));
    for (const f of fs.readdirSync(IMAGETTES)) {
      if (f.endsWith(".jpg") && !attendues.has(f)) fs.unlinkSync(path.join(IMAGETTES, f));
    }
  } else {
    console.warn("ffmpeg/ffprobe introuvable (FFMPEG_DIR, PATH, E:\\Tools\\ffmpeg\\bin) : pas d'imagettes ni de durées.");
  }

  const contenu =
    "// Fichier généré par liste-videos.js : ne pas modifier à la main.\n" +
    `// ${videos.length} vidéos, générées le ${new Date().toISOString().slice(0, 10)}.\n` +
    `window.VIDEOS = ${JSON.stringify(videos, null, 1)};\n`;

  fs.writeFileSync(SORTIE, contenu, "utf8");
  console.log(`${videos.length} vidéos écrites dans ${path.relative(process.cwd(), SORTIE)}, ${nbImagettes} imagette(s) produite(s).`);
  if (echecs.length) {
    console.warn(`\n${echecs.length} vidéo(s) sans imagette :`);
    for (const e of echecs) console.warn(`  - ${e}`);
  }
  if (ignores.length) {
    console.warn(`\n${ignores.length} fichier(s) ignoré(s), nom non conforme :`);
    for (const f of ignores) console.warn(`  - ${f}`);
  }
})();
