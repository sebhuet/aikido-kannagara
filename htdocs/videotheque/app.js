"use strict";

/* ================================================================
   Textes (français / anglais)
   ================================================================ */

const TEXTES = {
  fr: {
    titre: "Techniques d'aïkido",
    sousTitre: "Vidéothèque de révision",
    recherche: "Rechercher : technique, attaque, sensei, kyu…",
    hasard: "Au hasard",
    hasardTitre: "Lire une technique au hasard parmi la sélection",
    apropos: "À propos",
    aproposTitre: "À propos de cette vidéothèque",
    filtresTitre: "Choisir dans n'importe quel ordre",
    toutEffacer: "Tout effacer",
    fermer: "Fermer",
    vitesse: "Vitesse",
    boucle: "Boucle",
    miroir: "Miroir",
    enchainer: "Enchaîner",
    imgMoins: "−1 img",
    imgPlus: "+1 img",
    file: "Liste de lecture",
    cPrec: "Clip précédent (P)",
    cSuiv: "Clip suivant (N)",
    cRecul: "Reculer de 2 s (←)",
    cAvance: "Avancer de 2 s (→)",
    cImgPrec: "Image précédente (,)",
    cImgSuiv: "Image suivante (.)",
    cLecture: "Lecture / pause (Espace)",
    cAB: "Boucle sur un passage : 1er clic = début, 2e clic = fin, 3e clic = annuler (B)",
    cBoucle: "Lire le clip en boucle (L)",
    cMiroir: "Image en miroir, pour travailler l'autre côté (M)",
    cEnchainer: "Enchaîner automatiquement le clip suivant de la liste (E)",
    cSon: "Son (S)",
    cPlein: "Plein écran (F)",
    raccourcis:
      "<kbd>Espace</kbd> lecture/pause · <kbd>←</kbd> <kbd>→</kbd> 2 s · <kbd>,</kbd> <kbd>.</kbd> image par image · " +
      "<kbd>↓</kbd> <kbd>↑</kbd> ralentir/accélérer · <kbd>B</kbd> boucle A-B · <kbd>L</kbd> boucle · <kbd>M</kbd> miroir · " +
      "<kbd>E</kbd> enchaîner · <kbd>S</kbd> son · <kbd>F</kbd> plein écran · <kbd>P</kbd> <kbd>N</kbd> clip précédent/suivant",
    regrouper: "Regrouper par",
    vues: { attaque: "Attaque", technique: "Technique", niveau: "Niveau", sensei: "Sensei", tableau: "Tableau des niveaux" },
    facettes: { niveau: "Niveau", forme: "Position", attaque: "Attaque", technique: "Technique", sens: "Forme", sensei: "Sensei", courant: "Fédération / courant" },
    clips: (n) => `${n} clip${n > 1 ? "s" : ""}`,
    toutLire: "Tout lire",
    toutLireTitre: "Lire ces clips à la suite",
    aucun: "Aucun clip pour cette combinaison.",
    retires: (r, v) => `« ${r.join(" », « ")} » retiré${r.length > 1 ? "s" : ""} : aucun clip ne correspondait avec « ${v} ».`,
    retirer: "Retirer ce choix",
    vide: "Aucun clip avec les choix actuels : cliquer pour repartir de celui-ci",
    inconnu: "Sensei non identifié",
    inconnuCourt: "Inconnu",
    nonPrecise: "Non précisé",
    precis: "Début et fin calés à l'image près",
    approx: "Début et fin approximatifs (à la seconde)",
    source: "Source",
    voirYT: "voir sur YouTube",
    chargement: "Chargement…",
    erreurYT: "Vidéo indisponible sur YouTube (retirée, privée ou intégration refusée).",
    erreurLocal: "Les vidéos YouTube ne se lisent pas depuis un fichier ouvert directement : servir le dossier site/ par HTTP (python -m http.server).",
    flash: {
      imgPlus: "+1 image", imgMoins: "−1 image", a: "Début A", ab: "Boucle A-B", abNon: "Boucle A-B annulée",
      boucle: "Boucle", boucleNon: "Boucle désactivée", miroir: "Miroir", miroirNon: "Image normale",
      ench: "Enchaînement", enchNon: "Enchaînement désactivé", suivant: "Clip suivant…", son: "Son", muet: "Muet"
    },
    legende: "Niveau auquel la technique est demandée (FFAB ou FFAAA, le plus précoce des deux)",
    caseTitre: (n, k) => `${n} · ${k}`,
    aproposHtml: `
      <h2>Techniques d'aïkido en vidéo</h2>
      <p>Débutant en aïkido, j'ai rassemblé ces vidéos pour faciliter mes révisions et approfondir mes connaissances. Je les partage dans un esprit d'entraide. Elles m'ont semblé pédagogiques et utiles, mais il existe bien d'autres ressources de grande valeur : cette liste n'est pas exhaustive et je la compléterai au fil de mes découvertes et de vos suggestions.</p>
      <h3>Comment s'en servir</h3>
      <p>Les techniques se retrouvent par attaque, par technique, par niveau de kyu ou par sensei. Les filtres se combinent dans n'importe quel ordre, et la recherche tolère les fautes de frappe (« kotegaesi », « shiho », « 3 kyu », « Habert »…). Chaque clip se lit en boucle ; le ralenti, l'image par image et le miroir aident à décomposer le mouvement.</p>
      <h3>Niveaux</h3>
      <p>Le classement par niveau mêle les progressions techniques FFAAA et FFAB : une technique apparaît à un niveau de kyu dès que l'une des deux fédérations considère qu'elle doit être connue à ce niveau. Cette approche n'est pas entièrement compatible avec les programmes des deux fédérations, mais j'espère qu'elle reste utile.</p>
      <h3>Vidéos</h3>
      <p>Les vidéos appartiennent à leurs auteurs et restent hébergées sur YouTube ; chaque clip renvoie à la vidéo d'origine. Les débuts et fins des clips des vidéos FFAB sont calés automatiquement à l'image près (coupes de montage, bandeaux de titre, fondus) ; les autres sont encore à la seconde près.</p>
      <h3>Contact</h3>
      <p>Remarques et suggestions : <a href="mailto:sebhuet@gmail.com">sebhuet@gmail.com</a></p>`
  },
  en: {
    titre: "Aikido techniques",
    sousTitre: "Video study library",
    recherche: "Search: technique, attack, sensei, kyu…",
    hasard: "Random",
    hasardTitre: "Play a random technique from the selection",
    apropos: "About",
    aproposTitre: "About this library",
    filtresTitre: "Pick in any order",
    toutEffacer: "Clear all",
    fermer: "Close",
    vitesse: "Speed",
    boucle: "Loop",
    miroir: "Mirror",
    enchainer: "Autoplay",
    imgMoins: "−1 fr",
    imgPlus: "+1 fr",
    file: "Playlist",
    cPrec: "Previous clip (P)",
    cSuiv: "Next clip (N)",
    cRecul: "Back 2 s (←)",
    cAvance: "Forward 2 s (→)",
    cImgPrec: "Previous frame (,)",
    cImgSuiv: "Next frame (.)",
    cLecture: "Play / pause (Space)",
    cAB: "Loop a section: 1st click = start, 2nd click = end, 3rd click = cancel (B)",
    cBoucle: "Loop the clip (L)",
    cMiroir: "Mirror image, to practise the other side (M)",
    cEnchainer: "Play the next clip of the list automatically (E)",
    cSon: "Sound (S)",
    cPlein: "Full screen (F)",
    raccourcis:
      "<kbd>Space</kbd> play/pause · <kbd>←</kbd> <kbd>→</kbd> 2 s · <kbd>,</kbd> <kbd>.</kbd> frame by frame · " +
      "<kbd>↓</kbd> <kbd>↑</kbd> slower/faster · <kbd>B</kbd> A-B loop · <kbd>L</kbd> loop · <kbd>M</kbd> mirror · " +
      "<kbd>E</kbd> autoplay · <kbd>S</kbd> sound · <kbd>F</kbd> full screen · <kbd>P</kbd> <kbd>N</kbd> previous/next clip",
    regrouper: "Group by",
    vues: { attaque: "Attack", technique: "Technique", niveau: "Level", sensei: "Sensei", tableau: "Level chart" },
    facettes: { niveau: "Level", forme: "Position", attaque: "Attack", technique: "Technique", sens: "Form", sensei: "Sensei", courant: "Federation / style" },
    clips: (n) => `${n} clip${n > 1 ? "s" : ""}`,
    toutLire: "Play all",
    toutLireTitre: "Play these clips in a row",
    aucun: "No clip for this combination.",
    retires: (r, v) => `“${r.join("”, “")}” removed: no clip matched with “${v}”.`,
    retirer: "Remove this choice",
    vide: "No clip with the current choices: click to start again from this one",
    inconnu: "Unidentified sensei",
    inconnuCourt: "Unknown",
    nonPrecise: "Not specified",
    precis: "Start and end set to the exact frame",
    approx: "Approximate start and end (to the second)",
    source: "Source",
    voirYT: "watch on YouTube",
    chargement: "Loading…",
    erreurYT: "Video unavailable on YouTube (removed, private or embedding disabled).",
    erreurLocal: "YouTube videos do not play from a file opened directly: serve the site/ folder over HTTP (python -m http.server).",
    flash: {
      imgPlus: "+1 frame", imgMoins: "−1 frame", a: "Start A", ab: "A-B loop", abNon: "A-B loop off",
      boucle: "Loop", boucleNon: "Loop off", miroir: "Mirror", miroirNon: "Normal image",
      ench: "Autoplay", enchNon: "Autoplay off", suivant: "Next clip…", son: "Sound on", muet: "Muted"
    },
    legende: "Level at which the technique is required (FFAB or FFAAA, whichever comes first)",
    caseTitre: (n, k) => `${n} · ${k}`,
    aproposHtml: `
      <h2>Aikido techniques on video</h2>
      <p>As a beginner in Aikido, I gathered these videos to help my revisions and deepen my knowledge, and I share them in a spirit of mutual support. They seemed educational and helpful to me, but there are many other valuable resources: this list is not exhaustive and I will expand it as I discover more and with your suggestions.</p>
      <h3>How to use it</h3>
      <p>Techniques can be found by attack, by technique, by kyu level or by sensei. Filters combine in any order and the search tolerates typos (“kotegaesi”, “shiho”, “3 kyu”, “Habert”…). Each clip loops; slow motion, frame by frame and mirror help to break the movement down.</p>
      <h3>Levels</h3>
      <p>The level classification blends the technical progressions of the French federations FFAAA and FFAB: a technique appears at a kyu level as soon as one of the two federations considers it should be known at that level. This may not fully match either syllabus, but I hope it is still helpful.</p>
      <h3>Videos</h3>
      <p>The videos belong to their authors and stay hosted on YouTube; each clip links to the original video. Clips from FFAB videos start and end on the exact frame (edit cuts, title banners and fades are detected automatically); the others are still accurate to the second.</p>
      <h3>Contact</h3>
      <p>Comments and suggestions: <a href="mailto:sebhuet@gmail.com">sebhuet@gmail.com</a></p>`
  }
};

