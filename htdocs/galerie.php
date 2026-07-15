<?php
require_once __DIR__ . '/includes/data.php';
$club = club_data();
$site = rtrim($club['url'], '/');

// Catégories : slug (= nom du dossier) => label affiché.
// Le slug doit rester en ASCII sans espace : il sert de segment d'URL.
$categories = [
    'cours'      => 'Cours',
    'stages'     => 'Stages',
    'grades'     => 'Passages de grades',
    'evenements' => 'Événements',
    'vie-club'   => 'Vie du club',
    'art'        => 'Art',
];

$extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$galleryDir = __DIR__ . '/galerie';

// Scan des photos, à plat (pas de sous-dossier).
$gallery = [];
$totalPhotos = 0;
foreach ($categories as $slug => $label) {
    $photos = [];
    $dir = $galleryDir . '/' . $slug;
    if (is_dir($dir)) {
        foreach (scandir($dir) as $file) {
            if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $extensions, true)) {
                $photos[] = $file;
            }
        }
        sort($photos);
    }
    $gallery[$slug] = $photos;
    $totalPhotos += count($photos);
}

/** Chemin web d'une photo (encodé : espaces et accents sont fréquents dans les noms). */
function galerie_src($slug, $photo)
{
    return 'galerie/' . rawurlencode($slug) . '/' . rawurlencode($photo);
}

/** Titre lisible dérivé du nom de fichier. */
function galerie_titre($photo, $label)
{
    $titre = pathinfo($photo, PATHINFO_FILENAME);
    $titre = preg_replace('/^IMG-\d{8}-WA\d+$/i', $label, $titre);
    $titre = str_replace(['_', '-'], ' ', $titre);
    // Enlever l'index de fin (« … 01 ») : il numérote le fichier, pas la photo
    $titre = preg_replace('/\s+\d{1,3}$/', '', $titre);
    // Une majuscule à chaque mot (« Stage Hiroshi Ikeda »), pas seulement au premier.
    // ucwords (et non mb_convert_case) : pas de dépendance à mbstring, que le reste
    // du site évite volontairement. Les accents en milieu de mot (« fête ») sont
    // conservés ; seule la 1re lettre est mise en majuscule, or nos noms de fichiers
    // commencent tous par une lettre ASCII.
    return ucwords(strtolower(trim($titre)));
}

/** Permalien partageable d'une photo. */
function galerie_permalien($site, $slug, $photo)
{
    return $site . '/galerie.php?photo=' . urlencode($slug . '/' . $photo);
}

/**
 * Lien de partage Facebook. Le « sharer » ne reçoit QUE l'URL : c'est Facebook qui
 * va la crawler et lire ses balises og: — d'où l'importance de les rendre dynamiques.
 */
function partage_facebook($url)
{
    return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
}

// ---- Photo ciblée par un lien de partage (?photo=slug/fichier) ----
// La valeur est comparée à la liste RÉELLEMENT scannée. Sans cette validation, on
// pourrait injecter n'importe quelle og:image via l'URL et se servir du site comme
// relais d'image sur Facebook (et lire des chemins hors du dossier galerie).
$photoPartagee = null;
$demande = $_GET['photo'] ?? '';
if ($demande !== '') {
    foreach ($gallery as $slug => $photos) {
        foreach ($photos as $photo) {
            if ($slug . '/' . $photo === $demande) {
                $photoPartagee = ['slug' => $slug, 'photo' => $photo, 'label' => $categories[$slug]];
                break 2;
            }
        }
    }
}

// ---- Open Graph ----
// Par défaut : la galerie entière. og:image doit être une VRAIE photo — une galerie
// qui s'annonce sur Facebook avec le logo du club ne donne envie de rien.
$ogUrl   = $site . '/galerie.php';
$ogTitle = 'Galerie photos — ' . $club['name'];
$ogDesc  = 'Cours, stages, passages de grades, événements et vie du club en images.';
$ogImage = $club['logo'];
foreach ($gallery as $slug => $photos) {
    if ($photos) {
        $ogImage = $site . '/' . galerie_src($slug, $photos[0]);
        break;
    }
}

