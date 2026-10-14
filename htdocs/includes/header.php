<?php require_once __DIR__ . '/data.php'; ?>
    <!-- Header -->
    <header class="header">
        <div class="container header__container">
            <a href="/" class="header__logo">
                <img src="/images/logo-kannagara.jpg" alt="Aïkido Kannagara Guyancourt" class="header__logo-img">
            </a>

            <nav class="nav">
                <button class="nav__toggle" aria-label="Menu">
                    <span class="nav__toggle-bar"></span>
                    <span class="nav__toggle-bar"></span>
                    <span class="nav__toggle-bar"></span>
                </button>

                <ul class="nav__list">
                    <?php
                    $pages = [
                        'index' => 'Accueil',
                        'aikido' => 'Aïkido',
                        'club' => 'Club',
                        'professeurs' => 'Professeurs',
                        'agenda' => 'Agenda',
                        'actualites' => 'Actualités',
                        'galerie' => 'Galerie',
                        'videotheque' => 'Vidéos',
                        'blog' => 'Blog',
                        'inscription' => 'Inscription',
                        'contact' => 'Contact',
                    ];
                    // Liens absolus : l'en-tête sert aussi aux pages des sous-dossiers
                    // (videotheque/, 404). La vidéothèque est un dossier, pas une page .php.
                    $liens = ['index' => '/', 'videotheque' => '/videotheque/'];
                    foreach ($pages as $slug => $label):
                        $isActive = (isset($active) && $active === $slug);
                        $activeClass = $isActive ? ' nav__link--active' : '';
                        $href = $liens[$slug] ?? "/$slug.php";
                    ?>
                    <li class="nav__item"><a href="<?= $href ?>" class="nav__link<?= $activeClass ?>"><?= $label ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
        <div class="nav-overlay"></div>
    </header>

    <?php include __DIR__ . '/breadcrumb.php'; ?>

    <main id="main">

