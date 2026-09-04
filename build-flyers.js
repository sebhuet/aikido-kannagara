#!/usr/bin/env node
/**
 * Génération des PDF des supports print (affiches, flyers, livret, fléchage)
 *
 * Chaque support est une page HTML de htdocs/ dont la feuille d'impression
 * (@media print) fixe le format A4. Le PDF est produit par Chrome sans interface,
 * qui respecte cette feuille : le texte reste vectoriel. C'est volontairement une
 * autre voie que le bouton « Télécharger le PDF » de la page, qui exporte une
 * image JPEG via html2canvas et perd donc la finesse du texte.
 *
 * Usage: node build-flyers.js              # tous les supports
 *        node build-flyers.js bouygues     # ceux dont le nom contient « bouygues »
 *
 * Prérequis :
 * - Chrome installé. Chemin surchargeable par la variable d'environnement CHROME_PATH.
 * - Un accès réseau : le QR code du pied de page est construit au chargement par le
 *   script qrcodejs servi par cdnjs. Sans réseau, le PDF sort sans QR code, et la
 *   vérification de pages ci-dessous ne le détecte pas.
 */

const fs = require("fs");
const os = require("os");
const path = require("path");
const { execFileSync } = require("child_process");
const { pathToFileURL } = require("url");

const SOURCES_DIR = path.join(__dirname, "htdocs");
const SORTIE_DIR = path.join(__dirname, "flyers");

// Supports à générer. `pages` est le nombre de pages attendu : il sert de garde-fou,
// une feuille d'impression cassée se voyant d'abord au nombre de pages produites.
const SUPPORTS = [
  { source: "affiche-aikido.html", sortie: "affiche-aikido-kannagara.pdf", pages: 1 },
  { source: "affiche-aikido-cse.html", sortie: "affiche-aikido-kannagara-cse.pdf", pages: 1 },
  { source: "affiche-aikido-bouygues.html", sortie: "affiche-aikido-kannagara-bouygues.pdf", pages: 1 },
  { source: "flyer-aikido.html", sortie: "flyer-aikido-kannagara.pdf", pages: 2 },
  { source: "flyer-aikido-bouygues.html", sortie: "flyer-aikido-kannagara-bouygues.pdf", pages: 2 },
  { source: "livret-aikido.html", sortie: "livret-aikido-kannagara.pdf", pages: 4 },
  { source: "flechage-aikido.html", sortie: "flechage-aikido-kannagara.pdf", pages: 5 }
];

// Emplacements usuels de Chrome sous Windows, puis macOS et Linux
const CHEMINS_CHROME = [
  "C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe",
  "C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe",
  path.join(os.homedir(), "AppData", "Local", "Google", "Chrome", "Application", "chrome.exe"),
  "/Applications/Google Chrome.app/Contents/MacOS/Google Chrome",
  "/usr/bin/google-chrome",
  "/usr/bin/chromium"
];

/**
 * Localise l'exécutable Chrome
 */
function trouverChrome() {
  if (process.env.CHROME_PATH) {
    if (!fs.existsSync(process.env.CHROME_PATH)) {
      throw new Error(`CHROME_PATH pointe sur un fichier absent : ${process.env.CHROME_PATH}`);
    }
    return process.env.CHROME_PATH;
  }

  const trouve = CHEMINS_CHROME.find((chemin) => fs.existsSync(chemin));
  if (!trouve) {
    throw new Error("Chrome introuvable. Renseignez la variable d'environnement CHROME_PATH.");
  }
  return trouve;
}

/**
 * Compte les pages d'un PDF produit par Chrome (Skia) sans dépendance externe :
 * chaque page y est un objet « /Type /Page », à ne pas confondre avec l'unique
 * « /Type /Pages » qui les regroupe.
 */
function compterPages(buffer) {
  const occurrences = buffer.toString("latin1").match(/\/Type\s*\/Page[^s]/g);
  return occurrences ? occurrences.length : 0;
}

/**
 * Imprime une page HTML en PDF. Écrit d'abord un fichier temporaire, et ne
 * remplace le PDF en place qu'une fois les vérifications passées : un support
 * déjà livré n'est jamais écrasé par une sortie douteuse.
 */
function imprimer(chrome, support) {
  const source = path.join(SOURCES_DIR, support.source);
  if (!fs.existsSync(source)) {
    throw new Error(`source absente : ${support.source}`);
  }

  const destination = path.join(SORTIE_DIR, support.sortie);
  const temporaire = path.join(SORTIE_DIR, `.tmp-${support.sortie}`);
  // Profil jetable : sans lui, Chrome rejoint la session déjà ouverte de
  // l'utilisateur (« Opening in existing browser session ») et n'imprime rien.
  const profil = fs.mkdtempSync(path.join(os.tmpdir(), "kanna-pdf-"));

  try {
    execFileSync(
      chrome,
      [
        "--headless",
        "--disable-gpu",
        "--no-first-run",
        "--no-pdf-header-footer",
        `--user-data-dir=${profil}`,
        // Laisse le temps aux scripts de cdnjs de construire le QR code
        "--virtual-time-budget=15000",
        // Chemin de sortie absolu obligatoire, sinon Chrome refuse d'écrire
        `--print-to-pdf=${temporaire}`,
        pathToFileURL(source).href
      ],
      { stdio: ["ignore", "ignore", "pipe"] }
    );

    if (!fs.existsSync(temporaire)) {
      throw new Error("Chrome n'a produit aucun fichier");
    }

    const buffer = fs.readFileSync(temporaire);
    if (buffer.subarray(0, 5).toString("latin1") !== "%PDF-") {
      throw new Error("la sortie n'est pas un PDF");
    }

    const pages = compterPages(buffer);
    if (pages !== support.pages) {
      throw new Error(`${pages} page(s) produite(s) au lieu de ${support.pages} attendue(s)`);
    }

    fs.renameSync(temporaire, destination);
    return { pages, taille: buffer.length };
  } catch (erreur) {
    if (fs.existsSync(temporaire)) fs.unlinkSync(temporaire);
    throw erreur;
  } finally {
    fs.rmSync(profil, { recursive: true, force: true });
  }
}

function main() {
  const filtre = process.argv[2];
  const supports = filtre ? SUPPORTS.filter((s) => s.sortie.toLowerCase().includes(filtre.toLowerCase())) : SUPPORTS;

  if (supports.length === 0) {
    console.error(`❌ Aucun support ne correspond à « ${filtre} »`);
    console.error(`   Disponibles : ${SUPPORTS.map((s) => s.sortie).join(", ")}`);
    process.exit(1);
  }

  const chrome = trouverChrome();
  console.log(`🖨️  Génération des PDF print (${supports.length} support(s))`);
  console.log(`   Chrome : ${chrome}\n`);

  let echecs = 0;

  supports.forEach((support) => {
    process.stdout.write(`   ${support.sortie.padEnd(42)} `);
    try {
      const { pages, taille } = imprimer(chrome, support);
      console.log(`✅ ${pages} page(s), ${(taille / 1048576).toFixed(2)} Mo`);
    } catch (erreur) {
      console.log(`❌ ${erreur.message}`);
      echecs += 1;
    }
  });

  if (echecs > 0) {
    console.error(`\n❌ ${echecs} support(s) en échec, les PDF concernés sont inchangés`);
    process.exit(1);
  }

  console.log("\n✨ Supports print à jour dans flyers/");
}

main();
