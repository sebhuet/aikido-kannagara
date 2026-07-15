<?php require_once __DIR__ . '/includes/data.php'; $club = club_data(); $sch = $club['schedule']; $loc = $club['location']; ?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Contact | Club d'aïkido Guyancourt - Gymnase Maurice Baquet</title>
    <meta name="description" content="Contactez Aïkido Kannagara Guyancourt. <?= htmlspecialchars($loc['venue']) ?>, <?= htmlspecialchars($loc['street']) ?>. Tél : <?= htmlspecialchars($club['contact']['phone']) ?>. Plan d'accès et formulaire de contact.">
    <meta name="keywords" content="contact aïkido, Guyancourt, gymnase maurice baquet, adresse, téléphone, plan">
    <meta name="author" content="Aïkido Kannagara Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/contact.php">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/contact.php">
    <meta property="og:title" content="Contact - Aïkido Kannagara Guyancourt">
    <meta property="og:description" content="<?= htmlspecialchars($loc['venue']) ?>, <?= htmlspecialchars($loc['street']) ?>, <?= htmlspecialchars($loc['postalCode']) ?> <?= htmlspecialchars($loc['city']) ?>. Tél: <?= htmlspecialchars($club['contact']['phone']) ?>.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.jpg">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Contact - Aïkido Kannagara Guyancourt">
    <meta name="twitter:description" content="<?= htmlspecialchars($loc['venue']) ?>, <?= htmlspecialchars($loc['street']) ?>, <?= htmlspecialchars($loc['postalCode']) ?> <?= htmlspecialchars($loc['city']) ?>. Tél: <?= htmlspecialchars($club['contact']['phone']) ?>.">
    <meta name="twitter:image" content="https://kannagara.fr/images/logo-kannagara.jpg">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- Schema.org LocalBusiness -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Aïkido Kannagara Guyancourt",
        "description": "Club d'aïkido affilié FFAB",
        "telephone": <?= json_encode($club['contact']['phoneIntl']) ?>,
        "email": <?= json_encode($club['contact']['email']) ?>,
        "address": {
            "@type": "PostalAddress",
            "streetAddress": <?= json_encode($loc['venue'] . ', ' . $loc['street'], JSON_UNESCAPED_UNICODE) ?>,
            "addressLocality": <?= json_encode($loc['city'], JSON_UNESCAPED_UNICODE) ?>,
            "postalCode": <?= json_encode($loc['postalCode']) ?>,
            "addressCountry": <?= json_encode($loc['country']) ?>
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": <?= json_encode($loc['geo']['lat']) ?>,
            "longitude": <?= json_encode($loc['geo']['lng']) ?>
        },
        "url": "https://kannagara.fr",
        "openingHoursSpecification": <?= json_encode([
            ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => $sch['daysSchemaOrg'], 'opens' => $sch['children']['opens'], 'closes' => $sch['children']['closes'], 'validFrom' => $club['seasonStart'], 'description' => 'Cours enfants'],
            ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => $sch['daysSchemaOrg'], 'opens' => $sch['adultsRange']['opens'], 'closes' => $sch['adultsRange']['closes'], 'validFrom' => $club['seasonStart'], 'description' => 'Cours adultes'],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>,
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
        ]
    }
    </script>
