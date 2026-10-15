#!/usr/bin/env node
/**
 * Images d'aperçu des liens partagés (WhatsApp, Facebook) : 1200 × 630 px.
 *
 * Usage : node tools/images_partage.js
 *
 * Presque toutes les pages annonçaient le logo du club, carré et minuscule dans un
 * aperçu de lien. Ce script compose une image par usage (photo du club, logo, titre)
 * et la photographie avec Chrome sans interface, comme build-flyers.js :
 *   htdocs/images/partage/kannagara.jpg   accueil et pages sans image propre
 *   htdocs/images/partage/inscription.jpg
 *   htdocs/images/partage/aikido.jpg
 *   htdocs/images/partage/videotheque.jpg (mosaïque des imagettes de la vidéothèque)
 * Les textes viennent de data/club.json. À relancer après un changement de saison,
 * de jours de cours ou de photo ; les images produites sont à commiter.
 * Chrome : emplacements usuels, ou variable d'environnement CHROME_PATH.
 */

import fs from "node:fs";
import os from "node:os";
import path from "node:path";
import { spawn } from "node:child_process";
import { fileURLToPath, pathToFileURL } from "node:url";

const RACINE = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const HTDOCS = path.join(RACINE, "htdocs");
const SORTIE = path.join(HTDOCS, "images", "partage");
const club = JSON.parse(fs.readFileSync(path.join(HTDOCS, "data", "club.json"), "utf8"));

const fichier = (relatif) => pathToFileURL(path.join(HTDOCS, relatif)).href;
const esc = (s) => String(s).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
const jours = "le " + club.schedule.days.map((j) => j.toLowerCase()).join(" et le ");

/* ---------- Les images ---------- */

const imagettes = fs
  .readdirSync(path.join(HTDOCS, "videotheque", "imagettes"))
  .filter((f) => f.endsWith(".webp"))
  .sort()
  .filter((_, i, t) => i % Math.max(1, Math.floor(t.length / 30)) === 0)
  .slice(0, 30)
  .map((f) => fichier(`videotheque/imagettes/${f}`));

const IMAGES = [
  {
    nom: "kannagara",
    photo: "galerie/vie-club/vie-du-club-02.jpg",
    titre: club.name,
    texte: `Cours enfants dès 7 ans et adultes, ${jours}, au ${club.location.venue}`
  },
  {
    nom: "inscription",
    photo: "images/flyer/enfants.jpg",
    titre: "Rejoindre le club",
    texte: `Cours d'essai, inscription et tarifs de la saison ${club.season}`
  },
  {
    nom: "aikido",
    photo: "images/flyer/travail.jpg",
    titre: "L'Aïkido",
    texte: "Art martial japonais sans compétition, accessible à tous"
  },
  {
    nom: "videotheque",
    mosaique: imagettes,
    titre: "Techniques d'aïkido en vidéo",
    texte: "Par attaque, technique, kyu ou sensei, avec ralenti, image par image et mode interrogation"
  }
];

function page(image) {
  const fond = image.mosaique
    ? `<div class="mosaique">${image.mosaique.map((src) => `<img src="${src}" alt="">`).join("")}</div>`
    : `<div class="photo" style="background-image: url('${fichier(image.photo)}')"></div>`;
  return `<!doctype html>
<html lang="fr"><head><meta charset="utf-8"><style>
  html, body { margin: 0; width: 1200px; height: 630px; overflow: hidden; background: #000; }
  body { font-family: "Century Gothic", "Avenir", "Helvetica Neue", sans-serif; color: #fff; }
  .photo { position: absolute; inset: 0; background: right center / cover no-repeat; filter: grayscale(1); }
  .mosaique { position: absolute; inset: -20px; display: grid; grid-template-columns: repeat(6, 1fr); gap: 6px;
    transform: rotate(-4deg) scale(1.08); filter: grayscale(1); }
  .mosaique img { width: 100%; aspect-ratio: 16 / 9; object-fit: cover; display: block; }
  .voile { position: absolute; inset: 0;
    background: linear-gradient(90deg, rgba(0,0,0,0.94) 0%, rgba(0,0,0,0.82) 42%, rgba(0,0,0,0.15) 78%, rgba(0,0,0,0) 100%); }
  .texte { position: absolute; left: 72px; top: 0; bottom: 0; width: 620px;
    display: flex; flex-direction: column; justify-content: center; }
  .logo { width: 104px; height: 104px; border-radius: 50%; background: #fff; display: grid; place-items: center;
    margin-bottom: 30px; }
  .logo img { width: 84px; height: auto; }
  h1 { font-size: 58px; line-height: 1.06; margin: 0; font-weight: 700; }
  .trait { width: 84px; height: 5px; background: #ce3030; margin: 26px 0 22px; }
  p { font-size: 27px; line-height: 1.35; margin: 0; color: rgba(255,255,255,0.9); }
  .site { position: absolute; left: 72px; bottom: 38px; font-size: 22px; letter-spacing: 0.05em; color: #f48a84; }
</style></head><body>
  ${fond}
  <div class="voile"></div>
  <div class="texte">
    <div class="logo"><img src="${fichier("images/logo-kannagara.png")}" alt=""></div>
    <h1>${esc(image.titre)}</h1>
    <div class="trait"></div>
    <p>${esc(image.texte)}</p>
  </div>
  <div class="site">${esc(club.url.replace(/^https?:\/\//, ""))}</div>
</body></html>`;
}

