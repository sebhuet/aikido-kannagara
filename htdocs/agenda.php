<?php require_once __DIR__ . '/includes/jsonld.php'; ?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Agenda des cours | Planning et présence des professeurs - Aïkido Kannagara Guyancourt</title>
    <meta name="description" content="Agenda des cours d'aïkido du club Kannagara Guyancourt. Planning, présence des professeurs. Ouvert à tous les licenciés, toutes fédérations.">
    <meta name="keywords" content="agenda aïkido, planning cours aïkido, horaires aïkido Guyancourt, professeurs présents">
    <meta name="author" content="Aïkido Kannagara Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/agenda.php">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/agenda.php">
    <meta property="og:title" content="Agenda des cours - Aïkido Kannagara Guyancourt">
    <meta property="og:description" content="Planning des cours et présence des professeurs. Cours ouverts à tous les licenciés.">
    <meta property="og:image" content="https://kannagara.fr/images/partage/kannagara.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Agenda des cours - Aïkido Kannagara Guyancourt">
    <meta name="twitter:description" content="Planning des cours et présence des professeurs. Cours ouverts à tous les licenciés.">
    <meta name="twitter:image" content="https://kannagara.fr/images/partage/kannagara.jpg">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css?v=<?= substr(md5_file(__DIR__ . '/css/style.css'), 0, 8) ?>">
    <link rel="stylesheet" href="css/responsive.css?v=<?= substr(md5_file(__DIR__ . '/css/responsive.css'), 0, 8) ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- JSON-LD : les cours hebdomadaires de la saison (includes/jsonld.php) -->
    <?php jsonld_script(jsonld_cours()); ?>

    <style>
        .info-box {
            background: linear-gradient(135deg, #8B0000 0%, #660000 100%);
            color: white;
            padding: var(--spacing-xl);
            border-radius: 12px;
            margin-bottom: var(--spacing-xxl);
            box-shadow: 0 4px 15px rgba(139, 0, 0, 0.2);
        }

        .info-box h3 {
            margin-top: 0;
            margin-bottom: var(--spacing-md);
            font-size: 1.3rem;
            color: white;
        }

        .info-box p {
            margin-bottom: var(--spacing-sm);
            line-height: 1.7;
            color: white;
        }

        .info-box strong {
            color: white;
        }

        .info-box a {
            color: #FFD700;
        }

        .info-box a:hover {
            color: white;
        }

        .agenda-week__title {
            font-size: 1.5rem;
            color: var(--color-primary);
            margin: var(--spacing-lg) 0 var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--color-bg-alt);
            border-left: 4px solid var(--color-accent);
            border-radius: 4px;
        }

        .agenda-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: var(--spacing-xl);
        }

        .agenda-table thead {
            background: linear-gradient(135deg, var(--color-primary) 0%, #2c3e50 100%);
            color: white;
        }

        .agenda-table th {
            padding: var(--spacing-md);
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .agenda-table td {
            padding: var(--spacing-md);
            border-bottom: 1px solid var(--color-border);
        }

        .agenda-table tbody tr:hover {
            background: var(--color-bg-alt);
        }

        .agenda-table tbody tr:last-child td {
            border-bottom: none;
        }

        .agenda-day-cell {
            font-weight: 600;
            color: var(--color-primary);
            white-space: nowrap;
            min-width: 120px;
        }

        .agenda-time-cell {
            color: var(--color-accent);
            font-weight: 700;
            font-size: 0.95rem;
            white-space: nowrap;
        }

        .agenda-type-cell {
            color: var(--color-text);
            font-weight: 500;
        }

        .agenda-teachers-cell {
            color: var(--color-text);
        }

        .agenda-closed {
            background: #f9f9f9;
            color: #999;
            font-style: italic;
        }

        .teacher-link {
            color: var(--color-accent);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .teacher-link:hover {
            color: var(--color-primary);
            text-decoration: underline;
        }

        .agenda-course__reason {
            color: #666;
            font-style: italic;
        }

        .agenda-course__note {
            margin-top: var(--spacing-xs);
            padding: var(--spacing-xs) var(--spacing-sm);
            background: rgba(139, 0, 0, 0.1);
            border-radius: 4px;
            font-size: 0.85rem;
            color: var(--color-accent);
            display: inline-block;
        }

        .agenda-note-icon {
            margin-right: var(--spacing-xs);
        }

        /* Prochain jour de cours : badge et lignes surlignées */
        .agenda-badge {
            display: inline-block;
            margin-left: 6px;
            padding: 2px 8px;
            border-radius: 999px;
            background: var(--color-secondary);
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            vertical-align: middle;
        }

        .agenda-table tbody tr.agenda-row--prochain {
            background: rgba(206, 48, 48, 0.07);
        }

        /* Semaines au-delà des 4 prochaines : repliées derrière un bouton */
        .agenda-suite > summary {
            display: block;
            width: fit-content;
            margin: var(--spacing-lg) auto;
            padding: var(--spacing-sm) var(--spacing-lg);
            border: 2px solid var(--color-secondary);
            border-radius: 4px;
            color: var(--color-secondary);
            font-weight: 600;
            cursor: pointer;
            list-style: none;
        }

        .agenda-suite > summary::-webkit-details-marker {
            display: none;
        }

        .agenda-suite > summary:hover,
        .agenda-suite > summary:focus-visible {
            background: var(--color-secondary);
            color: white;
        }

        .agenda-suite[open] .agenda-suite__ouvrir,
        .agenda-suite:not([open]) .agenda-suite__fermer {
            display: none;
        }

        @media (max-width: 768px) {
            .agenda-table {
                font-size: 0.9rem;
            }
            
            .agenda-table th,
            .agenda-table td {
                padding: var(--spacing-sm);
            }
            
            .agenda-day-cell {
                min-width: auto;
            }
        }

        /* Téléphone : les quatre colonnes doivent tenir dans l'écran. Le tableau, plus
           large, coupait la colonne des professeurs (overflow: hidden). */
        @media (max-width: 600px) {
            .agenda-table {
                font-size: 0.82rem;
            }

            .agenda-table th,
            .agenda-table td {
                padding: 0.6rem 0.4rem;
            }

            .agenda-table th {
                font-size: 0.72rem;
                letter-spacing: 0;
            }

            .agenda-day-cell {
                white-space: normal;
            }

            .agenda-time-cell {
                font-size: 0.8rem;
            }

            .agenda-badge {
                display: block;
                width: fit-content;
                margin: 4px 0 0;
            }
        }
    </style>
</head>
<body>
    <?php
    $active = 'agenda';
    include 'includes/header.php';
    require_once __DIR__ . '/includes/markdown.php';
    require_once __DIR__ . '/includes/agenda-parser.php';
    ?>




    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Agenda des Cours</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Agenda
            </p>
        </div>
    </section>

    <!-- Introduction et infos -->
    <section class="section">
        <div class="container">
            <!-- Info cours ouverts -->
            <div class="info-box">
                <h3>🥋 Cours ouverts à tous les licenciés</h3>
                <p>
                    Les cours sont <strong>ouverts à tous les pratiquants licenciés</strong>, quelle que soit leur fédération (FFAB, FFAAA, etc.). 
                    Participation : <strong>10€/cours</strong> pour les pratiquants extérieurs au club.
                </p>
                <p style="margin-bottom: 0;">
                    📍 <a href="https://maps.app.goo.gl/xuTo7Rqh51XWqWEh6" target="_blank" rel="noopener" style="color: #FFD700;">Gymnase Maurice Baquet</a>, Mail des Graviers, 78280 Guyancourt
                </p>
            </div>

            <!-- Horaires réguliers résumé -->
            <?php include 'includes/horaires.php'; ?>
        </div>
    </section>

    <!-- Agenda généré dynamiquement depuis agenda.md : seulement les jours à venir.
         Les 4 prochaines semaines sont dépliées, la suite de la saison est repliée
         (elle faisait plus de 30 écrans de téléphone). -->
    <?php
    $aujourdhui = strtotime('today');
    $semaines = agenda_a_venir(parse_agenda(__DIR__ . '/agenda.md'), $aujourdhui);
    $nbVisibles = 4;
    echo render_agenda(array_slice($semaines, 0, $nbVisibles), $aujourdhui);
    $suite = array_slice($semaines, $nbVisibles);
    ?>
    <?php if ($suite): ?>
    <details class="agenda-suite">
        <summary>
            <span class="agenda-suite__ouvrir">Voir les <?= count($suite) ?> semaines suivantes</span>
            <span class="agenda-suite__fermer">Masquer les semaines suivantes</span>
        </summary>
        <?= render_agenda($suite, null, $nbVisibles) ?>
    </details>
    <?php elseif (!$semaines): ?>
    <section class="section">
        <div class="container">
            <p class="text-center">Le planning de la prochaine saison sera publié ici avant la rentrée.</p>
        </div>
    </section>
    <?php endif; ?>

    <?php include 'includes/footer.php'; ?>




    <!-- JavaScript -->
    <script src="js/main.js?v=<?= substr(md5_file(__DIR__ . '/js/main.js'), 0, 8) ?>" defer></script>
</body>
</html>