let langue = "fr";
const T = () => TEXTES[langue];

const NIVEAUX = ["6 Kyu", "5 Kyu", "4 Kyu", "3 Kyu", "2 Kyu", "1 Kyu", "1 Dan"];
const COULEUR_NIVEAU = { "6 Kyu": "--n6", "5 Kyu": "--n5", "4 Kyu": "--n4", "3 Kyu": "--n3", "2 Kyu": "--n2", "1 Kyu": "--n1", "1 Dan": "--nd" };

function nomNiveau(n) {
  const k = parseInt(n, 10);
  if (/dan/i.test(n)) return "Shodan";
  if (langue === "en") return `${k}${k === 1 ? "st" : k === 2 ? "nd" : k === 3 ? "rd" : "th"} kyu`;
  return `${k}${k === 1 ? "er" : "e"} kyu`;
}

const FACETTES = [
  { cle: "niveau", ordre: NIVEAUX },
  { cle: "forme", ordre: ["Tachi Waza", "Suwari Waza", "Hanmi Handachi Waza", "Ushiro Waza", "Buki Waza"] },
  { cle: "attaque", ordre: null }, // ordre du classeur
  { cle: "technique", ordre: null },
  { cle: "sens", ordre: ["Omote", "Ura"] },
  { cle: "sensei", ordre: [] },
  { cle: "courant", ordre: ["FFAB", "FFAAA", "Iwama", "?"] }
];

const VUES = ["attaque", "technique", "niveau", "sensei", "tableau"];
const VITESSES = [0.25, 0.5, 0.75, 1];
const PAS_SAUT = 2;

/* ================================================================
   Outils
   ================================================================ */

const $ = (id) => document.getElementById(id);

function el(tag, attrs = {}, ...enfants) {
  const n = document.createElement(tag);
  for (const [k, v] of Object.entries(attrs)) {
    if (v == null || v === false) continue;
    if (k === "class") n.className = v;
    else if (k === "style") n.style.cssText = v;
    else if (k.startsWith("on")) n.addEventListener(k.slice(2), v);
    else n.setAttribute(k, v === true ? "" : v);
  }
  for (const e of enfants.flat()) if (e != null && e !== false) n.append(e.nodeType ? e : document.createTextNode(e));
  return n;
}

function svg(chemin) {
  const s = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  s.setAttribute("viewBox", "0 0 24 24");
  s.setAttribute("aria-hidden", "true");
  const p = document.createElementNS("http://www.w3.org/2000/svg", "path");
  p.setAttribute("d", chemin);
  s.append(p);
  return s;
}
const IC_LECTURE = "M8 5v14l11-7z";
const IC_PAUSE = "M7 5h4v14H7zM13 5h4v14h-4z";
const IC_MUET = "M4 9h4l5-4v14l-5-4H4zM16 9l5 6m0-6l-5 6";
const IC_SON = "M4 9h4l5-4v14l-5-4H4zm12.5-1.5a5 5 0 0 1 0 9M15 10a2.5 2.5 0 0 1 0 4";

function sansAccent(s) {
  return s.normalize("NFD").replace(/[̀-ͯ]/g, "").toLowerCase();
}

function stockage(cle, valeur) {
  try {
    if (valeur === undefined) return localStorage.getItem(cle);
    if (valeur === null) localStorage.removeItem(cle);
    else localStorage.setItem(cle, valeur);
  } catch (e) { /* stockage indisponible : préférences non retenues */ }
  return null;
}

function fmtTemps(s) {
  if (!isFinite(s) || s < 0) s = 0;
  const m = Math.floor(s / 60);
  const r = Math.floor(s % 60);
  return `${m}:${String(r).padStart(2, "0")}`;
}

function fmtTempsFin(s) {
  if (!isFinite(s) || s < 0) s = 0;
  return `${Math.floor(s / 60)}:${(s % 60).toFixed(1).padStart(4, "0")}`;
}

