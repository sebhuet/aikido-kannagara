<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Actualités | Stages et événements aïkido Guyancourt</title>
    <meta name="description" content="Actualités du club Kannagara Aïkido : portes ouvertes septembre, stages FFAB, passages de grades. Événements à Guyancourt.">
    <meta name="keywords" content="actualités aïkido, stage aïkido, portes ouvertes, événements Guyancourt, FFAB">
    <meta name="author" content="Kannagara Aïkido Club de Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.7678;2.0567">
    <meta name="ICBM" content="48.7678, 2.0567">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/actualites.html">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/actualites.html">
    <meta property="og:title" content="Actualités - Kannagara Aïkido">
    <meta property="og:description" content="Portes ouvertes, stages, événements du club d'aïkido de Guyancourt.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Actualités - Kannagara Aïkido">
    <meta name="twitter:description" content="Portes ouvertes, stages, événements du club d'aïkido de Guyancourt.">
    <meta name="twitter:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "Actualités - Kannagara Aïkido",
        "description": "Actualités du club Kannagara Aïkido : portes ouvertes septembre, stages FFAB, passages de grades. Événements à Guyancourt.",
        "url": "https://kannagara.fr/actualites.html",
        "inLanguage": "fr",
        "isPartOf": {
            "@type": "WebSite",
            "name": "Kannagara Aïkido",
            "url": "https://kannagara.fr"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Kannagara Aïkido Club de Guyancourt",
            "url": "https://kannagara.fr",
            "logo": {
                "@type": "ImageObject",
                "url": "https://kannagara.fr/images/logo-kannagara.png"
            }
        }
    }
    </script>

    <style>
        /* Calendrier des événements */
        .calendar {
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: var(--spacing-xl);
        }

        .calendar__header {
            background: var(--color-primary);
            color: white;
            padding: var(--spacing-lg);
            text-align: center;
        }

        .calendar__title {
            font-size: 1.5rem;
            margin-bottom: var(--spacing-xs);
        }

        .calendar__subtitle {
            opacity: 0.8;
            font-size: 0.95rem;
        }

        .calendar__body {
            padding: var(--spacing-lg);
        }

        .calendar__month {
            margin-bottom: var(--spacing-lg);
        }

        .calendar__month:last-child {
            margin-bottom: 0;
        }

        .calendar__month-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--color-secondary);
            padding-bottom: var(--spacing-sm);
            border-bottom: 2px solid var(--color-accent);
            margin-bottom: var(--spacing-md);
        }

        .calendar__events {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .calendar__event {
            display: flex;
            gap: var(--spacing-md);
            padding: var(--spacing-sm) 0;
            border-bottom: 1px solid var(--color-border);
        }

        .calendar__event:last-child {
            border-bottom: none;
        }

        .calendar__event-date {
            min-width: 80px;
            font-weight: 600;
            color: var(--color-accent);
        }

        .calendar__event-title {
            flex: 1;
            color: var(--color-text);
        }

        .calendar__event-type {
            font-size: 0.8rem;
            padding: 2px 8px;
            border-radius: 12px;
            background: var(--color-bg-alt);
            color: var(--color-text-light);
        }

        .calendar__event-type--stage {
            background: rgba(139, 0, 0, 0.1);
            color: var(--color-secondary);
        }

        .calendar__event-type--cours {
            background: rgba(201, 162, 39, 0.2);
            color: var(--color-accent);
        }

        .calendar__event-type--grade {
            background: rgba(26, 26, 26, 0.1);
            color: var(--color-primary);
        }

        .calendar__legend {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--color-bg-alt);
            border-top: 1px solid var(--color-border);
            justify-content: center;
        }

        .calendar__legend-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            font-size: 0.85rem;
        }

        @media (max-width: 600px) {
            .calendar__event {
                flex-direction: column;
                gap: var(--spacing-xs);
            }
            .calendar__event-date {
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <?php $active = 'actualites'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Actualités du Club</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Actualités
            </p>
        </div>
    </section>

    <!-- Événements à venir (dynamique depuis evenements.md) -->
    <?php
    require_once __DIR__ . '/includes/evenements-parser.php';
    $evenements = parse_evenements(__DIR__ . '/evenements.md');
    ?>
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Événements à venir</h2>
                <p class="section__subtitle">Retrouvez ici les prochains rendez-vous du club</p>
            </div>

            <?php if (!empty($evenements)): ?>
            <div class="cards-grid">
                <?php foreach ($evenements as $evt): ?>
                <div class="card fade-in">
                    <div class="card__content">
                        <span class="blog-card__date"><?= htmlspecialchars(format_date_evenement($evt['date'])) ?></span>
                        <h3 class="card__title"><?= htmlspecialchars($evt['title']) ?></h3>
                        <?php if ($evt['description']): ?>
                        <p class="card__text"><?= htmlspecialchars($evt['description']) ?></p>
                        <?php endif; ?>
                        <p class="card__meta">
                            <?php if ($evt['horaire']): ?>
                                <strong>Horaire :</strong> <?= htmlspecialchars($evt['horaire']) ?><br>
                            <?php endif; ?>
                            <?php if ($evt['animateur']): ?>
                                <strong>Animé par :</strong> <?= htmlspecialchars($evt['animateur']) ?><br>
                            <?php endif; ?>
                            <?php if ($evt['lieu']): ?>
                                <strong>Lieu :</strong>
                                <?php if ($evt['lieu_url']): ?>
                                    <a href="<?= htmlspecialchars($evt['lieu_url']) ?>" target="_blank" rel="noopener" title="Voir sur Google Maps"><?= htmlspecialchars($evt['lieu']) ?> <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></a>
                                <?php else: ?>
                                    <?= htmlspecialchars($evt['lieu']) ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="info-box" style="max-width: 700px; margin: 0 auto; text-align: center;">
                <p>Aucun événement à venir pour le moment. Revenez bientôt !</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Actualités régulières -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Activités régulières</h2>
            </div>

            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <div class="info-box">
                    <h3 class="info-box__title">Cours hebdomadaires</h3>
                    <p>
                        Les cours reprennent chaque année début septembre et se poursuivent
                        jusqu'à fin juin, hors vacances scolaires.
                    </p>
                    <?php include 'includes/horaires.php'; ?>
                </div>

                <div class="info-box">
                    <h3 class="info-box__title">Stages fédéraux</h3>
                    <p>
                        Le club participe régulièrement aux stages organisés par la FFAB
                        au niveau régional et national. Ces stages sont l'occasion de
                        pratiquer avec des experts de haut niveau et de rencontrer
                        des pratiquants d'autres clubs.
                    </p>
                </div>

                <div class="info-box">
                    <h3 class="info-box__title">Passages de grades</h3>
                    <p>
                        Des sessions de passage de grades (kyu) sont organisées régulièrement
                        au sein du club. Les examens pour les grades dan (ceinture noire)
                        se passent lors des stages fédéraux.
                    </p>
                    <p>
                        <a href="grades.php">En savoir plus sur les grades</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Archives / Annonces passées -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Vie du club</h2>
            </div>

            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <p>
                    Tout au long de l'année, le club organise et participe à de nombreux événements :
                </p>

                <ul>
                    <li>Stages internes avec les professeurs du club</li>
                    <li>Participation aux stages régionaux FFAB</li>
                    <li>Échanges avec d'autres clubs de la région</li>
                    <li>Démonstrations lors d'événements locaux</li>
                    <li>Moments conviviaux (galette des rois, repas de fin d'année...)</li>
                </ul>

                <p>
                    Pour être tenu informé des prochains événements, n'hésitez pas à nous contacter
                    ou à suivre les annonces sur cette page.
                </p>

                <div class="text-center mt-4">
                    <a href="contact.php" class="btn btn--primary">Nous contacter</a>
                    <a href="inscription.php" class="btn btn--outline">S'inscrire</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
</body>
</html>
