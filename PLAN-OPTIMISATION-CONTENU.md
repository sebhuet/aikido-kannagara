# Plan d'optimisation du contenu — Aïkido Kannagara Guyancourt

> Objectif : supprimer la redondance de contenu qui rend le site difficile à
> maintenir et à comprendre. Chaque information doit avoir **un seul domicile
> canonique** ; partout ailleurs, on met un **court renvoi (teaser + lien)**,
> jamais une copie.
>
> Cas déclencheur : la règle du hakama était écrite (différemment) à **6 endroits**.
> La corriger a demandé 6 éditions. Ce plan vise à éliminer ces situations.

---

## 1. Ce qui est DÉJÀ bien centralisé (ne pas y toucher)

Le socle technique est sain, il faut s'appuyer dessus :

| Donnée | Source unique | Diffusion |
|---|---|---|
| Nom, fondation 1990, contact, adresse, horaires, tarifs, FFAB, resp. pédago | `data/club.json` via `includes/data.php` | Lue par les pages **et** par la génération LLM/sitemap |
| Adresse + tél + email + « Affilié FFAB » + n° club + agrément | `includes/footer.php` | Affiché **sur toutes les pages** |
| Tableau des horaires | `includes/horaires.php` (lit `club.json`) | Inclus par index, club, contact, aikido, agenda, actualites, faq |
| Tarifs | variables `$p` (`club.json`) | Rendu dynamique dans inscription.php |

**Conséquence directe :** puisque le footer répète déjà l'adresse, le téléphone,
l'email et l'affiliation FFAB **sur chaque page**, tout bloc de page qui **réécrit
ces mêmes informations en dur** est un doublon pur — à retirer.

---

## 2. Principe directeur : un domicile canonique par sujet

| Sujet | Domicile canonique | Rappel toléré ailleurs (teaser + lien) |
|---|---|---|
| Téléphone / email / adresse | **footer** (partout) + `contact.php` | Ne jamais réécrire en dur |
| Lieu de pratique / carte / accès | **contact.php** | footer (adresse seule) |
| Présidente / équipe dirigeante | **club.php** | contact.php (présidente = point de contact) |
| Horaires des cours | **agenda.php** + composant `horaires.php` | teaser via composant sur l'accueil |
| Tarifs / documents / équipement / inscription | **inscription.php** | — |
| Histoire / membres / affiliations / dojo / partenaires | **club.php** | footer (FFAB) |
| Biographies des enseignants | **professeurs.php** | index (carrousel teaser) |
| Qu'est-ce que l'aïkido, histoire, principes, self-défense, femmes, enfants | **aikido.php** | index (teaser) |
| 10 fondations + chutes (ukemi) + bio Tamura | **fondations.php** | lexique (liste nue + lien) |
| Armes (jo / bokken / tanto) | **armes.php** | lexique + grades (résumé + lien) |
| Grades kyu/dan, **hakama**, programme technique | **grades.php** | inscription / faq (résumé + lien) |
| Glossaire des termes japonais | **lexique.php** | — |
| Événements à venir | **actualites.php** | — |
| Comptes-rendus datés (stages passés, passages) | **blog.php** | — |
| Foire aux questions | **faq.php** | les autres pages renvoient vers faq |

**Règle d'or de la page d'accueil (`index.php`) :** c'est un **aiguilleur**, pas un
entrepôt. Elle ne doit contenir que des teasers courts + boutons, jamais le bloc
complet (contact, adresse, carte, explication FFAB détaillée…).

---

## 3. Corrections urgentes (bugs découverts pendant l'audit)

Ces deux points ne sont pas que de la redondance, ce sont des **erreurs** :

### 3.1 — `faq.php` : horaires enfants FAUX et codés en dur
- Réponse L.367 : « Les cours enfants ont lieu le lundi et jeudi de **18h30 à 19h30** ».
- Schema.org L.60 : même valeur « **18h30 à 19h30** ».
- **Or le canonique (`club.json`) est 18h00 – 19h00.** Information erronée, en plus
  d'être dupliquée hors du composant.
- **Action :** corriger la valeur **et** cesser de l'écrire en dur (renvoyer vers
  `horaires.php` / `agenda.php`).

### 3.2 — `lexique.php` : bloc dupliqué 6× après le footer
- Le bloc « Pour aller plus loin » légitime est à **L.741** (avant `include footer.php`, L.754).
- Il est **répété 6 fois** en contenu orphelin **après** le footer (L.756 → L.902),
  rendu hors de la structure de page. Pur artefact de copier-coller.
- **Action :** supprimer les lignes **756 à 902**.

### 3.3 — (à vérifier) `inscription.php` : incohérence interne
- L.357 « 2 cours par semaine » (enfants) vs L.369 « 4 cours par semaine (6h) » (adultes).
  À confirmer factuellement — hors périmètre « doublon » mais à trancher.

---

## 4. État des lieux page par page

Légende : 🔴 doublon à retirer · 🟠 à résumer + lier · 🟢 domicile / rien à retirer.

