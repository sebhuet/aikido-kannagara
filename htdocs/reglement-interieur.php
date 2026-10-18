<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Règlement intérieur | Aïkido Kannagara Guyancourt</title>
    <meta name="description" content="Règlement intérieur du club Aïkido Kannagara Guyancourt. Règles de conduite, tenue, hygiène et étiquette sur le tatami.">
    <meta name="author" content="Aïkido Kannagara Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="https://kannagara.fr/reglement-interieur.php">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/reglement-interieur.php">
    <meta property="og:title" content="Règlement intérieur | Aïkido Kannagara Guyancourt">
    <meta property="og:description" content="Règlement intérieur du club Aïkido Kannagara Guyancourt. Règles de conduite, tenue, hygiène et étiquette sur le tatami.">
    <meta property="og:image" content="https://kannagara.fr/images/partage/kannagara.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Règlement intérieur | Aïkido Kannagara Guyancourt">
    <meta name="twitter:description" content="Règlement intérieur du club Aïkido Kannagara Guyancourt. Règles de conduite, tenue, hygiène et étiquette sur le tatami.">
    <meta name="twitter:image" content="https://kannagara.fr/images/partage/kannagara.jpg">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css?v=<?= substr(md5_file(__DIR__ . '/css/style.css'), 0, 8) ?>">
    <link rel="stylesheet" href="css/responsive.css?v=<?= substr(md5_file(__DIR__ . '/css/responsive.css'), 0, 8) ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

</head>
<body>
    <?php $active = 'reglement-interieur'; include 'includes/header.php'; ?>



    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Règlement intérieur</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / <a href="mentions-legales.php">Mentions légales</a> / Règlement intérieur
            </p>
        </div>
    </section>

    <!-- Règlement intérieur révisé -->
    <section class="section">
        <div class="container">
            <object
                data="docs/Kannagara%20_%20R%C3%A8glement%20int%C3%A9rieur%20_%20Rev.%202025.pdf"
                type="application/pdf"
                aria-label="Règlement intérieur révisé de l'association Kannagara"
                style="display: block; width: 100%; height: 80vh; min-height: 600px; max-width: 900px; margin: 0 auto;"
            >
                <p class="text-center">
                    Votre navigateur ne peut pas afficher ce PDF.
                    <a href="docs/Kannagara%20_%20R%C3%A8glement%20int%C3%A9rieur%20_%20Rev.%202025.pdf">Télécharger le règlement intérieur révisé en 2025</a>.
                </p>
            </object>

            <div class="text-center mt-4" style="max-width: 900px; margin: var(--spacing-xl) auto 0;">
                <a href="docs/Kannagara%20_%20R%C3%A8glement%20int%C3%A9rieur%20_%20Rev.%202025.pdf" class="btn btn--primary" download>Télécharger le règlement (PDF)</a>
                <a href="statuts.php" class="btn btn--primary">Statuts de l'association</a>
                <a href="inscription.php" class="btn btn--outline">S'inscrire au club</a>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/main.js?v=<?= substr(md5_file(__DIR__ . '/js/main.js'), 0, 8) ?>" defer></script>
</body>
</html>