function fmtDuree(s) {
  const m = Math.round(s / 60);
  return m < 1 ? `${Math.round(s)} s` : m < 60 ? `${m} min` : `${Math.floor(m / 60)} h ${String(m % 60).padStart(2, "0")}`;
}

function fmtVitesse(v) {
  return (langue === "fr" ? String(v).replace(".", ",") : String(v)) + "×";
}

/* --- Moteur de recherche --- */

// Mots français ou variantes courantes ramenés au terme japonais
const ALIAS = {
  genou: "suwari", genoux: "suwari", agenou: "suwari", seiza: "suwari",
  debout: "tachi", arriere: "ushiro", derriere: "ushiro", dos: "ushiro",
  saisie: "dori", poignet: "katate", poignets: "ryote", frappe: "uchi",
  arme: "buki", armes: "buki", couteau: "tanto", baton: "jo",
  shodan: "1dan", dan: "1dan", kneeling: "suwari", standing: "tachi", behind: "ushiro",
  weapon: "buki", knife: "tanto", stick: "jo"
};

// Forme canonique : sans accent ni séparateur, lettres doublées simplifiées,
// variantes de transcription unifiées (tori/dori, handashi/handachi, ou/u, shi/chi)
function canon(s) {
  return sansAccent(s)
    .replace(/[^a-z0-9]/g, "")
    .replace(/(.)\1+/g, "$1")
    .replace(/tori/g, "dori")
    .replace(/handashi/g, "handachi")
    .replace(/tenshi/g, "tenchi")
    .replace(/jyu/g, "ju")
    .replace(/ou/g, "u");
}

function jetonsDe(texte) {
  return sansAccent(texte)
    .split(/[\s,;·]+/)
    .map((m) => canon(ALIAS[m.replace(/[^a-z0-9]/g, "")] || m))
    .filter(Boolean);
}

function distance(a, b) {
  const l = Array.from({ length: b.length + 1 }, (_, j) => j);
  for (let i = 1; i <= a.length; i++) {
    let diag = l[0];
    l[0] = i;
    for (let j = 1; j <= b.length; j++) {
      const t = l[j];
      l[j] = Math.min(l[j] + 1, l[j - 1] + 1, diag + (a[i - 1] === b[j - 1] ? 0 : 1));
      diag = t;
    }
  }
  return l[b.length];
}

// Un mot tapé correspond s'il commence un des termes. Seulement s'il n'en commence aucun
// (faute de frappe), on accepte un terme proche : 1 faute dès 4 lettres, 2 dès 8.
function correspond(jeton, clip, exact) {
  if (clip._mots.some((m) => m.startsWith(jeton))) return true;
  if (exact || jeton.length < 4) return false;
  const tol = jeton.length >= 8 ? 2 : 1;
  return clip._mots.some((m) => {
    for (let n = jeton.length - tol; n <= jeton.length + tol; n++) {
      if (n > 0 && n <= m.length && distance(jeton, m.slice(0, n)) <= tol) return true;
    }
    return false;
  });
}

/* ================================================================
   Données
   ================================================================ */

const D = window.DONNEES || { clips: [], senseis: [], videos: {} };

// Compteur par sensei dans une même tuile : « Habert », « Habert 2 »…
const CLIPS = D.clips.map((c) => {
  const champs = [c.forme, c.attaque, c.technique, c.sens, c.sensei, c.courant, c.niveau];
  const mots = new Set();
  for (const ch of champs) {
    if (!ch) continue;
    const m = ch.split(/[\s,]+/).filter(Boolean);
    for (let i = 0; i < m.length; i++) mots.add(canon(m.slice(i).join("")));
  }
  return { ...c, duree: Math.max(0, c.fin - c.debut), _mots: [...mots] };
});
const PAR_ID = new Map(CLIPS.map((c) => [String(c.id), c]));

const RANG = {
  forme: (c) => c.ordre[0],
  attaque: (c) => c.ordre[1],
  technique: (c) => c.ordre[2],
  niveau: (c) => c.ordre[3],
  sens: (c) => ({ Omote: 0, Ura: 1 })[c.sens] ?? 2
};

function comparer(a, b) {
  return (
    a.ordre[0] - b.ordre[0] ||
    a.ordre[1] - b.ordre[1] || a.attaque.localeCompare(b.attaque) ||
    a.ordre[2] - b.ordre[2] || a.technique.localeCompare(b.technique) ||
    RANG.sens(a) - RANG.sens(b) ||
    (a.sensei || "~").localeCompare(b.sensei || "~", "fr") ||
    a.video.localeCompare(b.video) || a.debut - b.debut
  );
}
CLIPS.sort(comparer);

// Valeurs de chaque facette, dans l'ordre du classeur
const valeurs = {};
for (const f of FACETTES) {
  const vus = new Map();
  for (const c of CLIPS) {
    const v = c[f.cle];
    if (!v) continue;
    const r = f.ordre && f.ordre.length ? f.ordre.indexOf(v) : RANG[f.cle] ? RANG[f.cle](c) : 0;
    if (!vus.has(v)) vus.set(v, r === -1 ? 999 : r);
  }
  valeurs[f.cle] = [...vus.keys()].sort((a, b) => vus.get(a) - vus.get(b) || a.localeCompare(b, "fr"));
}

function libelle(cle, val) {
  if (cle === "niveau") return nomNiveau(val);
  if (cle === "courant" && val === "?") return T().nonPrecise;
  if (cle === "sensei" && !val) return T().inconnu;
  return val;
}

/* ================================================================
   État et filtrage
   ================================================================ */

const sel = new Map(); // ordre d'insertion = ordre de choix
let requete = "";
let vue = "attaque";

function filtrer({ sauf = null, avecRecherche = true } = {}) {
  const t = avecRecherche ? jetonsDe(requete).map((j) => [j, CLIPS.some((c) => c._mots.some((m) => m.startsWith(j)))]) : [];
  return CLIPS.filter((c) => {
    for (const [k, val] of sel) if (k !== sauf && c[k] !== val) return false;
    return t.every(([j, exact]) => correspond(j, c, exact));
  });
}

function choisir(cle, val) {
  if (sel.has(cle) && sel.get(cle) === val) {
    sel.delete(cle);
  } else {
    sel.delete(cle);
    sel.set(cle, val);
    // Choix incompatible avec les précédents : on retire les plus anciens jusqu'à
    // retrouver au moins un clip, plutôt que d'afficher une liste vide.
    const retires = [];
    while (filtrer({ avecRecherche: false }).length === 0) {
      const autre = [...sel.keys()].find((k) => k !== cle);
      if (!autre) break;
      retires.push(libelle(autre, sel.get(autre)));
      sel.delete(autre);
    }
    if (retires.length) annoncer(T().retires(retires, libelle(cle, val)));
  }
  majTout();
}

let minuteurAnnonce;
function annoncer(texte) {
  const a = $("annonce");
  a.textContent = texte;
  a.classList.add("visible");
  clearTimeout(minuteurAnnonce);
  minuteurAnnonce = setTimeout(() => a.classList.remove("visible"), 5000);
}

/* ================================================================
   Facettes et vues
   ================================================================ */

const puces = {}; // cle -> Map(val -> bouton)

