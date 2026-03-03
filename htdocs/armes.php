<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Les Armes en Aïkido | Jo, Bokken et Tanto - Kannagara</title>
    <meta name="description" content="Découvrez les armes de l'aïkido : jo (bâton), bokken (sabre en bois) et tanto (couteau). Histoire, utilisation et importance dans la pratique.">
    <meta name="keywords" content="armes aïkido, jo, bokken, tanto, buki waza, sabre aïkido, bâton aïkido, aiki jo, aiki ken">
    <meta name="author" content="Kannagara Aïkido Club de Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.7678;2.0567">
    <meta name="ICBM" content="48.7678, 2.0567">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/armes.html">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://kannagara.fr/armes.html">
    <meta property="og:title" content="Les Armes en Aïkido - Jo, Bokken, Tanto">
    <meta property="og:description" content="Le travail avec les armes en aïkido : comprendre les origines des techniques à mains nues.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">
    <meta property="og:locale" content="fr_FR">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Les Armes en Aïkido - Jo, Bokken, Tanto">
    <meta name="twitter:description" content="Le travail avec les armes en aïkido : comprendre les origines des techniques à mains nues.">
    <meta name="twitter:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/logo-kannagara.png">

    <style>
        .arme-section {
            margin-bottom: var(--spacing-xxl);
        }

        .arme-card {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: var(--spacing-xl);
            align-items: start;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        @media (max-width: 768px) {
            .arme-card {
                grid-template-columns: 1fr;
            }
        }

        .arme-card__visual {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            padding: var(--spacing-xl);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 300px;
            color: white;
            text-align: center;
        }

        .arme-card__icon {
            font-size: 5rem;
            margin-bottom: var(--spacing-md);
        }

        .arme-card__kanji {
            font-size: 3rem;
            font-weight: 300;
            opacity: 0.8;
        }

        .arme-card__content {
            padding: var(--spacing-xl);
        }

        .arme-card__title {
            font-size: 2rem;
            color: var(--color-primary);
            margin-bottom: var(--spacing-md);
        }

        .arme-card__subtitle {
            font-size: 1.1rem;
            color: var(--color-accent);
            font-style: italic;
            margin-bottom: var(--spacing-lg);
        }

        .arme-card__description {
            line-height: 1.8;
            margin-bottom: var(--spacing-lg);
        }

        .arme-specs {
            background: var(--color-bg-alt);
            padding: var(--spacing-md);
            border-radius: 8px;
            margin-bottom: var(--spacing-lg);
        }

        .arme-specs__title {
            font-weight: 600;
            color: var(--color-secondary);
            margin-bottom: var(--spacing-sm);
        }

        .arme-specs__list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .arme-specs__list li {
            padding: var(--spacing-xs) 0;
            border-bottom: 1px solid var(--color-border);
        }

        .arme-specs__list li:last-child {
            border-bottom: none;
        }

        .arme-specs__list strong {
            color: var(--color-primary);
        }

        .techniques-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: var(--spacing-sm);
        }

        .techniques-list__item {
            background: var(--color-bg-alt);
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: 4px;
            font-size: 0.95rem;
        }

        .importance-section {
            background: var(--color-primary);
            color: white;
            padding: var(--spacing-xxl);
            border-radius: 8px;
            margin: var(--spacing-xxl) 0;
        }

        .importance-section h2 {
            color: var(--color-accent);
            margin-bottom: var(--spacing-lg);
        }

        .importance-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-lg);
        }

        .importance-item {
            text-align: center;
            padding: var(--spacing-md);
        }

        .importance-item__icon {
            font-size: 2.5rem;
            margin-bottom: var(--spacing-sm);
        }

        .importance-item__title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: var(--spacing-sm);
            color: var(--color-accent);
        }

        .importance-item__text {
            font-size: 0.95rem;
            opacity: 0.9;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <?php $active = 'armes'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Les Armes en Aïkido</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / <a href="aikido.php">Aïkido</a> / Armes
            </p>
        </div>
    </section>

    <!-- Introduction -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <p>
                    Le travail avec les armes (<strong>buki waza</strong>) fait partie intégrante de la pratique de l'aïkido.
                    Morihei Ueshiba, le fondateur, a développé ses techniques à partir de son expérience
                    avec différentes écoles d'armes traditionnelles. Comprendre le travail des armes
                    permet de mieux saisir l'origine et la logique des techniques à mains nues.
                </p>
                <p>
                    Les trois armes principales utilisées en aïkido sont le <strong>jo</strong> (bâton),
                    le <strong>bokken</strong> (sabre en bois) et le <strong>tanto</strong> (couteau en bois).
                </p>
            </div>
        </div>
    </section>

    <!-- Jo -->
    <section class="section section--alt" id="jo">
        <div class="container">
            <div class="arme-section">
                <div class="arme-card">
                    <div class="arme-card__visual">
                        <div class="arme-card__icon">|</div>
                        <div class="arme-card__kanji">杖</div>
                    </div>
                    <div class="arme-card__content">
                        <h2 class="arme-card__title">Le Jo</h2>
                        <p class="arme-card__subtitle">Le bâton - L'arme de la polyvalence</p>

                        <div class="arme-card__description">
                            <p>
                                Le <strong>jo</strong> est un bâton droit en bois, traditionnellement en chêne blanc japonais.
                                C'est une arme polyvalente qui peut être utilisée pour frapper, bloquer, balayer
                                et effectuer des techniques de contrôle.
                            </p>
                            <p>
                                Le travail du jo en aïkido (<strong>aiki-jo</strong>) développe particulièrement
                                la coordination des deux mains, le sens des distances et la fluidité des déplacements.
                                Les mouvements circulaires caractéristiques de l'aïkido se retrouvent naturellement
                                dans la manipulation du jo.
                            </p>
                        </div>

                        <div class="arme-specs">
                            <h4 class="arme-specs__title">Caractéristiques</h4>
                            <ul class="arme-specs__list">
                                <li><strong>Longueur :</strong> environ 128 cm (4 shaku 2 sun 1 bu)</li>
                                <li><strong>Diamètre :</strong> environ 2,4 cm</li>
                                <li><strong>Matériau :</strong> bois (chêne blanc, hêtre, frêne)</li>
                                <li><strong>Poids :</strong> variable selon le bois (400-700g)</li>
                            </ul>
                        </div>

                        <h4 style="margin-bottom: var(--spacing-sm); color: var(--color-secondary);">Techniques principales</h4>
                        <div class="techniques-list">
                            <span class="techniques-list__item">Tsuki (coup direct)</span>
                            <span class="techniques-list__item">Uchi (frappe)</span>
                            <span class="techniques-list__item">Harai (balayage)</span>
                            <span class="techniques-list__item">Suburi (exercices)</span>
                            <span class="techniques-list__item">31 jo kata</span>
                            <span class="techniques-list__item">Jo dori (désarmement)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bokken -->
    <section class="section" id="bokken">
        <div class="container">
            <div class="arme-section">
                <div class="arme-card">
                    <div class="arme-card__visual">
                        <div class="arme-card__icon">⚔</div>
                        <div class="arme-card__kanji">木剣</div>
                    </div>
                    <div class="arme-card__content">
                        <h2 class="arme-card__title">Le Bokken</h2>
                        <p class="arme-card__subtitle">Le sabre en bois - L'âme du samouraï</p>

                        <div class="arme-card__description">
                            <p>
                                Le <strong>bokken</strong> (ou bokuto) est une réplique en bois du katana japonais.
                                Il permet d'étudier les principes du sabre en toute sécurité tout en conservant
                                le poids et l'équilibre d'une vraie lame.
                            </p>
                            <p>
                                Le travail du sabre en aïkido (<strong>aiki-ken</strong>) est fondamental pour comprendre
                                les angles de coupe, la précision du geste et l'importance du timing.
                                De nombreuses techniques à mains nues de l'aïkido trouvent leur origine
                                dans les mouvements de sabre.
                            </p>
                        </div>

                        <div class="arme-specs">
                            <h4 class="arme-specs__title">Caractéristiques</h4>
                            <ul class="arme-specs__list">
                                <li><strong>Longueur totale :</strong> environ 102 cm</li>
                                <li><strong>Longueur de lame :</strong> environ 77 cm</li>
                                <li><strong>Matériau :</strong> bois (chêne rouge/blanc, hêtre)</li>
                                <li><strong>Poids :</strong> 500-700g selon le bois</li>
                            </ul>
                        </div>

                        <h4 style="margin-bottom: var(--spacing-sm); color: var(--color-secondary);">Techniques principales</h4>
                        <div class="techniques-list">
                            <span class="techniques-list__item">Shomen uchi (coupe verticale)</span>
                            <span class="techniques-list__item">Yokomen uchi (coupe latérale)</span>
                            <span class="techniques-list__item">Tsuki (estoc)</span>
                            <span class="techniques-list__item">Suburi (coupes répétées)</span>
                            <span class="techniques-list__item">Kumitachi (combat)</span>
                            <span class="techniques-list__item">Tachi dori (désarmement)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tanto -->
    <section class="section section--alt" id="tanto">
        <div class="container">
            <div class="arme-section">
                <div class="arme-card">
                    <div class="arme-card__visual">
                        <div class="arme-card__icon">/</div>
                        <div class="arme-card__kanji">短刀</div>
                    </div>
                    <div class="arme-card__content">
                        <h2 class="arme-card__title">Le Tanto</h2>
                        <p class="arme-card__subtitle">Le couteau - La menace rapprochée</p>

                        <div class="arme-card__description">
                            <p>
                                Le <strong>tanto</strong> est une dague ou couteau court traditionnel japonais.
                                En aïkido, on utilise une version en bois ou en mousse pour l'entraînement.
                                C'est l'arme qui simule les attaques à courte distance.
                            </p>
                            <p>
                                Le travail contre tanto (<strong>tanto dori</strong>) est essentiel car il développe
                                la vigilance, la précision des entrées et la capacité à contrôler une menace rapprochée.
                                Les techniques de défense contre couteau sont parmi les plus réalistes de l'aïkido
                                en termes d'application martiale.
                            </p>
                        </div>

                        <div class="arme-specs">
                            <h4 class="arme-specs__title">Caractéristiques</h4>
                            <ul class="arme-specs__list">
                                <li><strong>Longueur totale :</strong> environ 30 cm</li>
                                <li><strong>Longueur de lame :</strong> environ 20-25 cm</li>
                                <li><strong>Matériau :</strong> bois, mousse ou caoutchouc</li>
                                <li><strong>Usage :</strong> simulation d'attaque au couteau</li>
                            </ul>
                        </div>

                        <h4 style="margin-bottom: var(--spacing-sm); color: var(--color-secondary);">Attaques principales</h4>
                        <div class="techniques-list">
                            <span class="techniques-list__item">Tsuki (estoc direct)</span>
                            <span class="techniques-list__item">Shomen uchi (coupe verticale)</span>
                            <span class="techniques-list__item">Yokomen uchi (coupe latérale)</span>
                            <span class="techniques-list__item">Tanto dori (défenses)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Importance du travail aux armes -->
    <section class="section">
        <div class="container">
            <div class="importance-section">
                <h2>Pourquoi travailler avec les armes ?</h2>
                <div class="importance-grid">
                    <div class="importance-item">
                        <div class="importance-item__icon">📐</div>
                        <h3 class="importance-item__title">Comprendre les distances</h3>
                        <p class="importance-item__text">
                            Les armes obligent à respecter une distance de sécurité (ma-ai)
                            et développent la conscience spatiale.
                        </p>
                    </div>
                    <div class="importance-item">
                        <div class="importance-item__icon">🎯</div>
                        <h3 class="importance-item__title">Précision du geste</h3>
                        <p class="importance-item__text">
                            L'arme prolonge le corps et révèle les imperfections techniques.
                            Le travail devient plus exigeant et précis.
                        </p>
                    </div>
                    <div class="importance-item">
                        <div class="importance-item__icon">⏱️</div>
                        <h3 class="importance-item__title">Sens du timing</h3>
                        <p class="importance-item__text">
                            Face à une arme, le timing devient crucial.
                            On apprend à lire l'intention et à agir au bon moment.
                        </p>
                    </div>
                    <div class="importance-item">
                        <div class="importance-item__icon">🔗</div>
                        <h3 class="importance-item__title">Origines des techniques</h3>
                        <p class="importance-item__text">
                            De nombreuses techniques à mains nues découlent directement
                            des mouvements de sabre et de bâton.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Conseils pratiques -->
    <section class="section section--alt">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Conseils pour les débutants</h2>
            </div>

            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <div class="info-box">
                    <h4 class="info-box__title">Acquisition des armes</h4>
                    <ul>
                        <li>Les premières armes peuvent être prêtées par le club</li>
                        <li>Attendez les conseils du professeur avant d'acheter</li>
                        <li>Privilégiez la qualité à la quantité</li>
                        <li>Les armes d'entraînement se trouvent dans les magasins spécialisés</li>
                    </ul>
                </div>

                <div class="info-box mt-3">
                    <h4 class="info-box__title">Entretien des armes</h4>
                    <ul>
                        <li>Vérifiez régulièrement l'état du bois (fissures, échardes)</li>
                        <li>Huilez légèrement le bois une à deux fois par an</li>
                        <li>Stockez dans un endroit sec, à l'abri des variations de température</li>
                        <li>Ne laissez jamais vos armes au soleil direct</li>
                    </ul>
                </div>

                <div class="info-box mt-3">
                    <h4 class="info-box__title">Sécurité</h4>
                    <ul>
                        <li>Respectez toujours la distance avec votre partenaire</li>
                        <li>Ne manipulez jamais une arme sans autorisation</li>
                        <li>Portez vos armes dans un étui ou sac de transport</li>
                        <li>Signalez immédiatement tout dommage sur une arme</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section">
        <div class="container">
            <div class="info-box" style="max-width: 700px; margin: 0 auto; text-align: center;">
                <h3 class="info-box__title">Envie de découvrir le travail aux armes ?</h3>
                <p>
                    Le travail aux armes fait partie intégrante de nos cours.
                    Venez essayer lors d'un cours d'essai gratuit !
                </p>
                <div class="mt-3">
                    <a href="inscription.php" class="btn btn--primary">S'inscrire</a>
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
