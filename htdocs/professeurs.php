<?php
require_once 'includes/markdown.php';

// Charger toutes les fiches .md
$fiches_dir = __DIR__ . '/professeurs/fiches';
$fichiers = glob($fiches_dir . '/*.md');
sort($fichiers);

$fiches = [];
foreach ($fichiers as $fichier) {
    $fiche = parse_fiche($fichier);
    if ($fiche) $fiches[] = $fiche;
}

// Générer les données pour les meta tags
$noms = array_map(fn($f) => $f['meta']['name'] ?? '', $fiches);
$noms_grades = array_map(fn($f) => ($f['meta']['name'] ?? '') . ' (' . ($f['meta']['grade'] ?? '') . ')', $fiches);
$nb = count($fiches);

$meta_description = "L'équipe enseignante du club Kannagara : " . implode(', ', $noms_grades) . '.';
$meta_keywords = implode(', ', $noms) . ', professeur aïkido, DESJEPS, FFAB';
$og_description = $nb . ' enseignants diplômés : ' . implode(', ', $noms_grades) . '.';

// Générer le Schema.org
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => "Professeurs d'aïkido du club Kannagara",
    'itemListElement' => [],
];
foreach ($fiches as $i => $fiche) {
    $schema['itemListElement'][] = [
        '@type' => 'Person',
        'position' => $i + 1,
        'name' => $fiche['meta']['name'] ?? '',
        'jobTitle' => "Professeur d'aïkido",
        'description' => ($fiche['meta']['grade'] ?? '') . '.',
        'worksFor' => [
            '@type' => 'Organization',
            'name' => 'Kannagara Aïkido Club de Guyancourt',
        ],
    ];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Nos Professeurs | Équipe d'enseignants diplômés - Kannagara Aïkido</title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/professeurs.html">

    <!-- Open Graph -->
    <meta property="og:type" content="profile">
    <meta property="og:url" content="https://kannagara.fr/professeurs.html">
    <meta property="og:title" content="Équipe enseignante - Kannagara Aïkido Guyancourt">
    <meta property="og:description" content="<?= htmlspecialchars($og_description) ?>">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- Schema.org -->
    <script type="application/ld+json">
    <?= json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>

    </script>
</head>
<body>
    <?php $active = 'professeurs'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Nos Professeurs</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Professeurs
            </p>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 900px; margin: 0 auto;">

                <p class="text-center" style="font-size: 1.125rem; margin-bottom: var(--spacing-xl);">
                    Le club Kannagara dispose d'une équipe d'enseignants expérimentés et diplômés,
                    formés dans la tradition de l'aïkido transmise par Maître Tamura.
                </p>

            </div>

            <?php
            foreach ($fiches as $index => $fiche):
                $meta = $fiche['meta'];
                $name = $meta['name'] ?? '';
                $slug = slugify($name);
                $grade = $meta['grade'] ?? '';
                $diplome = $meta['diplome'] ?? '';
                $fonction = $meta['fonction'] ?? '';
                $photo = $meta['photo'] ?? '';
                $body_html = markdown_to_html($fiche['body']);

                $photo_left = ($index % 2 === 0);
                $is_alt = ($index % 2 === 0);

                // Bloc photo
                $photo_block = '<div class="team-member" style="text-align: center;">
                            <img src="professeurs/fiches/' . htmlspecialchars($photo) . '" alt="' . htmlspecialchars($name) . '" class="team-member__photo" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>';

                // Bloc texte
                $text_block = '<div>
                            <h2 style="margin-top: 0;">' . htmlspecialchars($name) . '</h2>
                            <p class="team-member__grade" style="font-size: 1.25rem; margin-bottom: var(--spacing-md);">
                                ' . htmlspecialchars($grade) . '
                            </p>
                            <p><strong>Diplôme</strong> : ' . htmlspecialchars($diplome) . '</p>'
                            . ($fonction ? '<p><strong>Fonction fédérale</strong> : ' . htmlspecialchars($fonction) . '</p>' : '');

                if ($body_html) {
                    $text_block .= '<h3>Parcours</h3>' . "\n" . $body_html;
                }

                $text_block .= '</div>';

                // Colonnes selon la position de la photo
                if ($photo_left) {
                    $grid_cols = '250px 1fr';
                    $grid_content = $photo_block . "\n" . $text_block;
                } else {
                    $grid_cols = '1fr 250px';
                    $grid_content = $text_block . "\n" . $photo_block;
                }
            ?>

            <?php if ($is_alt): ?>
            <div id="<?= htmlspecialchars($slug) ?>" class="section section--alt" style="margin: var(--spacing-xl) calc(-50vw + 50%); padding: var(--spacing-xl) calc(50vw - 50%);">
                <div style="max-width: 900px; margin: 0 auto;">
                    <div class="team-grid" style="grid-template-columns: <?= $grid_cols ?>; align-items: start;">
                        <?= $grid_content ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div id="<?= htmlspecialchars($slug) ?>" style="max-width: 900px; margin: var(--spacing-xl) auto;">
                <div class="team-grid" style="grid-template-columns: <?= $grid_cols ?>; align-items: start;">
                    <?= $grid_content ?>
                </div>
            </div>
            <?php endif; ?>

            <?php endforeach; ?>

            <!-- Approche pédagogique -->
            <div class="content" style="max-width: 900px; margin: 0 auto;">
                <h2>Notre approche pédagogique</h2>
                <p>
                    L'enseignement au club Kannagara se caractérise par :
                </p>
                <ul>
                    <li><strong>Respect de la tradition</strong> : Un aïkido fidèle à l'enseignement des maîtres</li>
                    <li><strong>Adaptation</strong> : Des cours adaptés au niveau et aux capacités de chacun</li>
                    <li><strong>Bienveillance</strong> : Une atmosphère d'entraide et de respect mutuel</li>
                    <li><strong>Progression</strong> : Un suivi personnalisé pour chaque pratiquant</li>
                    <li><strong>Ouverture</strong> : Des stages et échanges avec d'autres clubs</li>
                </ul>

                <div class="text-center mt-4">
                    <a href="inscription.php" class="btn btn--primary">S'inscrire au club</a>
                    <a href="contact.php" class="btn btn--outline">Nous contacter</a>
                </div>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- JavaScript -->
    <script src="js/main.js"></script>
</body>
</html>
