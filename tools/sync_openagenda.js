#!/usr/bin/env node
/**
 * Synchronisation à sens unique : htdocs/evenements.md -> agenda OpenAgenda du club
 *
 * evenements.md reste la référence : le site le lit à chaud, et cet outil recopie
 * ses événements à venir dans OpenAgenda (API v2). Rien n'est jamais lu en retour.
 *
 * Usage : node tools/sync_openagenda.js [options]
 *   (sans option)    simulation : affiche ce qui serait créé, mis à jour ou supprimé
 *   --apply          applique réellement les changements
 *   --apercu         affiche le JSON envoyé pour chaque événement, sans aucun appel réseau
 *   --only <id>      ne traite qu'un événement (id = « 2027-04-11-stage-jean-marc-chamot »)
 *   --force          renvoie même les événements inchangés et lève le garde-fou de suppression
 *   --no-delete      ne supprime rien dans OpenAgenda
 *
 * Configuration dans env/openagenda (non versionné), une valeur par ligne :
 *   OPENAGENDA_AGENDA_UID=12345678
 *   OPENAGENDA_PUBLIC_KEY=oa_pk_...   lecture, suffit pour la simulation
 *   OPENAGENDA_SECRET_KEY=oa_sk_...   écriture, requise pour --apply
 * Une clé seule sur sa ligne est aussi reconnue à son préfixe (oa_pk_, oa_sk_), un
 * nombre seul comme UID d'agenda. Les variables d'environnement du même nom priment.
 *
 * Correspondance entre evenements.md et OpenAgenda :
 * - chaque événement porte l'identifiant externe { key: "kannagara", value: <id du site> },
 *   le même que le permalien de partage (?evenement=…) : l'écriture se fait par
 *   PUT …/events/ext/kannagara/<id>, qui crée ou met à jour sans doublon ;
 * - seuls les événements à venir sont envoyés ; « - openagenda: non » en exclut un ;
 * - l'horaire en texte libre devient des créneaux : « 09h30 - 12h30 14h00 - 17h00 »
 *   donne deux créneaux, une heure seule (« à partir de 19h00 ») dure DUREE_OUVERTE_MIN ;
 * - le lieu du club (club.json) est créé ou mis à jour automatiquement ; tout autre lieu
 *   doit exister dans l'agenda OpenAgenda sous exactement le même nom ;
 * - un événement retiré d'evenements.md est supprimé d'OpenAgenda s'il est encore à venir.
 *   Les événements créés à la main dans OpenAgenda (sans cet identifiant) ne sont jamais
 *   touchés ;
 * - l'image est envoyée comme fichier (lu dans htdocs/), pas comme URL : OpenAgenda
 *   refuse parfois de télécharger depuis un hébergeur tiers (erreur « url.invalid »).
 */

import fs from "node:fs";
import path from "node:path";
import crypto from "node:crypto";
import { fileURLToPath } from "node:url";

const RACINE = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const HTDOCS = path.join(RACINE, "htdocs");
const FICHIER_EVENEMENTS = path.join(HTDOCS, "evenements.md");
const FICHIER_CLUB = path.join(RACINE, "htdocs", "data", "club.json");
const FICHIER_CONFIG = path.join(RACINE, "env", "openagenda");
// Empreintes des derniers envois : évite de renvoyer un événement inchangé
const FICHIER_ETAT = path.join(RACINE, ".cache", "openagenda-sync.json");

const API = "https://api.openagenda.com/v2";
const CLE_EXT = "kannagara";
const FUSEAU = "Europe/Paris";
const DUREE_OUVERTE_MIN = 120;
const MOTS_CLES = ["aïkido", "arts martiaux", "Guyancourt"];
// Au-delà de cette part des événements gérés, une suppression massive est refusée sans --force
const SEUIL_SUPPRESSION = 0.5;
const TYPES_IMAGE = {
  ".jpg": "image/jpeg",
  ".jpeg": "image/jpeg",
  ".png": "image/png",
  ".webp": "image/webp",
  ".gif": "image/gif"
};