function construireFacettes() {
  const conteneur = $("facettes");
  conteneur.replaceChildren();
  for (const f of FACETTES) {
    puces[f.cle] = new Map();
    if (valeurs[f.cle].length < 2) continue; // un seul choix possible : facette inutile
    const liste = el("div", { class: "puces", role: "group", "aria-labelledby": `f-${f.cle}` });
    for (const val of valeurs[f.cle]) {
      const b = el(
        "button",
        { class: "puce", type: "button", "aria-pressed": "false", onclick: () => choisir(f.cle, val) },
        f.cle === "niveau" ? el("i", { class: "puce__niveau", style: `background: var(${COULEUR_NIVEAU[val]})` }) : null,
        el("span", {}, libelle(f.cle, val)),
        el("span", { class: "puce__nb" }, "0")
      );
      puces[f.cle].set(val, b);
      liste.append(b);
    }
    conteneur.append(el("section", { class: "facette" }, el("h3", { id: `f-${f.cle}` }, T().facettes[f.cle]), liste));
  }
}

function majFacettes() {
  for (const f of FACETTES) {
    const base = filtrer({ sauf: f.cle });
    const n = new Map();
    for (const c of base) n.set(c[f.cle], (n.get(c[f.cle]) || 0) + 1);
    for (const [val, b] of puces[f.cle]) {
      const actif = sel.has(f.cle) && sel.get(f.cle) === val;
      const nb = n.get(val) || 0;
      b.setAttribute("aria-pressed", String(actif));
      b.classList.toggle("vide", !actif && nb === 0);
      b.querySelector(".puce__nb").textContent = nb;
      b.title = !actif && nb === 0 ? T().vide : "";
    }
  }
}

function construireVues() {
  $("vues").replaceChildren(
    el("span", { class: "vues__libelle" }, T().regrouper),
    ...VUES.map((v) =>
      el("button", { class: "vue", type: "button", "data-vue": v, "aria-pressed": String(v === vue), onclick: () => changerVue(v) }, T().vues[v])
    )
  );
}

function changerVue(v) {
  vue = v;
  document.querySelectorAll("#vues .vue").forEach((b) => b.setAttribute("aria-pressed", String(b.dataset.vue === v)));
  majResultats();
  ecrireAdresse();
}

/* ================================================================
   Résultats
   ================================================================ */

let resultats = [];

// Pour chaque vue : clé et titre de section, clé de tuile, nom et contexte de la tuile
const REGROUPEMENTS = {
  attaque: {
    section: (c) => [c.forme, c.attaque],
    tuile: (c) => [c.technique, c.sens],
    ctx: () => null
  },
  technique: {
    section: (c) => [c.technique],
    tuile: (c) => [c.forme, c.attaque, c.sens],
    ctx: (c) => c.forme,
    nom: (c) => c.attaque
  },
  niveau: {
    section: (c) => [nomNiveau(c.niveau)],
    tuile: (c) => [c.forme, c.attaque, c.technique, c.sens],
    ctx: (c) => `${c.forme} · ${c.attaque}`,
    tri: (a, b) => a.ordre[3] - b.ordre[3] || comparer(a, b)
  },
  sensei: {
    section: (c) => [c.sensei || T().inconnu],
    tuile: (c) => [c.forme, c.attaque, c.technique, c.sens],
    ctx: (c) => `${c.forme} · ${c.attaque}`,
    tri: (a, b) => (a.sensei || "~").localeCompare(b.sensei || "~", "fr") || comparer(a, b)
  }
};

function majResultats() {
  resultats = filtrer();
  const R = REGROUPEMENTS[vue];
  if (R?.tri) resultats = [...resultats].sort(R.tri);

  const total = resultats.reduce((a, c) => a + c.duree, 0);
  $("resume").replaceChildren(
    el("span", { class: "resume__nb" }, T().clips(resultats.length)),
    resultats.length > 1 ? boutonToutLire(resultats, true, total) : null,
    ...[...sel].map(([k, val]) =>
      el(
        "button",
        { class: "etiquette", type: "button", title: T().retirer, onclick: () => choisir(k, val) },
        libelle(k, val),
        el("span", { "aria-hidden": "true" }, "×")
      )
    )
  );

  const zone = $("resultats");
  if (!resultats.length) {
    zone.replaceChildren(
      el("div", { class: "vide-etat" }, el("p", {}, T().aucun), el("button", { class: "bouton", type: "button", onclick: toutEffacer }, T().toutEffacer))
    );
    return;
  }
  if (vue === "tableau") {
    zone.replaceChildren(tableau(resultats));
    return;
  }

  const sections = new Map();
  for (const c of resultats) {
    const s = R.section(c);
    const cs = s.join("|");
    if (!sections.has(cs)) sections.set(cs, { titre: s.filter(Boolean).join(" · "), tuiles: new Map() });
    const t = sections.get(cs).tuiles;
    const ct = R.tuile(c).join("|");
    if (!t.has(ct)) t.set(ct, []);
    t.get(ct).push(c);
  }

  const frag = document.createDocumentFragment();
  for (const s of sections.values()) {
    const clipsSection = [...s.tuiles.values()].flat();
    const nb = clipsSection.length;
    const tuiles = el("div", { class: "tuiles" });
    for (const versions of s.tuiles.values()) tuiles.append(tuile(versions, R, clipsSection));
    frag.append(
      el(
        "section",
        { class: "groupe" },
        el(
          "div",
          { class: "groupe__tete" },
          el("h3", { class: "groupe__titre" }, s.titre),
          el("small", {}, T().clips(nb)),
          nb > 1 ? boutonToutLire(clipsSection) : null
        ),
        tuiles
      )
    );
  }
  zone.replaceChildren(frag);
  majSurlignage();
}

function nomVersion(c, versions) {
  const memes = versions.filter((x) => x.sensei === c.sensei);
  const base = c.sensei || T().inconnuCourt;
  return memes.length > 1 ? `${base} ${memes.indexOf(c) + 1}` : base;
}

function imageClip(c) {
  return c.imagette || `https://i.ytimg.com/vi/${c.video}/mqdefault.jpg`;
}

// Une tuile par technique : imagette du premier clip, un bouton par version
// (sensei) ; survoler un bouton montre son imagette
function tuile(versions, R, liste) {
  const v0 = versions[0];
  const nom = R.nom ? R.nom(v0) : v0.technique;
  const image = el(
    "button",
    { class: "tuile__image", type: "button", "aria-label": `${nom} ${v0.sens || ""} ${v0.sensei || ""}`, onclick: () => ouvrir(v0, liste) },
    vignette(v0),
    el("span", { class: "tuile__lecture", "aria-hidden": "true" }, svg(IC_LECTURE)),
    vue !== "niveau"
      ? el("span", { class: "tuile__niveau" }, el("i", { style: `background: var(${COULEUR_NIVEAU[v0.niveau]})` }), nomNiveau(v0.niveau))
      : null,
    el("span", { class: "tuile__duree" }, fmtTemps(v0.duree))
  );
  const montrer = (c) => {
    const img = image.querySelector("img.vignette");
    if (img) img.src = imageClip(c);
    image.querySelector(".tuile__duree").textContent = fmtTemps(c.duree);
  };
  const ctx = R.ctx(v0);
  return el(
    "article",
    { class: "tuile", "data-ids": versions.map((c) => c.id).join(" ") },
    image,
    el(
      "div",
      { class: "tuile__corps" },
      ctx ? el("div", { class: "tuile__ctx" }, ctx) : null,
      el("div", { class: "tuile__nom" }, nom, badgeSens(v0.sens)),
      el(
        "div",
        { class: "tuile__versions" },
        versions.map((c) =>
          el(
            "button",
            {
              class: "lire",
              type: "button",
              "data-id": c.id,
              title: [c.sensei, c.courant !== "?" ? c.courant : null, fmtTemps(c.duree)].filter(Boolean).join(" · "),
              onclick: () => ouvrir(c, liste),
              onmouseenter: versions.length > 1 ? () => montrer(c) : null,
              onmouseleave: versions.length > 1 ? () => montrer(v0) : null
            },
            svg(IC_LECTURE),
            nomVersion(c, versions)
          )
        )
      )
    )
  );
}

