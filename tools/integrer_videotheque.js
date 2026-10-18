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
 *     app.js, style.css et donnees.js dès qu'ils changent, malgré le cache d'une semaine ;
 *   - rend la page lisible sans JavaScript, pour Google et les robots des assistants IA
 *     qui n'exécutent pas l'application (74 mots lisibles auparavant) : titre, description,
 *     aperçu de partage, données structurées, titre H1 et liste des techniques en HTML,
 *     remplacée par l'application dès son démarrage.
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
    /* Ouverture du lecteur : son titre s'arrête sous l'en-tête du site et la barre de recherche */
    .lecteur { scroll-margin-top: calc(var(--header-height) + 72px); }
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
    }
    /* Liste des techniques écrite dans la page pour les robots qui n'exécutent pas le
       JavaScript ; l'application la remplace au démarrage. Masquée d'emblée quand le
       JavaScript tourne, pour qu'elle ne s'affiche pas un instant avant l'application. */
    .js .statique { display: none; }
    .statique { max-width: 800px; line-height: 1.6; }
    .statique h2 { margin: 1.5rem 0 0.4rem; font-size: 1.1rem; }
    .statique ul { margin: 0 0 0 1.2rem; }`;

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

/* ---------- Référencement : la page lisible sans JavaScript ---------- */

const CLUB = JSON.parse(fs.readFileSync(path.join(RACINE, "htdocs", "data", "club.json"), "utf8"));
const SITE = CLUB.url.replace(/\/$/, "");
const URL_PAGE = `${SITE}/videotheque/`;
const D = JSON.parse(
  lire("donnees.js")
    .trim()
    .replace(/^window\.DONNEES\s*=\s*/, "")
    .replace(/;$/, "")
);
const esc = (s) => String(s).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
const liste = (noms) => (noms.length > 1 ? noms.slice(0, -1).join(", ") + " et " + noms.at(-1) : noms[0] || "");
const nomNiveau = (n) => (/dan/i.test(n) ? "shodan" : `${parseInt(n, 10)}${parseInt(n, 10) === 1 ? "er" : "e"} kyu`);

// Une technique = position + attaque + technique + sens, comme dans l'application ;
// son niveau est le plus précoce de ses clips (ordre[3] : rang du niveau).
const techniques = new Map();
for (const c of D.clips) {
  const cle = [c.forme, c.attaque, c.technique, c.sens].join("|");
  if (!techniques.has(cle)) techniques.set(cle, { ...c, senseis: new Set() });
  const t = techniques.get(cle);
  if (c.sensei) t.senseis.add(c.sensei);
  if (c.ordre[3] < t.ordre[3]) Object.assign(t, { niveau: c.niveau, ordre: [t.ordre[0], t.ordre[1], t.ordre[2], c.ordre[3]] });
}
const groupes = new Map();
const parOrdre = (a, b) =>
  a.ordre[0] - b.ordre[0] || a.ordre[1] - b.ordre[1] || a.ordre[2] - b.ordre[2] || (a.sens || "").localeCompare(b.sens || "");
for (const t of [...techniques.values()].sort(parOrdre)) {
  const titre = `${t.forme} · ${t.attaque}`;
  if (!groupes.has(titre)) groupes.set(titre, []);
  groupes.get(titre).push(t);
}
const videos = Object.entries(D.videos);
const senseis = [...new Set(D.clips.map((c) => c.sensei).filter(Boolean))].sort((a, b) => a.localeCompare(b, "fr"));
const chaines = [...new Set(videos.map(([, v]) => v.chaine).filter(Boolean))];

const titre = "Techniques d'aïkido en vidéo | Kannagara Guyancourt";
const description =
  `${techniques.size} techniques d'aïkido en vidéo, par attaque, technique, kyu ou sensei : ` +
  "ralenti, image par image et mode interrogation. Vidéothèque du club Kannagara.";
const intro =
  `La vidéothèque du club ${CLUB.name} réunit ${D.clips.length} clips de ${techniques.size} techniques d'aïkido, ` +
  `du 6e kyu au shodan, présentées par ${liste(senseis)}, tirés de ${videos.length} vidéos publiées par ` +
  `${liste(chaines)}. On les retrouve par attaque, par technique, par niveau de kyu ou par sensei, avec ralenti, ` +
  "image par image, miroir et un mode interrogation pour réviser les passages de grade. Les vidéos restent " +
  "hébergées sur YouTube : chaque clip renvoie à la vidéo d'origine.";
const imagePartage = ["videotheque", "kannagara"]
  .map((n) => `images/partage/${n}.jpg`)
  .find((f) => fs.existsSync(path.join(RACINE, "htdocs", f)));