const FORMAT_DECALAGE = new Intl.DateTimeFormat("en-US", { timeZone: FUSEAU, timeZoneName: "longOffset" });
const FORMAT_JOUR = new Intl.DateTimeFormat("en-CA", { timeZone: FUSEAU });

// ---------------------------------------------------------------------------
// Lecture d'evenements.md (mêmes règles que includes/evenements-parser.php)
// ---------------------------------------------------------------------------

/**
 * Réplique exacte de slugify() (includes/markdown.php) : strtolower de PHP 8 ne met en
 * minuscules que l'ASCII, une majuscule accentuée devient donc un tiret. Tout écart
 * changerait l'identifiant, et OpenAgenda verrait un nouvel événement.
 */
function slugify(nom) {
  const translit = {
    à: "a",
    â: "a",
    ä: "a",
    é: "e",
    è: "e",
    ê: "e",
    ë: "e",
    î: "i",
    ï: "i",
    ô: "o",
    ö: "o",
    ù: "u",
    û: "u",
    ü: "u",
    ç: "c",
    ñ: "n",
    œ: "oe",
    æ: "ae"
  };
  return nom
    .replace(/[A-Z]/g, (c) => c.toLowerCase())
    .replace(/[àâäéèêëîïôöùûüçñœæ]/g, (c) => translit[c])
    .replace(/[^a-z0-9-]+/g, "-")
    .replace(/^-+|-+$/g, "");
}

function lireEvenements(contenu) {
  const evenements = [];
  let courant = null;
  const clore = () => {
    if (courant) {
      courant.description = courant.description.trim();
      evenements.push(courant);
    }
  };

  for (const brute of contenu.split("\n")) {
    const ligne = brute.trim();
    if (ligne === "---") continue;
    if (ligne.startsWith("# ") && !ligne.startsWith("## ")) continue;
    if (ligne.startsWith("## Format")) {
      courant = null;
      continue;
    }
    if (ligne.startsWith("## ")) {
      clore();
      courant = {
        title: ligne.slice(3),
        date: null,
        horaire: null,
        lieu: null,
        animateur: null,
        image: null,
        openagenda: true,
        description: ""
      };
      continue;
    }
    if (!courant) continue;

    const meta = ligne.match(/^- (date|horaire|lieu|lieu_url|animateur|image|openagenda):\s*(.+)$/);
    if (meta) {
      const [, cle, valeur] = meta;
      if (cle === "date") {
        const p = valeur.trim().split("/");
        if (p.length === 3) courant.date = { j: +p[0], m: +p[1], a: +p[2] };
      } else if (cle === "openagenda") {
        courant.openagenda = !/^(non|no|false|0)$/i.test(valeur.trim());
      } else {
        courant[cle] = valeur.trim();
      }
      continue;
    }
    if (ligne.startsWith("- `")) continue;
    if (ligne.startsWith("Les événements passés")) continue;
    if (ligne !== "" && !ligne.startsWith("- ")) {
      courant.description += (courant.description ? " " : "") + ligne;
    }
  }
  clore();

  return evenements
    .filter((e) => e.date)
    .map((e) => {
      const iso = `${e.date.a}-${deux(e.date.m)}-${deux(e.date.j)}`;
      return { ...e, iso, id: `${iso}-${slugify(e.title)}` };
    });
}

// ---------------------------------------------------------------------------
// Horaires : texte libre -> créneaux ISO 8601 à l'heure de Paris
// ---------------------------------------------------------------------------

function deux(n) {
  return String(n).padStart(2, "0");
}

