<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Mentions légales | Kannagara Aïkido</title>
    <meta name="description" content="Mentions légales du site Kannagara Aïkido Club de Guyancourt.">
    <meta name="robots" content="noindex, follow">
    <link rel="canonical" href="https://kannagara.fr/mentions-legales.html">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/mentions-legales.html">
    <meta property="og:title" content="Mentions légales | Kannagara Aïkido">
    <meta property="og:description" content="Mentions légales du site Kannagara Aïkido Club de Guyancourt.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
    <?php $active = 'mentions-legales'; include 'includes/header.php'; ?>



    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Mentions légales</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Mentions légales
            </p>
        </div>
    </section>

    <!-- Mentions légales -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 900px; margin: 0 auto;">

                <h2>Mentions légales</h2>

                <h3>Éditeur du site</h3>
                <p>
                    <strong>Kannagara Aïkido Club de Guyancourt</strong><br>
                    Association loi 1901<br>
                    Siège social : 9 impasse Jean Bouin, 78390 Bois-d'Arcy<br>
                    Email : <a href="mailto:aikido.kannagara.guyancourt@gmail.com">aikido.kannagara.guyancourt@gmail.com</a><br>
                    Téléphone : 06 76 48 16 01
                </p>

                <h3>Directeur de la publication</h3>
                <p>
                    Fanny Jacquemier, Présidente de l'association
                </p>

                <h3>Hébergement</h3>
                <p>
                    <strong>Gandi SAS</strong><br>
                    63-65 Boulevard Masséna, 75013 Paris<br>
                    <a href="https://www.gandi.net" target="_blank" rel="noopener">www.gandi.net</a>
                </p>

                <h3>Propriété intellectuelle</h3>
                <p>
                    L'ensemble du contenu de ce site (textes, images, vidéos, logos) est la propriété
                    de l'association Kannagara Aïkido Club de Guyancourt, sauf mention contraire.
                    Toute reproduction, même partielle, est soumise à autorisation préalable.
                </p>

                <h3>Protection des données personnelles</h3>
                <p>
                    Conformément au Règlement Général sur la Protection des Données (RGPD) et à la
                    loi Informatique et Libertés, vous disposez d'un droit d'accès, de rectification
                    et de suppression des données vous concernant.
                </p>
                <p>
                    Les données collectées via le formulaire de contact sont uniquement utilisées
                    pour répondre à vos demandes et ne sont pas transmises à des tiers.
                </p>
                <p>
                    Pour exercer vos droits, contactez-nous à : <a href="mailto:aikido.kannagara.guyancourt@gmail.com">aikido.kannagara.guyancourt@gmail.com</a>
                </p>

                <h3>Cookies</h3>
                <p>
                    Ce site n'utilise pas de cookies de tracking ou de cookies publicitaires.
                    Seuls des cookies techniques essentiels au fonctionnement du site peuvent être utilisés.
                </p>

                <h3>Crédits</h3>
                <p>
                    Conception et réalisation : Kannagara Aïkido Club de Guyancourt<br>
                    Photographies : © Kannagara Aïkido Club de Guyancourt
                </p>

            </div>
        </div>
    </section>

    <!-- Documents de l'association -->
    <section class="section section--alt">
        <div class="container">
            <div class="content" style="max-width: 900px; margin: 0 auto;">
                <h2>Documents de l'association</h2>
                <p>Consultez les documents officiels de l'association :</p>

                <div class="cards-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--spacing-lg); margin-top: var(--spacing-lg);">
                    <a href="statuts.php" class="card" style="text-decoration: none; color: inherit;">
                        <div class="card__content">
                            <h3 class="card__title">Statuts de l'association</h3>
                            <p class="card__text">Les statuts définissent l'objet, la composition et le fonctionnement de l'association loi 1901.</p>
                            <span class="btn btn--outline" style="margin-top: var(--spacing-sm);">Consulter les statuts</span>
                        </div>
                    </a>

                    <a href="reglement-interieur.php" class="card" style="text-decoration: none; color: inherit;">
                        <div class="card__content">
                            <h3 class="card__title">Règlement intérieur</h3>
                            <p class="card__text">Le règlement intérieur précise les règles de conduite, tenue, hygiène et étiquette au sein du club.</p>
                            <span class="btn btn--outline" style="margin-top: var(--spacing-sm);">Consulter le règlement</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/main.js"></script>
</body>
</html>
