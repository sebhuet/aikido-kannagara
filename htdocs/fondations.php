<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Les Fondations de l'Aïkido selon Maître Tamura | Kannagara Aïkido</title>
    <meta name="description" content="Les 10 fondations de l'aïkido selon Maître Nobuyoshi Tamura : shisei, kokyu, kamae, ma-ai, irimi, tenkan, ura-omote, tai sabaki, atemi, kokyu ryoku.">
    <meta name="keywords" content="fondations aïkido, Tamura, shisei, kokyu, kamae, ma-ai, irimi, tenkan, tai sabaki, FFAB, kihon">
    <meta name="author" content="Kannagara Aïkido Club de Guyancourt">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/fondations.html">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://kannagara.fr/fondations.html">
    <meta property="og:title" content="Les Fondations de l'Aïkido selon Maître Tamura">
    <meta property="og:description" content="Les 10 fondations essentielles de l'aïkido transmises par Maître Tamura, pilier de l'enseignement FFAB.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">
    <meta property="og:locale" content="fr_FR">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/logo-kannagara.png">

    <style>
        .fondation-intro {
            max-width: 900px;
            margin: 0 auto var(--spacing-xxl);
            text-align: center;
        }

        .fondation-intro__quote {
            font-style: italic;
            font-size: 1.2rem;
            color: var(--color-secondary);
            border-left: 4px solid var(--color-accent);
            padding-left: var(--spacing-lg);
            margin: var(--spacing-xl) auto;
            max-width: 700px;
            text-align: left;
        }

        .fondations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: var(--spacing-xl);
            max-width: 1200px;
            margin: 0 auto;
        }

        .fondation-card {
            background: white;
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .fondation-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .fondation-card__header {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            color: white;
            padding: var(--spacing-lg);
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
        }

        .fondation-card__number {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .fondation-card__title {
            margin: 0;
            font-size: 1.8rem;
            color: white;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .fondation-card__kanji {
            font-size: 2rem;
            opacity: 0.8;
            margin-left: auto;
        }

        .fondation-card__body {
            padding: var(--spacing-lg);
        }

        .fondation-card__definition {
            font-weight: 600;
            color: var(--color-accent);
            margin-bottom: var(--spacing-sm);
            font-size: 1.1rem;
        }

        .fondation-card__description {
            color: var(--color-text);
            line-height: 1.7;
        }

        .fondation-card__points {
            margin-top: var(--spacing-md);
            padding-left: var(--spacing-md);
            list-style: none;
        }

        .fondation-card__points li {
            margin-bottom: var(--spacing-xs);
            position: relative;
            padding-left: var(--spacing-md);
        }

        .fondation-card__points li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            width: 6px;
            height: 6px;
            background: var(--color-accent);
            border-radius: 50%;
        }

        .tamura-bio {
            background: var(--color-bg-alt);
            border-radius: 12px;
            padding: var(--spacing-xl);
            max-width: 900px;
            margin: var(--spacing-xxl) auto 0;
        }

        .tamura-bio__header {
            display: flex;
            align-items: center;
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }

        .tamura-bio__avatar {
            width: 100px;
            height: 100px;
            background: var(--color-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
        }

        .tamura-bio__name {
            font-size: 1.5rem;
            color: var(--color-primary);
            margin: 0;
        }

        .tamura-bio__dates {
            color: var(--color-text-light);
            margin: var(--spacing-xs) 0 0;
        }

        .fondation-summary {
            background: white;
            border: 2px solid var(--color-accent);
            border-radius: 12px;
            padding: var(--spacing-xl);
            max-width: 800px;
            margin: var(--spacing-xxl) auto 0;
        }

        .fondation-summary__title {
            color: var(--color-primary);
            text-align: center;
            margin-bottom: var(--spacing-lg);
        }

        .fondation-summary__list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-sm);
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .fondation-summary__item {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            padding: var(--spacing-sm);
            background: var(--color-bg-alt);
            border-radius: 6px;
        }

        .fondation-summary__item span:first-child {
            font-weight: bold;
            color: var(--color-secondary);
            min-width: 25px;
        }

        @media (max-width: 768px) {
            .fondations-grid {
                grid-template-columns: 1fr;
            }

            .tamura-bio__header {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <?php $active = 'fondations'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Les Fondations de l'Aïkido</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / <a href="aikido.php">Aïkido</a> / Fondations
            </p>
        </div>
    </section>

    <!-- Introduction -->
    <section class="section">
        <div class="container">
            <div class="fondation-intro">
                <h2>L'enseignement de Maître Tamura</h2>
                <p>
                    <strong>Maître Nobuyoshi Tamura</strong>, 8e dan et élève direct du fondateur Morihei Ueshiba,
                    a formalisé un ensemble de <strong>dix fondations</strong> qui constituent le socle de la pratique
                    de l'aïkido. Ces principes, transmis au sein de la FFAB, ne sont pas de simples exercices
                    d'échauffement mais représentent l'essence même de la discipline.
                </p>

                <blockquote class="fondation-intro__quote">
                    "Plus qu'un simple échauffement, la préparation est déjà la pratique elle-même.
                    Enseigner et transmettre les bases, c'est approfondir sans relâche les fondations
                    dans la pratique, et non se concentrer uniquement sur l'étude des techniques ou des katas."
                    <footer style="margin-top: var(--spacing-sm); font-style: normal; color: var(--color-text-light);">
                        - Extrait du Manuel du Pratiquant FFAB
                    </footer>
                </blockquote>

                <p>
                    Ces fondations sont les éléments structurants avec lesquels il est possible de développer
                    le <strong>sens de la globalité</strong>. Il ne s'agit pas simplement d'accumuler des
                    connaissances techniques mais d'approfondir inlassablement ces notions.
                </p>
            </div>

            <!-- Résumé des 10 fondations -->
            <div class="fondation-summary">
                <h3 class="fondation-summary__title">Les 10 Fondations</h3>
                <ul class="fondation-summary__list">
                    <li class="fondation-summary__item"><span>1.</span> Shisei (Posture)</li>
                    <li class="fondation-summary__item"><span>2.</span> Kokyu (Respiration)</li>
                    <li class="fondation-summary__item"><span>3.</span> Kamae (Garde)</li>
                    <li class="fondation-summary__item"><span>4.</span> Ma-ai (Distance)</li>
                    <li class="fondation-summary__item"><span>5.</span> Irimi (Entrée)</li>
                    <li class="fondation-summary__item"><span>6.</span> Tenkan (Rotation)</li>
                    <li class="fondation-summary__item"><span>7.</span> Ura / Omote (Aspects)</li>
                    <li class="fondation-summary__item"><span>8.</span> Tai sabaki (Déplacement)</li>
                    <li class="fondation-summary__item"><span>9.</span> Atemi (Coup)</li>
                    <li class="fondation-summary__item"><span>10.</span> Kokyu ryoku (Puissance)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Les 10 Fondations détaillées -->
    <section class="section section--alt">
        <div class="container">
            <div class="fondations-grid">

                <!-- 1. Shisei -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">1</div>
                        <h3 class="fondation-card__title">Shisei</h3>
                        <span class="fondation-card__kanji">姿勢</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">La Posture</p>
                        <p class="fondation-card__description">
                            Shisei traduit la position, l'attitude, la posture. Ce terme contient deux significations :
                            <strong>Sugata</strong> (forme, figure, taille) et <strong>Ikioi</strong> (force, vigueur, vivacité).
                        </p>
                        <ul class="fondation-card__points">
                            <li>La posture est à la fois physique et mentale</li>
                            <li>Un maintien qui met le pratiquant en éveil, disponible</li>
                            <li>Tete, épaules, hanches et pieds parfaitement alignés</li>
                            <li>Non seulement une attitude externe mais aussi une force intérieure visible de l'extérieur</li>
                        </ul>
                    </div>
                </div>

                <!-- 2. Kokyu -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">2</div>
                        <h3 class="fondation-card__title">Kokyu</h3>
                        <span class="fondation-card__kanji">呼吸</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">La Respiration</p>
                        <p class="fondation-card__description">
                            Au-dela de la simple oxygénation, la respiration contrôlée offre des bénéfices
                            dépassant la fonction vitale, particulièrement lors d'efforts physiques intenses.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Un bon kokyu est lent, profond, long et naturel</li>
                            <li>C'est une respiration abdominale</li>
                            <li>Au début, accentuer l'expiration puis laisser l'inspiration se faire naturellement</li>
                            <li>Coordination du souffle avec le mouvement</li>
                        </ul>
                    </div>
                </div>

                <!-- 3. Kamae -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">3</div>
                        <h3 class="fondation-card__title">Kamae</h3>
                        <span class="fondation-card__kanji">構え</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">La Garde</p>
                        <p class="fondation-card__description">
                            "Se tenir prêt, se mettre en garde." Kamae contient à la fois les forces du ki
                            et le pouvoir de percevoir tous les détails. En aïkido, on utilise <strong>hanmi no kamae</strong>
                            (garde de profil).
                        </p>
                        <ul class="fondation-card__points">
                            <li>Position qui prépare aux événements futurs</li>
                            <li>Peut prévenir l'affrontement ou conditionner les premiers échanges</li>
                            <li><strong>Migi hanmi</strong> : garde droite (pied droit avancé)</li>
                            <li><strong>Hidari hanmi</strong> : garde gauche (pied gauche avancé)</li>
                        </ul>
                    </div>
                </div>

                <!-- 4. Ma-ai -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">4</div>
                        <h3 class="fondation-card__title">Ma-ai</h3>
                        <span class="fondation-card__kanji">間合い</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">La Distance</p>
                        <p class="fondation-card__description">
                            L'espace "convenable" qui sépare deux aïkidokas sans qu'il soit possible d'en donner
                            une valeur précise. Certains le ressentent instinctivement, d'autres nécessitent un apprentissage.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Notion à la fois spatiale et temporelle</li>
                            <li>Intervalle juste entre les partenaires</li>
                            <li>Varie selon la situation et l'intention</li>
                            <li>Nécessite une perception fine et une adaptation constante</li>
                        </ul>
                    </div>
                </div>

                <!-- 5. Irimi -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">5</div>
                        <h3 class="fondation-card__title">Irimi</h3>
                        <span class="fondation-card__kanji">入身</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">L'Entrée / La Pénétration</p>
                        <p class="fondation-card__description">
                            "Entrer, pénétrer, transpercer." Quand deux forces se déplacent dans des directions opposées,
                            irimi est l'utilisation de cette force résultante en relation avec sa propre position
                            au moment du croisement.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Avancer en réduisant la distance tout en contrôlant l'adversaire</li>
                            <li><strong>Irimi issoku</strong> : entrer d'un pas sur le côté du partenaire</li>
                            <li>Retourner la force de l'attaque</li>
                            <li>Rendre l'adversaire moins menaçant</li>
                        </ul>
                    </div>
                </div>

                <!-- 6. Tenkan -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">6</div>
                        <h3 class="fondation-card__title">Tenkan</h3>
                        <span class="fondation-card__kanji">転換</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">La Rotation / Le Changement de direction</p>
                        <p class="fondation-card__description">
                            Transformer un mouvement linéaire en mouvement circulaire par changement de direction
                            autour d'un pivot. Le pied avant sert de point de rotation.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Pivot à 180 degrés sur le pied avant</li>
                            <li>Rotation du corps tout en gardant le contact</li>
                            <li>Permet de rediriger l'énergie de l'attaque</li>
                            <li><strong>Irimi-tenkan</strong> : combinaison entrée + rotation</li>
                        </ul>
                    </div>
                </div>

                <!-- 7. Ura / Omote -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">7</div>
                        <h3 class="fondation-card__title">Ura / Omote</h3>
                        <span class="fondation-card__kanji">裏 / 表</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">Les Aspects Caché / Visible</p>
                        <p class="fondation-card__description">
                            Une technique en aïkido a deux aspects : <strong>ura waza</strong> et <strong>omote waza</strong>.
                            Ces deux facettes coexistent dans la plupart des techniques.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Ura</strong> : l'envers, le verso, l'aspect caché des choses</li>
                            <li><strong>Omote</strong> : la surface, l'extérieur, l'aspect apparent</li>
                            <li>Omote : entrée vers l'avant du partenaire</li>
                            <li>Ura : entrée vers l'arrière du partenaire</li>
                        </ul>
                    </div>
                </div>

                <!-- 8. Tai sabaki -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">8</div>
                        <h3 class="fondation-card__title">Tai sabaki</h3>
                        <span class="fondation-card__kanji">体捌き</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">Le Déplacement du corps</p>
                        <p class="fondation-card__description">
                            "L'essence de l'aïkido" : se déplacer pour éviter l'attaque, se positionner favorablement
                            et déstabiliser l'adversaire simultanément.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Tsugi ashi</strong> : pas glissé (pied arriere rejoint l'avant)</li>
                            <li><strong>Ayumi ashi</strong> : marche normale alternée</li>
                            <li><strong>Kaiten</strong> : rotation sur place</li>
                            <li>Esquive et positionnement en un seul mouvement</li>
                        </ul>
                    </div>
                </div>

                <!-- 9. Atemi -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">9</div>
                        <h3 class="fondation-card__title">Atemi</h3>
                        <span class="fondation-card__kanji">当身</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">Le Coup</p>
                        <p class="fondation-card__description">
                            Les coups existent dans l'aïkido pour maintenir la distance ou contrôler l'adversaire
                            durant les techniques. Ils sont généralement simulés en pratique.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Outil de déstabilisation et de contrôle</li>
                            <li>Permet de créer une ouverture</li>
                            <li>Maintient la distance de sécurité</li>
                            <li>Élément essentiel souvent sous-estimé</li>
                        </ul>
                    </div>
                </div>

                <!-- 10. Kokyu ryoku -->
                <div class="fondation-card">
                    <div class="fondation-card__header">
                        <div class="fondation-card__number">10</div>
                        <h3 class="fondation-card__title">Kokyu ryoku</h3>
                        <span class="fondation-card__kanji">呼吸力</span>
                    </div>
                    <div class="fondation-card__body">
                        <p class="fondation-card__definition">La Puissance respiratoire</p>
                        <p class="fondation-card__description">
                            Dépasse la respiration seule en procurant puissance, précision et contrôle total
                            de l'adversaire. C'est la coordination de la puissance à travers le souffle.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Puissance qui vient du centre (hara)</li>
                            <li>Coordination corps-souffle-esprit</li>
                            <li>Contrôle sans force musculaire excessive</li>
                            <li>Objectif ultime de la pratique</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Les Ukemi -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 900px; margin: 0 auto;">
                <h2 style="text-align: center; margin-bottom: var(--spacing-xl);">Les Chutes (Ukemi)</h2>
                <p style="text-align: center; margin-bottom: var(--spacing-xl);">
                    Bien que ne faisant pas partie des 10 fondations officielles, les <strong>ukemi</strong>
                    (littéralement "corps qui reçoit") sont un élément fondamental de la pratique,
                    aussi important que les techniques elles-mêmes.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mae ukemi</h3>
                            <p class="card__text">
                                <strong>Chute avant roulée</strong> : réception souple en roulant vers l'avant.
                                La plus courante, elle permet de se relever rapidement en position de garde.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ushiro ukemi</h3>
                            <p class="card__text">
                                <strong>Chute arrière roulée</strong> : réception en roulant vers l'arrière.
                                Nécessite de bien rentrer le menton et d'arrondir le dos.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Yoko ukemi</h3>
                            <p class="card__text">
                                <strong>Chute latérale</strong> : réception sur le côté avec frappe du bras
                                pour amortir. Utilisée pour certaines projections spécifiques.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Tobu ukemi</h3>
                            <p class="card__text">
                                <strong>Chute plaquée</strong> : projection aérienne avec réception dynamique.
                                Requiert une bonne maîtrise des ukemi de base.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Biographie Tamura -->
    <section class="section section--alt">
        <div class="container">
            <div class="tamura-bio">
                <div class="tamura-bio__header">
                    <div class="tamura-bio__avatar">T</div>
                    <div>
                        <h3 class="tamura-bio__name">Maître Nobuyoshi Tamura</h3>
                        <p class="tamura-bio__dates">2 mars 1933 - 9 juillet 2010</p>
                    </div>
                </div>
                <p>
                    Né à Osaka en 1933, <strong>Nobuyoshi Tamura</strong> débute la pratique des arts martiaux très jeune.
                    Il devient rapidement l'un des élèves les plus proches de <strong>O Sensei Morihei Ueshiba</strong>,
                    fondateur de l'aïkido, qu'il accompagne pendant de nombreuses années.
                </p>
                <p>
                    En 1964, il s'installe en France où il contribue énormément au développement de l'aïkido.
                    Directeur technique de la <strong>FFAB</strong> (Fédération Française d'Aïkido et de Budo),
                    il forme des générations de pratiquants et d'enseignants, laissant un héritage technique
                    et philosophique considérable.
                </p>
                <p>
                    Son ouvrage "<strong>Aïkido</strong>" reste une référence pour tous les pratiquants.
                    Les fondations qu'il a formalisées sont aujourd'hui au cœur de l'enseignement FFAB
                    et permettent de transmettre l'essence de la discipline du fondateur.
                </p>
                <p>
                    Maître Tamura s'est éteint le 9 juillet 2010 à Saint-Maximin-la-Sainte-Baume, laissant derrière lui
                    un héritage immense pour l'aïkido mondial.
                </p>
            </div>

            <div class="info-box mt-4" style="max-width: 700px; margin: var(--spacing-xl) auto 0; text-align: center;">
                <h4 class="info-box__title">Citation</h4>
                <blockquote style="font-style: italic; margin: var(--spacing-md) 0;">
                    "L'aïkido n'est pas une technique de combat mais un moyen de s'améliorer soi-même
                    en harmonie avec les autres et avec la nature."
                </blockquote>
                <p style="color: var(--color-text-light);">- Maître Nobuyoshi Tamura</p>
            </div>
        </div>
    </section>

    <!-- Liens -->
    <section class="section">
        <div class="container">
            <div class="text-center">
                <h2 style="margin-bottom: var(--spacing-xl);">Pour aller plus loin</h2>
                <div class="btn-group">
                    <a href="lexique.php" class="btn btn--primary">Lexique japonais</a>
                    <a href="aikido.php" class="btn btn--outline">Découvrir l'aïkido</a>
                    <a href="grades.php" class="btn btn--outline">Les grades</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>





    <!-- JavaScript -->
    <script src="js/main.js"></script>
</body>
</html>
