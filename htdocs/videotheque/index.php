<!doctype html>
<!-- Généré par tools/integrer_videotheque.js depuis la vidéothèque (index.html) : ne pas modifier ici. -->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="theme-color" content="#141312">
  <title>Techniques d'aïkido en vidéo | Kannagara Guyancourt</title>
  <meta name="description" content="158 techniques d'aïkido en vidéo, par attaque, technique, kyu ou sensei : ralenti, image par image et mode interrogation. Vidéothèque du club Kannagara.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://kannagara.fr/videotheque/">
  <meta property="og:title" content="Techniques d'aïkido en vidéo | Kannagara Guyancourt">
  <meta property="og:description" content="158 techniques d'aïkido en vidéo, par attaque, technique, kyu ou sensei : ralenti, image par image et mode interrogation. Vidéothèque du club Kannagara.">
  <meta property="og:image" content="https://kannagara.fr/images/partage/videotheque.jpg">
  <meta property="og:locale" content="fr_FR">
  <meta property="og:site_name" content="Aïkido Kannagara Guyancourt">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Techniques d'aïkido en vidéo | Kannagara Guyancourt">
  <meta name="twitter:description" content="158 techniques d'aïkido en vidéo, par attaque, technique, kyu ou sensei : ralenti, image par image et mode interrogation. Vidéothèque du club Kannagara.">
  <meta name="twitter:image" content="https://kannagara.fr/images/partage/videotheque.jpg">
  <script>document.documentElement.classList.add("js")</script>
  <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Techniques d'aïkido en vidéo",
  "description": "158 techniques d'aïkido en vidéo, par attaque, technique, kyu ou sensei : ralenti, image par image et mode interrogation. Vidéothèque du club Kannagara.",
  "url": "https://kannagara.fr/videotheque/",
  "inLanguage": "fr",
  "image": "https://kannagara.fr/images/partage/videotheque.jpg",
  "about": {
    "@type": "Thing",
    "name": "Aïkido"
  },
  "isPartOf": {
    "@id": "https://kannagara.fr/#website"
  },
  "publisher": {
    "@type": "SportsClub",
    "@id": "https://kannagara.fr/#organization",
    "name": "Aïkido Kannagara Guyancourt",
    "url": "https://kannagara.fr/"
  }
}
  </script>
  <link rel="canonical" href="https://kannagara.fr/videotheque/">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
  <link rel="stylesheet" href="style.css?v=3349e5046f">
  <style>
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
    .statique ul { margin: 0 0 0 1.2rem; }
  </style>
</head>
<body class="page-videotheque">
<?php $active = 'videotheque'; include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>
<header class="barre">
  <button class="marque" id="accueil" type="button" title="Revenir à la liste complète">
    <span class="marque__point" aria-hidden="true"></span>
    <span>
      <span class="marque__nom" data-i18n="titre">Techniques d'aïkido</span><br>
      <span class="marque__sous" data-i18n="sousTitre">Vidéothèque de révision</span>
    </span>
  </button>
  <div class="recherche">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 3a7 7 0 0 1 5.6 11.2l5.1 5.1-1.4 1.4-5.1-5.1A7 7 0 1 1 10 3zm0 2a5 5 0 1 0 0 10 5 5 0 0 0 0-10z"/></svg>
    <input id="q" type="search" autocomplete="off" data-i18n-placeholder="recherche" placeholder="Rechercher : technique, attaque, sensei, kyu…" aria-label="Rechercher" title="Raccourci : /  ·  Entrée lit la première vidéo  ·  Échap efface">
  </div>
  <button class="bouton" id="hasard" type="button" data-i18n-title="hasardTitre" title="Lire une technique au hasard parmi la sélection">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17 3l4 4-4 4V8h-2.6l-3 3.5-1.3-1.5 3.4-4H17zM3 6h4.6l9.4 11H17v-3l4 4-4 4v-3h-2.6L5 8H3zm0 10h2l2.2-2.6 1.3 1.5L6 18H3z"/></svg>
    <span class="bouton__texte" data-i18n="hasard">Au hasard</span>
  </button>
  <button class="bouton" id="interroger" type="button" data-i18n-title="interroTitre" title="S'interroger sur la sélection, comme à un passage de grade : le nom de la technique d'abord, la vidéo ensuite (I)">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm-1 11h2v2h-2zm1-9a3.5 3.5 0 0 1 1.9 6.4c-.6.4-.9.7-.9 1.3v.3h-2v-.4c0-1.3.7-2 1.6-2.6A1.5 1.5 0 1 0 10.5 9.5h-2A3.5 3.5 0 0 1 12 6z"/></svg>
    <span class="bouton__texte" data-i18n="interroger">S'interroger</span>
  </button>
  <button class="bouton" id="ouvrir-apropos" type="button" data-i18n-title="aproposTitre" title="À propos de cette vidéothèque">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a10 10 0 1 1 0 20 10 10 0 0 1 0-20zm0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16zm1 7v6h-2v-6zm0-4v2h-2V7z"/></svg>
    <span class="bouton__texte" data-i18n="apropos">À propos</span>
  </button>
  <button class="bouton bouton--langue" id="langue" type="button" title="English">EN</button>
