#!/usr/bin/env node
/**
 * Génère htdocs/llms.txt et htdocs/llms-full.txt, les fichiers lus par les assistants IA.
 *
 * Usage : node build-llms.js (lancé par build-all.js)
 *
 * Les textes rédigés vivent dans tools/llms/llms.md et tools/llms/llms-full.md. Les faits
 * qui changent y sont des marqueurs {{nom}}, remplis ici depuis les sources du site :
 * data/club.json, professeurs/fiches/*.md, evenements.md (événements à venir seulement)
 * et les données de la vidéothèque. Recopiés à la main, ces fichiers avaient perdu leurs
 * accents, annonçaient un formulaire de contact disparu, gardaient les horaires de la
 * saison passée et ignoraient la vidéothèque.
 *
 * Un marqueur inconnu arrête le build : mieux vaut un échec qu'un « {{tarifs}} » publié.
 */

const fs = require("fs");
const path = require("path");

const HTDOCS = path.join(__dirname, "htdocs");
const MODELES = path.join(__dirname, "tools", "llms");
const club = JSON.parse(fs.readFileSync(path.join(HTDOCS, "data", "club.json"), "utf8"));
const site = club.url.replace(/\/$/, "");

const liste = (noms) => (noms.length > 1 ? noms.slice(0, -1).join(", ") + " et " + noms.at(-1) : noms[0] || "");
const dateFr = (iso) => iso.split("-").reverse().join("/");

/** Réplique de slugify() (includes/markdown.php), comme tools/sync_openagenda.js. */
function slugify(nom) {
  const translit = { à: "a", â: "a", ä: "a", é: "e", è: "e", ê: "e", ë: "e", î: "i", ï: "i", ô: "o", ö: "o", ù: "u", û: "u", ü: "u", ç: "c", ñ: "n", œ: "oe", æ: "ae" };
  return nom
    .replace(/[A-Z]/g, (c) => c.toLowerCase())
    .replace(/[àâäéèêëîïôöùûüçñœæ]/g, (c) => translit[c])
    .replace(/[^a-z0-9-]+/g, "-")
    .replace(/^-+|-+$/g, "");
}

/* ---------- Enseignants : professeurs/fiches/*.md ---------- */

function lireFiche(fichier) {
  const texte = fs.readFileSync(fichier, "utf8").replace(/\r\n/g, "\n");
  const m = texte.match(/^---\n([\s\S]*?)\n---\n([\s\S]*)$/);
  if (!m) return null;
  const meta = {};
  for (const ligne of m[1].split("\n")) {
    const kv = ligne.match(/^(\w+):\s*(.*)$/);
    if (kv) meta[kv[1]] = kv[2].trim();
  }
  // Markdown réduit au texte : gras et italique retirés, un paragraphe par ligne
  const bio = m[2]
    .trim()
    .split(/\n\s*\n/)
    .map((p) => p.replace(/\*\*(.+?)\*\*/g, "$1").replace(/(^|\W)_(.+?)_(?=\W|$)/g, "$1$2").replace(/\s*\n\s*/g, " ").trim())
    .filter(Boolean);
  return { ...meta, bio };
}

const fiches = fs
  .readdirSync(path.join(HTDOCS, "professeurs", "fiches"))
  .filter((f) => f.endsWith(".md"))
  .sort()
  .map((f) => lireFiche(path.join(HTDOCS, "professeurs", "fiches", f)))
  .filter((f) => f && f.name);
const responsable = club.pedagogicalLead;
const role = (f) => (f.name === responsable.name ? " (responsable pédagogique)" : "");

/* ---------- Événements à venir : evenements.md ---------- */