### `index.php` — page d'accueil (le principal responsable)
La homepage recopie des morceaux de presque toutes les autres pages.
- 🔴 **Bloc « Nous contacter » complet (L.329-361)** : photo + Fanny présidente + tél
  + email + « Lieu de pratique » + liste des villes + **iframe carte**. Doublon massif
  de `contact.php` (L.104-170) et du footer. → Remplacer par un simple bandeau
  « Une question ? » + bouton vers **contact.php**.
- 🔴 **Carte « Affilié FFAB » (L.221-227)** : déjà dans le footer et détaillée dans
  `club.php`. → Retirer.
- 🟠 **Carte « Environ 50 membres » (L.199-207)** : texte quasi identique à
  `club.php` L.87-96 (domicile). → Garder au plus une phrase teaser.
- 🟠 **Sous-titre adresse de la section Horaires (L.238)** et **adresse du bloc
  contact (L.345)** : redondants avec footer/contact. → Retirer l'adresse, garder le
  lien Maps si utile.
- 🟢 **Teaser « Qu'est-ce que l'aïkido ? » (L.250-276)** : légitime (court + bouton
  « En savoir plus » → aikido.php). À conserver tel quel.
- 🟢 **Carrousel enseignants (L.285-326)** : teaser visuel acceptable sur l'accueil
  (bouton → professeurs.php). À conserver ; le détail des bios reste sur professeurs.php.
- 🟢 Include `horaires.php` (L.241) : teaser légitime via composant.

### `club.php` — identité du club 🟢 (domicile), 2 retraits
- 🔴 **Info-box « Adresse du dojo » (L.130-137)** : doublon strict du footer (L.50-54)
  et de `contact.php` (L.141-145). → Remplacer par un lien vers **contact.php**.
- 🟠 **Bloc « Notre dojo » (L.121-128)** : l'adresse + la liste des villes desservies
  vivent dans `contact.php`. → Réduire à une phrase sur le tatami/dojo + lien.
- 🟢 À conserver (domicile) : Notre histoire / Noël Stella / nom Kannagara, « Le club
  aujourd'hui » (les ~50 membres, c'est **ici** le domicile), Affiliations détaillées,
  Équipe dirigeante, Partenaires / offre CSE.

### `contact.php` — coordonnées & lieu 🟢 (destination)
- Rien à retirer. C'est le domicile de : présidente-contact, email, lieu, carte.
  Les copies à supprimer sont sur **index.php** et **club.php** (voir ci-dessus).

### `professeurs.php` — enseignants 🟢 (destination)
- Rien à retirer. Domicile des biographies et de la composition de l'équipe.
  Les doublons (noms/grades) sont sur index.php (carrousel) et club.php (Sébastien Huet
  comme dirigeant, ce qui est légitime).

### `aikido.php` — présentation générale 🟠
- 🟠 **Principes « Ai / Ki / Do » (L.154-165)** : gloses + kanji + « la voie de
  l'harmonie des énergies » redéfinissent des termes du **lexique** (L.225-229). →
  Garder une phrase, lier au lexique.
- 🟠 **« La pratique » (L.167-180)** : redéfinit *keikogi* / *hakama* (domaine lexique ;
  règle hakama = **grades.php**) et la liste *Tachi-waza / Suwari-waza / Hanmi-handachi /
  Buki-waza* (domaine lexique + grades). → Résumer sans redéfinir, ajouter les liens.
- 🟢 À conserver : histoire, filiation Tamura, bienfaits, self-défense, femmes, enfants,
  « Pour aller plus loin ».

### `fondations.php` — 10 fondations + ukemi + bio Tamura 🟢
- Domicile propre. Rien à retirer. (La citation Tamura dupliquée est à corriger côté
  **lexique**, pas ici.)

### `armes.php` — jo / bokken / tanto 🟢
- Domicile propre. Rien à retirer.

### `grades.php` — grades & programme 🟢 (hakama déjà corrigé)
- 🟠 **§ « Travail aux armes (Buki-waza) » (L.217)** : résumé légitime dans un
  programme technique. → Ajouter un lien vers **armes.php** (le détail « 128 cm » y vit).
- 🟢 Reste : domicile de la règle hakama (2e kyu), des grades et du programme technique.

### `lexique.php` — glossaire 🟠 + bug technique
- 🔴 **Bug technique** : supprimer les blocs dupliqués **L.756-902** (cf. §3.2).
- 🟠 **§ « Les fondations selon Maître Tamura » (L.702-737)** : garder le nom + la
  **liste nue** des 10 termes + le lien existant ; **retirer** la re-définition
  détaillée et la citation Tamura (doublon de `fondations.php` L.629). Le détail vit
  dans fondations.php.
- 🟠 **§ « Les armes » (L.615)** : définitions courtes légitimes pour un lexique ;
  **ajouter un lien** vers armes.php (actuellement absent).
- 🟢 Reste : domicile des définitions de termes japonais.

