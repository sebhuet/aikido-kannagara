<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Statistiques | Kannagara Aïkido</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <style>
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: var(--spacing-lg);
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .stats-table th,
        .stats-table td {
            padding: var(--spacing-sm) var(--spacing-md);
            text-align: center;
            border-bottom: 1px solid var(--color-border);
        }

        .stats-table td:nth-child(5) {
            text-align: left;
        }

        .stats-table th {
            background: var(--color-primary);
            color: white;
            font-weight: 600;
        }

        .stats-table td:first-child {
            text-align: left;
            font-weight: 600;
        }

        .stats-table tr:last-child td {
            border-bottom: none;
        }

        .stats-table tr:hover td {
            background: var(--color-bg-light);
        }

        .stats-table .total-row td {
            background: var(--color-bg-light);
            font-weight: 700;
            border-top: 2px solid var(--color-primary);
        }

        .stats-bar {
            display: inline-block;
            height: 12px;
            background: var(--color-accent);
            border-radius: 6px;
            vertical-align: middle;
            margin-left: var(--spacing-xs);
        }

        .stats-section {
            margin-top: var(--spacing-xl);
        }

        .stats-section h2 {
            color: var(--color-primary);
        }
    </style>
</head>
<body>
    <?php $active = ''; include 'includes/header.php'; ?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Statistiques</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Statistiques
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">

<?php
require_once 'includes/agenda-parser.php';

$weeks = parse_agenda(__DIR__ . '/agenda.md');

// Compteurs par professeur
$stats = []; // nom => ['jours' => N, 'enfants' => N, 'adultes' => N, 'prochain' => null]
$today = date('Y-m-d');

foreach ($weeks as $week) {
    // Extraire l'année depuis le titre de la semaine (format JJ/MM/YYYY)
    preg_match('/(\d{2})\/(\d{2})\/(\d{4})/', $week['title'], $wm);
    $weekYear = $wm ? $wm[3] : date('Y');

    foreach ($week['days'] as $day) {
        // Extraire la date du jour (format "Lundi 16/03")
        $dayDate = null;
        if (preg_match('/(\d{2})\/(\d{2})$/', $day['name'], $dm)) {
            $dayDate = $weekYear . '-' . $dm[2] . '-' . $dm[1];
        }

        // Collecter les profs de ce jour (pour compter les jours uniques)
        $profsThisDay = [];

        foreach ($day['courses'] as $course) {
            $teachers = $course['teachers'] ?? '';
            if ($teachers === '' || $teachers === 'À confirmer' || $teachers === 'Pas de cours' || $course['time'] === 'Fermé') {
                continue;
            }

            // Ignorer les stages
            $type = strtolower($course['type']);
            if (strpos($type, 'stage') !== false) {
                continue;
            }

            // Ignorer Jean-Marc Chamot (professeur principal, hors répartition)
            if (strpos($teachers, 'Jean-Marc Chamot') !== false && trim($teachers) === 'Jean-Marc Chamot') {
                continue;
            }

            // Un cours peut avoir plusieurs profs séparés par des virgules
            $names = array_map('trim', explode(',', $teachers));
            foreach ($names as $name) {
                if ($name === '') continue;

                if (!isset($stats[$name])) {
                    $stats[$name] = ['jours' => 0, 'enfants' => 0, 'adultes' => 0, 'prochain' => null];
                }

                // Compter par type de cours
                if (strpos($type, 'enfant') !== false) {
                    $stats[$name]['enfants']++;
                } elseif (strpos($type, 'adulte') !== false) {
                    $stats[$name]['adultes']++;
                }

                $profsThisDay[$name] = true;

                // Prochain cours >= aujourd'hui
                if ($dayDate && $dayDate >= $today && $stats[$name]['prochain'] === null) {
                    $stats[$name]['prochain'] = $dayDate;
                }
            }
        }

        // Incrémenter le compteur de jours pour chaque prof présent ce jour
        foreach (array_keys($profsThisDay) as $name) {
            $stats[$name]['jours']++;
        }
    }
}

// Trier par ordre alphabétique
ksort($stats, SORT_LOCALE_STRING);

// Trouver le max pour les barres
$maxJours = 0;
foreach ($stats as $s) {
    if ($s['jours'] > $maxJours) $maxJours = $s['jours'];
}
?>

            <div class="stats-section">
                <h2>Répartition</h2>
                <table class="stats-table">
                    <thead>
                        <tr>
                            <th>Professeur</th>
                            <th>Jours</th>
                            <th>Enfants</th>
                            <th>Adultes</th>
                            <th>Répartition</th>
                            <th>Prochain cours</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
$totalJours = 0;
$totalEnfants = 0;
$totalAdultes = 0;

foreach ($stats as $name => $s):
    $totalJours += $s['jours'];
    $totalEnfants += $s['enfants'];
    $totalAdultes += $s['adultes'];
    $barWidth = $maxJours > 0 ? round(($s['jours'] / $maxJours) * 150) : 0;
?>
                        <tr>
                            <td><?= htmlspecialchars($name) ?></td>
                            <td><?= $s['jours'] ?></td>
                            <td><?= $s['enfants'] ?></td>
                            <td><?= $s['adultes'] ?></td>
                            <td><span class="stats-bar" style="width: <?= $barWidth ?>px;"></span></td>
                            <td><?php
                                if ($s['prochain']) {
                                    $d = DateTime::createFromFormat('Y-m-d', $s['prochain']);
                                    echo $d ? $d->format('d/m/Y') : '-';
                                } else {
                                    echo '-';
                                }
                            ?></td>
                        </tr>
<?php endforeach; ?>
                        <tr class="total-row">
                            <td>Total</td>
                            <td><?= $totalJours ?></td>
                            <td><?= $totalEnfants ?></td>
                            <td><?= $totalAdultes ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="js/main.js"></script>
</body>
</html>