/** Plages [début, fin] en minutes, fusionnées quand elles se touchent. */
function plagesHoraire(texte) {
  if (!texte) return [];
  const re = /(\d{1,2})\s*h\s*(\d{2})?/g;
  const heures = [];
  let m;
  while ((m = re.exec(texte))) {
    heures.push({ min: +m[1] * 60 + (m[2] ? +m[2] : 0), debut: m.index, fin: re.lastIndex });
  }

  const plages = [];
  for (let i = 0; i < heures.length; i++) {
    const h = heures[i];
    const suivante = heures[i + 1];
    if (suivante && /^\s*(-|–|—|à|a)\s*$/.test(texte.slice(h.fin, suivante.debut))) {
      plages.push([h.min, suivante.min]);
      i++;
    } else {
      plages.push([h.min, Math.min(h.min + DUREE_OUVERTE_MIN, 23 * 60 + 59)]);
    }
  }

  plages.sort((a, b) => a[0] - b[0]);
  const fusion = [];
  for (const p of plages) {
    const derniere = fusion[fusion.length - 1];
    if (derniere && p[0] <= derniere[1]) derniere[1] = Math.max(derniere[1], p[1]);
    else fusion.push([...p]);
  }
  return fusion;
}

function decalageParis(instant) {
  const nom = FORMAT_DECALAGE.formatToParts(instant).find((p) => p.type === "timeZoneName").value;
  const m = nom.match(/GMT([+-])(\d{2}):(\d{2})/);
  return m ? (m[1] === "-" ? -1 : 1) * (+m[2] * 60 + +m[3]) : 0;
}

/** Heure murale de Paris -> ISO avec décalage (+01:00 l'hiver, +02:00 l'été). */
function isoParis({ a, m, j }, minutes) {
  const hh = Math.floor(minutes / 60);
  const mm = minutes % 60;
  const commeUtc = new Date(Date.UTC(a, m - 1, j, hh, mm));
  const decalage = decalageParis(new Date(commeUtc.getTime() - decalageParis(commeUtc) * 60000));
  const abs = Math.abs(decalage);
  const signe = decalage < 0 ? "-" : "+";
  return `${a}-${deux(m)}-${deux(j)}T${deux(hh)}:${deux(mm)}:00${signe}${deux(Math.floor(abs / 60))}:${deux(abs % 60)}`;
}

function aujourdhuiParis() {
  return FORMAT_JOUR.format(new Date());
}

// ---------------------------------------------------------------------------
// Construction de l'événement OpenAgenda
// ---------------------------------------------------------------------------

function normaliserNom(nom) {
  return nom.normalize("NFD").replace(/[̀-ͯ]/g, "").toLowerCase().replace(/\s+/g, " ").trim();
}

/** Coupe à la dernière espace avant la limite, pour ne pas trancher un mot. */
function resume(texte, max) {
  if (texte.length <= max) return texte;
  const coupe = texte.slice(0, max - 1);
  const espace = coupe.lastIndexOf(" ");
  return (espace > max / 2 ? coupe.slice(0, espace) : coupe).replace(/[\s,;:.]+$/, "") + "…";
}

/** Image locale (chemin relatif à htdocs/, comme dans evenements.md) prête à l'envoi. */
function lireImage(chemin) {
  const fichier = path.join(HTDOCS, chemin.replace(/^\/+/, ""));
  if (!fichier.startsWith(HTDOCS + path.sep) || !fs.existsSync(fichier)) {
    throw new Error(`image introuvable dans htdocs/ : ${chemin}`);
  }
  const type = TYPES_IMAGE[path.extname(fichier).toLowerCase()];
  if (!type) throw new Error(`format d'image non géré : ${chemin}`);
  const octets = fs.readFileSync(fichier);
  return {
    octets,
    type,
    nom: path.basename(fichier),
    empreinte: crypto.createHash("sha1").update(octets).digest("hex")
  };
}

/**
 * Corps envoyé à OpenAgenda, sans locationUid (ajouté à l'envoi) : l'empreinte reste
 * ainsi la même en simulation, où l'uid du lieu n'est pas encore connu.
 */
