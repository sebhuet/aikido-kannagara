<!doctype html>
<!-- Généré par tools/integrer_videotheque.js depuis la vidéothèque (index.html) : ne pas modifier ici. -->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="theme-color" content="#141312">
  <meta name="description" content="Techniques d'aïkido en vidéo : par attaque, par technique, par niveau de kyu ou par sensei, avec recherche et lecteur image par image.">
  <title>Aïkido · Techniques en vidéo</title>
  <link rel="canonical" href="https://kannagara.fr/videotheque/">
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
  <link rel="stylesheet" href="style.css?v=8f946f33d6">
  <style>
    /* Intégration dans le site : la vidéothèque se place sous l'en-tête fixe */
    body { padding-top: var(--header-height); background-image: none; }
    .barre { top: var(--header-height); }
    .filtres { top: calc(var(--header-height) + 72px); max-height: calc(100vh - var(--header-height) - 88px); }
    /* Pas de bouton « À propos » sur le site (app.js en a besoin : on le masque) */
    #ouvrir-apropos { display: none; }
    @media (max-width: 900px) {
      .lecteur { top: var(--header-height); }
    }
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
        <kbd>E</kbd> enchaîner · <kbd>S</kbd> son · <kbd>F</kbd> plein écran · <kbd>P</kbd> <kbd>N</kbd> clip précédent/suivant
      </p>
    </section>

    <div class="annonce" id="annonce" role="status" aria-live="polite"></div>
    <div class="vues" id="vues" role="group" aria-label="Regrouper par"></div>
    <div class="resume" id="resume" aria-live="polite"></div>
    <div id="resultats"></div>
  </main>
</div>

<dialog class="apropos" id="apropos">
  <div class="apropos__corps" id="apropos-corps"></div>
  <form class="apropos__pied" method="dialog"><button class="bouton" data-i18n="fermer">Fermer</button></form>
</dialog>

<script src="donnees.js?v=8f946f33d6"></script>
<script src="app.js?v=8f946f33d6"></script>
<script src="/js/main.js" defer></script>
</body>
</html>
