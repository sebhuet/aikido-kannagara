<?php require_once __DIR__ . '/includes/data.php'; require_once __DIR__ . '/includes/equipe.php'; $club = club_data(); $sch = $club['schedule']; ?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Aïkido Kannagara Guyancourt | Cours d'aïkido pour tous</title>
    <meta name="description" content="Club d'aïkido à Guyancourt (78) affilié FFAB. Cours pour enfants et adultes sous la responsabilité pédagogique de Nacer Chekkaba. Gymnase Maurice Baquet, lundi et jeudi.">
    <meta name="keywords" content="aïkido, aikido, Guyancourt, Saint-Quentin-en-Yvelines, Montigny-le-Bretonneux, Versailles, arts martiaux, FFAB, Jean-Marc Chamot, dojo, Yvelines, 78, cours aïkido">
    <meta name="author" content="Aïkido Kannagara Guyancourt">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/">
    <meta property="og:title" content="Aïkido Kannagara Guyancourt">
    <meta property="og:description" content="Club d'aïkido à Guyancourt (78) affilié FFAB. Responsabilité pédagogique de Nacer Chekkaba. Cours enfants et adultes, lundi et jeudi.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.jpg">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:site_name" content="Aïkido Kannagara Guyancourt">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Aïkido Kannagara Guyancourt">
    <meta name="twitter:description" content="Club d'aïkido à Guyancourt (78) affilié FFAB. Responsabilité pédagogique de Nacer Chekkaba. Cours enfants et adultes, lundi et jeudi.">
    <meta name="twitter:image" content="https://kannagara.fr/images/logo-kannagara.jpg">

    <!-- Geo Tags -->
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/logo-kannagara.jpg">

    <!-- LLM-friendly content -->
    <link rel="alternate" type="text/plain" href="https://kannagara.fr/llms.txt" title="LLM summary">
    <link rel="alternate" type="text/plain" href="https://kannagara.fr/llms-full.txt" title="LLM full content">

    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SportsActivityLocation",
        "@id": "https://kannagara.fr/#organization",
        "name": "Aïkido Kannagara Guyancourt",
        "alternateName": "Kannagara",
        "description": "Club d'aïkido affilié à la FFAB, proposant des cours pour enfants et adultes à Guyancourt depuis 1990.",
        "url": "https://kannagara.fr",
        "logo": "https://kannagara.fr/images/logo-kannagara.jpg",
        "image": "https://kannagara.fr/images/logo-kannagara.jpg",
        "telephone": "+33676481601",
        "email": "aikido.kannagara.guyancourt@gmail.com",
        "foundingDate": "1990",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Gymnase Maurice Baquet, Mail des Graviers",
            "addressLocality": "Guyancourt",
            "postalCode": "78280",
            "addressCountry": "FR"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": 48.772739,
            "longitude": 2.065928
        },
        "openingHoursSpecification": [
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": <?= json_encode($sch['daysSchemaOrg']) ?>,
                "opens": "<?= $sch['children']['opens'] ?>",
                "closes": "<?= $sch['children']['closes'] ?>",
                "validFrom": "<?= $club['seasonStart'] ?>",
                "description": "Cours enfants"
            },
            {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": <?= json_encode($sch['daysSchemaOrg']) ?>,
                "opens": "<?= $sch['adultsRange']['opens'] ?>",
                "closes": "<?= $sch['adultsRange']['closes'] ?>",
                "validFrom": "<?= $club['seasonStart'] ?>",
                "description": "Cours adultes"
            }
        ],
        "sameAs": [
            "https://www.facebook.com/Kannagara-a%C3%AFkido-club-de-Guyancourt-375533475979211/"
        ],
        "memberOf": {
            "@type": "Organization",
            "name": "Fédération Française d'Aïkido et de Budo",
            "alternateName": "FFAB"
        },
        "areaServed": [
            {"@type": "City", "name": "Guyancourt"},
            {"@type": "City", "name": "Montigny-le-Bretonneux"},
            {"@type": "City", "name": "Voisins-le-Bretonneux"},
            {"@type": "City", "name": "Élancourt"},
            {"@type": "City", "name": "Trappes"},
            {"@type": "City", "name": "La Verrière"},
            {"@type": "City", "name": "Buc"},
            {"@type": "City", "name": "Vélizy-Villacoublay"},
            {"@type": "City", "name": "Versailles"},
            {"@type": "AdministrativeArea", "name": "Saint-Quentin-en-Yvelines"}
        ],
        "sport": "Aïkido",
        "employee": [
            {
                "@type": "Person",
                "@id": "https://kannagara.fr/professeurs.php#jean-marc-chamot",
                "name": "Jean-Marc Chamot",
                "jobTitle": "Professeur d'aïkido - Intervenant régulier",
                "description": "7e Dan Aïkido, 4e Dan Iaïdo. Cadre technique FFAB, titulaire du DESJEPS. Formé auprès d'André Nocquet (premier uchi-deshi étranger du fondateur de l'aïkido) et de Maître Tamura Nobuyoshi. Plus de 50 ans de pratique, près de 40 ans d'enseignement.",
                "hasCredential": [
                    {
                        "@type": "EducationalOccupationalCredential",
                        "credentialCategory": "grade",
                        "name": "7e Dan Aïkido",
                        "recognizedBy": {
                            "@type": "Organization",
                            "name": "Fédération Française d'Aïkido et de Budo"
                        }
                    },
                    {
                        "@type": "EducationalOccupationalCredential",
                        "credentialCategory": "grade",
                        "name": "4e Dan Iaïdo"
                    },
                    {
                        "@type": "EducationalOccupationalCredential",
                        "credentialCategory": "diploma",
                        "name": "DESJEPS",
                        "description": "Diplôme d'État Supérieur de la Jeunesse, de l'Éducation Populaire et du Sport"
                    }
                ],
                "knowsAbout": ["Aïkido", "Iaïdo", "Judo", "Karaté", "Jodo"],
                "memberOf": {
                    "@type": "Organization",
                    "name": "Fédération Française d'Aïkido et de Budo",
                    "alternateName": "FFAB"
                }
            }
        ]
    }
    </script>