</header>

<div class="mise">
  <aside class="filtres" aria-label="Filtres">
    <div class="filtres__tete">
      <h2 data-i18n="filtresTitre">Choisir dans n'importe quel ordre</h2>
    </div>
    <div id="facettes"></div>
    <button class="lien" id="effacer" type="button" data-i18n="toutEffacer">Tout effacer</button>
  </aside>

  <main>
    <h1 class="sr-only">Techniques d'aïkido en vidéo : la vidéothèque du club Aïkido Kannagara Guyancourt</h1>
    <!-- Lecteur intégré -->
    <section class="lecteur" id="lecteur" hidden aria-label="Lecteur vidéo">
      <div class="lecteur__entete">
        <div class="lecteur__infos">
          <p class="lecteur__ctx" id="l-ctx"></p>
          <h2 class="lecteur__titre" id="l-titre"></h2>
          <p class="lecteur__source" id="l-source"></p>
        </div>
        <div class="lecteur__versions" id="l-versions"></div>
        <span class="lecteur__pos" id="l-pos"></span>
        <button class="icone" id="l-fermer" type="button" aria-label="Fermer le lecteur" data-i18n-title="fermer" title="Fermer le lecteur">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" fill="none"/></svg>
        </button>
      </div>

      <div class="ecran" id="l-ecran">
        <div class="ecran__cadre">
          <div class="ecran__video" id="l-video"><div id="yt"></div></div>
          <div class="attente" id="l-attente" hidden></div>
          <!-- Interrogation : énoncé de la technique, vidéo cachée jusqu'à la réponse -->
          <div class="question" id="l-question" aria-live="polite" hidden></div>
          <div class="flash" id="l-flash" aria-hidden="true"></div>
        </div>

        <div class="commandes" id="l-commandes">
          <div class="ligne-temps">
            <div class="piste">
              <div class="zone-ab" id="l-zone" hidden></div>
              <input class="progression" id="l-prog" type="range" min="0" max="0" step="0.001" value="0" aria-label="Position dans le clip">
            </div>
            <span class="temps" id="l-temps">0:00 / 0:00</span>
          </div>

          <div class="ligne-boutons">
            <div class="groupe-cmd" role="group" aria-label="Lecture">
              <button class="cmd" id="c-prec" type="button" data-i18n-title="cPrec" title="Clip précédent (P)" aria-label="Clip précédent">
                <svg viewBox="0 0 24 24"><path d="M6 5h2v14H6zM20 5v14L9 12z"/></svg>
              </button>
              <button class="cmd" id="c-recul" type="button" data-i18n-title="cRecul" title="Reculer de 2 s (←)">−2 s</button>
              <button class="cmd" id="c-img-prec" type="button" data-i18n-title="cImgPrec" title="Image précédente (,)" data-i18n="imgMoins">−1 img</button>
              <button class="cmd cmd--lecture" id="c-lecture" type="button" data-i18n-title="cLecture" title="Lecture / pause (Espace)" aria-label="Lecture">
                <svg viewBox="0 0 24 24"><path id="c-lecture-ic" d="M8 5v14l11-7z"/></svg>
              </button>
              <button class="cmd" id="c-img-suiv" type="button" data-i18n-title="cImgSuiv" title="Image suivante (.)" data-i18n="imgPlus">+1 img</button>
              <button class="cmd" id="c-avance" type="button" data-i18n-title="cAvance" title="Avancer de 2 s (→)">+2 s</button>
              <button class="cmd" id="c-suiv" type="button" data-i18n-title="cSuiv" title="Clip suivant (N)" aria-label="Clip suivant">
                <svg viewBox="0 0 24 24"><path d="M16 5h2v14h-2zM4 5v14l11-7z"/></svg>
              </button>
            </div>

            <div class="groupe-cmd" role="group" aria-label="Vitesse" id="c-vitesses">
              <span class="libelle-cmd" data-i18n="vitesse">Vitesse</span>
            </div>

            <div class="groupe-cmd" role="group" aria-label="Options">
              <button class="cmd" id="c-ab" type="button" data-i18n-title="cAB" title="Boucle sur un passage : 1er clic = début, 2e clic = fin, 3e clic = annuler (B)">A-B</button>
              <button class="cmd" id="c-boucle" type="button" aria-pressed="true" data-i18n-title="cBoucle" title="Lire le clip en boucle (L)" data-i18n="boucle">Boucle</button>
              <button class="cmd" id="c-miroir" type="button" aria-pressed="false" data-i18n-title="cMiroir" title="Image en miroir, pour travailler l'autre côté (M)" data-i18n="miroir">Miroir</button>
              <button class="cmd" id="c-enchainer" type="button" aria-pressed="false" data-i18n-title="cEnchainer" title="Enchaîner automatiquement le clip suivant de la liste (E)" data-i18n="enchainer">Enchaîner</button>
              <button class="cmd" id="c-son" type="button" aria-pressed="false" data-i18n-title="cSon" title="Son (S)" aria-label="Son">
                <svg viewBox="0 0 24 24"><path id="c-son-ic" d="M4 9h4l5-4v14l-5-4H4zM16 9l5 6m0-6l-5 6"/></svg>
              </button>
              <button class="cmd" id="c-plein" type="button" data-i18n-title="cPlein" title="Plein écran (F)" aria-label="Plein écran">
                <svg viewBox="0 0 24 24"><path d="M4 9V4h5v2H6v3zm10-5h6v5h-2V6h-4zM4 15h2v3h3v2H4zm14 3v-3h2v5h-5v-2z"/></svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Interrogation : avancement, verdict, mains libres (visible aussi en plein écran) -->
        <div class="interro" id="l-interro" hidden></div>
      </div>

      <div class="lecteur__versions lecteur__versions--bas" id="l-versions-bas"></div>

      <div class="lecteur__pied">
        <span class="precision" id="l-precision"></span>
        <span id="l-origine"></span>
      </div>

      <div class="file" id="l-file" hidden>
        <div class="file__tete"><strong data-i18n="file">Liste de lecture</strong><span id="l-file-info"></span></div>
        <div class="file__liste" id="l-file-liste"></div>
      </div>

      <p class="raccourcis" data-i18n-html="raccourcis">
        <kbd>Espace</kbd> lecture/pause · <kbd>←</kbd> <kbd>→</kbd> 2 s · <kbd>,</kbd> <kbd>.</kbd> image par image ·
        <kbd>↓</kbd> <kbd>↑</kbd> ralentir/accélérer · <kbd>B</kbd> boucle A-B · <kbd>L</kbd> boucle · <kbd>M</kbd> miroir ·
        <kbd>E</kbd> enchaîner · <kbd>S</kbd> son · <kbd>F</kbd> plein écran · <kbd>P</kbd> <kbd>N</kbd> clip précédent/suivant ·
        <kbd>I</kbd> s'interroger · <kbd>J</kbd> <kbd>R</kbd> je savais / à revoir
      </p>
    </section>

    <div class="annonce" id="annonce" role="status" aria-live="polite"></div>
    <div class="vues" id="vues" role="group" aria-label="Regrouper par"></div>
    <div class="resume" id="resume" aria-live="polite"></div>
    <div id="resultats">
      <div class="statique">
        <p>La vidéothèque du club Aïkido Kannagara Guyancourt réunit 260 clips de 158 techniques d'aïkido, du 6e kyu au shodan, présentées par Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé, tirés de 24 vidéos publiées par Greg Habert et Aïkido FFAB Île de France. On les retrouve par attaque, par technique, par niveau de kyu ou par sensei, avec ralenti, image par image, miroir et un mode interrogation pour réviser les passages de grade. Les vidéos restent hébergées sur YouTube : chaque clip renvoie à la vidéo d'origine.</p>
        <h2>Tachi Waza · Ai Hanmi Katate Dori</h2>
        <ul>
          <li>Ikkyo omote : 6e kyu, Aurélie Lucchetti et Greg Habert</li>
          <li>Ikkyo ura : 6e kyu, Aurélie Lucchetti et Greg Habert</li>
          <li>Nikyo omote : 6e kyu, Aurélie Lucchetti et Greg Habert</li>
          <li>Nikyo ura : 6e kyu, Aurélie Lucchetti et Greg Habert</li>
          <li>Kote Gaeshi : 6e kyu, Aurélie Lucchetti et Greg Habert</li>
          <li>Shiho Nage : 6e kyu, Greg Habert</li>
          <li>Shiho Nage omote : 6e kyu, Aurélie Lucchetti</li>
          <li>Shiho Nage ura : 6e kyu, Aurélie Lucchetti</li>
          <li>Ude Kime Nage : 4e kyu, Greg Habert</li>
          <li>Ude Kime Nage omote : 4e kyu, Aurélie Lucchetti</li>
          <li>Ude Kime Nage ura : 4e kyu, Aurélie Lucchetti</li>
          <li>Irimi Nage : 6e kyu, Greg Habert</li>
          <li>Irimi Nage omote : 6e kyu, Aurélie Lucchetti</li>
          <li>Irimi Nage ura : 6e kyu, Aurélie Lucchetti</li>
          <li>Koshi Nage : 2e kyu, Aurélie Lucchetti et Greg Habert</li>
          <li>Kokyu Nage : shodan, Aurélie Lucchetti et Greg Habert</li>
        </ul>
        <h2>Tachi Waza · Kata Dori</h2>
        <ul>
          <li>Ikkyo omote : 4e kyu, Greg Habert</li>
          <li>Ikkyo ura : 4e kyu, Greg Habert</li>
        </ul>
        <h2>Tachi Waza · Ryote Dori</h2>
        <ul>
          <li>Ikkyo omote : 3e kyu, Greg Habert et Stéphane Cissé</li>
          <li>Ikkyo ura : 3e kyu, Greg Habert et Stéphane Cissé</li>
          <li>Kote Gaeshi : 2e kyu, Greg Habert et Stéphane Cissé</li>
          <li>Shiho Nage : 3e kyu, Stéphane Cissé</li>
          <li>Ude Kime Nage : shodan, Stéphane Cissé</li>
          <li>Irimi Nage : 2e kyu, Stéphane Cissé</li>
          <li>Tenchi Nage : 4e kyu, Greg Habert</li>
          <li>Tenchi Nage omote : 4e kyu, Stéphane Cissé</li>
          <li>Tenchi Nage ura : 4e kyu, Stéphane Cissé</li>
          <li>Koshi Nage : shodan, Greg Habert et Stéphane Cissé</li>
          <li>Kokyu Nage : shodan, Greg Habert et Stéphane Cissé</li>
        </ul>
        <h2>Tachi Waza · Katate Ryote Dori</h2>
        <ul>
          <li>Ikkyo omote : 3e kyu, Greg Habert</li>
          <li>Ikkyo ura : 3e kyu, Greg Habert</li>
          <li>Nikyo ura : 3e kyu, Greg Habert</li>
          <li>Kote Gaeshi : 3e kyu, Greg Habert</li>
          <li>Shiho Nage : shodan, Greg Habert</li>
          <li>Ude Kime Nage : 3e kyu, Greg Habert</li>
          <li>Irimi Nage ura : 2e kyu, Greg Habert</li>
          <li>Sokumen Irimi Nage : shodan, Greg Habert</li>
          <li>Koshi Nage : shodan, Greg Habert</li>
          <li>Kokyu Nage : 3e kyu, Greg Habert</li>
          <li>Juji Garami : 1er kyu, Greg Habert</li>
        </ul>
        <h2>Tachi Waza · Shomen Uchi</h2>
        <ul>
          <li>Ikkyo omote : 5e kyu, Jean-Luc Charles</li>
          <li>Ikkyo ura : 5e kyu, Jean-Luc Charles</li>
          <li>Kote Gaeshi : 5e kyu, Jean-Luc Charles</li>
          <li>Shiho Nage : 2e kyu, Jean-Luc Charles</li>
          <li>Ude Kime Nage : shodan, Jean-Luc Charles</li>
          <li>Irimi Nage omote : 5e kyu, Jean-Luc Charles</li>
          <li>Irimi Nage ura : 5e kyu, Jean-Luc Charles</li>
          <li>Koshi Nage : shodan, Jean-Luc Charles</li>
          <li>Kokyu Nage : shodan, Jean-Luc Charles</li>
        </ul>
        <h2>Tachi Waza · Yokomen Uchi</h2>
        <ul>
          <li>Ikkyo omote : 3e kyu, Stéphane Cissé</li>
          <li>Ikkyo ura : 3e kyu, Stéphane Cissé</li>
          <li>Nikyo omote : 3e kyu, Stéphane Cissé</li>
          <li>Nikyo ura : 3e kyu, Stéphane Cissé</li>
          <li>Kote Gaeshi : 3e kyu, Stéphane Cissé</li>
          <li>Shiho Nage omote : 4e kyu, Stéphane Cissé</li>
          <li>Shiho Nage ura : 4e kyu, Stéphane Cissé</li>
          <li>Ude Kime Nage : 4e kyu, Stéphane Cissé</li>
          <li>Irimi Nage omote : 3e kyu, Stéphane Cissé</li>
          <li>Irimi Nage ura : 3e kyu, Stéphane Cissé</li>
          <li>Koshi Nage : shodan, Stéphane Cissé</li>
          <li>Kokyu Nage : shodan, Stéphane Cissé</li>
        </ul>
        <h2>Tachi Waza · Kata Dori Men Uchi</h2>
        <ul>
          <li>Ikkyo omote : 2e kyu, Greg Habert</li>
          <li>Ikkyo ura : 2e kyu, Greg Habert</li>
          <li>Nikyo ura : 2e kyu, Greg Habert</li>
          <li>Kote Gaeshi : 2e kyu, Greg Habert</li>
          <li>Shiho Nage : 2e kyu, Greg Habert</li>
          <li>Ude Kime Nage : shodan, Greg Habert</li>
          <li>Irimi Nage : 2e kyu, Greg Habert</li>
          <li>Koshi Nage : shodan, Greg Habert</li>
          <li>Kokyu Nage : shodan, Greg Habert</li>
        </ul>
        <h2>Suwari Waza · Shomen Uchi</h2>
        <ul>
          <li>Ikkyo omote : 5e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Ikkyo ura : 5e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Nikyo omote : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Nikyo ura : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Sankyo omote : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Sankyo ura : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Yonkyo omote : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Yonkyo ura : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Gokyo : 1er kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Kote Gaeshi : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Irimi Nage : 5e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Kokyu Nage : shodan, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
        </ul>
        <h2>Suwari Waza · Yokomen Uchi</h2>
        <ul>
          <li>Ikkyo omote : 2e kyu, Greg Habert</li>
          <li>Ikkyo ura : 2e kyu, Greg Habert</li>
          <li>Nikyo omote : 2e kyu, Greg Habert</li>
          <li>Nikyo ura : 2e kyu, Greg Habert</li>
          <li>Sankyo omote : 2e kyu, Greg Habert</li>
          <li>Sankyo ura : 2e kyu, Greg Habert</li>
          <li>Yonkyo omote : 2e kyu, Greg Habert</li>
          <li>Yonkyo ura : 2e kyu, Greg Habert</li>
          <li>Gokyo : 2e kyu, Greg Habert</li>
          <li>Kote Gaeshi : 1er kyu, Greg Habert</li>
          <li>Irimi Nage : 2e kyu, Greg Habert</li>
          <li>Kokyu Nage : shodan, Greg Habert</li>
        </ul>
        <h2>Hanmi Handachi Waza · Katate Dori</h2>
        <ul>
          <li>Ikkyo omote : shodan, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Nikyo ura : 1er kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Kote Gaeshi : shodan, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Shiho Nage omote : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Shiho Nage ura : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Irimi Nage : shodan, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Uchi Kaiten Nage : 3e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Soto Kaiten Nage : 2e kyu, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Kokyu Nage : shodan, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
          <li>Sumi Otoshi : shodan, Aurélie Lucchetti, Greg Habert, Jean-Luc Charles et Stéphane Cissé</li>
        </ul>
        <h2>Hanmi Handachi Waza · Ushiro Ryo Kata Dori</h2>
        <ul>
          <li>Ikkyo : shodan, Greg Habert</li>
          <li>Sankyo : shodan, Greg Habert</li>
          <li>Kote Gaeshi : shodan, Greg Habert</li>
          <li>Kokyu Nage : shodan, Greg Habert</li>
        </ul>
        <h2>Ushiro Waza · Ushiro Ryote Dori</h2>
        <ul>
          <li>Ikkyo : 3e kyu, Aurélie Lucchetti</li>
          <li>Nikyo ura : 3e kyu, Aurélie Lucchetti</li>
          <li>Sankyo : 4e kyu, Aurélie Lucchetti</li>
          <li>Kote Gaeshi : 3e kyu, Aurélie Lucchetti</li>
          <li>Shiho Nage : 3e kyu, Aurélie Lucchetti</li>
          <li>Ude Kime Nage : 3e kyu, Aurélie Lucchetti</li>
          <li>Irimi Nage : 3e kyu, Aurélie Lucchetti</li>
          <li>Koshi Nage : 1er kyu, Aurélie Lucchetti</li>
          <li>Kokyu Nage : 1er kyu, Aurélie Lucchetti</li>
          <li>Juji Garami : 2e kyu, Aurélie Lucchetti</li>
        </ul>
        <h2>Ushiro Waza · Ushiro Eri Dori</h2>
        <ul>
          <li>Ikkyo omote : 1er kyu, Greg Habert</li>
          <li>Ikkyo ura : 1er kyu, Greg Habert</li>
          <li>Nikyo ura : shodan, Greg Habert</li>
          <li>Kote Gaeshi : 1er kyu, Greg Habert</li>
          <li>Shiho Nage : 1er kyu, Greg Habert</li>
          <li>Ude Kime Nage : shodan, Greg Habert</li>
          <li>Irimi Nage : shodan, Greg Habert</li>
          <li>Koshi Nage : shodan, Greg Habert</li>
          <li>Kokyu Nage : shodan, Greg Habert</li>
          <li>Aiki Otoshi : shodan, Greg Habert</li>
        </ul>
        <h2>Ushiro Waza · Ushiro Katate Dori Kubishime</h2>
        <ul>
          <li>Ikkyo : 2e kyu, Greg Habert</li>
          <li>Nikyo ura : shodan, Greg Habert</li>
          <li>Kote Gaeshi : 1er kyu, Greg Habert</li>
          <li>Shiho Nage : 1er kyu, Greg Habert</li>
          <li>Ude Kime Nage : shodan, Greg Habert</li>
          <li>Irimi Nage : 1er kyu, Greg Habert</li>
          <li>Koshi Nage : shodan, Greg Habert</li>
          <li>Kokyu Nage : shodan, Greg Habert</li>
        </ul>
        <h2>Buki Waza · Tanto Dori Shomen Uchi</h2>
        <ul>
          <li>Gokyo : shodan, Greg Habert</li>
          <li>Shiho Nage : shodan, Greg Habert</li>
        </ul>
        <h2>Buki Waza · Tanto Dori Yokomen Uchi</h2>
        <ul>
          <li>Gokyo : shodan, Greg Habert</li>
          <li>Shiho Nage : shodan, Greg Habert</li>
        </ul>
        <h2>Buki Waza · Tanto Dori Chudan Tsuki</h2>
        <ul>
          <li>Ikkyo : shodan, Greg Habert</li>
          <li>Hiji Kime Osae : shodan, Greg Habert</li>
          <li>Kote Gaeshi : shodan, Greg Habert</li>
          <li>Shiho Nage : shodan, Greg Habert</li>
          <li>Irimi Nage : shodan, Greg Habert</li>
          <li>Uchi Kaiten Sankyo : shodan, Greg Habert</li>
          <li>Kubi Nage : shodan, Greg Habert</li>
          <li>Ude Osae Nage : shodan, Greg Habert</li>
        </ul>
        <h2>Buki Waza · Jo Dori Chudan Tsuki</h2>
        <ul>
          <li>Ikkyo omote : shodan, Aurélie Lucchetti et Greg Habert</li>
          <li>Kote Gaeshi : shodan, Aurélie Lucchetti et Greg Habert</li>
          <li>Shiho Nage : shodan, Aurélie Lucchetti et Greg Habert</li>
          <li>Ude Kime Nage : shodan, Aurélie Lucchetti et Greg Habert</li>
          <li>Irimi Nage omote : shodan, Greg Habert</li>
          <li>Sokumen Irimi Nage : shodan, Aurélie Lucchetti et Greg Habert</li>
          <li>Koshi Nage : shodan, Greg Habert</li>
          <li>Kokyu Nage : shodan, Greg Habert</li>
          <li>Juji Garami : shodan, Greg Habert</li>
        </ul>
        <h2>Buki Waza · Jo Nage</h2>
        <ul>
          <li>Jyu Waza : shodan, Greg Habert</li>
        </ul>
        <h2>Vidéos d'origine</h2>
        <ul>
          <li><a href="https://www.youtube.com/watch?v=9gzxPxhQKVE">Préparation Nidan : Hanmihandashi waza Ushiro ryokatadori par Greg Habert</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=hwry2oz2L2Y">Préparation Shodan : Suwari waza Shomen uchi par Greg Habert et Léo Gaspard</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=RnX5hrbR_eQ">Point Technique : Ushiro waza Katate Kubishime par Greg Habert</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=fEgRsM_ikJo">Point Technique : Suwari waza Yokomen Uchi par Greg Habert et Alexandre Dallemagne</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=bRjzCbkj3Fc">Préparation Shodan : Hanmihandashi waza Gyakyhanmi katatedori par Greg Habert et Léo Gaspard</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=AXB4Grouc98">Préparation au Shodan : Tachi waza Morotedori par Greg Habert et Nicolas Charvet</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=Ok447jIlgm8">Préparation Nidan : Suwari waza Yokomen uchi par Greg Habert et Alexandre Dallemagne</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=xrqEIh93DbE">Préparation Shodan : Tachi waza Ai-hanmi katatedori par Greg Habert et Lucile Marguinaud</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=8DcuSnmW1wc">Point Technique de la FFAB ligue IDF par Aurélie Lucchetti : Ushiro waza Ryotedori.</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=OG2nLNzziPY">Préparation Nidan : Ushiro waza Eridori par Greg Habert</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=zjhStd2IJ3w">Préparation au Shodan : Tachi waza Katadori menuchi par Greg Habert et Laurence Zettwoog</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=1xG4L6a--cU">Préparation Shodan : Tachi waza Ryotedori par Greg Habert et Lucile Marguinaud.</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=Q9BlCi3qqWw">Préparation au Shodan : Tachi waza Katadori Ikkyo par Greg Habert et Laurence Zettwoog</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=MtewPE3sePQ">Préparation au Shodan : Buki waza Tantodori par Greg Habert et Léo Gaspard</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=gaJeAxlZB34">Préparation au Shodan : Bukiwaza Jodori par Greg Habert et Laurence Zettwoog</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=1u6_aEkHVSk">Préparation au Shodan : Bukiwaza Jonage par Greg Habert et Lucile Marguinaud</a>, Greg Habert</li>
          <li><a href="https://www.youtube.com/watch?v=CciXzcNU5UA">Point Technique de la FFAB ligue IDF par Aurélie Lucchetti : Jodori.</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=3MkGxQQ0f3U">FFAB IDF présente : Passage Shodan - Suwari waza Shomen uchi</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=vvjqTcfI0to">FFAB IDF - Passage Shodan - Hanmihandashi waza Gyakukatatedori</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=z7GwbWAxzIg">FFAB IDF présente : Passage Shodan - Tachi waza Aihanmi katatedori</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=z6V2LbvX7yQ">FFAB IDF présente : Passage Shodan - Tachi waza Ryotedori</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=HtROljrGMzY">FFAB IDF présente : Passage Shodan - Tachi waza Shomenuchi</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=hB8jDVdUnNk">FFAB IDF présente : Passage Shodan - Tachi waza Yokomen uchi</a>, Aïkido FFAB Île de France</li>
          <li><a href="https://www.youtube.com/watch?v=fdZVHRz4-r4">FFAB IDF présente : Passage Shodan - Ushiro waza Ryotedori</a>, Aïkido FFAB Île de France</li>
        </ul>
      </div>
    </div>
  </main>
</div>

<dialog class="apropos" id="apropos">
  <div class="apropos__corps" id="apropos-corps"></div>
  <form class="apropos__pied" method="dialog"><button class="bouton" data-i18n="fermer">Fermer</button></form>
</dialog>

<script src="donnees.js?v=3349e5046f"></script>
<script src="app.js?v=3349e5046f"></script>
<script src="/js/main.js" defer></script>
</body>
</html>