/* ---------- Chrome sans interface, piloté par le protocole DevTools ---------- */

const CHEMINS_CHROME = [
  "C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe",
  "C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe",
  path.join(os.homedir(), "AppData", "Local", "Google", "Chrome", "Application", "chrome.exe"),
  "/Applications/Google Chrome.app/Contents/MacOS/Google Chrome",
  "/usr/bin/google-chrome",
  "/usr/bin/chromium"
];
const chromeExe = process.env.CHROME_PATH || CHEMINS_CHROME.find((c) => fs.existsSync(c));
if (!chromeExe || !fs.existsSync(chromeExe)) {
  console.error("Chrome introuvable. Renseignez la variable d'environnement CHROME_PATH.");
  process.exit(1);
}

const PORT = 9335;
const pause = (ms) => new Promise((r) => setTimeout(r, ms));
// Profil jetable : sans lui, Chrome rejoint la session déjà ouverte de l'utilisateur
const profil = fs.mkdtempSync(path.join(os.tmpdir(), "kannagara-partage-"));
const chrome = spawn(
  chromeExe,
  ["--headless=new", `--remote-debugging-port=${PORT}`, `--user-data-dir=${profil}`, "--allow-file-access-from-files", "--no-first-run", "about:blank"],
  { stdio: "ignore" }
);

let cibles = [];
for (let i = 0; i < 50 && !cibles.find((t) => t.type === "page"); i++) {
  await pause(200);
  cibles = await fetch(`http://127.0.0.1:${PORT}/json`).then((r) => r.json()).catch(() => []);
}
const ws = new WebSocket(cibles.find((t) => t.type === "page").webSocketDebuggerUrl);
await new Promise((r) => (ws.onopen = r));
let n = 0;
const attente = new Map();
ws.onmessage = (m) => {
  const d = JSON.parse(m.data);
  if (d.id && attente.has(d.id)) attente.get(d.id)(d.result);
};
const cdp = (method, params = {}) =>
  new Promise((r) => {
    attente.set(++n, r);
    ws.send(JSON.stringify({ id: n, method, params }));
  });

await cdp("Page.enable");
await cdp("Emulation.setDeviceMetricsOverride", { width: 1200, height: 630, deviceScaleFactor: 1, mobile: false });
fs.mkdirSync(SORTIE, { recursive: true });
const tmp = fs.mkdtempSync(path.join(os.tmpdir(), "kannagara-pages-"));

try {
  for (const image of IMAGES) {
    const html = path.join(tmp, `${image.nom}.html`);
    fs.writeFileSync(html, page(image));
    await cdp("Page.navigate", { url: pathToFileURL(html).href });
    // Photos et polices chargées, puis un temps de rendu
    for (let i = 0; i < 40; i++) {
      const pret = await cdp("Runtime.evaluate", {
        expression: "document.readyState === 'complete' && [...document.images].every((i) => i.complete)",
        returnByValue: true
      });
      if (pret?.result?.value) break;
      await pause(150);
    }
    await pause(400);
    const capture = await cdp("Page.captureScreenshot", { format: "jpeg", quality: 82 });
    const cible = path.join(SORTIE, `${image.nom}.jpg`);
    fs.writeFileSync(cible, Buffer.from(capture.data, "base64"));
    console.log(`  ✓ images/partage/${image.nom}.jpg (${Math.round(fs.statSync(cible).size / 1024)} Ko)`);
  }
} finally {
  ws.close();
  chrome.kill();
}
