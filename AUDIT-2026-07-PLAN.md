# Audit de redondance — plan d'action (12/07/2026)

> Audit multi-agents (8 axes) sur l'état du dépôt au 12/07/2026.
> Complète PLAN-OPTIMISATION-CONTENU.md (1re passe, déjà appliquée).
> Les références de lignes sont valables à cette date — revérifier avant d'appliquer.

---

# PLAN D'ACTION CONSOLIDÉ — Aïkido Kannagara

7 axes d'audit, ~60 constats bruts → **9 lots livrables indépendamment**. Cause racine unique derrière la moitié des dérives : `data/club.json` ne modélise **qu'une seule saison** et n'est lu que par 4 pages sur 21.

---

## LOT 0 — SÉCURITÉ (à traiter avant tout le reste)

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 0.1 | **[MORT/SÉCU]** Binaire ELF 32-bit MIPS de 627 Ko commité à la racine sous le nom `app`. Référencé par aucun `.php/.js/.json`, mais poussé sur GitHub **et** sur Gandi par `deploy.sh`. Avant suppression : `git log --diff-filter=A -- app`, passage VirusTotal, puis `git rm app` + règle `.gitignore`. Si le commit d'ajout est inattendu → auditer les accès au dépôt. | `/app` | petit | Retire un artefact typique de dropper IoT du chemin de déploiement |

---

## LOT 1 — SAISONS & HORAIRES *(cause racine — à faire en premier)*

La grille horaire est écrite à la main dans **9 endroits vivants**, dont **un seul** est lu par le site. La saison **en cours** (enfants 18h30-19h30 / adultes 19h30-21h30) n'existe **dans aucune donnée** : `club.json` ne porte que la saison à venir (07/09/2026).

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 1.1 | **[DONNEE — racine]** Remplacer `season` / `seasonStart` / `schedule` (singulier) par un tableau **`seasons[]` daté** : `{label, validFrom, validThrough, days, daysSchemaOrg, children:{opens,closes}, adults:[{opens,closes}…]}`. Supprimer les champs `label` textuels (dérivables de `opens`/`closes` — helper déjà présant dans `horaires-resume.php:30`). | `htdocs/data/club.json:26-37` | moyen | Débloque **tous** les autres constats horaires |
| 1.2 | **[DONNEE]** Ajouter `club_season(?string $date=null)` (saison dont [validFrom,validThrough] contient la date) et `club_season_next()` dans `data.php`. **La bascule du 07/09/2026 devient automatique : zéro fichier à éditer ce jour-là.** | `htdocs/includes/data.php` | petit | Fin des bascules manuelles |
| 1.3 | **[DERIVE]** `horaires.php` code en dur « exactement 2 créneaux adultes » (`$s['adults'][0]`, `[1]`, `rowspan="2"`). La saison en cours n'en a **qu'un** → undefined index dès la migration. Boucler sur `$s['adults']`, `rowspan = count(...)`. | `htdocs/includes/horaires.php:30-35` | petit | Débloque 1.1 |
| 1.4 | **[DERIVE]** `horaires.php` / `horaires-resume.php` affichent la saison **en cours**, et n'ajoutent l'encart « à partir du 07/09/2026 » que si `club_season_next()` existe (il disparaît tout seul après bascule). | `includes/horaires.php:5,16`, `includes/horaires-resume.php:22` | petit | Le site cesse d'annoncer un horaire futur comme actuel |
| 1.5 | **[DERIVE]** JSON-LD : les **seules** `openingHoursSpecification` du site ont `validFrom: 2026-09-07` → pour Google, le club n'a **aucun horaire valide aujourd'hui**. Émettre une spec par créneau **et par saison**, avec `validFrom` + `validThrough`. | `index.php:81,89`, `contact.php:62-63` | petit | Restaure un balisage horaire valide |
| 1.6 | **[MORT]** Le bloc `### Horaires` d'`agenda.md` (l.14-25) est **du code mort** : `agenda-parser.php:32,47` ne rentre dans ses branches que si `$wi >= 0`, or le bloc précède le premier `## Semaine du` (l.27). C'est pourtant le seul endroit qui documente correctement les 2 saisons. Après migration : supprimer l.3-25 (ou déplacer dans `tools/prompts/`). | `htdocs/agenda.md:3-25` | petit | Supprime une 3e source de vérité fantôme |
| 1.7 | **[DONNEE]** `tools/prompts/regles.md:3-16` redéclare les DEUX grilles + jours + lieu, et c'est **lui** qui pilote la génération d'`agenda.md`. Le faire lire `club.json` (injection de la grille courante dans le prompt) au lieu de la coder en dur. | `tools/prompts/regles.md` | moyen | Sinon la bascule du 07/09 devra être refaite ici aussi |
| 1.8 | **[DONNEE]** `agenda.md` retape la grille sur **~120 lignes de séance**. Faire porter à chaque séance un TYPE (Enfants/Adultes) et laisser l'heure **vide** quand c'est celle de la saison ; le parser la résout depuis `seasons[]` via la date de la semaine. Heure explicite uniquement en cas de dérogation. | `htdocs/agenda.md:31-388`, `includes/agenda-parser.php` | moyen | Changer une grille = 1 ligne au lieu de 120 |
| 1.9 | **[DERIVE]** `affiche-aikido.html:218,222` annonce 18h00-19h00 **sans mention de saison**, alors que les 2 flyers portent bien « (saison 2026-2027) ». Une affiche posée aujourd'hui est fausse de 30 min pendant 2 mois. Minimum : ajouter la mention. Mieux : générer les 3 blocs au build. | `htdocs/affiche-aikido.html`, `flyer-aikido.html:493`, `flyer-aikido-bouygues.html:518` | petit | Support imprimé cesse de mentir |