function lireEvenements() {
  const evenements = [];
  let courant = null;
  for (const brute of fs.readFileSync(path.join(HTDOCS, "evenements.md"), "utf8").split("\n")) {
    const ligne = brute.trim();
    if (ligne === "---" || (ligne.startsWith("# ") && !ligne.startsWith("## "))) continue;
    if (ligne.startsWith("## Format")) {
      courant = null;
      continue;
    }
    if (ligne.startsWith("## ")) {
      courant = { title: ligne.slice(3), date: null, horaire: null, lieu: null, description: "" };
      evenements.push(courant);
      continue;
    }
    if (!courant) continue;
    const meta = ligne.match(/^- (date|horaire|lieu|lieu_url|animateur|image|openagenda):\s*(.+)$/);
    if (meta) {
      if (meta[1] === "date") {
        const p = meta[2].trim().split("/");
        if (p.length === 3) courant.date = `${p[2]}-${p[1].padStart(2, "0")}-${p[0].padStart(2, "0")}`;
      } else courant[meta[1]] = meta[2].trim();
      continue;
    }
    if (ligne.startsWith("- `") || ligne.startsWith("Les événements passés")) continue;
    if (ligne !== "" && !ligne.startsWith("- ")) courant.description += (courant.description ? " " : "") + ligne;
  }
  const aujourdhui = new Date().toLocaleDateString("sv-SE"); // AAAA-MM-JJ, heure locale
  return evenements.filter((e) => e.date && e.date >= aujourdhui).sort((a, b) => a.date.localeCompare(b.date));
}

function jourFr(iso) {
  const [a, m, j] = iso.split("-").map(Number);
  const texte = new Date(a, m - 1, j).toLocaleDateString("fr-FR", { weekday: "long", day: "numeric", month: "long", year: "numeric" });
  return texte.charAt(0).toUpperCase() + texte.slice(1);
}

/* ---------- Vidéothèque : videotheque/donnees.js ---------- */

function lireVideotheque() {
  const fichier = path.join(HTDOCS, "videotheque", "donnees.js");
  if (!fs.existsSync(fichier)) return null;
  const D = JSON.parse(fs.readFileSync(fichier, "utf8").trim().replace(/^window\.DONNEES\s*=\s*/, "").replace(/;$/, ""));
  return {
    clips: D.clips.length,
    techniques: new Set(D.clips.map((c) => [c.forme, c.attaque, c.technique, c.sens].join("|"))).size,
    videos: Object.keys(D.videos).length,
    senseis: [...new Set(D.clips.map((c) => c.sensei).filter(Boolean))].sort((a, b) => a.localeCompare(b, "fr"))
  };
}

/* ---------- Valeurs des marqueurs ---------- */

const loc = club.location;
const sch = club.schedule;
const prix = club.pricing;
const jours = sch.days.map((j) => j.toLowerCase());
const adultes = liste(sch.adults.map((c) => c.label));
const presidente = (club.board || []).find((m) => m.key === "president");
const evenements = lireEvenements();
const video = lireVideotheque();
const saisonDebut = dateFr(club.seasonStart);