function vignette(c) {
  return el("img", { loading: "lazy", decoding: "async", class: "vignette", src: imageClip(c), alt: "" });
}

function boutonToutLire(liste, fort = false, total = 0) {
  return el(
    "button",
    { class: "tout-lire" + (fort ? " tout-lire--fort" : ""), type: "button", title: T().toutLireTitre, onclick: () => lireTout(liste) },
    svg(IC_LECTURE),
    fort && total ? `${T().toutLire} · ${fmtDuree(total)}` : T().toutLire
  );
}

function badgeSens(sens) {
  if (!sens) return null;
  return el("span", { class: `sens sens--${sansAccent(sens)}` }, sens);
}

/* --- Tableau attaque × technique, coloré par niveau --- */

function tableau(liste) {
  const lignes = new Map(); // forme -> attaque -> technique -> clips
  const colonnes = new Map();
  for (const c of liste) {
    if (!lignes.has(c.forme)) lignes.set(c.forme, new Map());
    const f = lignes.get(c.forme);
    if (!f.has(c.attaque)) f.set(c.attaque, new Map());
    const a = f.get(c.attaque);
    if (!a.has(c.technique)) a.set(c.technique, []);
    a.get(c.technique).push(c);
    if (!colonnes.has(c.technique)) colonnes.set(c.technique, c.ordre[2]);
  }
  const techs = [...colonnes.keys()].sort((x, y) => colonnes.get(x) - colonnes.get(y) || x.localeCompare(y));
  const corps = el("tbody");
  for (const [forme, attaques] of lignes) {
    corps.append(el("tr", { class: "forme" }, el("th", { colspan: techs.length + 1 }, forme)));
    for (const [attaque, parTech] of attaques) {
      const tr = el("tr", {}, el("th", { scope: "row" }, attaque));
      for (const t of techs) {
        const clips = parTech.get(t);
        if (!clips) { tr.append(el("td", {}, el("span", { class: "case" }))); continue; }
        const niv = clips.reduce((m, c) => (c.ordre[3] < m.ordre[3] ? c : m)).niveau;
        tr.append(
          el(
            "td",
            {},
            el(
              "button",
              {
                class: "case",
                type: "button",
                "data-n": niv,
                style: `background: var(${COULEUR_NIVEAU[niv]})`,
                title: `${forme} · ${attaque} · ${t}\n${nomNiveau(niv)} · ${T().clips(clips.length)}`,
                onclick: () => lireTout(clips, false)
              },
              clips.length
            )
          )
        );
      }
      corps.append(tr);
    }
  }
  const tete = el("thead", {}, el("tr", {}, el("th", {}), ...techs.map((t) => el("th", { scope: "col" }, el("span", {}, t)))));
  return el(
    "div",
    {},
    el("div", { class: "tableau-zone" }, el("table", { class: "tableau" }, tete, corps)),
    el(
      "p",
      { class: "legende" },
      T().legende + " :",
      ...NIVEAUX.map((n) => el("span", {}, el("i", { style: `background: var(${COULEUR_NIVEAU[n]})` }), nomNiveau(n)))
    )
  );
}

function toutEffacer() {
  sel.clear();
  requete = "";
  $("q").value = "";
  majTout();
}

/* ================================================================
   Adresse (#…) : garde la sélection, la vue et le clip en cours
   ================================================================ */

function lireAdresse() {
  const p = new URLSearchParams(location.hash.slice(1));
  sel.clear();
  for (const f of FACETTES) if (p.has(f.cle) && valeurs[f.cle].includes(p.get(f.cle))) sel.set(f.cle, p.get(f.cle));
  requete = p.get("q") || "";
  $("q").value = requete;
  if (VUES.includes(p.get("vue"))) vue = p.get("vue");
  return p.get("c");
}

function ecrireAdresse() {
  const p = new URLSearchParams();
  if (vue !== "attaque") p.set("vue", vue);
  for (const [k, v] of sel) p.set(k, v);
  if (requete) p.set("q", requete);
  if (courante()) p.set("c", courante().id);
  const h = p.toString();
  history.replaceState(history.state, "", h ? "#" + h : location.pathname + location.search);
}

function majTout() {
  majFacettes();
  majResultats();
  // La liste de lecture suit les filtres tant que le clip en cours en fait partie
  const c = courante();
  if (c) {
    const i = resultats.indexOf(c);
    if (i !== -1) { L.liste = resultats; L.index = i; }
    majNavigation();
    majFile();
  }
  ecrireAdresse();
}

/* ================================================================
   Lecteur YouTube
   ================================================================ */

const L = { liste: [], index: -1, vitesse: 1, a: null, b: null, miroir: false, boucle: true, enchainer: false, muet: true };

// Le lecteur YouTube ne donne le temps courant qu'à chaque message reçu de
// l'iframe (quelques fois par seconde) : entre deux messages, on extrapole
// pour couper la boucle à l'image près.
const Y = {
  player: null,
  pret: null,
  video: null,
  etat: -1,
  t: 0,
  quand: 0,
  cible: null, // dernier saut demandé, en attente de confirmation
  cibleQuand: 0,
  vitesse: 1,
  erreur: false
};
const LECTURE = 1, PAUSE = 2, FINI = 0, ATTENTE = 3;
let minuteurSuite;
let minuteurDemarrage;

function courante() {
  return L.liste[L.index] || null;
}

function fpsDe(c) {
  return c.fps || 25;
}
const imageDe = (c, t) => Math.floor(t * fpsDe(c) + 1e-3);
const tempsDe = (c, i) => (i + 0.3) / fpsDe(c); // un peu après le début de l'image i
const imgDebut = (c) => Math.round(c.debut * fpsDe(c));
const imgFin = (c) => Math.round(c.fin * fpsDe(c)); // première image non montrée
// Seuil de fin : juste avant l'image qui suit le clip, pour ne jamais la montrer.
// La marge couvre le délai entre notre demande de saut et sa prise en compte par
// le lecteur (environ 30 ms), d'autant plus court en temps vidéo qu'on ralentit.
const seuilFin = (c) => imgFin(c) / fpsDe(c) - Math.max(0.006, 0.03 * L.vitesse);

function preparerYouTube() {
  if (Y.pret) return Y.pret;
  Y.pret = new Promise((ok) => {
    window.onYouTubeIframeAPIReady = () => {
      const vars = {
        controls: 0, disablekb: 1, fs: 0, rel: 0, iv_load_policy: 3, playsinline: 1,
        modestbranding: 1, cc_load_policy: 0, autoplay: 1, mute: 1, enablejsapi: 1
      };
      if (location.origin && location.origin !== "null") vars.origin = location.origin;
      Y.player = new YT.Player("yt", {
        host: "https://www.youtube-nocookie.com",
        width: "100%",
        height: "100%",
        playerVars: vars,
        events: {
          onReady: () => ok(Y.player),
          onStateChange: surEtat,
          onPlaybackRateChange: (e) => (Y.vitesse = e.data),
          onError: () => {
            Y.erreur = true;
            attente(T().erreurYT);
          }
        }
      });
    };
    document.head.append(el("script", { src: "https://www.youtube.com/iframe_api" }));
  });
  return Y.pret;
}

