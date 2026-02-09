<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Règlement intérieur | Kannagara Aïkido</title>
    <meta name="description" content="Règlement intérieur du club Kannagara Aïkido de Guyancourt. Règles de conduite, tenue, hygiène et étiquette sur le tatami.">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="https://kannagara.fr/reglement-interieur.html">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/reglement-interieur.html">
    <meta property="og:title" content="Règlement intérieur | Kannagara Aïkido">
    <meta property="og:description" content="Règlement intérieur du club Kannagara Aïkido de Guyancourt. Règles de conduite, tenue, hygiène et étiquette sur le tatami.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- Marked.js for Markdown parsing -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
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

    <!-- Contenu du règlement -->
    <section class="section">
        <div class="container">
            <div class="content" id="markdown-content" style="max-width: 900px; margin: 0 auto;">
                <p>Chargement...</p>
            </div>

            <div class="text-center mt-4" style="max-width: 900px; margin: var(--spacing-xl) auto 0;">
                <a href="statuts.php" class="btn btn--primary">Statuts de l'association</a>
                <a href="inscription.php" class="btn btn--outline">S'inscrire au club</a>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/main.js"></script>
    <script>
        // Charger et afficher le contenu markdown
        fetch('reglement-interieur.md')
            .then(response => response.text())
            .then(markdown => {
                document.getElementById('markdown-content').innerHTML = marked.parse(markdown);
            })
            .catch(error => {
                document.getElementById('markdown-content').innerHTML = '<p>Erreur lors du chargement du contenu.</p>';
                console.error('Erreur:', error);
            });
    </script>
</body>
</html>