const ogImage = imagePartage ? `${SITE}/${imagePartage}` : CLUB.logo;

const jsonld = {
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  name: "Techniques d'aïkido en vidéo",
  description,
  url: URL_PAGE,
  inLanguage: "fr",
  image: ogImage,
  about: { "@type": "Thing", name: "Aïkido" },
  isPartOf: { "@id": `${SITE}/#website` },
  publisher: { "@type": "SportsClub", "@id": `${SITE}/#organization`, name: CLUB.name, url: `${SITE}/` }
};

const seo = `  <title>${esc(titre)}</title>
  <meta name="description" content="${esc(description)}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="${URL_PAGE}">
  <meta property="og:title" content="${esc(titre)}">
  <meta property="og:description" content="${esc(description)}">
  <meta property="og:image" content="${esc(ogImage)}">
  <meta property="og:locale" content="fr_FR">
  <meta property="og:site_name" content="${esc(CLUB.name)}">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="${esc(titre)}">
  <meta name="twitter:description" content="${esc(description)}">
  <meta name="twitter:image" content="${esc(ogImage)}">
  <script>document.documentElement.classList.add("js")</script>
  <script type="application/ld+json">
${JSON.stringify(jsonld, null, 2).replace(/</g, "\\u003c")}
  </script>`;

const statique = `      <div class="statique">
        <p>${esc(intro)}</p>
${[...groupes]
  .map(
    ([g, ts]) => `        <h2>${esc(g)}</h2>
        <ul>
${ts
  .map(
    (t) =>
      `          <li>${esc(t.technique + (t.sens ? " " + t.sens.toLowerCase() : ""))} : ${esc(nomNiveau(t.niveau))}` +
      `${t.senseis.size ? ", " + esc(liste([...t.senseis].sort((a, b) => a.localeCompare(b, "fr")))) : ""}</li>`
  )
  .join("\n")}
        </ul>`
  )
  .join("\n")}
        <h2>Vidéos d'origine</h2>
        <ul>
${videos.map(([id, v]) => `          <li><a href="https://www.youtube.com/watch?v=${esc(id)}">${esc(v.titre)}</a>, ${esc(v.chaine)}</li>`).join("\n")}
        </ul>
      </div>`;

function remplacerUne(texte, motif, remplacement) {
  const n = texte.split(motif).length - 1;
  if (n !== 1) {
    console.error(`index.html : ${n} occurrence(s) de ${motif} (1 attendue)`);
    process.exit(1);
  }
  return texte.replace(motif, () => remplacement);
}

// En-tête : métadonnées de la vidéothèque, sans sa feuille de style (rajoutée après celles du site),
// ni son titre ni sa description (remplacés par ceux du site, ci-dessus)
const meta = tete[1]
  .split("\n")
  .filter((l) => l.trim() && !/rel="stylesheet"/.test(l) && !/rel="icon"/.test(l))
  .filter((l) => !/<title>/.test(l) && !/name="description"/.test(l))
  .map((l) => "  " + l.trim())
  .join("\n");

let corpsPage = remplacerUne(
  corps[1],
  "<main>",
  `<main>\n    <h1 class="sr-only">Techniques d'aïkido en vidéo : la vidéothèque du club ${esc(CLUB.name)}</h1>`
);
corpsPage = remplacerUne(corpsPage, '<div id="resultats"></div>', `<div id="resultats">\n${statique}\n    </div>`);
const scripts = corpsPage.replace(/(src)="(donnees\.js|app\.js)(?:\?v=[^"]*)?"/g, `$1="$2?v=${version}"`);

const php = `<!doctype html>
<!-- Généré par tools/integrer_videotheque.js depuis la vidéothèque (index.html) : ne pas modifier ici. -->
<html lang="fr">
<head>
${meta}
${seo}
  <link rel="canonical" href="${URL_PAGE}">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <link rel="stylesheet" href="/css/style.css?v=<?= substr(md5_file($_SERVER['DOCUMENT_ROOT'] . '/css/style.css'), 0, 8) ?>">
  <link rel="stylesheet" href="/css/responsive.css?v=<?= substr(md5_file($_SERVER['DOCUMENT_ROOT'] . '/css/responsive.css'), 0, 8) ?>">
  <link rel="stylesheet" href="style.css?v=${version}">
  <style>${STYLE_INTEGRATION}
  </style>
</head>
<body class="page-videotheque">
<?php $active = 'videotheque'; include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
${scripts.trim()}
<script src="/js/main.js?v=<?= substr(md5_file($_SERVER['DOCUMENT_ROOT'] . '/js/main.js'), 0, 8) ?>" defer></script>
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