</head>
<body>
    <?php $active = 'contact'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Contact</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Contact
            </p>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="section">
        <div class="container">
            <div class="contact-grid">
                <!-- Informations de contact -->
                <div>
                    <h2>Nous contacter</h2>

                    <?php $presidente = club_board_member('president'); ?>
                    <div class="team-member" style="text-align: center; margin: var(--spacing-lg) 0;">
                        <img src="<?= htmlspecialchars($presidente['photo']) ?>" alt="<?= htmlspecialchars($presidente['name']) ?>" class="team-member__photo" style="width: 200px; height: 200px; object-fit: cover;" loading="lazy">
                        <h3 class="team-member__name"><?= htmlspecialchars($presidente['name']) ?></h3>
                        <p class="team-member__grade"><?= htmlspecialchars($presidente['role']) ?> du club</p>
                        <p style="margin-top: var(--spacing-sm);"><a href="tel:<?= preg_replace('/\s+/', '', $presidente['phone']) ?>"><?= htmlspecialchars($presidente['phone']) ?></a></p>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h4>Email</h4>
                            <p><a href="mailto:<?= htmlspecialchars($club['contact']['email']) ?>"><?= htmlspecialchars($club['contact']['email']) ?></a></p>
                        </div>
                    </div>

                    <div class="contact-info__item">
                        <div class="contact-info__icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                        <div>
                            <h4>Horaires des cours</h4>
                            <?php include 'includes/horaires-resume.php'; ?>
                        </div>
                    </div>

                    <h3 class="mt-4">Lieu de pratique</h3>
                    <div class="info-box">
                        <h4 class="info-box__title"><a href="<?= htmlspecialchars($loc['mapsUrl']) ?>" target="_blank" rel="noopener" title="Voir sur Google Maps"><?= htmlspecialchars($loc['venue']) ?> <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></a></h4>
                        <p>
                            <?= htmlspecialchars($loc['street']) ?><br>
                            <?= htmlspecialchars($loc['postalCode']) ?> <?= htmlspecialchars($loc['city']) ?>
                        </p>
                        <p class="mt-1">
                            Au cœur de Saint-Quentin-en-Yvelines, accessible depuis Montigny-le-Bretonneux,
                            Voisins-le-Bretonneux, Élancourt, Versailles, Vélizy et les communes voisines.
                        </p>
                        <p class="mt-1">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=<?= rawurlencode($loc['venue'] . ', ' . $loc['city']) ?>" target="_blank" rel="noopener" class="btn btn--outline" style="font-size: 0.9rem;">
                                Calculer mon itinéraire
                            </a>
                        </p>
                    </div>
                </div>

                <?php /* Aperçu de plan cliquable, entièrement autonome (SVG + CSS, aucune
                         requête réseau) : contrairement à l'iframe Google Maps, il ne peut
                         pas être bloqué par un ad-blocker ni tomber en panne côté Google. */ ?>
                <a class="contact-map" href="<?= htmlspecialchars($loc['mapsUrl']) ?>" target="_blank" rel="noopener"
                   aria-label="Ouvrir <?= htmlspecialchars($loc['venue']) ?> dans Google Maps">
                    <svg class="contact-map__deco" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
                        <g stroke="#c7ced6" stroke-width="7" fill="none" opacity="0.55">
                            <path d="M-20 95 L 420 120"/>
                            <path d="M-20 215 L 420 195"/>
                            <path d="M 95 -20 L 72 320"/>
                            <path d="M 255 -20 L 285 320"/>
                        </g>
                        <g stroke="#d6dce2" stroke-width="2.5" fill="none" opacity="0.7">
                            <path d="M-20 155 L 420 150"/>
                            <path d="M 175 -20 L 178 320"/>
                        </g>
                    </svg>
                    <span class="contact-map__content">
                        <span class="contact-map__pin" aria-hidden="true">
                            <svg width="44" height="44" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7zm0 9.5A2.5 2.5 0 1 1 12 6.5a2.5 2.5 0 0 1 0 5z"/></svg>
                        </span>
                        <strong class="contact-map__venue"><?= htmlspecialchars($loc['venue']) ?></strong>
                        <span class="contact-map__cta">Ouvrir dans Google Maps ↗</span>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Formulaire de contact -->
    <section class="section section--alt">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Envoyez-nous un message</h2>
                <p class="section__subtitle">Nous vous répondrons dans les plus brefs délais</p>
            </div>

            <div class="text-center">
                <p style="max-width: 600px; margin: 0 auto var(--spacing-lg);">
                    Pour nous contacter, vous pouvez utiliser notre formulaire en ligne
                    ou nous envoyer directement un email.
                </p>
                <a href="mailto:<?= htmlspecialchars($club['contact']['email']) ?>?subject=Contact depuis le site web" class="btn btn--primary">
                    Envoyer un email
                </a>
            </div>
        </div>
    </section>

    <!-- Informations complémentaires -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <h2>Venir nous voir</h2>
                <p>
                    N'hésitez pas à venir assister à un cours pour découvrir l'ambiance du club.
                    Les spectateurs sont les bienvenus (dans le respect du calme nécessaire à la pratique).
                </p>
                <p>
                    Pour les personnes souhaitant essayer l'aïkido, nous vous recommandons de nous
                    contacter au préalable, notamment en dehors de la période des portes ouvertes
                    de septembre.
                </p>

                <div class="info-box">
                    <h4 class="info-box__title">Conseil</h4>
                    <p>
                        Pour un premier cours d'essai, prévoyez d'arriver 15 minutes avant le début
                        du cours pour vous présenter et vous préparer. Un survêtement propre
                        peut suffire pour la première séance.
                    </p>
                </div>

                <div class="text-center mt-4">
                    <a href="inscription.php" class="btn btn--primary">En savoir plus sur l'inscription</a>
                    <a href="actualites.php" class="btn btn--outline">Voir les événements</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
</body>
</html>
