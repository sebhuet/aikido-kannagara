<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Galerie Photos | Kannagara Aïkido Club de Guyancourt</title>
    <meta name="description" content="Découvrez la galerie photos du club Kannagara Aïkido : cours, stages, passages de grades et moments de vie du club à Guyancourt.">
    <meta name="keywords" content="aikido, aïkido, Guyancourt, photos, galerie, stages, grades, cours, FFAB">
    <meta name="author" content="Kannagara Aïkido Club de Guyancourt">
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

    <!-- Filtres -->
    <section class="section section--alt">
        <div class="container">
            <div class="gallery-filters" role="group" aria-label="Filtrer les photos">
                <button class="gallery-filter active" data-filter="all">Toutes</button>
                <button class="gallery-filter" data-filter="cours">Cours</button>
                <button class="gallery-filter" data-filter="stages">Stages</button>
                <button class="gallery-filter" data-filter="grades">Passages de grades</button>
                <button class="gallery-filter" data-filter="vie-club">Vie du club</button>
            </div>

            <!-- Section Cours -->
            <div class="gallery-section" data-category="cours">
                <h2 class="gallery-section__title">Cours réguliers</h2>
                <div class="gallery-grid">
                    <div class="gallery-item" data-category="cours">
                        <div class="gallery-item__placeholder">
                            <span>🥋</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Cours adultes</h3>
                            <p class="gallery-item__date">Pratique au dojo</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="cours">
                        <div class="gallery-item__placeholder">
                            <span>👧</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Cours enfants</h3>
                            <p class="gallery-item__date">Initiation ludique</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="cours">
                        <div class="gallery-item__placeholder">
                            <span>⚔️</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Travail aux armes</h3>
                            <p class="gallery-item__date">Jo, bokken, tanto</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Stages -->
            <div class="gallery-section" data-category="stages">
                <h2 class="gallery-section__title">Stages</h2>
                <div class="gallery-grid">
                    <div class="gallery-item" data-category="stages">
                        <div class="gallery-item__placeholder">
                            <span>🏯</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Stage régional FFAB</h3>
                            <p class="gallery-item__date">2023</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="stages">
                        <div class="gallery-item__placeholder">
                            <span>🥋</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Stage de rentrée</h3>
                            <p class="gallery-item__date">Septembre 2023</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="stages">
                        <div class="gallery-item__placeholder">
                            <span>☀️</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Stage d'été</h3>
                            <p class="gallery-item__date">Juillet 2023</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Grades -->
            <div class="gallery-section" data-category="grades">
                <h2 class="gallery-section__title">Passages de grades</h2>
                <div class="gallery-grid">
                    <div class="gallery-item" data-category="grades">
                        <div class="gallery-item__placeholder">
                            <span>🎌</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Passage de grades</h3>
                            <p class="gallery-item__date">Juin 2023</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="grades">
                        <div class="gallery-item__placeholder">
                            <span>🏆</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Remise de diplômes</h3>
                            <p class="gallery-item__date">Saison 2022-2023</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Vie du club -->
            <div class="gallery-section" data-category="vie-club">
                <h2 class="gallery-section__title">Vie du club</h2>
                <div class="gallery-grid">
                    <div class="gallery-item" data-category="vie-club">
                        <div class="gallery-item__placeholder">
                            <span>🎉</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Repas du club</h3>
                            <p class="gallery-item__date">Décembre 2023</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="vie-club">
                        <div class="gallery-item__placeholder">
                            <span>🚪</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Portes ouvertes</h3>
                            <p class="gallery-item__date">Septembre 2023</p>
                        </div>
                    </div>
                    <div class="gallery-item" data-category="vie-club">
                        <div class="gallery-item__placeholder">
                            <span>👥</span>
                        </div>
                        <div class="gallery-item__overlay">
                            <h3 class="gallery-item__title">Photo de groupe</h3>
                            <p class="gallery-item__date">Fin de saison</p>
                        </div>
                    </div>
                </div>
            </div>
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
            <img src="" alt="" class="lightbox__image">
            <p class="lightbox__caption"></p>
        </div>
        <button class="lightbox__nav lightbox__next" aria-label="Photo suivante">&#10095;</button>
    </div>

    <!-- JavaScript -->
    <script src="js/main.js"></script>
    <script>
        // Filtres de galerie
        document.addEventListener('DOMContentLoaded', function() {
            const filters = document.querySelectorAll('.gallery-filter');
            const sections = document.querySelectorAll('.gallery-section');

            filters.forEach(filter => {
                filter.addEventListener('click', function() {
                    const category = this.dataset.filter;

                    // Mise à jour des boutons actifs
                    filters.forEach(f => f.classList.remove('active'));
                    this.classList.add('active');

                    // Filtrage des sections
                    sections.forEach(section => {
                        if (category === 'all' || section.dataset.category === category) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                });
            });

            // Lightbox (prêt pour les vraies images)
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = lightbox.querySelector('.lightbox__image');
            const lightboxCaption = lightbox.querySelector('.lightbox__caption');
            const lightboxClose = lightbox.querySelector('.lightbox__close');

            // Fermeture de la lightbox
            lightboxClose.addEventListener('click', () => {
                lightbox.classList.remove('active');
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.classList.remove('active');
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    lightbox.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