**Copies de la grille horaire : 9 → 1.**

---

## LOT 2 — llms.txt / llms-full.txt *(le fichier le plus faux du dépôt, servi aux IA)*

Remonté par **5 axes sur 7**. 90 + 491 lignes, un **3e clone du site écrit à la main**, généré par aucun script (`build-all.js:11-14` ne lance que blog + sitemap ; le TODO est déjà écrit dans `includes/data.php:10-11`).

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 2.1 | **[DERIVE]** Les **15 URLs de `llms.txt:74-90` sont en `.html`** alors que le site est en `.php` et 301-redirige (`.htaccess:37`). C'est exactement ce que le commit « liens internes en .php » a corrigé partout **sauf ici**. Corriger immédiatement. | `htdocs/llms.txt:74-90` | petit | 15 URLs non canoniques servies aux crawlers IA |
| 2.2 | **[DERIVE]** **9 occurrences** d'horaires 2026-2027 présentés comme **actuels**, sans date de validité. Un assistant IA qui lit le site répond aujourd'hui une heure fausse. Correction d'urgence : dater ou retirer. | `llms.txt:29-30`, `llms-full.txt:30-31,117,298,326,383,467-468` | petit | Arrête l'information fausse **maintenant** |
| 2.3 | **[DERIVE]** `llms-full.txt:383` « 18h00-22h00 » : plage qui **n'existe sur aucune page** (fusion enfants+adultes). `llms-full.txt:42,381` attribue le **téléphone du club** à la présidente (2 champs distincts dans `club.json`). Supprimer. | `htdocs/llms-full.txt` | petit | 2 faits faux |
| 2.4 | **[DERIVE]** `llms-full.txt:88` « hakama pour les pratiquants avancés » contredit `club.json.hakamaFromGrade = "2e kyu"` (lu par `grades.php:110`, `inscription.php:494`). `llms.txt:55` vs `llms-full.txt:215` : Germain Chamot « est » vs « a été » rédacteur en chef → **les deux copies manuelles du même fait divergent déjà entre elles**. | `llms.txt:55`, `llms-full.txt:88,215` | petit | Preuve empirique du besoin de génération |
| 2.5 | **[DONNEE]** Écrire **`build-llms.js`** (lecture `club.json` + `professeurs/fiches/*.md` + liste d'URLs de `build-sitemap.js`) et le brancher dans `build-all.js`. ~90 occurrences de `club.json` recopiées à la main disparaissent (Maurice Baquet ×11, horaires ×22, tél ×4, tarifs ×6, Nacer Chekkaba ×9, FFAB ×39…). | `build-llms.js` (nouveau), `build-all.js:11-14` | moyen | **La plus grosse poche de duplication du dépôt** |
| 2.6 | **[MORT]** Statuer sur `llms-full.txt` (voir ARBITRAGE A) : il duplique 9 pages entières, est déjà incomplet (catégorie galerie `événement/` manquante, `llms-full.txt:475-480`), et le site est déjà crawlable en HTML + JSON-LD. Si suppression : nettoyer `robots.txt:69-70`, `index.php:46`, `sitemap.xml:100`. | | petit | −491 lignes à maintenir à la main |
| 2.7 | **[DERIVE]** Tant que `llms.txt` sert des URLs mortes, **ne pas le laisser annoncé en `rel=alternate`** (`index.php:44-45`, présent sur index uniquement). | `htdocs/index.php:44-45` | petit | |

---

## LOT 3 — club.json redevient vraiment la source unique

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 3.1 | **[DERIVE]** **Coordonnées geo contradictoires** : `club.json:23` dit `48.7678 / 2.0567`, l'iframe Maps de `contact.php:164` (Place ID réel) dit `48.772739 / 2.065928` — **~900 m d'écart**. La mauvaise valeur alimente le JSON-LD (`contact.php:57-58`, `index.php:72-73`) et les meta geo de 18 pages. → **ARBITRAGE B**, puis plus aucun littéral `48.7678` dans le dépôt. | `club.json:23`, `contact.php:164`, `index.php:72-73`, 18 `*.php` | petit (après arbitrage) | Corrige la position publiée du dojo |
| 3.2 | **[DERIVE]** **2 sources pour les enseignants** : `club.json:54` `pedagogicalLead.grade = "4e Dan Aïkido FFAB"` vs `professeurs/fiches/02-nacer-chekkaba.md:4` `"4ème Dan Aïkido FFAB"` (orthographes divergentes). Choisir **les fiches `.md`** comme domicile (plus riches, déjà parsées par `parse_fiche()`), ne garder dans `club.json` qu'une référence. → **ARBITRAGE C** | `club.json:52-56`, `professeurs/fiches/*.md` | petit | 1 source, pas 2 |
| 3.3 | **[DONNEE]** **Ajouter à `club.json`** : `childrenApprox: 20` (« une vingtaine d'enfants » : `index.php:205`, `aikido.php:378`, `club.php:90`, llms ×3) ; `board: [{role,name,phone,photo}]` (le tél du trésorier `06 37 92 75 37`, `club.php:166`, n'existe **nulle part** dans `club.json`) ; `areaServed: [...]`. | `htdocs/data/club.json` | petit | Donne un domicile à 3 faits orphelins |
| 3.4 | **[DERIVE]** **Villes desservies listées 5 fois, listes déjà divergentes** : 10 villes dans `index.php:101-112` et `contact.php:65-76` (copie caractère pour caractère), 9 en prose dans `faq.php:19-20,530-533`, mais **5 seulement** dans `contact.php:150-151` et `inscription.php:604-606` (Trappes, La Verrière, Buc ont disparu). → `club.json.areaServed` + `includes/villes.php`. | 5 fichiers ci-contre | petit | Une ville ajoutée = 1 seul endroit |
| 3.5 | **[MORT/DONNEE]** **6 clés de `club.json` lues par AUCUN PHP**, alors que leur valeur est écrite en dur dans les pages : `alternateName` (→`index.php:55`), `membersApprox` (→`index.php:203`, `club.php:9,23,29`), `founder` « Noël Stella » (→`club.php:67,72`), `sameAs` (→`index.php:94`), `logo` (→`index.php:58-59`), `region`, `shortName`. Aujourd'hui **on paie le coût des deux** : la clé donne l'illusion d'une source unique et la valeur affichée vient d'ailleurs. Brancher ou supprimer, champ par champ. → **ARBITRAGE D** | `club.json:3,4,6,8,9,21,61` | petit | Fait disparaître le plus de duplication par ligne modifiée |
| 3.6 | **[DONNEE]** Téléphone (×4) et email (×5) écrits en dur **hors** des composants centralisés : `mentions-legales.php:66,67,100`, `galerie.php:379`, `affiche.php:840`, `club.php:160`, `index.php:60-61`. Présidente en dur : `club.php:158`, `mentions-legales.php:72`, `affiche.php:840`. → `$club['contact'][...]` / `$club['board']`. | 6 fichiers | petit | |

---

## LOT 4 — JSON-LD unifié (`includes/schema-org.php`)

13 blocs manuels, **aucun** ne référence un `@id` commun. `club.json` n'alimente que 3 blocs sur 16.

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 4.1 | **[DERIVE]** **Même `@id` Person, deux descriptions différentes** : `index.php:117-120` « Plus de 50 ans de pratique, près de 40 ans d'enseignement » vs `professeurs.php:46-59` « Plus de 50 ans de pratique. » — même `@id`, `hasCredential` recopié intégralement aux deux endroits. → `index.php` ne garde qu'une **référence** `{"@id": ".../professeurs.php#jean-marc-chamot"}`. | `index.php:114-135`, `professeurs.php:46-60` | petit | Corrige un conflit d'entité pour Google |
| 4.2 | **[DERIVE]** **L'adresse du dojo existe en 2 formes incompatibles** : `index.php:65` fusionne le venue dans `streetAddress` ; `agenda.php:51-54` et `inscription.php:56-61` le mettent en `Place.name`. Aucun des 3 ne porte `addressRegion` alors que `club.json` a `location.region = FR-78`. → `schema_address()` / `schema_place()`. | `index.php:65`, `agenda.php:51-54`, `inscription.php:56-61` | petit | |
| 4.3 | **[DERIVE]** **`agenda.php` — la page domicile des horaires ne balise aucun horaire** : `@type: Event` **sans `startDate`** (Event invalide pour Google), `eventSchedule` sans `startTime`/`endTime`, `byDay` en dur. Supprimer l'Event fictif ; émettre `OpeningHoursSpecification` + `Place`. Les vraies séances datées (`agenda.md`, 30 semaines + professeur) sont, elles, balisables en `Event[]`. | `agenda.php:43,60,70-73` | moyen | Supprime un balisage invalide |
| 4.4 | **[DONNEE]** **Le nœud Organization est recopié en dur dans 10-12 fichiers** (`author` ET `publisher` sur `aikido.php:46,50`, `armes.php:50,55`, `grades.php:49,54`, `lexique.php:50`, `actualites.php:48,53`, `galerie.php:49`, `organizer` `agenda.php:60`, `provider` `inscription.php:47`, `worksFor` `professeurs.php:38`, + `blog/_template.html:38-52`). `name`+`url`+`logo ImageObject` recopiés ~15 fois. Aucun ne référence `@id: .../#organization` défini en `index.php:53`. | 12 fichiers | moyen | Fin de la recopie d'identité |
| 4.5 | **[DONNEE]** Créer **`includes/schema-org.php`** : `schema_org_id()`, `schema_organization()`, `schema_org_ref()`, `schema_place()`, `schema_address()`, `schema_geo()`, `schema_hours()` (une spec par saison, cf. LOT 1), `schema_offers()`, `schema_article()`, `schema_emit(...$nodes)` → un seul `<script>` avec `@graph`. Tout dérivé de `club.json`. Forme détaillée déjà spécifiée dans l'audit. | nouveau | gros | Socle de tout le lot |
| 4.6 | **[DONNEE]** `blog/_template.html` est le seul hors PHP : `build-blog.js` construit déjà footer et breadcrumb depuis `club.json` mais laisse le `BlogPosting` en dur → ajouter un placeholder `{{schema}}` injecté comme le footer. | `blog/_template.html:38-52`, `build-blog.js` | petit | |
| 4.7 | **[AFFICHAGE]** **Balisage creux** : `actualites.php:44` `CollectionPage` sans aucun Event (alors que la page rend `evenements.md`) ; `galerie.php:53` `ImageGallery` sans `ImageObject` ; `lexique.php:45` `DefinedTermSet` sans `DefinedTerm` ; `index.php:96-107` `areaServed` : 10 villes balisées, invisibles sur la page. → alimenter depuis la source réelle, ou rétrograder en `WebPage`. | 4 fichiers | moyen | |
| 4.8 | **[AFFICHAGE]** `club.php`, `blog.php`, `fondations.php`, `mentions-legales.php`, `statuts.php`, `reglement-interieur.php` : **aucun balisage** — alors que `club.php` est la page « à propos » (fondateur, 1990, 50 licenciés). Ajouter `AboutPage` / `Blog` / `Article` + ref `#organization`. | 6 fichiers | petit | |

---

## LOT 5 — `<head>` centralisé (`includes/head-meta.php`)

**Cause racine mécanique** : `includes/header.php:1` fait bien `require data.php`, mais header.php est inclus **dans le `<body>`** → le `<head>` de 17 pages **ne peut physiquement pas lire `club.json`**. Seuls `index.php:1`, `contact.php:1`, `faq.php:4`, `inscription.php:1` chargent `club_data()` avant le `<head>`.

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 5.1 | **[DERIVE]** Le `<head>` (~20 lignes) est copié-collé **20 fois et a déjà divergé** : `og:locale` n'existe que sur 6 pages/18, `og:site_name` **sur 1 seule** (`index.php:21`), `apple-touch-icon` sur 5/17. Personne n'a repropagé les ajouts. | 20 `*.php` | — | Constat |
| 5.2 | **[DONNEE]** Bloc `geo.region` / `geo.placename` / `geo.position "48.7678;2.0567"` / `ICBM` recopié **à l'identique sur 18 pages** + `blog/_template.html:28`, alors que `club.json:23` le porte. | 18 `*.php` | — | −72 lignes |
| 5.3 | **[AFFICHAGE]** `og:description` == `twitter:description` sur **16 pages sur 18** ; sur `statuts.php:9/22/28`, `reglement-interieur.php:9/22/28`, `mentions-legales.php:9/22/28` **le même texte est écrit trois fois**. Seules exceptions réelles : `faq.php` et `galerie.php`. | 18 `*.php` | — | |
| 5.4 | **[DONNEE]** **109 occurrences** littérales de `https://kannagara.fr` (canonical ×18, og:url ×18) et **45** de l'URL du logo (og:image + twitter:image ×36), alors que `club.json` expose `url` et `logo`. | 18 `*.php` | — | Changement de domaine = 1 ligne |
| 5.5 | **[DONNEE — le correctif]** Créer **`includes/head-meta.php`** exposant `page_meta(['title','description','canonical','type','image'])` : émet title/description/robots/canonical/og:*/twitter:*/geo:*/author/`og:site_name`/`og:locale` depuis `club_data()`, avec `twitter:* = og:*` par défaut et `og:description = description` par défaut. **Ajouter `require_once __DIR__.'/includes/data.php';` en ligne 1 de CHAQUE page.** Chaque page ne garde que 2-4 lignes spécifiques. → **ARBITRAGE E** (forme + périmètre : 18-20 fichiers touchés) | nouveau + 20 `*.php` | gros | **~200-270 lignes supprimées**, `og:*` uniformes d'office, geo branché sur club.json |
| 5.6 | **[MORT]** `meta keywords` sur **15 pages** (ignoré par Google depuis 2009), + construction dynamique de `$meta_keywords` dans `professeurs.php:85` **jamais exploitée**. Supprimer. → **ARBITRAGE F** | 15 `*.php` | petit | −15 lignes, 0 impact SEO |
| 5.7 | **[DONNEE]** Meta descriptions recopiant des faits de `club.json` : `index.php:9` (« Nacer Chekkaba… Gymnase Maurice Baquet, lundi et jeudi »), `club.php:8,9` (« depuis 1990 », « Environ 50 membres »). `contact.php:9` fait **déjà bien** (interpole `$loc['venue']`) → appliquer le même pattern. | `index.php:9`, `club.php:8-9` | petit | |

---

## LOT 6 — Fil d'Ariane + `page-header` (table de routes unique)

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 6.1 | **[DERIVE]** **Le fil visible contredit le JSON-LD** : `lexique.php:187`, `fondations.php:257`, `armes.php:240` affichent **3 niveaux** (« Accueil / Aïkido / … ») alors que `includes/breadcrumb.php:32-38` n'émet que **2 ListItem**. `statuts.php:51` et `reglement-interieur.php:51` affichent un palier « Mentions légales » **absent de `$__bcTitles`** → aucun JSON-LD émis. Google reçoit un fil différent de celui que voit l'utilisateur. → **ARBITRAGE G** | `breadcrumb.php`, 5 pages | moyen | Referme la dérive |
| 6.2 | **[DERIVE]** **3 tables de libellés divergentes** pour le même fil : `breadcrumb.php:13` `'aikido' => "L'Aïkido"` vs `aikido.php:254` fil visible « Aïkido » ; `header.php:19` `'club' => 'Club'` vs `breadcrumb.php:14` `'club' => 'Le Club'`. → **une seule table `{slug => [titre, parentSlug]}`** consommée par `header.php` (nav), `breadcrumb.php` (JSON-LD) **et** le fil visible. | `includes/header.php:19`, `includes/breadcrumb.php:13-14` | petit | Le bug se referme mécaniquement |
| 6.3 | **[AFFICHAGE]** Bloc `section.page-header > h1 + p.page-header__breadcrumb` **copié à l'identique sur 20 pages** (8 lignes chacune ; `aikido.php:77-84`, `club.php:49-56`, `contact.php:90-97`, `agenda.php:248-255`…). → `includes/page-header.php`, appelé depuis `header.php` juste après `<main>`. | 20 `*.php` | moyen | **~115 lignes** ; le fil visible ne peut plus contredire le JSON-LD |
| 6.4 | **[MORT]** `includes/breadcrumb.php:7` — docblock « les URLs suivent la forme canonique actuelle (.html) » alors que la ligne 36 émet `.php`. Corriger. | `includes/breadcrumb.php:7` | trivial | |

---

## LOT 7 — Éditorial (contradictions lisibles par un visiteur)

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 7.1 | **[DERIVE]** **L'équipe est décrite comme 4 personnes alors que le site en publie 5.** `professeurs.php:145-148` annonce 4 enseignants puis rend **5 fiches** juste en dessous (la page se contredit elle-même). Même phrase à 4 noms dans `index.php:184-186`, `index.php:215-216`, `faq.php:562-565`, `faq.php:112` (JSON-LD FAQPage), `aikido.php:94-95` — pendant que le carrousel `index.php:280-310` affiche bien 5. **Sébastien Huet** (`fiches/05-sebastien-huet.md`) est absent de **toutes** les phrases. → **ARBITRAGE H**, puis `includes/equipe-resume.php` généré depuis les fiches. | 5 fichiers | moyen | Corrige une contradiction visible |
| 7.2 | **[DERIVE]** **« Cours d'essai gratuit » : 5 formulations contradictoires.** `inscription.php:510` « (gratuit en septembre) » → sous-entend **payant** le reste de l'année ; `armes.php:508` et `aikido.php:455` « cours d'essai gratuit » **sans condition** ; `faq.php:488-490` « particulièrement en septembre » ; `contact.php:216` sans condition. Le JSON-LD `inscription.php:45` fige la version restrictive. **Un visiteur de janvier ne peut pas savoir si l'essai lui est facturé.** → **ARBITRAGE I**, puis `trialPolicy` dans `club.json` + `includes/essai.php`. | 6 fichiers | petit | Corrige une promesse commerciale contradictoire |
| 7.3 | **[DERIVE]** Jean-Marc Chamot : filiation Nocquet/Tamura/Sugano réécrite dans `faq.php:128` (JSON-LD), `faq.php:579-584` (clair), `aikido.php:148-150` — source réelle : `fiches/01-jean-marc-chamot.md:11-13`. Ajouter `schemaDescription`/`credentials` au front-matter ; `professeurs.php` seul émetteur. Ailleurs : phrase + lien `professeurs.php#jean-marc-chamot`. | 4 fichiers | moyen | (fusionne avec 4.1) |
| 7.4 | **[DONNEE]** Le **carrousel d'accueil recopie à la main** noms + grades + photos des 5 fiches (`index.php:279-311`), et les 5 `aria-label` de pagination répètent encore les 5 noms (`index.php:306-310`). → même boucle `glob(fiches/*.md)` + `parse_fiche()` que `professeurs.php:5-13`. | `index.php:279-311` | petit | Un grade modifié met à jour accueil + carrousel + professeurs d'un coup |
| 7.5 | **[DONNEE]** Identité du club (`1990`, `Noël Stella`, `~50 licenciés`) en dur : `club.php:8,9,23,29,67,72,89-90`, `index.php:56,62,183,203-205` (copie intégrale de `club.php`), `aikido.php:378`. Domicile éditorial = `club.php` ; le reste lit `club_data()`. Sur `aikido.php:378`, supprimer le comptage (il n'y apporte rien). | 3 fichiers | petit | |
| 7.6 | **[AFFICHAGE]** **`club.php` répète FFAB deux fois dans la même page** : carte « FFAB » (`club.php:104-105`) et carte partenaire « FFAB » (`club.php:192-196`), ~90 lignes plus bas, **même phrase** ; + `club.php:112-115` « Agrément Jeunesse et Sports », déjà dans `footer.php:11-12` **sur toutes les pages**. → supprimer la section « Affiliations et agréments » (l.~99-119), garder la carte partenaire (lien sortant). → **ARBITRAGE J** | `club.php:99-119` | petit | |

---

## LOT 8 — Composants d'affichage

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 8.1 | **[DERIVE]** **`agenda.php` casse le composant global `.info-box`** : `css/style.css:493` la définit en blanc + liseré rouge (utilisée sur **12 pages**) ; le `<style>` inline d'`agenda.php` la réécrit **intégralement** en dégradé rouge plein + texte blanc (y compris `h3/p/strong`). Même nom de classe → deux composants visuellement opposés ; toute retouche de `.info-box` est **silencieusement ignorée** sur agenda. → renommer en `.info-box--highlight` et remonter dans `style.css`. → **ARBITRAGE K** | `agenda.php` (style inline), `css/style.css:493` | petit | Referme une dérive CSS active |
| 8.2 | **[AFFICHAGE]** **CTA de fin de page dupliqué ~12 fois**, avec libellés qui divergent par simple faute de casse née du copier-coller : `aikido.php:457` « Commencer l'**A**ïkido » vs `grades.php:226` « Commencer l'**a**ïkido » ; « S'inscrire » / « S'inscrire au club » / « Rejoindre le club ». → `includes/cta.php`. | 12 `*.php` | petit | ~25 lignes |
| 8.3 | **[AFFICHAGE]** **« Pour aller plus loin » : même titre, 3 structures et 2 niveaux de titre** — `aikido.php:396` (h2, cards-grid), `fondations.php:641` (h2, btn-group), `lexique.php:732` (**h3**, info-box). Le h2/h3 abîme la hiérarchie des titres. → `includes/pour-aller-plus-loin.php` (rendu unique, chaque page passe ses liens). | 3 `*.php` | petit | ~40 lignes |
| 8.4 | **[AFFICHAGE]** `footer.php:66` s'arrête à `</footer>` → **20 pages recopient** `<script src="js/main.js" defer>` + `</body></html>`. Déplacer dans `footer.php` avec un `$scripts_extra` optionnel (galerie, faq). Idem : le style inline `max-width:700px; margin:0 auto; text-align:center` est répété **mot pour mot** sur `actualites.php:254`, `armes.php:504`, `galerie.php:372`, `lexique.php:731` → classe `.info-box--cta`. | `includes/footer.php`, 20 `*.php` | petit | ~50 lignes |

---

## LOT 9 — Ménage (code mort, à froid)

| # | Action | Fichiers | Effort | Gain |
|---|---|---|---|---|
| 9.1 | **[MORT — prioritaire]** **4 scripts de migration one-shot morts, dont 2 destructeurs** : `sync-layout.js` et `fix-navigation.js` **réinjectent un header/footer en dur dans chaque page** — ils annuleraient l'architecture `includes/` si quelqu'un les relançait par réflexe. + `add-agenda-to-nav.js`, `analyze-seo.js`. Appelés par aucun build (`build-all.js:11-14`, `deploy.sh:5`). **Supprimer les 4 et retirer leurs mentions de `.claude/CLAUDE.md` et `.claude/settings.local.json`** (sinon ils resteront suggérés). | racine | petit | Élimine un risque de régression majeure |
| 9.2 | **[MORT]** **`feed.xml` n'est généré par aucun script** (`build-blog.js` ne contient pas une occurrence de « feed »). Dernier `pubDate` : Jan 2024 — il coïncide **par hasard** avec le dernier article. **Le premier nouvel article publiera un flux RSS silencieusement incomplet, sans erreur visible.** → générer dans `build-blog.js` (qui parse déjà les front-matters et connaît `club.json`). | `htdocs/feed.xml`, `build-blog.js` | petit | Bombe à retardement désamorcée |
| 9.3 | **[MORT]** **2 pages entièrement orphelines** : `affiche.php` (47 Ko, 578 lignes de `<style>` inline, copie en dur de l'adresse du club) et `stats_profs.php` (parse `agenda.md`, règle métier en dur l.134-135 « Ignorer Jean-Marc Chamot »). Aucun `href=` entrant, absentes de `header.php`, `footer.php` et `sitemap.xml` — mais **publiquement accessibles par URL directe**. → **ARBITRAGE L** | `htdocs/affiche.php`, `htdocs/stats_profs.php` | petit | 55 Ko de code non maintenu |
| 9.4 | **[MORT]** **CSS : 25 classes sur 118 jamais utilisées** (~21 %). Suppression **sans risque** : `.schedule__day/__group/__item/__time` (rendus caducs par `includes/horaires.php`), utilitaires morts (`.mb-0/1/3/4`, `.mt-0`, `.text-left/accent/secondary`), `.hero__logo/__enso/__encre`, `.header__logo-text/-subtitle`, `.btn--secondary`, `.team-member__bio`. **Vérifier avant suppression** : `.form__*` (contact/inscription ne les utilisent pas, mais confirmer). | `htdocs/css/style.css` | petit | |
| 9.5 | **[MORT]** ~1 900 lignes de `<style>` inline (`affiche.php` 578, `fondations.php` 201, `galerie.php` 191, `faq.php` 169, `agenda.php` 157, `armes.php` 154, `inscription.php` 150…). Chantier de fond, à remonter progressivement dans `style.css` en commençant par les plus gros. | 8 `*.php` | gros | |
| 9.6 | **[MORT]** `build-sitemap.js:37-38` déclare `llms.txt`/`llms-full.txt` en `changefreq: monthly` alors que **rien ne les met à jour**. Aligner après le LOT 2. | `build-sitemap.js:37-38` | trivial | |

---

## ⚖️ ARBITRAGES REQUIS (choix éditoriaux ou produit — non tranchés)

| Réf | Question | Bloque |
|---|---|---|
| **A** | **`llms-full.txt` : générer (build-llms.js) ou supprimer ?** Les 300 lignes narratives (bios, histoire, fondations) **ne se dérivent pas de `club.json`** — il faudrait les templater. Or le site est déjà crawlable en HTML + JSON-LD. 3 options identifiées : (1) générer les deux ; (2) garder un `llms.txt` généré + supprimer `llms-full` ; (3) abandonner les deux. | LOT 2 |
| **B** | **Quelle est la vraie position du Gymnase Maurice Baquet ?** `club.json` : 48.7678/2.0567. L'embed Google (Place ID réel) : 48.77274/2.06593. **~900 m d'écart.** | LOT 3, 4, 5 |
| **C** | **Enseignants : domicile unique = les fiches `.md` (et on supprime `pedagogicalLead` de `club.json`), ou l'inverse ?** | LOT 3, 7 |
| **D** | **Champs morts de `club.json`** (`shortName`, `founder`, `membersApprox`, `pedagogicalLead`, `region`, `logo`, `sameAs`, `alternateName`) : **brancher ou supprimer**, champ par champ ? Recommandation de l'audit : brancher `founder`/`membersApprox`/`logo`/`sameAs` (déjà affichés en dur), supprimer `shortName`/`region`. | LOT 3 |
| **E** | **Head centralisé** (`includes/head-meta.php`) : c'est **la correction la plus structurante** (18-20 fichiers touchés + `require data.php` en ligne 1 de chaque page). Go/no-go, et forme : `page_meta([...])` appelé en 1 ligne (explicite) vs include lisant `$pageTitle`/`$pageDescription` (plus proche du style actuel) ? | LOT 5 |
| **F** | **`meta keywords` : suppression sur les 15 pages ?** Aucun moteur ne les lit, mais c'est une suppression visible. | LOT 5 |
| **G** | **Fil d'Ariane : 3 niveaux partout** (on aligne `breadcrumb.php` sur les pages) **ou 2 niveaux partout** (on aligne les pages) ? Les deux se défendent — à trancher **avant** de créer la table de routes. | LOT 6 |
| **H** | **L'équipe compte 4 ou 5 enseignants ?** Les fiches et le carrousel disent 5 (avec Sébastien Huet), **toutes** les phrases du site disent 4. | LOT 7 |
| **I** | **Le cours d'essai est-il gratuit toute l'année, ou seulement en septembre ?** La réponse fixe la formulation unique et corrige `aikido.php`/`armes.php` (qui promettent aujourd'hui la version la plus généreuse). | LOT 7, 8 |
| **J** | **Garder la section « Affiliations et agréments » de `club.php`**, sachant que le footer affiche déjà FFAB + Jeunesse et Sports sur **chaque** page ? | LOT 7 |
| **K** | **La variante rouge de `.info-box` sur `agenda.php` est-elle voulue** (→ `.info-box--highlight`) **ou accidentelle** (→ suppression, rendu standard) ? | LOT 8 |
| **L** | **`affiche.php` et `stats_profs.php`** : outils internes à sortir de `htdocs/` (vers `tools/`) ou pages à supprimer ? | LOT 9 |
| **M** | **Saison 2025-2026** : (a) confirme-t-on qu'elle n'a **qu'UN** créneau adultes (19h30-21h30) là où la suivante en a deux ? (b) **quelle est sa date de `validFrom` ?** Elle n'est écrite **nulle part** dans le dépôt (`agenda.md` ne remonte qu'au 05/01/2026). | LOT 1 |
| **N** | **`og:image`** : garder le logo partout, ou permettre une image dédiée par page (galerie, blog, actualités gagneraient une vraie photo en aperçu de partage) ? | LOT 5 |
| **O** | **Le binaire `app`** : l'avez-vous ajouté volontairement ? Sinon → incident de sécurité, pas ménage. | LOT 0 |

---

## 🏆 LES 5 ACTIONS QUI RAPPORTENT LE PLUS

**1. Migrer `club.json` vers `seasons[]` + `club_season()` dans `data.php`** *(LOT 1.1-1.5 — effort moyen)*
Cause racine de la moitié des dérives du site. Aujourd'hui la saison **en vigueur** n'existe dans aucune donnée : le site, les llms, l'affiche et les JSON-LD annoncent tous un horaire qui ne sera vrai qu'au 07/09/2026. Corrige le site **et** rend la bascule du 07/09 automatique (zéro fichier à éditer ce jour-là). **Copies de la grille : 9 → 1.**

**2. Corriger *maintenant* les 15 URLs `.html` et les 9 horaires faux de `llms.txt`/`llms-full.txt`** *(LOT 2.1-2.4 — effort petit)*
Ce sont les fichiers **explicitement servis aux IA**, et ils sont faux **aujourd'hui** : ils envoient les crawlers sur 15 URLs qui 301-redirigent, et font répondre une heure de cours erronée. Une heure de travail, effet immédiat. Puis `build-llms.js` (LOT 2.5) supprime ~90 copies manuelles de `club.json`.

**3. Supprimer `sync-layout.js` et `fix-navigation.js` (+ leurs mentions dans `.claude/`)** *(LOT 9.1 — effort petit)*
Ces deux scripts **réinjectent header et footer en dur dans chaque page**. Un `node sync-layout.js` lancé par réflexe détruit toute l'architecture `includes/`. C'est le risque de régression le plus violent du dépôt, pour 5 minutes de suppression. (Et : traiter le binaire `app`, LOT 0.)

**4. `includes/head-meta.php` + `require data.php` en ligne 1 de chaque page** *(LOT 5.5 — effort gros)*
Le plus gros gain net : **~200-270 lignes supprimées**, 109 occurrences d'URL et 45 du logo ramenées à 1, `og:locale`/`og:site_name`/`apple-touch-icon` uniformes d'office. Surtout, c'est le **déblocage structurel** : tant que le `<head>` ne peut pas lire `club.json`, aucune centralisation de meta/geo/JSON-LD n'est possible sur 17 pages.

**5. Trancher les 3 contradictions visibles par un visiteur : 4 vs 5 enseignants, essai gratuit, coordonnées geo** *(ARBITRAGES B, H, I — effort petit une fois tranché)*
Ce ne sont pas des dettes techniques mais des **bugs produit actifs** : `professeurs.php` se contredit dans sa propre page ; un visiteur de janvier ne peut pas savoir si son cours d'essai est facturé ; le club publie une position à 900 m de son dojo. Coût de correction quasi nul, coût d'inaction payé à chaque visite.