if ($photoPartagee) {
    $titrePartage = galerie_titre($photoPartagee['photo'], $photoPartagee['label']);
    $ogUrl   = galerie_permalien($site, $photoPartagee['slug'], $photoPartagee['photo']);
    $ogTitle = $titrePartage . ' — ' . $club['name'];
    $ogDesc  = $photoPartagee['label'] . ' — galerie photos du club Aïkido Kannagara Guyancourt.';
    $ogImage = $site . '/' . galerie_src($photoPartagee['slug'], $photoPartagee['photo']);
}
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title><?= htmlspecialchars($ogTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta name="author" content="<?= htmlspecialchars($club['name']) ?>">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">
    <meta name="robots" content="index, follow">
    <?php /* Canonical toujours la galerie : les URL ?photo= sont des variantes de partage,
             pas des pages à indexer séparément. Facebook, lui, se fie à og:url. */ ?>
    <link rel="canonical" href="<?= htmlspecialchars($site) ?>/galerie.php">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($ogUrl) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
    <meta property="og:locale" content="fr_FR">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/logo-kannagara.jpg">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ImageGallery",
        "name": "Galerie Photos Aïkido Kannagara Guyancourt",
        "description": "Galerie photos du club Aïkido Kannagara Guyancourt : cours, stages, passages de grades et vie du club.",
        "url": "https://kannagara.fr/galerie.php",
        "isPartOf": {
            "@type": "WebSite",
            "name": "Aïkido Kannagara Guyancourt",
            "url": "https://kannagara.fr"
        }
    }
    </script>

    <style>
        /* Styles spécifiques galerie */
        .gallery-filters {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-xl);
        }

        .gallery-filter {
            padding: var(--spacing-sm) var(--spacing-lg);
            border: 2px solid var(--color-primary);
            background: transparent;
            color: var(--color-primary);
            font-family: var(--font-body);
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 4px;
        }

        .gallery-filter:hover,
        .gallery-filter.active {
            background: var(--color-primary);
            color: white;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--spacing-lg);
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .gallery-item__image {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
            display: block;
        }

        .gallery-item__placeholder {
            width: 100%;
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, var(--color-bg-alt) 0%, var(--color-border) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-text-light);
            font-size: 3rem;
        }

        .gallery-item__overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: var(--spacing-md);
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
            color: white;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-item__overlay,
        .gallery-item:focus-within .gallery-item__overlay {
            transform: translateY(0);
        }

        /* Tactile : sans souris, pas de :hover. Sans cette règle, le titre et le bouton
           de partage resteraient invisibles — donc inatteignables — sur mobile. */
        @media (hover: none) {
            .gallery-item__overlay {
                transform: translateY(0);
            }
        }

        /* Le bouton de partage lui-même (.fb-share) est défini dans style.css :
           il est partagé avec les événements. Ici, seul le comportement propre
           à la galerie. */

        .gallery-item__title {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .gallery-item__date {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        .gallery-section {
            margin-bottom: var(--spacing-xxl);
        }

        .gallery-section__title {
            font-size: 1.5rem;
            color: var(--color-primary);
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-sm);
            border-bottom: 2px solid var(--color-accent);
            display: inline-block;
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.95);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox__content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .lightbox__image {
            max-width: 100%;
            max-height: 85vh;
            object-fit: contain;
        }

        .lightbox__close {
            position: absolute;
            top: -40px;
            right: 0;
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            padding: var(--spacing-sm);
        }

        .lightbox__caption {
            text-align: center;
            color: white;
            margin-top: var(--spacing-md);
            font-size: 1.1rem;
        }

        .lightbox__nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            font-size: 2rem;
            padding: var(--spacing-md);
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .lightbox__nav:hover {
            background: rgba(255,255,255,0.4);
        }

        .lightbox__prev {
            left: 20px;
        }

        .lightbox__next {
            right: 20px;
        }

        .gallery-empty {
            text-align: center;
            padding: var(--spacing-xxl);
            color: var(--color-text-light);
        }

        .gallery-empty__icon {
            font-size: 4rem;
            margin-bottom: var(--spacing-md);
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <?php $active = 'galerie'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Galerie Photos</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Galerie
            </p>
        </div>
    </section>

    <!-- Introduction -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 800px; margin: 0 auto; text-align: center;">
                <p>
                    Découvrez la vie du club Kannagara à travers notre galerie photos :
                    moments de pratique, stages, passages de grades et événements qui rythment notre saison.
                </p>
            </div>
        </div>
    </section>

    <!-- Galerie dynamique -->
    <section class="section section--alt">
        <div class="container">
            <?php /* Le scan des photos et les helpers sont dans le prélude (en tête du
                     fichier) : le <head> en a besoin pour les balises og:. */ ?>
            <?php if ($totalPhotos > 0): ?>
                <!-- Partager la galerie entière -->
                <div class="text-center" style="margin-bottom: var(--spacing-lg);">
                    <a class="btn btn--outline fb-share-btn"
                       href="<?= htmlspecialchars(partage_facebook($site . '/galerie.php')) ?>"
                       target="_blank" rel="noopener"
                       aria-label="Partager la galerie sur Facebook">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.25h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07z"/></svg>
                        Partager la galerie sur Facebook
                    </a>
                </div>

                <!-- Filtres -->
                <div class="gallery-filters" role="group" aria-label="Filtrer les photos">
                    <button class="gallery-filter active" data-filter="all">Toutes (<?= $totalPhotos ?>)</button>
                    <?php foreach ($categories as $slug => $label):
                        if (empty($gallery[$slug])) continue;
                    ?>
                        <button class="gallery-filter" data-filter="<?= $slug ?>"><?= $label ?> (<?= count($gallery[$slug]) ?>)</button>
                    <?php endforeach; ?>
                </div>

                <!-- Sections par catégorie -->
                <?php foreach ($categories as $slug => $label):
                    if (empty($gallery[$slug])) continue;
                ?>
                <div class="gallery-section" data-category="<?= $slug ?>">
                    <h2 class="gallery-section__title"><?= $label ?></h2>
                    <div class="gallery-grid">
                        <?php foreach ($gallery[$slug] as $photo):
                            $src       = galerie_src($slug, $photo);
                            $title     = galerie_titre($photo, $label);
                            $permalien = galerie_permalien($site, $slug, $photo);
                            $ciblee    = $photoPartagee
                                && $photoPartagee['slug'] === $slug
                                && $photoPartagee['photo'] === $photo;
                        ?>
                        <div class="gallery-item<?= $ciblee ? ' is-ciblee' : '' ?>"
                             data-category="<?= $slug ?>"
                             data-photo="<?= htmlspecialchars($slug . '/' . $photo) ?>">
                            <img src="<?= htmlspecialchars($src) ?>"
                                 alt="<?= htmlspecialchars($title . ' — Aïkido Kannagara Guyancourt') ?>"
                                 class="gallery-item__image"
                                 loading="lazy">
                            <div class="gallery-item__overlay">
                                <h3 class="gallery-item__title"><?= htmlspecialchars($title) ?></h3>
                                <a class="fb-share fb-share--overlay"
                                   href="<?= htmlspecialchars(partage_facebook($permalien)) ?>"
                                   target="_blank" rel="noopener"
                                   title="Partager cette photo sur Facebook"
                                   aria-label="Partager la photo « <?= htmlspecialchars($title) ?> » sur Facebook">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.25h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07z"/></svg>
                                    Partager
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="gallery-empty">
                    <div class="gallery-empty__icon">📷</div>
                    <p>La galerie est en cours de constitution.<br>Revenez bientôt !</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Message pour contribuer -->
    <section class="section">
        <div class="container">
            <div class="info-box" style="max-width: 700px; margin: 0 auto; text-align: center;">
                <h3 class="info-box__title">Partagez vos photos !</h3>
                <p>
                    Vous avez des photos de nos cours, stages ou événements ?
                    N'hésitez pas à les partager avec le club pour enrichir notre galerie.
                </p>
                <p class="mt-2">
                    <a href="mailto:aikido.kannagara.guyancourt@gmail.com" class="btn btn--primary">Envoyer vos photos</a>
                </p>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Visionneuse de photos">
        <button class="lightbox__close" aria-label="Fermer">&times;</button>
        <button class="lightbox__nav lightbox__prev" aria-label="Photo précédente">&#10094;</button>
        <div class="lightbox__content">
            <img src="" alt="Photo agrandie" class="lightbox__image">
            <p class="lightbox__caption"></p>
        </div>
        <button class="lightbox__nav lightbox__next" aria-label="Photo suivante">&#10095;</button>
    </div>

    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filtres de galerie
            var filters = document.querySelectorAll('.gallery-filter');
            var sections = document.querySelectorAll('.gallery-section');

            filters.forEach(function(filter) {
                filter.addEventListener('click', function() {
                    var category = this.dataset.filter;
                    filters.forEach(function(f) { f.classList.remove('active'); });
                    this.classList.add('active');
                    sections.forEach(function(section) {
                        section.style.display = (category === 'all' || section.dataset.category === category) ? 'block' : 'none';
                    });
                });
            });

            // Lightbox
            var lightbox = document.getElementById('lightbox');
            var lightboxImg = lightbox.querySelector('.lightbox__image');
            var lightboxCaption = lightbox.querySelector('.lightbox__caption');
            var allImages = [];
            var currentIndex = 0;

            // Collecter toutes les images cliquables
            document.querySelectorAll('.gallery-item').forEach(function(item) {
                var img = item.querySelector('.gallery-item__image');
                var title = item.querySelector('.gallery-item__title');
                if (img) {
                    var idx = allImages.length;
                    allImages.push({ src: img.src, caption: title ? title.textContent : '' });
                    item.addEventListener('click', function(e) {
                        // Le bouton de partage est DANS l'item cliquable : sans ce garde-fou,
                        // cliquer « Partager » ouvrirait la lightbox en plus d'aller sur Facebook.
                        if (e.target.closest('.fb-share')) return;
                        currentIndex = idx;
                        showLightbox();
                    });
                }
            });

            // Arrivée depuis un lien de partage (?photo=…) : amener la photo à l'écran.
            var ciblee = document.querySelector('.is-ciblee');
            if (ciblee) {
                ciblee.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            function showLightbox() {
                lightboxImg.src = allImages[currentIndex].src;
                lightboxCaption.textContent = allImages[currentIndex].caption;
                lightbox.classList.add('active');
            }

            // Navigation
            lightbox.querySelector('.lightbox__prev').addEventListener('click', function(e) {
                e.stopPropagation();
                currentIndex = (currentIndex - 1 + allImages.length) % allImages.length;
                showLightbox();
            });
            lightbox.querySelector('.lightbox__next').addEventListener('click', function(e) {
                e.stopPropagation();
                currentIndex = (currentIndex + 1) % allImages.length;
                showLightbox();
            });

            // Fermeture
            lightbox.querySelector('.lightbox__close').addEventListener('click', function() {
                lightbox.classList.remove('active');
            });
            lightbox.addEventListener('click', function(e) {
                if (e.target === lightbox) lightbox.classList.remove('active');
            });
            document.addEventListener('keydown', function(e) {
                if (!lightbox.classList.contains('active')) return;
                if (e.key === 'Escape') lightbox.classList.remove('active');
                if (e.key === 'ArrowLeft') { currentIndex = (currentIndex - 1 + allImages.length) % allImages.length; showLightbox(); }
                if (e.key === 'ArrowRight') { currentIndex = (currentIndex + 1) % allImages.length; showLightbox(); }
            });
        });
    </script>
</body>
</html>
