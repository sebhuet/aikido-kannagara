<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Galerie Photos | Kannagara Aïkido Club de Guyancourt</title>
    <meta name="description" content="Découvrez la galerie photos du club Kannagara Aïkido : cours, stages, passages de grades et moments de vie du club à Guyancourt.">
    <meta name="keywords" content="aïkido, aikido, Guyancourt, photos, galerie, stages, grades, cours, FFAB">
    <meta name="author" content="Kannagara Aïkido Club de Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.7678;2.0567">
    <meta name="ICBM" content="48.7678, 2.0567">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/galerie.html">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/galerie.html">
    <meta property="og:title" content="Galerie Photos - Kannagara Aïkido">
    <meta property="og:description" content="Découvrez la galerie photos du club Kannagara Aïkido : cours, stages, passages de grades et vie du club.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">
    <meta property="og:locale" content="fr_FR">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Galerie Photos - Kannagara Aïkido">
    <meta name="twitter:description" content="Découvrez la galerie photos du club Kannagara Aïkido.">
    <meta name="twitter:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/logo-kannagara.png">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ImageGallery",
        "name": "Galerie Photos Kannagara Aïkido",
        "description": "Galerie photos du club Kannagara Aïkido de Guyancourt : cours, stages, passages de grades et vie du club.",
        "url": "https://kannagara.fr/galerie.html",
        "isPartOf": {
            "@type": "WebSite",
            "name": "Kannagara Aïkido Club de Guyancourt",
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

        .gallery-item:hover .gallery-item__overlay {
            transform: translateY(0);
        }

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
            <?php
            // Catégories : slug => label
            $categories = [
                'cours'    => 'Cours',
                'stages'   => 'Stages',
                'grades'   => 'Passages de grades',
                'vie-club' => 'Vie du club',
                'art'      => 'Art',
            ];

            $galleryDir = __DIR__ . '/galerie';
            $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            // Scanner les images par catégorie
            $gallery = [];
            $totalPhotos = 0;
            foreach ($categories as $slug => $label) {
                $dir = $galleryDir . '/' . $slug;
                $photos = [];
                if (is_dir($dir)) {
                    $files = scandir($dir);
                    foreach ($files as $file) {
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (in_array($ext, $extensions)) {
                            $photos[] = $file;
                        }
                    }
                    sort($photos);
                }
                $gallery[$slug] = $photos;
                $totalPhotos += count($photos);
            }

            // N'afficher les filtres que s'il y a des photos
            $categoriesWithPhotos = array_filter($gallery, fn($p) => count($p) > 0);
            ?>

            <?php if ($totalPhotos > 0): ?>
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
                            $src = 'galerie/' . $slug . '/' . $photo;
                            $name = pathinfo($photo, PATHINFO_FILENAME);
                            // Titre lisible : remplacer tirets/underscores, enlever préfixes type IMG-20211122-WA
                            $title = preg_replace('/^IMG-\d{8}-WA\d+$/i', $label, $name);
                            $title = str_replace(['_', '-'], ' ', $title);
                            $title = ucfirst(trim($title));
                        ?>
                        <div class="gallery-item" data-category="<?= $slug ?>">
                            <img src="<?= htmlspecialchars($src) ?>"
                                 alt="<?= htmlspecialchars($title . ' — Kannagara Aïkido') ?>"
                                 class="gallery-item__image"
                                 loading="lazy">
                            <div class="gallery-item__overlay">
                                <h3 class="gallery-item__title"><?= htmlspecialchars($title) ?></h3>
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
                    item.addEventListener('click', function() {
                        currentIndex = idx;
                        showLightbox();
                    });
                }
            });

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