function surEtat(e) {
  Y.etat = e.data;
  Y.t = Y.player.getCurrentTime();
  Y.quand = performance.now();
  // La vidéo est là dès qu'elle change d'état, même si la lecture automatique
  // a été bloquée par le navigateur : on ne masque plus l'image.
  if (e.data !== ATTENTE && Y.video) attente(null);
  if (e.data === FINI) finDeClip();
  majBoutonLecture();
}

// Temps courant estimé, en secondes dans la vidéo YouTube
function tempsYT() {
  const p = Y.player;
  if (!p || !p.getCurrentTime) return 0;
  const t = p.getCurrentTime();
  const now = performance.now();
  if (Y.cible != null) {
    // Tant que l'iframe n'a pas confirmé le saut, on part de la cible
    if (Math.abs(t - Y.cible) < 0.6 || now - Y.cibleQuand > 1500) {
      Y.cible = null;
    } else {
      return Y.cible + (Y.etat === LECTURE ? ((now - Y.cibleQuand) / 1000) * Y.vitesse : 0);
    }
  }
  if (t !== Y.t) {
    Y.t = t;
    Y.quand = now;
  }
  return Y.etat === LECTURE ? Y.t + ((now - Y.quand) / 1000) * Y.vitesse : Y.t;
}

function sauter(t) {
  if (!Y.player) return;
  Y.player.seekTo(t, true);
  Y.cible = t;
  Y.cibleQuand = performance.now();
  Y.t = t;
  Y.quand = Y.cibleQuand;
}

function attente(texte) {
  const a = $("l-attente");
  a.hidden = !texte;
  a.textContent = texte || "";
}

function lireTout(liste, ench = true) {
  if (ench) basculerEnchainer(true);
  ouvrir(liste[0], liste);
}

let fileAffichee = null;
function majFile() {
  const zone = $("l-file");
  const conteneur = $("l-file-liste");
  if (L.liste.length < 2) {
    zone.hidden = true;
    fileAffichee = null;
    return;
  }
  zone.hidden = false;
  if (fileAffichee !== L.liste) {
    fileAffichee = L.liste;
    const total = L.liste.reduce((a, c) => a + c.duree, 0);
    $("l-file-info").textContent = `${T().clips(L.liste.length)} · ${fmtDuree(total)}`;
    conteneur.replaceChildren(
      ...L.liste.map((c, i) =>
        el(
          "button",
          { class: "file__item", type: "button", onclick: () => { L.index = i; charger(true); } },
          el("span", { class: "file__vignette" }, vignette(c)),
          el("span", { class: "file__nom" }, `${c.technique}${c.sens ? " " + c.sens : ""}`),
          el("span", { class: "file__sous" }, [c.forme, c.attaque, c.sensei].filter(Boolean).join(" · "))
        )
      )
    );
  }
  const items = [...conteneur.children];
  items.forEach((b, i) => b.classList.toggle("en-cours", i === L.index));
  const c = items[L.index];
  if (c) conteneur.scrollTo({ left: c.offsetLeft - (conteneur.clientWidth - c.offsetWidth) / 2, behavior: "smooth" });
}

function ouvrir(c, liste = resultats) {
  let i = liste.indexOf(c);
  if (i === -1) { liste = [c]; i = 0; }
  L.liste = liste;
  L.index = i;
  const lecteur = $("lecteur");
  const etaitCache = lecteur.hidden;
  // Une entrée d'historique par ouverture : le bouton Retour du téléphone ferme le lecteur
  if (etaitCache) history.pushState({ lecteur: true }, "", location.href);
  lecteur.hidden = false;
  document.documentElement.classList.add("lecteur-ouvert");
  charger(true);
  if (getComputedStyle(lecteur).position === "fixed") {
    if (etaitCache) lecteur.scrollTop = 0;
    return;
  }
  const r = lecteur.getBoundingClientRect();
  if (etaitCache || r.top < 0 || r.top > innerHeight * 0.5) lecteur.scrollIntoView({ behavior: "smooth", block: "start" });
}

async function charger(lire) {
  const c = courante();
  if (!c) return;
  clearTimeout(minuteurSuite);
  L.a = L.b = null;
  majAB();
  afficherInfos(c);

  if (location.protocol === "file:") {
    attente(T().erreurLocal);
    return;
  }
  if (!Y.player) attente(T().chargement);
  const p = await preparerYouTube();
  if (courante() !== c) return; // un autre clip a été demandé entre-temps
  Y.erreur = false;
  const debut = tempsDe(c, imgDebut(c));
  if (Y.video === c.video) {
    sauter(debut);
    if (lire) p.playVideo();
  } else {
    Y.video = c.video;
    attente(T().chargement);
    p.loadVideoById({ videoId: c.video, startSeconds: debut });
    Y.cible = debut;
    Y.cibleQuand = performance.now();
    if (!lire) p.pauseVideo();
    // Lecture automatique refusée (vidéo restée « non commencée ») : on relance,
    // puis on rend l'image visible quoi qu'il arrive ; le bouton Lecture reste là.
    clearTimeout(minuteurDemarrage);
    minuteurDemarrage = setTimeout(() => {
      if (courante() !== c) return;
      if (lire && Y.etat !== LECTURE) p.playVideo();
      setTimeout(() => courante() === c && !Y.erreur && attente(null), 2500);
    }, 2000);
  }
  p.setPlaybackRate(L.vitesse);
  if (L.muet) p.mute(); else p.unMute();
}

function afficherInfos(c) {
  $("l-ctx").textContent = `${c.forme} · ${c.attaque}`;
  $("l-titre").replaceChildren(c.technique, badgeSens(c.sens) || "");
  $("l-source").textContent = [c.sensei || T().inconnu, c.courant !== "?" ? c.courant : null, nomNiveau(c.niveau)].filter(Boolean).join(" · ");

  // Autres versions de la même technique (autres sensei)
  const versions = CLIPS.filter(
    (x) => x.forme === c.forme && x.attaque === c.attaque && x.technique === c.technique && x.sens === c.sens
  );
  const boutons = () =>
    versions.length > 1
      ? versions.map((x) =>
          el(
            "button",
            { class: "lire" + (x === c ? " en-cours" : ""), type: "button", onclick: () => changerVersion(x) },
            svg(IC_LECTURE),
            nomVersion(x, versions)
          )
        )
      : [];
  $("l-versions").replaceChildren(...boutons());
  $("l-versions-bas").replaceChildren(...boutons());

  const prec = $("l-precision");
  prec.className = "precision" + (c.precis ? "" : " precision--approx");
  prec.replaceChildren(el("i"), c.precis ? T().precis : T().approx);
  const v = D.videos[c.video];
  const lien = `https://www.youtube.com/watch?v=${c.video}&t=${Math.floor(c.debut)}s`;
  $("l-origine").replaceChildren(
    `${T().source} : `,
    el("a", { href: lien, target: "_blank", rel: "noopener" }, v?.titre || T().voirYT),
    v?.chaine ? ` · ${v.chaine}` : ""
  );

  majNavigation();
  majFile();
  majSurlignage();
  ecrireAdresse();
  document.title = `${c.technique}${c.sens ? " " + c.sens : ""} · ${c.attaque} · ${T().titre}`;
}

function changerVersion(x) {
  if (x === courante()) return;
  let i = L.liste.indexOf(x);
  if (i === -1) {
    L.liste = [...L.liste];
    L.liste.splice(L.index + 1, 0, x);
    i = L.index + 1;
  }
  L.index = i;
  charger(true);
}

function majNavigation() {
  $("c-prec").disabled = L.index <= 0;
  $("c-suiv").disabled = L.index >= L.liste.length - 1;
  $("l-pos").textContent = L.liste.length > 1 ? `${L.index + 1} / ${L.liste.length}` : "";
}