function construireEvenement(e, club) {
  const site = club.url.replace(/\/+$/, "");
  const lieu = e.lieu || club.location.venue;

  const plages = plagesHoraire(e.horaire);
  if (plages.length === 0) {
    throw new Error(
      `horaire absent ou illisible (« ${e.horaire ?? ""} ») : indiquez par exemple « - horaire: 19h30 - 21h30 »`
    );
  }
  if (e.title.length > 140) throw new Error("titre trop long pour OpenAgenda (140 caractères au plus)");
  if (e.id.length > 100)
    throw new Error("identifiant trop long pour OpenAgenda (100 caractères au plus) : raccourcir le titre");

  const courte = e.description
    ? resume(e.description, 200)
    : resume(`Rendez-vous proposé par le club ${club.name}. Lieu : ${lieu}.`, 200);

  const paragraphes = [];
  if (e.description) paragraphes.push(e.description);
  paragraphes.push(`**Horaire :** ${e.horaire}`);
  if (e.animateur) paragraphes.push(`**Animé par :** ${e.animateur}`);
  paragraphes.push(`**Lieu :** ${lieu}`);
  paragraphes.push(
    `Toutes les informations sur le site du club : ${site}/actualites.php?evenement=${encodeURIComponent(e.id)}`
  );

  const corps = {
    title: { fr: e.title },
    description: { fr: courte },
    longDescription: { fr: paragraphes.join("\n\n") },
    keywords: { fr: MOTS_CLES },
    timings: plages.map(([debut, fin]) => ({ begin: isoParis(e.date, debut), end: isoParis(e.date, fin) })),
    // Sur place : exigé explicitement par l'agenda, et impose un locationUid
    attendanceMode: 1,
    extIds: [{ key: CLE_EXT, value: e.id }],
    // Publié : l'agenda met sinon les nouveaux événements « à modérer »
    state: 2
  };

  let image = null;
  if (e.image && /^https?:\/\//.test(e.image)) corps.image = { url: e.image };
  else if (e.image) image = lireImage(e.image);
  return { corps, lieu, image };
}

/** Inclut le contenu de l'image : une photo remplacée sous le même nom est renvoyée. */
function empreinte({ corps, lieu, image }) {
  return crypto
    .createHash("sha1")
    .update(JSON.stringify({ corps, lieu, image: image?.empreinte ?? null }))
    .digest("hex");
}

// ---------------------------------------------------------------------------
// Configuration et client API
// ---------------------------------------------------------------------------

function lireConfig() {
  const conf = {};
  if (fs.existsSync(FICHIER_CONFIG)) {
    for (const brute of fs.readFileSync(FICHIER_CONFIG, "utf8").split(/\r?\n/)) {
      const ligne = brute.trim();
      if (!ligne || ligne.startsWith("#")) continue;
      const m = ligne.match(/^([A-Z_]+)\s*=\s*(.*)$/);
      if (m) conf[m[1]] = m[2].trim().replace(/^["']|["']$/g, "");
      else if (ligne.startsWith("oa_pk_")) conf.OPENAGENDA_PUBLIC_KEY = ligne;
      else if (ligne.startsWith("oa_sk_")) conf.OPENAGENDA_SECRET_KEY = ligne;
      else if (/^\d+$/.test(ligne)) conf.OPENAGENDA_AGENDA_UID = ligne;
    }
  }
  for (const cle of ["OPENAGENDA_AGENDA_UID", "OPENAGENDA_PUBLIC_KEY", "OPENAGENDA_SECRET_KEY"]) {
    if (process.env[cle]) conf[cle] = process.env[cle];
  }

  // Le préfixe d'une clé fait foi sur l'étiquette de sa ligne : une clé oa_pk_ rangée
  // sous OPENAGENDA_SECRET_KEY reste une clé publique, incapable d'écrire.
  let cleLecture = conf.OPENAGENDA_PUBLIC_KEY;
  let cleSecrete = conf.OPENAGENDA_SECRET_KEY;
  const avertissements = [];
  if (cleSecrete?.startsWith("oa_pk_")) {
    avertissements.push(
      "la valeur de OPENAGENDA_SECRET_KEY commence par oa_pk_ : c'est une clé publique (une clé secrète commence par oa_sk_)"
    );
    cleLecture ??= cleSecrete;
    cleSecrete = undefined;
  }
  if (cleLecture?.startsWith("oa_sk_")) {
    avertissements.push(
      "la valeur de OPENAGENDA_PUBLIC_KEY commence par oa_sk_ : c'est une clé secrète, utilisée comme telle"
    );
    cleSecrete ??= cleLecture;
    cleLecture = undefined;
  }
  return { agenda: conf.OPENAGENDA_AGENDA_UID, cleLecture, cleSecrete, avertissements };
}

class ClientOpenAgenda {
  constructor({ agenda, cleLecture, cleSecrete }) {
    this.agenda = agenda;
    this.cleLecture = cleLecture;
    this.cleSecrete = cleSecrete;
    this.jetonCourant = null;
  }

  /** La clé secrète s'échange contre un jeton d'accès (durée de vie d'environ une heure). */
  async jeton() {
    if (this.jetonCourant && this.jetonCourant.expire > Date.now()) return this.jetonCourant.valeur;
    const rep = await this.brut("POST", "/requestAccessToken", { corps: { code: this.cleSecrete } });
    if (!rep?.access_token) throw new Error("réponse inattendue de requestAccessToken (pas d'access_token)");
    const duree = (rep.expires_in ?? 3600) * 1000;
    this.jetonCourant = { valeur: rep.access_token, expire: Date.now() + duree - 60000 };
    return this.jetonCourant.valeur;
  }

  /** Lecture : la clé passe dans l'en-tête « key » (la publique de préférence). */
  async lecture(chemin, params = []) {
    return this.brut("GET", chemin, { params, entetes: { key: this.cleLecture ?? this.cleSecrete } });
  }

  /** Écriture : toujours avec le jeton d'accès, dans l'en-tête « access-token ». */
  async ecriture(methode, chemin, { corps, formulaire } = {}) {
    return this.brut(methode, chemin, { corps, formulaire, entetes: { "access-token": await this.jeton() } });
  }

  async brut(methode, chemin, { corps, formulaire, params = [], entetes = {} } = {}) {
    const url = new URL(API + chemin);
    for (const [cle, valeur] of params) url.searchParams.append(cle, valeur);
    // Pas de content-type pour un FormData : fetch pose lui-même la frontière multipart
    const rep = await fetch(url, {
      method: methode,
      headers: { accept: "application/json", ...(corps ? { "content-type": "application/json" } : {}), ...entetes },
      body: formulaire ?? (corps ? JSON.stringify(corps) : undefined),
      signal: AbortSignal.timeout(60000)
    });
    const texte = await rep.text();
    let json = null;
    try {
      json = texte ? JSON.parse(texte) : null;
    } catch {
      // réponse non JSON : le texte brut sert au message d'erreur
    }
    if (!rep.ok) {
      const detail = json ? JSON.stringify(json.errors ?? json.error ?? json.message ?? json) : texte.slice(0, 300);
      const erreur = new Error(`${methode} ${url.pathname} : HTTP ${rep.status} ${detail}`);
      erreur.status = rep.status;
      throw erreur;
    }
    return json;
  }

  /**
   * Événements publiés, en cours ou à venir, portant notre identifiant externe : id -> uid.
   * C'est l'agenda en ligne qui fait foi pour les suppressions, jamais le fichier d'état.
   */
  async evenementsGeres() {
    const geres = new Map();
    const base = [
      ["relative[]", "current"],
      ["relative[]", "upcoming"],
      ["detailed", "1"],
      ["monolingual", "fr"],
      ["size", "300"]
    ];

    let apres = null;
    let lus = 0;
    for (let page = 0; page < 50; page++) {
      const params = [...base, ...(apres ?? []).map((v) => ["after[]", String(v)])];
      const rep = await this.lecture(`/agendas/${this.agenda}/events`, params);
      const evenements = rep?.events ?? [];
      lus += evenements.length;
      for (const ev of evenements) {
        const ext = (ev.extIds ?? []).find((x) => x.key === CLE_EXT);
        if (ext) geres.set(ext.value, { uid: ev.uid, titre: typeof ev.title === "string" ? ev.title : ev.title?.fr });
      }
      apres = rep?.after;
      // Le curseur peut rester non nul après la dernière page : on s'arrête aussi au total
      if (!apres || evenements.length === 0 || lus >= (rep?.total ?? Infinity)) break;
    }
    return geres;
  }

  async lieuParIdExterne(valeur) {
    try {
      const rep = await this.lecture(`/agendas/${this.agenda}/locations/ext/${CLE_EXT}/${encodeURIComponent(valeur)}`);
      return rep?.location ?? rep;
    } catch (erreur) {
      if (erreur.status === 404) return null;
      throw erreur;
    }
  }

  async enregistrerLieu(valeur, lieu) {
    const rep = await this.ecriture(
      "PUT",
      `/agendas/${this.agenda}/locations/ext/${CLE_EXT}/${encodeURIComponent(valeur)}`,
      {
        corps: { ...lieu, extIds: [{ key: CLE_EXT, value: valeur }] }
      }
    );
    return rep?.location ?? rep;
  }

  async chercherLieu(nom) {
    const rep = await this.lecture(`/agendas/${this.agenda}/locations`, [
      ["search", nom],
      ["size", "50"]
    ]);
    const cible = normaliserNom(nom);
    return (rep?.locations ?? []).find((l) => normaliserNom(l.name ?? "") === cible) ?? null;
  }

  /** Avec une image, envoi multipart : champ « data » (JSON) + champ « image » (fichier). */
  async enregistrerEvenement(id, corps, image) {
    const chemin = `/agendas/${this.agenda}/events/ext/${CLE_EXT}/${encodeURIComponent(id)}`;
    let rep;
    if (image) {
      const formulaire = new FormData();
      formulaire.append("data", JSON.stringify(corps));
      formulaire.append("image", new Blob([image.octets], { type: image.type }), image.nom);
      rep = await this.ecriture("PUT", chemin, { formulaire });
    } else {
      rep = await this.ecriture("PUT", chemin, { corps });
    }
    return rep?.event ?? rep;
  }

  async supprimerEvenement(id) {
    await this.ecriture("DELETE", `/agendas/${this.agenda}/events/ext/${CLE_EXT}/${encodeURIComponent(id)}`);
  }
}

// ---------------------------------------------------------------------------
// Programme principal
// ---------------------------------------------------------------------------

function lireOptions(argv) {
  const options = { apply: false, apercu: false, force: false, supprimer: true, seul: null };
  for (let i = 0; i < argv.length; i++) {
    const a = argv[i];
    if (a === "--apply") options.apply = true;
    else if (a === "--apercu") options.apercu = true;
    else if (a === "--force") options.force = true;
    else if (a === "--no-delete") options.supprimer = false;
    else if (a === "--only") options.seul = argv[++i];
    else throw new Error(`option inconnue : ${a}`);
  }
  if (options.apply && options.apercu) throw new Error("--apply et --apercu sont incompatibles");
  if (argv.includes("--only") && !options.seul) throw new Error("--only attend un identifiant d'événement");
  return options;
}

function lireEtat() {
  try {
    return JSON.parse(fs.readFileSync(FICHIER_ETAT, "utf8"));
  } catch {
    return {};
  }
}

function ecrireEtat(etat) {
  fs.mkdirSync(path.dirname(FICHIER_ETAT), { recursive: true });
  fs.writeFileSync(FICHIER_ETAT, JSON.stringify(etat, null, 2) + "\n");
}

/** Le lieu du club vient de club.json : une seule source pour l'adresse du dojo. */
function lieuDuClub(club) {
  const l = club.location;
  return {
    cle: slugify(l.venue),
    donnees: {
      name: l.venue,
      address: `${l.street}, ${l.postalCode} ${l.city}`,
      postalCode: l.postalCode,
      city: l.city,
      countryCode: l.country,
      latitude: l.geo.lat,
      longitude: l.geo.lng
    }
  };
}

async function main() {
  const options = lireOptions(process.argv.slice(2));
  const club = JSON.parse(fs.readFileSync(FICHIER_CLUB, "utf8"));
  const tous = lireEvenements(fs.readFileSync(FICHIER_EVENEMENTS, "utf8"));
  const aujourdhui = aujourdhuiParis();

  // Deux événements du même jour et du même titre auraient le même identifiant
  const vus = new Set();
  for (const e of tous) {
    if (vus.has(e.id)) throw new Error(`deux événements ont le même identifiant « ${e.id} » (même date, même titre)`);
    vus.add(e.id);
  }

  const aVenir = tous.filter((e) => e.iso >= aujourdhui && e.openagenda);
  const cibles = options.seul ? aVenir.filter((e) => e.id === options.seul) : aVenir;
  if (options.seul && cibles.length === 0) {
    throw new Error(`aucun événement à venir et publiable n'a l'identifiant « ${options.seul} »`);
  }

  const erreurs = [];
  const prets = [];
  for (const e of cibles) {
    try {
      prets.push({ e, ...construireEvenement(e, club) });
    } catch (erreur) {
      erreurs.push(`${e.id} : ${erreur.message}`);
    }
  }

  if (options.apercu) {
    for (const { e, corps, lieu, image } of prets) {
      const fichier = image ? `, image : ${image.nom} (${Math.round(image.octets.length / 1024)} Ko)` : "";
      console.log(`\n=== ${e.id} (lieu : ${lieu}${fichier})`);
      console.log(JSON.stringify(corps, null, 2));
    }
    return terminer(erreurs, `${prets.length} événement(s) prêt(s), aucun appel réseau`);
  }

  const config = lireConfig();
  for (const avertissement of config.avertissements) console.warn(`⚠️  ${avertissement}`);
  if (!/^\d+$/.test(config.agenda ?? "")) {
    throw new Error(
      `UID d'agenda absent ou invalide. Ajoutez « OPENAGENDA_AGENDA_UID=… » dans env/openagenda (l'UID s'affiche en bas de la barre latérale de la page de l'agenda sur openagenda.com).`
    );
  }
  if (options.apply && !config.cleSecrete) {
    throw new Error("--apply exige la clé secrète : ajoutez « OPENAGENDA_SECRET_KEY=oa_sk_… » dans env/openagenda.");
  }
  if (!config.cleLecture && !config.cleSecrete) {
    throw new Error("aucune clé OpenAgenda : ajoutez « OPENAGENDA_PUBLIC_KEY=oa_pk_… » dans env/openagenda.");
  }

  const client = new ClientOpenAgenda(config);
  const mode = options.apply ? "application" : "simulation";
  console.log(`🗓️  Synchronisation evenements.md -> OpenAgenda (agenda ${config.agenda}, ${mode})\n`);

  // ---- Lieux ----
  const lieuClub = lieuDuClub(club);
  const lieux = new Map();
  for (const nom of new Set(prets.map((p) => p.lieu))) {
    try {
      if (normaliserNom(nom) === normaliserNom(lieuClub.donnees.name)) {
        if (options.apply) {
          const l = await client.enregistrerLieu(lieuClub.cle, lieuClub.donnees);
          if (!l?.uid) throw new Error("OpenAgenda n'a pas renvoyé l'uid du lieu du club");
          lieux.set(nom, { uid: l.uid, note: `lieu du club enregistré (uid ${l.uid})` });
        } else {
          const l = await client.lieuParIdExterne(lieuClub.cle);
          lieux.set(nom, {
            uid: l?.uid ?? null,
            note: l ? `lieu du club présent (uid ${l.uid})` : "lieu du club absent, il sera créé depuis club.json"
          });
        }
      } else {
        const l = await client.chercherLieu(nom);
        if (!l)
          throw new Error(
            `lieu « ${nom} » introuvable dans l'agenda : créez-le une fois sur openagenda.com sous exactement ce nom`
          );
        lieux.set(nom, { uid: l.uid, note: `trouvé dans l'agenda (uid ${l.uid})` });
      }
      console.log(`   📍 ${nom} : ${lieux.get(nom).note}`);
    } catch (erreur) {
      lieux.set(nom, { erreur: erreur.message });
      console.log(`   📍 ${nom} : ❌ ${erreur.message}`);
    }
  }

  // ---- Plan ----
  const geres = await client.evenementsGeres();
  const etat = lireEtat();
  const plan = [];
  for (const p of prets) {
    const l = lieux.get(p.lieu);
    if (l?.erreur) {
      erreurs.push(`${p.e.id} : ${l.erreur}`);
      continue;
    }
    const hash = empreinte(p);
    const existe = geres.has(p.e.id);
    const inchange = existe && etat[p.e.id] === hash && !options.force;
    plan.push({ ...p, hash, action: inchange ? "inchangé" : existe ? "mise à jour" : "création" });
  }

  let suppressions = [];
  if (options.supprimer && !options.seul) {
    const conserves = new Set(aVenir.map((e) => e.id));
    suppressions = [...geres.keys()].filter((id) => !conserves.has(id));
    if (suppressions.length > 2 && suppressions.length > geres.size * SEUIL_SUPPRESSION && !options.force) {
      erreurs.push(
        `garde-fou : ${suppressions.length} suppressions sur ${geres.size} événements gérés, aucune n'est faite (relancer avec --force si c'est voulu)`
      );
      suppressions = [];
    }
  }

  console.log("");
  for (const p of plan) {
    const icone = { création: "➕", "mise à jour": "🔄", inchangé: "✔️ " }[p.action];
    console.log(`   ${icone} ${p.action.padEnd(12)} ${p.e.id}`);
  }
  for (const id of suppressions) console.log(`   🗑️  suppression  ${id} (${geres.get(id).titre ?? "sans titre"})`);

  if (!options.apply) {
    const aFaire = plan.filter((p) => p.action !== "inchangé").length + suppressions.length;
    return terminer(erreurs, `simulation : ${aFaire} changement(s) à appliquer avec --apply`);
  }

  // ---- Application ----
  let faits = 0;
  for (const p of plan) {
    if (p.action === "inchangé") continue;
    try {
      const ev = await client.enregistrerEvenement(p.e.id, { ...p.corps, locationUid: lieux.get(p.lieu).uid }, p.image);
      etat[p.e.id] = p.hash;
      faits++;
      console.log(`   ✅ ${p.e.id} (uid ${ev?.uid ?? "?"})`);
    } catch (erreur) {
      erreurs.push(`${p.e.id} : ${erreur.message}`);
    }
  }
  for (const id of suppressions) {
    try {
      await client.supprimerEvenement(id);
      delete etat[id];
      faits++;
      console.log(`   ✅ supprimé ${id}`);
    } catch (erreur) {
      erreurs.push(`suppression ${id} : ${erreur.message}`);
    }
  }
  ecrireEtat(etat);
  return terminer(erreurs, `${faits} changement(s) appliqué(s)`);
}

function terminer(erreurs, bilan) {
  if (erreurs.length) {
    console.error(`\n❌ ${erreurs.length} erreur(s) :`);
    for (const e of erreurs) console.error(`   - ${e}`);
    console.error(`\n${bilan}`);
    process.exitCode = 1;
  } else {
    console.log(`\n✨ ${bilan}`);
  }
}

main().catch((erreur) => {
  console.error(`❌ ${erreur.message}`);
  process.exitCode = 1;
});
