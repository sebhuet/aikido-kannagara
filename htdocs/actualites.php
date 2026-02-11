<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Actualités | Stages et événements aïkido Guyancourt</title>
    <meta name="description" content="Actualités du club Kannagara Aïkido : portes ouvertes septembre, stages FFAB, passages de grades. Événements à Guyancourt.">
    <meta name="keywords" content="actualités aïkido, stage aïkido, portes ouvertes, événements Guyancourt, FFAB">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/actualites.html">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/actualites.html">
    <meta property="og:title" content="Actualités - Kannagara Aïkido">
    <meta property="og:description" content="Portes ouvertes, stages, événements du club d'aïkido de Guyancourt.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

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

    <!-- Contenu principal -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Événements à venir</h2>
                <p class="section__subtitle">Retrouvez ici les prochains rendez-vous du club</p>
            </div>

            <div class="cards-grid">
                <!-- Événement 1 -->
                <div class="card fade-in">
                    <div class="card__content">
                        <span class="blog-card__date">Septembre 2025</span>
                        <h3 class="card__title">Portes ouvertes</h3>
                        <p class="card__text">
                            Venez découvrir l'aïkido gratuitement pendant tout le mois de septembre !
                            Cours d'essai ouverts à tous, avec prêt de kimono.
                        </p>
                        <p class="card__meta">
                            <strong>Animé par :</strong> L'équipe enseignante<br>
                            <strong>Lieu :</strong> <a href="https://maps.app.goo.gl/xuTo7Rqh51XWqWEh6" target="_blank" rel="noopener" title="Voir sur Google Maps">Gymnase Maurice Baquet <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></a>
                        </p>
                    </div>
                </div>

                <!-- Événement 2 -->
                <div class="card fade-in">
                    <div class="card__content">
                        <span class="blog-card__date">Samedi 30 août 2025</span>
                        <h3 class="card__title">Initiation "Découvrir avant de s'inscrire"</h3>
                        <p class="card__text">
                            Séance spéciale d'initiation pour les personnes qui souhaitent
                            découvrir l'aïkido avant la rentrée.
                        </p>
                        <p class="card__meta">
                            <strong>Horaire :</strong> 9h à 10h<br>
                            <strong>Animé par :</strong> Sébastien Huet
                        </p>
                    </div>
                </div>

                <!-- Événement 3 -->
                <div class="card fade-in">
                    <div class="card__content">
                        <span class="blog-card__date">Lundi 25 août 2025</span>
                        <h3 class="card__title">Pré-rentrée</h3>
                        <p class="card__text">
                            Reprise des cours pour les anciens membres avant la rentrée officielle.
                            L'occasion de se retrouver et de reprendre la pratique en douceur.
                        </p>
                        <p class="card__meta">
                            <strong>Horaire :</strong> 19h00<br>
                            <strong>Lieu :</strong> <a href="https://maps.app.goo.gl/xuTo7Rqh51XWqWEh6" target="_blank" rel="noopener" title="Voir sur Google Maps">Gymnase Maurice Baquet <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Calendrier de la saison -->
    <section class="section section--alt">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Calendrier de la saison 2024-2025</h2>
                <p class="section__subtitle">Les temps forts de l'année au club</p>
            </div>

            <div class="calendar" style="max-width: 800px; margin: 0 auto;">
                <div class="calendar__header">
                    <h3 class="calendar__title">Saison 2024-2025</h3>
                    <p class="calendar__subtitle">Du 2 septembre 2024 au 28 juin 2025</p>
                </div>

                <div class="calendar__body">
                    <!-- Septembre -->
                    <div class="calendar__month">
                        <h4 class="calendar__month-name">Septembre 2024</h4>
                        <ul class="calendar__events">
                            <li class="calendar__event">
                                <span class="calendar__event-date">2 sept.</span>
                                <span class="calendar__event-title">Reprise des cours - Rentrée</span>
                                <span class="calendar__event-type calendar__event-type--cours">Cours</span>
                            </li>
                            <li class="calendar__event">
                                <span class="calendar__event-date">Tout le mois</span>
                                <span class="calendar__event-title">Portes ouvertes - Cours d'essai gratuits</span>
                                <span class="calendar__event-type calendar__event-type--cours">Cours</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Octobre -->
                    <div class="calendar__month">
                        <h4 class="calendar__month-name">Octobre 2024</h4>
                        <ul class="calendar__events">
                            <li class="calendar__event">
                                <span class="calendar__event-date">19-20 oct.</span>
                                <span class="calendar__event-title">Stage régional FFAB Île-de-France</span>
                                <span class="calendar__event-type calendar__event-type--stage">Stage</span>
                            </li>
                            <li class="calendar__event">
                                <span class="calendar__event-date">26 oct.</span>
                                <span class="calendar__event-title">Vacances scolaires (pas de cours)</span>
                                <span class="calendar__event-type">Info</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Décembre -->
                    <div class="calendar__month">
                        <h4 class="calendar__month-name">Décembre 2024</h4>
                        <ul class="calendar__events">
                            <li class="calendar__event">
                                <span class="calendar__event-date">14 déc.</span>
                                <span class="calendar__event-title">Passage de grades (kyu)</span>
                                <span class="calendar__event-type calendar__event-type--grade">Grade</span>
                            </li>
                            <li class="calendar__event">
                                <span class="calendar__event-date">19 déc.</span>
                                <span class="calendar__event-title">Dernier cours avant les fêtes</span>
                                <span class="calendar__event-type calendar__event-type--cours">Cours</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Janvier -->
                    <div class="calendar__month">
                        <h4 class="calendar__month-name">Janvier 2025</h4>
                        <ul class="calendar__events">
                            <li class="calendar__event">
                                <span class="calendar__event-date">6 janv.</span>
                                <span class="calendar__event-title">Reprise des cours</span>
                                <span class="calendar__event-type calendar__event-type--cours">Cours</span>
                            </li>
                            <li class="calendar__event">
                                <span class="calendar__event-date">11 janv.</span>
                                <span class="calendar__event-title">Galette des rois du club</span>
                                <span class="calendar__event-type">Convivialité</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Mars -->
                    <div class="calendar__month">
                        <h4 class="calendar__month-name">Mars 2025</h4>
                        <ul class="calendar__events">
                            <li class="calendar__event">
                                <span class="calendar__event-date">15-16 mars</span>
                                <span class="calendar__event-title">Stage national FFAB</span>
                                <span class="calendar__event-type calendar__event-type--stage">Stage</span>
                            </li>
                            <li class="calendar__event">
                                <span class="calendar__event-date">22 mars</span>
                                <span class="calendar__event-title">Passage de grades (kyu)</span>
                                <span class="calendar__event-type calendar__event-type--grade">Grade</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Juin -->
                    <div class="calendar__month">
                        <h4 class="calendar__month-name">Juin 2025</h4>
                        <ul class="calendar__events">
                            <li class="calendar__event">
                                <span class="calendar__event-date">7 juin</span>
                                <span class="calendar__event-title">Passage de grades de fin de saison</span>
                                <span class="calendar__event-type calendar__event-type--grade">Grade</span>
                            </li>
                            <li class="calendar__event">
                                <span class="calendar__event-date">21 juin</span>
                                <span class="calendar__event-title">Démonstration - Fête du sport</span>
                                <span class="calendar__event-type">Événement</span>
                            </li>
                            <li class="calendar__event">
                                <span class="calendar__event-date">28 juin</span>
                                <span class="calendar__event-title">Dernier cours + Repas de fin d'année</span>
                                <span class="calendar__event-type">Convivialité</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="calendar__legend">
                    <div class="calendar__legend-item">
                        <span class="calendar__event-type calendar__event-type--cours">Cours</span>
                        Cours et portes ouvertes
                    </div>
                    <div class="calendar__legend-item">
                        <span class="calendar__event-type calendar__event-type--stage">Stage</span>
                        Stages FFAB
                    </div>
                    <div class="calendar__legend-item">
                        <span class="calendar__event-type calendar__event-type--grade">Grade</span>
                        Passages de grades
                    </div>
                </div>
            </div>

            <div class="info-box mt-4" style="max-width: 800px; margin: var(--spacing-xl) auto 0;">
                <p style="text-align: center;">
                    <em>Ce calendrier est donné à titre indicatif. Les dates peuvent être modifiées.
                    Consultez régulièrement cette page ou contactez-nous pour confirmation.</em>
                </p>
            </div>
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
                    <h4 class="info-box__title">Cours hebdomadaires</h4>
                    <p>
                        Les cours reprennent chaque année début septembre et se poursuivent
                        jusqu'à fin juin, hors vacances scolaires.
                    </p>
                    <?php include 'includes/horaires.php'; ?>
                </div>

                <div class="info-box">
                    <h4 class="info-box__title">Stages fédéraux</h4>
                    <p>
                        Le club participe régulièrement aux stages organisés par la FFAB
                        au niveau régional et national. Ces stages sont l'occasion de
                        pratiquer avec des experts de haut niveau et de rencontrer
                        des pratiquants d'autres clubs.
                    </p>
                </div>

                <div class="info-box">
                    <h4 class="info-box__title">Passages de grades</h4>
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
    <script src="js/main.js"></script>
</body>
</html>
