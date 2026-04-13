<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Page non trouvée | Kannagara Aïkido</title>
  <meta name="robots" content="noindex">

  <!-- Styles -->
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <link rel="apple-touch-icon" href="/images/logo-kannagara.jpg">
</head>
<body>
  <?php $active = ''; include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

  <main>
    <!-- Page Header -->
    <section class="page-header">
      <div class="container">
        <h1 class="page-header__title">Page non trouvée</h1>
        <p class="page-header__breadcrumb">
          <a href="/index.php">Accueil</a> / Erreur 404
        </p>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="info-box">
          <h2>Cette page n'existe pas ou a été déplacée</h2>
          <p>La page que vous recherchez est introuvable. Elle a peut-être été supprimée, renommée, ou l'adresse que vous avez saisie est incorrecte.</p>
          <p>Voici quelques liens utiles pour retrouver votre chemin :</p>
          <div class="mt-3">
            <a href="/index.php" class="btn btn--primary">Retour à l'accueil</a>
            <a href="/agenda.php" class="btn btn--outline">Voir l'agenda</a>
            <a href="/contact.php" class="btn btn--outline">Nous contacter</a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
</body>
</html>