### `inscription.php` — inscription 🟢 (domicile), 1 retrait
- 🔴 **§ « Questions fréquentes » (L.530-559)** : 3 Q/R qui doublonnent `faq.php`
  (âge → faq L.361 ; art martial préalable → faq L.347 ; inscription en cours d'année
  → faq L.654). → Retirer, remplacer par un lien « Voir la FAQ ».
- 🟢 À conserver (domicile) : essai, documents, **tarifs (déjà dynamiques via club.json)**,
  équipement, procédure, formulaire de pré-inscription.

### `faq.php` — foire aux questions 🟠 + bug
- 🔴 **Bug horaires 18h30 (L.60 + L.367)** : cf. §3.1 — corriger et dé-durcir.
- 🟠 Réponses dont le **détail** vit ailleurs → réduire à un résumé + lien :
  - hakama (L.446-455) → **grades.php**
  - armes en aïkido (L.611) → **armes.php** / aikido.php
  - self-défense (L.632) → **aikido.php**
  - équipement (L.409-427, actuellement **sans lien**) → **inscription.php**
  - grades (L.596) et documents (L.667) : déjà liés, juste alléger le texte.
- 🟢 Structure FAQ à conserver : c'est le domicile des Q/R.

### `agenda.php` — horaires & planning 🟢
- Domicile des horaires détaillés. Aucun horaire en dur. Rien à retirer.

### `actualites.php` — événements à venir 🟠
- 🟠 **Include `horaires.php` (L.275)** dans « Cours hebdomadaires » : le tableau
  d'horaires n'a pas sa place ici (domicile = agenda). → Retirer l'include, garder la
  phrase « reprise septembre → juin » + lien **agenda.php**.
- 🟠 **« Vie du club » (L.307-321)** : recoupe la catégorie blog « Vie du club » et
  club.php. → Privilégier un renvoi plutôt qu'une liste evergreen.
- 🟢 À conserver : « Événements à venir » (dynamique), stages, passages (déjà liés).

### `blog.php` — articles 🟢
- Archives **datées** (comptes-rendus). Recoupement thématique avec actualites/grades
  **légitime** tant que blog = archive et actualites = à venir. Rien à retirer.

---

## 5. Récapitulatif priorisé

| # | Priorité | Page | Lignes | Action | Destination |
|---|---|---|---|---|---|
| 1 | 🔴 Bug | faq.php | 60, 367 | Corriger « 18h30 »→18h00 **et** dé-durcir | horaires.php / agenda.php |
| 2 | 🔴 Bug | lexique.php | 756-902 | Supprimer les blocs dupliqués après le footer | — |
| 3 | 🔴 Doublon | index.php | 329-361 | Retirer le bloc contact complet → bandeau + bouton | contact.php |
| 4 | 🔴 Doublon | club.php | 130-137 | Retirer l'info-box adresse → lien | contact.php |
| 5 | 🔴 Doublon | inscription.php | 530-559 | Retirer les 3 Q/R → lien | faq.php |
| 6 | 🟠 Doublon | index.php | 221-227, 199-207, 238, 345 | Alléger cartes FFAB / membres / adresses | footer, club.php, contact.php |
| 7 | 🟠 Doublon | faq.php | 409-427, 446, 611, 632 | Résumer réponses + ajouter liens | inscription / grades / armes / aikido |
| 8 | 🟠 Doublon | aikido.php | 154-165, 167-180 | Résumer principes/pratique sans redéfinir | lexique.php, grades.php |
| 9 | 🟠 Doublon | lexique.php | 702-737 | Liste nue + lien, retirer re-définition + citation | fondations.php |
| 10 | 🟠 Doublon | actualites.php | 275, 307-321 | Retirer include horaires + renvoyer « vie du club » | agenda.php, blog.php |
| 11 | 🟠 Finition | grades.php / lexique.php | 217 / 615 | Ajouter liens vers la page dédiée | armes.php |
| 12 | ⚪ À trancher | inscription.php | 357 vs 369 | Vérifier « 2 vs 4 cours/semaine » | — (factuel) |

---

## 6. Garde-fous pour l'avenir

1. **Un fait = un domicile.** Avant d'écrire une info sur une page, se demander :
   « est-ce le domicile de ce sujet ? » Si non → teaser court + lien.
2. **Ne jamais réécrire en dur** ce qui est dans `club.json` (horaires, tarifs,
   contact, FFAB). Utiliser le composant `horaires.php` ou les variables. Le bug des
   « 18h30 » vient exactement de cette entorse.
3. **Homepage = aiguilleur.** Teasers + boutons uniquement.
4. **Doublon éditorial récurrent ?** Si une phrase (type règle hakama) doit vraiment
   apparaître à plusieurs endroits, la stocker dans `club.json` (ou un petit include
   partagé) et l'inclure — pour ne la corriger qu'une fois.
5. **Deux blocs JSON-LD** (SportsActivityLocation sur index.php, LocalBusiness sur
   contact.php) se recoupent : acceptable pour le SEO, mais à garder synchronisés via
   `club.json` (ils le sont déjà en partie).

---

*Document généré le 2026-07-11. Références de lignes valables à cette date ; à
revérifier avant application si le code a évolué.*
