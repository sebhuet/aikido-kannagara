    <!-- Header -->
    <header class="header">
        <div class="container header__container">
            <a href="index.php" class="header__logo">
                <img src="images/logo-kannagara.png" alt="Kannagara Aïkido Club de Guyancourt" class="header__logo-img">
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
                        'inscription' => 'Inscription',
                        'contact' => 'Contact',
                    ];
                    foreach ($pages as $slug => $label):
                        $isActive = (isset($active) && $active === $slug);
                        $activeClass = $isActive ? ' nav__link--active' : '';
                    ?>
                    <li class="nav__item"><a href="<?= $slug ?>.php" class="nav__link<?= $activeClass ?>"><?= $label ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
        <div class="nav-overlay"></div>
    </header>