function majSurlignage() {
  const id = String(courante()?.id ?? "");
  document.querySelectorAll("#resultats .lire").forEach((b) => b.classList.toggle("en-cours", b.dataset.id === id));
  document.querySelectorAll("#resultats .tuile").forEach((t) => t.classList.toggle("active", !!id && t.dataset.ids.split(" ").includes(id)));
}

function aller(delta) {
  const i = L.index + delta;
  if (i < 0 || i >= L.liste.length) return;
  L.index = i;
  charger(true);
}

function fermer() {
  if (history.state?.lecteur) history.back();
  else fermerLecteur();
}

function fermerLecteur() {
  if ($("lecteur").hidden) return;
  clearTimeout(minuteurSuite);
  const id = String(courante()?.id ?? "");
  Y.player?.pauseVideo?.();
  L.liste = [];
  L.index = -1;
  $("lecteur").hidden = true;
  document.documentElement.classList.remove("lecteur-ouvert");
  if (document.fullscreenElement) document.exitFullscreen();
  majSurlignage();
  ecrireAdresse();
  document.title = `${T().titre} · ${T().sousTitre}`;
  if (!id || !matchMedia("(max-width: 900px)").matches) return;
  const t = [...document.querySelectorAll("#resultats .tuile")].find((x) => x.dataset.ids.split(" ").includes(id));
  t?.scrollIntoView({ block: "center" });
}

/* --- Boucle de surveillance : fin du clip, boucle A-B, affichage du temps --- */

function surveiller() {
  const c = courante();
  if (c && Y.player && !Y.erreur && Y.video === c.video) {
    const t = tempsYT();
    if (Y.etat === LECTURE && Y.cible == null) {
      if (L.a != null && L.b != null && (t >= L.b || t < L.a - 0.1)) sauter(L.a);
      else if (t >= seuilFin(c)) finDeClip();
      else if (t < c.debut - 0.3) sauter(tempsDe(c, imgDebut(c)));
    }
    majTemps(t);
  }
  requestAnimationFrame(surveiller);
}

function finDeClip() {
  const c = courante();
  if (!c) return;
  if (L.boucle) {
    sauter(tempsDe(c, imgDebut(c)));
    Y.player.playVideo();
  } else if (L.enchainer && L.index < L.liste.length - 1) {
    Y.player.pauseVideo();
    flash(T().flash.suivant);
    minuteurSuite = setTimeout(() => aller(1), 600);
  } else {
    Y.player.pauseVideo();
    sauter(tempsDe(c, imgFin(c) - 1));
  }
}

function basculerLecture() {
  if (!Y.player) return;
  if (Y.etat === LECTURE || Y.etat === ATTENTE) Y.player.pauseVideo();
  else {
    const c = courante();
    const t = tempsYT();
    if (c && (t >= seuilFin(c) - 0.01 || t < c.debut - 0.1)) sauter(tempsDe(c, imgDebut(c)));
    Y.player.playVideo();
  }
}

function deplacer(sec) {
  const c = courante();
  if (!c || !Y.player) return;
  const t = Math.min(Math.max(c.debut, tempsYT() + sec), tempsDe(c, imgFin(c) - 1));
  sauter(t);
}

function image(sens) {
  const c = courante();
  if (!c || !Y.player) return;
  Y.player.pauseVideo();
  Y.etat = PAUSE;
  const i = Math.min(Math.max(imgDebut(c), imageDe(c, tempsYT()) + sens), imgFin(c) - 1);
  sauter(tempsDe(c, i));
  flash(sens > 0 ? T().flash.imgPlus : T().flash.imgMoins);
}

function regler(v) {
  L.vitesse = v;
  Y.player?.setPlaybackRate?.(v);
  document.querySelectorAll("#c-vitesses .cmd").forEach((b) => b.setAttribute("aria-pressed", String(Number(b.dataset.v) === v)));
}

function vitesseRelative(sens) {
  const i = VITESSES.indexOf(L.vitesse);
  const j = Math.min(Math.max(0, i + sens), VITESSES.length - 1);
  regler(VITESSES[j]);
  flash(fmtVitesse(VITESSES[j]));
}

function basculerAB() {
  const t = tempsYT();
  if (L.a == null) { L.a = t; flash(T().flash.a); }
  else if (L.b == null) {
    if (Math.abs(t - L.a) < 0.05) return;
    [L.a, L.b] = t > L.a ? [L.a, t] : [t, L.a];
    sauter(L.a);
    flash(T().flash.ab);
    if (Y.etat !== LECTURE) Y.player.playVideo();
  } else { L.a = L.b = null; flash(T().flash.abNon); }
  majAB();
}

function majAB() {
  const b = $("c-ab");
  b.textContent = L.a == null ? "A-B" : L.b == null ? "A → B ?" : "A-B ✓";
  b.setAttribute("aria-pressed", String(L.a != null));
  const zone = $("l-zone");
  const c = courante();
  if (L.a == null || !c || !c.duree) { zone.hidden = true; return; }
  zone.hidden = false;
  const fin = L.b == null ? L.a : L.b;
  zone.style.left = ((L.a - c.debut) / c.duree) * 100 + "%";
  zone.style.width = Math.max(0, ((fin - L.a) / c.duree) * 100) + "%";
}

function basculerBoucle() {
  L.boucle = !L.boucle;
  $("c-boucle").setAttribute("aria-pressed", String(L.boucle));
  stockage("aikido.boucle", L.boucle ? "1" : "0");
  flash(L.boucle ? T().flash.boucle : T().flash.boucleNon);
}

function basculerEnchainer(forcer) {
  const avant = L.enchainer;
  L.enchainer = typeof forcer === "boolean" ? forcer : !L.enchainer;
  $("c-enchainer").setAttribute("aria-pressed", String(L.enchainer));
  // Enchaîner prime sur la boucle du clip
  if (L.enchainer && L.boucle) {
    L.boucle = false;
    $("c-boucle").setAttribute("aria-pressed", "false");
  }
  if (avant !== L.enchainer && !$("lecteur").hidden) flash(L.enchainer ? T().flash.ench : T().flash.enchNon);
}

function basculerMiroir() {
  L.miroir = !L.miroir;
  $("l-video").classList.toggle("miroir", L.miroir);
  $("c-miroir").setAttribute("aria-pressed", String(L.miroir));
  flash(L.miroir ? T().flash.miroir : T().flash.miroirNon);
}

function basculerSon(forcer) {
  L.muet = typeof forcer === "boolean" ? forcer : !L.muet;
  stockage("aikido.muet", L.muet ? "1" : "0");
  if (Y.player?.mute) L.muet ? Y.player.mute() : Y.player.unMute();
  $("c-son").setAttribute("aria-pressed", String(!L.muet));
  $("c-son-ic").setAttribute("d", L.muet ? IC_MUET : IC_SON);
}

function pleinEcran() {
  const e = $("l-ecran");
  if (document.fullscreenElement || document.webkitFullscreenElement) {
    (document.exitFullscreen || document.webkitExitFullscreen).call(document);
  } else if (e.requestFullscreen) {
    e.requestFullscreen().then(() => screen.orientation?.lock?.("landscape").catch(() => {})).catch(() => {});
  } else if (e.webkitRequestFullscreen) e.webkitRequestFullscreen();
}

let minuteurFlash;
function flash(texte) {
  const f = $("l-flash");
  f.textContent = texte;
  f.classList.add("visible");
  clearTimeout(minuteurFlash);
  minuteurFlash = setTimeout(() => f.classList.remove("visible"), 500);
}