const valeurs = {
  nom: club.name,
  site,
  ville: loc.city,
  code_postal: loc.postalCode,
  fondation: String(club.foundingYear),
  fondateur: club.founder,
  membres: String(club.membersApprox),
  federation: club.federation.name,
  federation_sigle: club.federation.abbr,
  numero_club: club.federation.clubNumber,
  agrement: club.federation.agrement,
  lieu: loc.venue,
  adresse: `${loc.venue}, ${loc.street}, ${loc.postalCode} ${loc.city}`,
  gps: `${loc.geo.lat}, ${loc.geo.lng}`,
  carte: loc.mapsUrl,
  jours: "le " + jours.join(" et le "),
  jours_liste: liste(jours),
  horaire_enfants: sch.children.label,
  horaires_adultes: adultes,
  saison: club.season,
  saison_debut: saisonDebut,
  horaires: [
    `- Lieu : ${loc.venue}, ${loc.street}, ${loc.postalCode} ${loc.city}`,
    `- Cours enfants (dès 7 ans) : ${liste(jours)}, ${sch.children.label}`,
    `- Cours adultes : ${liste(jours)}, ${adultes}`,
    `- Saison ${club.season} : horaires en vigueur à partir du ${saisonDebut}`
  ].join("\n"),
  tarifs: [
    `- Enfants (7-14 ans) : ${prix.children} € par an`,
    `- Adultes (15 ans et plus) : ${prix.adults} € par an`,
    `- Tarif réduit (étudiants, chômeurs) : ${prix.reduced} € par an, sur justificatif`,
    `- Tarif famille : réduction de ${prix.familyDiscountPercent} % à partir de la ${prix.familyDiscountFrom}e inscription d'un même foyer`
  ].join("\n"),
  tarifs_resume:
    `enfants ${prix.children} € par an, adultes ${prix.adults} € par an, tarif réduit ${prix.reduced} € par an ` +
    `(étudiants et chômeurs, sur justificatif) ; réduction famille de ${prix.familyDiscountPercent} % ` +
    `dès la ${prix.familyDiscountFrom}e inscription d'un même foyer`,
  adhesion: club.membership.onlineUrl,
  essai_septembre: club.trial.label,
  essai_invitation: club.trial.invitation,
  // « Le reste de l'année, présentez-vous… » : l'invitation commence par une majuscule
  essai_reste: "Le reste de l'année, " + club.trial.invitation.charAt(0).toLowerCase() + club.trial.invitation.slice(1),
  hakama: club.hakamaFromGrade,
  telephone: club.contact.phone,
  email: club.contact.email,
  presidente: presidente ? presidente.name : "",
  bureau: (club.board || [])
    .map((m) => `- ${m.name} : ${m.role}${m.phone || (m.key === "president" ? club.contact.phone : "") ? ", " + (m.phone || club.contact.phone) : ""}`)
    .join("\n"),
  responsable: `${responsable.name} (${responsable.grade}, ${responsable.diploma})`,
  responsable_nom: responsable.name,
  nb_enseignants: String(fiches.length),
  equipe: fiches
    .map((f) => `- ${f.name} : ${[f.grade, (f.diplome || "").replace(/\s*\(.*\)$/, ""), f.fonction].filter(Boolean).join(", ")}${role(f)}`)
    .join("\n"),
  enseignants: fiches
    .map((f) =>
      [
        `### ${f.name}`,
        "",
        `- Grade : ${f.grade}`,
        f.diplome ? `- Diplôme : ${f.diplome}` : null,
        f.fonction ? `- Fonction : ${f.fonction}` : null,
        role(f) ? "- Rôle au club : responsable pédagogique" : null,
        `- Fiche : ${site}/professeurs.php#${slugify(f.name)}`,
        "",
        ...f.bio.flatMap((p) => [p, ""])
      ]
        .filter((l) => l !== null)
        .join("\n")
        .trim()
    )
    .join("\n\n"),
  evenements: evenements.length
    ? evenements
        .map(
          (e) =>
            `- ${jourFr(e.date)} : ${e.title}${e.horaire ? ", " + e.horaire : ""}, ${e.lieu || loc.venue}.` +
            `${e.description ? " " + e.description : ""} ${site}/actualites.php?evenement=${e.date}-${slugify(e.title)}`
        )
        .join("\n")
    : `Aucun événement annoncé pour le moment : voir ${site}/actualites.php`,
  video_clips: video ? String(video.clips) : "",
  video_techniques: video ? String(video.techniques) : "",
  video_videos: video ? String(video.videos) : "",
  video_senseis: video ? liste(video.senseis) : ""
};

/* ---------- Rendu ---------- */

function rendre(modele, sortie) {
  const texte = fs.readFileSync(path.join(MODELES, modele), "utf8").replace(/\r\n/g, "\n");
  const inconnus = new Set();
  const resultat = texte.replace(/\{\{(\w+)\}\}/g, (m, cle) => {
    if (!(cle in valeurs)) inconnus.add(cle);
    return valeurs[cle] ?? m;
  });
  if (inconnus.size) {
    console.error(`❌ ${modele} : marqueur(s) inconnu(s) ${[...inconnus].join(", ")}`);
    process.exit(1);
  }
  fs.writeFileSync(path.join(HTDOCS, sortie), resultat);
  console.log(`  ✓ ${sortie.padEnd(15)} (${Math.round(Buffer.byteLength(resultat) / 1024)} Ko)`);
}

console.log("🤖 Génération des fichiers pour les assistants IA...\n");
rendre("llms.md", "llms.txt");
rendre("llms-full.md", "llms-full.txt");
console.log(`\n✨ ${evenements.length} événement(s) à venir, ${fiches.length} enseignant(s)` + (video ? `, vidéothèque de ${video.techniques} techniques` : ""));