</head>
<body>
    <?php $active = 'index'; include 'includes/header.php'; ?>







    <!-- Hero Section -->
    <section class="hero" aria-labelledby="hero-title">
        <div class="hero__content">
            <h1 class="hero__title" id="hero-title">Aïkido Kannagara Guyancourt</h1>
            <p class="hero__subtitle">L'art martial de l'harmonie — enfants dès 7 ans, adultes tous niveaux</p>
            <p class="hero__description">
                <?= htmlspecialchars($club['trial']['label']) ?>.
                Rendez-vous le <?= htmlspecialchars(implode(' et le ', array_map('strtolower', $sch['days']))) ?> à Guyancourt (78).
            </p>
            <div class="hero__buttons">
                <a href="inscription.php#essai" class="btn btn--primary">Venez essayer</a>
                <a href="inscription.php" class="btn btn--outline">S'inscrire</a>
            </div>
        </div>
    </section>

    <!-- Moments de pratique : bandeau de 4 visuels sous le hero. Sélection fixe et curatée
         (distincte du bandeau « Le club en images » en bas de page, qui tourne au hasard
         chaque jour depuis la galerie). -->
    <?php
    $pratique = [
        ['file' => 'travail.jpg', 'alt' => "Travail à deux à mains nues, cours d'aïkido adultes"],
        ['file' => 'mixte.jpg', 'alt' => "Projection en aïkido, cours adultes"],
        ['file' => 'enfants.jpg', 'alt' => "Cours enfants d'aïkido, travail au bâton"],
        ['file' => 'self.jpg', 'alt' => "Immobilisation au sol, technique d'aïkido"],
    ];
    ?>
    <section class="section" aria-label="Moments de pratique">
        <div class="container">
            <div class="photo-strip">
                <?php foreach ($pratique as $ph): ?>
                <div class="photo-strip__item">
                    <img src="images/flyer/<?= htmlspecialchars($ph['file']) ?>"
                         alt="<?= htmlspecialchars($ph['alt']) ?>, Aïkido Kannagara Guyancourt"
                         loading="lazy">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Prochains rendez-vous : bandeau auto-extinguible (rien à venir = rien d'affiché) -->
    <?php
    require_once __DIR__ . '/includes/evenements-parser.php';
    $prochains = array_slice(parse_evenements(__DIR__ . '/evenements.md'), 0, 3);
    ?>
    <?php if ($prochains): ?>
    <section class="section section--alt" aria-labelledby="prochains-rdv-title">
        <div class="container">
            <div class="info-box">
                <h2 class="info-box__title" id="prochains-rdv-title">Prochains rendez-vous</h2>
                <p>Venez nous rencontrer :</p>
                <ul style="list-style: none; padding: 0; margin: 0.5rem 0 0;">
                    <?php foreach ($prochains as $evt): ?>
                    <li style="margin-bottom: 0.35rem;">
                        <a href="actualites.php?evenement=<?= urlencode($evt['slug']) ?>"><strong><?= htmlspecialchars($evt['title']) ?></strong></a>
                        — <?= htmlspecialchars(format_date_evenement($evt['date'])) ?><?= $evt['horaire'] ? ', ' . htmlspecialchars($evt['horaire']) : '' ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <p style="margin: 0.75rem 0 0;"><a href="actualites.php">Tous les événements →</a></p>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Résumé factuel (quick answer pour LLMs) -->
    <section class="section">
        <div class="container">
            <p style="max-width: 800px; margin: 0 auto; text-align: center; font-size: 1.125rem;">
                <strong>Kannagara</strong> est un club d'aïkido à Guyancourt (Yvelines), fondé en 1990
                et affilié à la FFAB. Le club est placé sous la <strong>responsabilité pédagogique de <?= htmlspecialchars(equipe_responsable()) ?></strong>.
                <?= equipe_intervenants_html() ?>
                interviennent régulièrement sur le tatami. Le club propose des cours
                pour enfants (dès 7 ans) et adultes, le lundi et le jeudi, au Gymnase Maurice Baquet.
            </p>
        </div>
    </section>

    <!-- Présentation rapide -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Bienvenue au Club</h2>
                <p class="section__subtitle">L'Aïkido, un art martial pour tous</p>
            </div>

            <div class="cards-grid">
                <div class="card fade-in">
                    <div class="card__content">
                        <h3 class="card__title">Environ 50 membres</h3>
                        <p class="card__text">
                            Notre club accueille près de 50 licenciés, dont une vingtaine d'enfants,
                            dans une ambiance familiale et respectueuse des traditions martiales.
                        </p>
                    </div>
                </div>

                <div class="card fade-in">
                    <div class="card__content">
                        <h3 class="card__title">Équipe enseignante</h3>
                        <p class="card__text">
                            Sous la responsabilité pédagogique de <strong><?= htmlspecialchars(equipe_responsable()) ?></strong>,
                            avec <?= htmlspecialchars(equipe_intervenants_txt()) ?>
                            comme intervenants réguliers. <a href="agenda.php">Voir le planning</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Horaires -->
    <section class="section section--alt">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Horaires des cours</h2>
                <p class="section__subtitle"><a href="https://maps.app.goo.gl/xuTo7Rqh51XWqWEh6" target="_blank" rel="noopener" title="Voir sur Google Maps">Gymnase Maurice Baquet <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></a></p>
            </div>

            <?php include 'includes/horaires.php'; ?>

            <div class="text-center mt-3">
                <a href="inscription.php" class="btn btn--outline">Nous rejoindre</a>
            </div>
        </div>
    </section>

    <!-- L'Aïkido en bref -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Qu'est-ce que l'Aïkido ?</h2>
            </div>

            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <p>
                    L'Aïkido est un art martial japonais fondé par Maître Morihei Ueshiba (1883-1969).
                    Contrairement à d'autres disciplines, <strong>l'aïkido exclut toute idée de compétition</strong>
                    et privilégie l'harmonie et le respect mutuel.
                </p>
                <p>
                    Les techniques d'aïkido reposent sur <strong>l'utilisation de la force de l'adversaire</strong>
                    et ne nécessitent pas d'aptitudes physiques particulières. Le travail musculaire
                    s'effectue naturellement en accord avec la constitution de chacun.
                </p>
                <p>
                    C'est pourquoi l'aïkido est pratiqué quotidiennement aussi bien par des femmes,
                    des hommes, des enfants que des personnes plus âgées.
                </p>
                <div class="text-center mt-3">
                    <a href="aikido.php" class="btn btn--primary">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Le club en images : 4 photos tirées des galeries, rotation quotidienne.
         Aucune maintenance : toute photo déposée dans galerie/ entre dans la rotation. -->
    <?php
    $stripLabels = ['cours' => 'Cours', 'stages' => 'Stages', 'grades' => 'Passages de grades', 'evenements' => 'Événements', 'vie-club' => 'Vie du club'];
    $stripPool = [];
    foreach ($stripLabels as $stripSlug => $stripLabel) {
        $stripDir = __DIR__ . '/galerie/' . $stripSlug;
        if (!is_dir($stripDir)) continue;
        foreach (scandir($stripDir) as $stripFile) {
            if (in_array(strtolower(pathinfo($stripFile, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'], true)) {
                $stripPool[] = ['slug' => $stripSlug, 'file' => $stripFile, 'label' => $stripLabel];
            }
        }
    }
    $stripPhotos = [];
    if ($stripPool) {
        // Graine quotidienne : la sélection change chaque jour mais reste stable dans la
        // journée (rendu prévisible, cache-friendly). On rétablit ensuite l'aléa normal.
        mt_srand((int) date('Ymd'));
        shuffle($stripPool);
        mt_srand();
        $stripPhotos = array_slice($stripPool, 0, 4);
    }
    ?>
    <?php if ($stripPhotos): ?>
    <section class="section section--alt" aria-labelledby="club-images-title">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title" id="club-images-title">Le club en images</h2>
            </div>

            <div class="photo-strip">
                <?php foreach ($stripPhotos as $ph):
                    $src = 'galerie/' . rawurlencode($ph['slug']) . '/' . rawurlencode($ph['file']);
                ?>
                <a class="photo-strip__item"
                   href="galerie.php?photo=<?= urlencode($ph['slug'] . '/' . $ph['file']) ?>"
                   title="<?= htmlspecialchars($ph['label']) ?> — voir dans la galerie">
                    <img src="<?= htmlspecialchars($src) ?>"
                         alt="<?= htmlspecialchars($ph['label']) ?> — la vie du club en photo, Aïkido Kannagara Guyancourt"
                         loading="lazy">
                </a>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-3">
                <a href="galerie.php" class="btn btn--outline">Voir toute la galerie</a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Nos professeurs (aperçu) -->
    <section class="section section--dark">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Nos Enseignants</h2>
            </div>

            <div class="teachers-carousel">
                <div class="teachers-carousel__track">
                    <div class="team-member teachers-carousel__slide active">
                        <img src="professeurs/fiches/01-jean-marc-chamot.jpg" alt="Jean-Marc Chamot" class="team-member__photo" loading="lazy">
                        <h3 class="team-member__name">Jean-Marc Chamot</h3>
                        <p class="team-member__grade">7ème Dan Aïkido - 4e Dan Iaïdo</p>
                    </div>
                    <div class="team-member teachers-carousel__slide">
                        <img src="professeurs/fiches/02-nacer-chekkaba.jpg" alt="Nacer Chekkaba" class="team-member__photo" loading="lazy">
                        <h3 class="team-member__name">Nacer Chekkaba</h3>
                        <p class="team-member__grade">4ème Dan Aïkido FFAB</p>
                    </div>
                    <div class="team-member teachers-carousel__slide">
                        <img src="professeurs/fiches/03-thierry-montfort.jpg" alt="Thierry Montfort" class="team-member__photo" loading="lazy">
                        <h3 class="team-member__name">Thierry Montfort</h3>
                        <p class="team-member__grade">3ème Dan Aïkido FFAB</p>
                    </div>
                    <div class="team-member teachers-carousel__slide">
                        <img src="professeurs/fiches/05-sebastien-huet.jpg" alt="Sébastien Huet" class="team-member__photo" loading="lazy">
                        <h3 class="team-member__name">Sébastien Huet</h3>
                        <p class="team-member__grade">1er Dan Aïkido FFAB</p>
                    </div>
                </div>
                <div class="teachers-carousel__dots">
                    <button class="teachers-carousel__dot active" data-slide="0" aria-label="Voir Jean-Marc Chamot"></button>
                    <button class="teachers-carousel__dot" data-slide="1" aria-label="Voir Nacer Chekkaba"></button>
                    <button class="teachers-carousel__dot" data-slide="2" aria-label="Voir Thierry Montfort"></button>
                    <button class="teachers-carousel__dot" data-slide="3" aria-label="Voir Sébastien Huet"></button>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="professeurs.php" class="btn btn--accent">En savoir plus</a>
            </div>
        </div>
    </section>

    <!-- Contact rapide -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Nous contacter</h2>
                <p class="section__subtitle">Une question ? Envie de venir voir un cours ?</p>
            </div>

            <div class="text-center mt-3">
                <a href="contact.php" class="btn btn--primary">Nous contacter</a>
                <a href="inscription.php" class="btn btn--outline">S'inscrire</a>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
</body>
</html>