function majTemps(t) {
  const c = courante();
  if (!c) return;
  const pos = Math.min(Math.max(0, t - c.debut), c.duree);
  const p = $("l-prog");
  if (document.activeElement !== p) {
    p.max = c.duree;
    p.value = pos;
  }
  p.style.setProperty("--p", c.duree ? (pos / c.duree) * 100 + "%" : "0%");
  const enPause = Y.etat !== LECTURE;
  $("l-temps").textContent = `${enPause ? fmtTempsFin(pos) : fmtTemps(pos)} / ${fmtTemps(c.duree)}`;
}

function majBoutonLecture() {
  const enPause = Y.etat !== LECTURE && Y.etat !== ATTENTE;
  $("c-lecture-ic").setAttribute("d", enPause ? IC_LECTURE : IC_PAUSE);
  $("c-lecture").setAttribute("aria-label", enPause ? "Lecture" : "Pause");
}

function brancherLecteur() {
  const vit = $("c-vitesses");
  vit.querySelectorAll(".cmd").forEach((b) => b.remove());
  for (const v of VITESSES) {
    vit.append(el("button", { class: "cmd", type: "button", "data-v": v, "aria-pressed": String(v === L.vitesse), onclick: () => regler(v) }, fmtVitesse(v)));
  }
}

function brancherCommandes() {
  window.addEventListener("popstate", fermerLecteur);
  // Un clic dans la vidéo donne le focus à l'iframe YouTube, qui garde alors les
  // touches du clavier : on le rend aussitôt à la page pour les raccourcis.
  window.addEventListener("blur", () =>
    setTimeout(() => {
      if (document.activeElement?.tagName === "IFRAME") document.activeElement.blur();
    })
  );
  $("l-prog").addEventListener("input", (e) => {
    const c = courante();
    if (c) sauter(c.debut + Number(e.target.value));
  });
  $("c-lecture").addEventListener("click", basculerLecture);
  $("c-recul").addEventListener("click", () => deplacer(-PAS_SAUT));
  $("c-avance").addEventListener("click", () => deplacer(PAS_SAUT));
  $("c-img-prec").addEventListener("click", () => image(-1));
  $("c-img-suiv").addEventListener("click", () => image(1));
  $("c-prec").addEventListener("click", () => aller(-1));
  $("c-suiv").addEventListener("click", () => aller(1));
  $("c-ab").addEventListener("click", basculerAB);
  $("c-boucle").addEventListener("click", basculerBoucle);
  $("c-miroir").addEventListener("click", basculerMiroir);
  $("c-enchainer").addEventListener("click", () => basculerEnchainer());
  $("c-son").addEventListener("click", () => basculerSon());
  $("c-plein").addEventListener("click", pleinEcran);
  $("l-fermer").addEventListener("click", fermer);

  // Un clic souris sur une commande ne lui donne pas le focus : la barre d'espace
  // reste ainsi dédiée à lecture/pause.
  $("l-commandes").addEventListener("mousedown", (e) => {
    if (e.target.closest("button")) e.preventDefault();
  });

  document.addEventListener("keydown", (e) => {
    if ($("lecteur").hidden || e.ctrlKey || e.metaKey || e.altKey) return;
    const cible = e.target;
    if (cible.matches?.("input[type=search], input[type=text], textarea")) return;
    const surBouton = cible.tagName === "BUTTON";
    const actions = {
      " ": surBouton ? null : basculerLecture,
      k: basculerLecture,
      ArrowLeft: () => deplacer(e.shiftKey ? -5 : -PAS_SAUT),
      ArrowRight: () => deplacer(e.shiftKey ? 5 : PAS_SAUT),
      ",": () => image(-1),
      ".": () => image(1),
      ArrowDown: () => vitesseRelative(-1),
      ArrowUp: () => vitesseRelative(1),
      b: basculerAB,
      l: basculerBoucle,
      m: basculerMiroir,
      e: () => basculerEnchainer(),
      s: () => { basculerSon(); flash(L.muet ? T().flash.muet : T().flash.son); },
      f: pleinEcran,
      n: () => aller(1),
      p: () => aller(-1),
      Escape: () => (document.fullscreenElement ? null : fermer())
    };
    const action = actions[e.key.length === 1 ? e.key.toLowerCase() : e.key];
    if (!action) return;
    e.preventDefault();
    action();
  });
}

/* ================================================================
   Langue
   ================================================================ */

function appliquerLangue(l) {
  langue = l;
  stockage("aikido.langue", l);
  document.documentElement.lang = l;
  const t = T();
  document.querySelectorAll("[data-i18n]").forEach((n) => (n.textContent = t[n.dataset.i18n]));
  document.querySelectorAll("[data-i18n-html]").forEach((n) => (n.innerHTML = t[n.dataset.i18nHtml]));
  document.querySelectorAll("[data-i18n-title]").forEach((n) => (n.title = t[n.dataset.i18nTitle]));
  document.querySelectorAll("[data-i18n-placeholder]").forEach((n) => (n.placeholder = t[n.dataset.i18nPlaceholder]));
  $("langue").textContent = l === "fr" ? "EN" : "FR";
  $("langue").title = l === "fr" ? "English" : "Français";
  $("apropos-corps").innerHTML = t.aproposHtml;
  construireFacettes();
  construireVues();
  brancherLecteur();
  majTout();
  const c = courante();
  if (c) afficherInfos(c);
  else document.title = `${t.titre} · ${t.sousTitre}`;
}

/* ================================================================
   Démarrage
   ================================================================ */

function demarrer() {
  const l = stockage("aikido.langue") || (navigator.language?.startsWith("fr") ? "fr" : "en");
  L.boucle = stockage("aikido.boucle") !== "0";
  $("c-boucle").setAttribute("aria-pressed", String(L.boucle));
  basculerSon(stockage("aikido.muet") !== "0");
  brancherCommandes();
  const id = lireAdresse();
  appliquerLangue(l === "en" ? "en" : "fr");

  $("q").addEventListener("input", (e) => {
    requete = e.target.value;
    majTout();
  });
  $("q").addEventListener("keydown", (e) => {
    if (e.key === "Enter" && resultats.length) {
      e.preventDefault();
      ouvrir(resultats[0]);
      e.target.blur();
    } else if (e.key === "Escape" && e.target.value) {
      e.preventDefault();
      e.target.value = "";
      requete = "";
      majTout();
    }
  });
  // « / » place le curseur dans la recherche, où que l'on soit
  document.addEventListener("keydown", (e) => {
    if (e.key !== "/" || e.target.matches?.("input, textarea")) return;
    e.preventDefault();
    $("q").focus();
    $("q").select();
  });
  $("effacer").addEventListener("click", toutEffacer);
  $("accueil").addEventListener("click", () => {
    fermer();
    toutEffacer();
    changerVue("attaque");
    scrollTo({ top: 0, behavior: "smooth" });
  });
  $("hasard").addEventListener("click", () => {
    if (resultats.length) ouvrir(resultats[Math.floor(Math.random() * resultats.length)]);
  });
  $("ouvrir-apropos").addEventListener("click", () => $("apropos").showModal());
  $("langue").addEventListener("click", () => appliquerLangue(langue === "fr" ? "en" : "fr"));

  requestAnimationFrame(surveiller);
  // Le lecteur YouTube met plusieurs secondes à s'installer : on le prépare
  // dès l'arrivée sur la page pour qu'il soit prêt au premier clic.
  if (location.protocol !== "file:") preparerYouTube();
  const c = id && PAR_ID.get(id);
  if (c) ouvrir(c);
}

demarrer();
