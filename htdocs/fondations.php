<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Les Fondations de l'Aikido selon Maitre Tamura | Kannagara Aikido</title>
    <meta name="description" content="Les 10 fondations de l'aikido selon Maitre Nobuyoshi Tamura : shisei, kokyu, kamae, ma-ai, irimi, tenkan, ura-omote, tai sabaki, atemi, kokyu ryoku.">
    <meta name="keywords" content="fondations aikido, Tamura, shisei, kokyu, kamae, ma-ai, irimi, tenkan, tai sabaki, FFAB, kihon">
    <meta name="author" content="Kannagara Aikido Club de Guyancourt">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/fondations.html">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://kannagara.fr/fondations.html">
    <meta property="og:title" content="Les Fondations de l'Aikido selon Maitre Tamura">
    <meta property="og:description" content="Les 10 fondations essentielles de l'aikido transmises par Maitre Tamura, pilier de l'enseignement FFAB.">
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
            <h1 class="page-header__title">Les Fondations de l'Aikido</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / <a href="aikido.php">Aikido</a> / Fondations
            </p>
        </div>
    </section>

    <!-- Introduction -->
    <section class="section">
        <div class="container">
            <div class="fondation-intro">
                <h2>L'enseignement de Maitre Tamura</h2>
                <p>
                    <strong>Maitre Nobuyoshi Tamura</strong>, 8e dan et eleve direct du fondateur Morihei Ueshiba,
                    a formalise un ensemble de <strong>dix fondations</strong> qui constituent le socle de la pratique
                    de l'aikido. Ces principes, transmis au sein de la FFAB, ne sont pas de simples exercices
                    d'echauffement mais representent l'essence meme de la discipline.
                </p>

                <blockquote class="fondation-intro__quote">
                    "Plus qu'un simple echauffement, la preparation est deja la pratique elle-meme.
                    Enseigner et transmettre les bases, c'est approfondir sans relache les fondations
                    dans la pratique, et non se concentrer uniquement sur l'etude des techniques ou des katas."
                    <footer style="margin-top: var(--spacing-sm); font-style: normal; color: var(--color-text-light);">
                        - Extrait du Manuel du Pratiquant FFAB
                    </footer>
                </blockquote>

                <p>
                    Ces fondations sont les elements structurants avec lesquels il est possible de developper
                    le <strong>sens de la globalite</strong>. Il ne s'agit pas simplement d'accumuler des
                    connaissances techniques mais d'approfondir inlassablement ces notions.
                </p>
            </div>

            <!-- Resume des 10 fondations -->
            <div class="fondation-summary">
                <h3 class="fondation-summary__title">Les 10 Fondations</h3>
                <ul class="fondation-summary__list">
                    <li class="fondation-summary__item"><span>1.</span> Shisei (Posture)</li>
                    <li class="fondation-summary__item"><span>2.</span> Kokyu (Respiration)</li>
                    <li class="fondation-summary__item"><span>3.</span> Kamae (Garde)</li>
                    <li class="fondation-summary__item"><span>4.</span> Ma-ai (Distance)</li>
                    <li class="fondation-summary__item"><span>5.</span> Irimi (Entree)</li>
                    <li class="fondation-summary__item"><span>6.</span> Tenkan (Rotation)</li>
                    <li class="fondation-summary__item"><span>7.</span> Ura / Omote (Aspects)</li>
                    <li class="fondation-summary__item"><span>8.</span> Tai sabaki (Deplacement)</li>
                    <li class="fondation-summary__item"><span>9.</span> Atemi (Coup)</li>
                    <li class="fondation-summary__item"><span>10.</span> Kokyu ryoku (Puissance)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Les 10 Fondations detaillees -->
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
                            <strong>Sugata</strong> (forme, figure, taille) et <strong>Ikioi</strong> (force, vigueur, vivacite).
                        </p>
                        <ul class="fondation-card__points">
                            <li>La posture est a la fois physique et mentale</li>
                            <li>Un maintien qui met le pratiquant en eveil, disponible</li>
                            <li>Tete, epaules, hanches et pieds parfaitement alignes</li>
                            <li>Non seulement une attitude externe mais aussi une force interieure visible de l'exterieur</li>
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
                            Au-dela de la simple oxygenation, la respiration controlee offre des benefices
                            depassant la fonction vitale, particulierement lors d'efforts physiques intenses.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Un bon kokyu est lent, profond, long et naturel</li>
                            <li>C'est une respiration abdominale</li>
                            <li>Au debut, accentuer l'expiration puis laisser l'inspiration se faire naturellement</li>
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
                            "Se tenir pret, se mettre en garde." Kamae contient a la fois les forces du ki
                            et le pouvoir de percevoir tous les details. En aikido, on utilise <strong>hanmi no kamae</strong>
                            (garde de profil).
                        </p>
                        <ul class="fondation-card__points">
                            <li>Position qui prepare aux evenements futurs</li>
                            <li>Peut prevenir l'affrontement ou conditionner les premiers echanges</li>
                            <li><strong>Migi hanmi</strong> : garde droite (pied droit avance)</li>
                            <li><strong>Hidari hanmi</strong> : garde gauche (pied gauche avance)</li>
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
                            L'espace "convenable" qui separe deux aikidokas sans qu'il soit possible d'en donner
                            une valeur precise. Certains le ressentent instinctivement, d'autres necessitent un apprentissage.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Notion a la fois spatiale et temporelle</li>
                            <li>Intervalle juste entre les partenaires</li>
                            <li>Varie selon la situation et l'intention</li>
                            <li>Necessite une perception fine et une adaptation constante</li>
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
                        <p class="fondation-card__definition">L'Entree / La Penetration</p>
                        <p class="fondation-card__description">
                            "Entrer, penetrer, transpercer." Quand deux forces se deplacent dans des directions opposees,
                            irimi est l'utilisation de cette force resultante en relation avec sa propre position
                            au moment du croisement.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Avancer en reduisant la distance tout en controlant l'adversaire</li>
                            <li><strong>Irimi issoku</strong> : entrer d'un pas sur le cote du partenaire</li>
                            <li>Retourner la force de l'attaque</li>
                            <li>Rendre l'adversaire moins menacant</li>
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
                            Transformer un mouvement lineaire en mouvement circulaire par changement de direction
                            autour d'un pivot. Le pied avant sert de point de rotation.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Pivot a 180 degres sur le pied avant</li>
                            <li>Rotation du corps tout en gardant le contact</li>
                            <li>Permet de rediriger l'energie de l'attaque</li>
                            <li><strong>Irimi-tenkan</strong> : combinaison entree + rotation</li>
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
                        <p class="fondation-card__definition">Les Aspects Cache / Visible</p>
                        <p class="fondation-card__description">
                            Une technique en aikido a deux aspects : <strong>ura waza</strong> et <strong>omote waza</strong>.
                            Ces deux facettes coexistent dans la plupart des techniques.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Ura</strong> : l'envers, le verso, l'aspect cache des choses</li>
                            <li><strong>Omote</strong> : la surface, l'exterieur, l'aspect apparent</li>
                            <li>Omote : entree vers l'avant du partenaire</li>
                            <li>Ura : entree vers l'arriere du partenaire</li>
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
                        <p class="fondation-card__definition">Le Deplacement du corps</p>
                        <p class="fondation-card__description">
                            "L'essence de l'aikido" : se deplacer pour eviter l'attaque, se positionner favorablement
                            et destabiliser l'adversaire simultanement.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Tsugi ashi</strong> : pas glisse (pied arriere rejoint l'avant)</li>
                            <li><strong>Ayumi ashi</strong> : marche normale alternee</li>
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
                            Les coups existent dans l'aikido pour maintenir la distance ou controler l'adversaire
                            durant les techniques. Ils sont generalement simules en pratique.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Outil de destabilisation et de controle</li>
                            <li>Permet de creer une ouverture</li>
                            <li>Maintient la distance de securite</li>
                            <li>Element essentiel souvent sous-estime</li>
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
                            Depasse la respiration seule en procurant puissance, precision et controle total
                            de l'adversaire. C'est la coordination de la puissance a travers le souffle.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Puissance qui vient du centre (hara)</li>
                            <li>Coordination corps-souffle-esprit</li>
                            <li>Controle sans force musculaire excessive</li>
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
                    (litteralement "corps qui recoit") sont un element fondamental de la pratique,
                    aussi important que les techniques elles-memes.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mae ukemi</h3>
                            <p class="card__text">
                                <strong>Chute avant roulee</strong> : reception souple en roulant vers l'avant.
                                La plus courante, elle permet de se relever rapidement en position de garde.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ushiro ukemi</h3>
                            <p class="card__text">
                                <strong>Chute arriere roulee</strong> : reception en roulant vers l'arriere.
                                Necessite de bien rentrer le menton et d'arrondir le dos.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Yoko ukemi</h3>
                            <p class="card__text">
                                <strong>Chute laterale</strong> : reception sur le cote avec frappe du bras
                                pour amortir. Utilisee pour certaines projections specifiques.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Tobu ukemi</h3>
                            <p class="card__text">
                                <strong>Chute plaquee</strong> : projection aerienne avec reception dynamique.
                                Requiert une bonne maitrise des ukemi de base.
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
                        <h3 class="tamura-bio__name">Maitre Nobuyoshi Tamura</h3>
                        <p class="tamura-bio__dates">2 mars 1933 - 9 juillet 2010</p>
                    </div>
                </div>
                <p>
                    Ne a Osaka en 1933, <strong>Nobuyoshi Tamura</strong> debute la pratique des arts martiaux tres jeune.
                    Il devient rapidement l'un des eleves les plus proches de <strong>O Sensei Morihei Ueshiba</strong>,
                    fondateur de l'aikido, qu'il accompagne pendant de nombreuses annees.
                </p>
                <p>
                    En 1964, il s'installe en France ou il contribue enormement au developpement de l'aikido.
                    Directeur technique de la <strong>FFAB</strong> (Federation Francaise d'Aikido et de Budo),
                    il forme des generations de pratiquants et d'enseignants, laissant un heritage technique
                    et philosophique considerable.
                </p>
                <p>
                    Son ouvrage "<strong>Aikido</strong>" reste une reference pour tous les pratiquants.
                    Les fondations qu'il a formalisees sont aujourd'hui au coeur de l'enseignement FFAB
                    et permettent de transmettre l'essence de la discipline du fondateur.
                </p>
                <p>
                    Maitre Tamura s'est eteint le 9 juillet 2010 a Saint-Maximin-la-Sainte-Baume, laissant derriere lui
                    un heritage immense pour l'aikido mondial.
                </p>
            </div>

            <div class="info-box mt-4" style="max-width: 700px; margin: var(--spacing-xl) auto 0; text-align: center;">
                <h4 class="info-box__title">Citation</h4>
                <blockquote style="font-style: italic; margin: var(--spacing-md) 0;">
                    "L'aikido n'est pas une technique de combat mais un moyen de s'ameliorer soi-meme
                    en harmonie avec les autres et avec la nature."
                </blockquote>
                <p style="color: var(--color-text-light);">- Maitre Nobuyoshi Tamura</p>
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
                    <a href="aikido.php" class="btn btn--outline">Decouvrir l'aikido</a>
                    <a href="grades.php" class="btn btn--outline">Les grades</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

                </blockquote>

                <p>
                    Ces fondations sont les elements structurants avec lesquels il est possible de developper
                    le <strong>sens de la globalite</strong>. Il ne s'agit pas simplement d'accumuler des
                    connaissances techniques mais d'approfondir inlassablement ces notions.
                </p>
            </div>

            <!-- Resume des 10 fondations -->
            <div class="fondation-summary">
                <h3 class="fondation-summary__title">Les 10 Fondations</h3>
                <ul class="fondation-summary__list">
                    <li class="fondation-summary__item"><span>1.</span> Shisei (Posture)</li>
                    <li class="fondation-summary__item"><span>2.</span> Kokyu (Respiration)</li>
                    <li class="fondation-summary__item"><span>3.</span> Kamae (Garde)</li>
                    <li class="fondation-summary__item"><span>4.</span> Ma-ai (Distance)</li>
                    <li class="fondation-summary__item"><span>5.</span> Irimi (Entree)</li>
                    <li class="fondation-summary__item"><span>6.</span> Tenkan (Rotation)</li>
                    <li class="fondation-summary__item"><span>7.</span> Ura / Omote (Aspects)</li>
                    <li class="fondation-summary__item"><span>8.</span> Tai sabaki (Deplacement)</li>
                    <li class="fondation-summary__item"><span>9.</span> Atemi (Coup)</li>
                    <li class="fondation-summary__item"><span>10.</span> Kokyu ryoku (Puissance)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Les 10 Fondations detaillees -->
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
                            <strong>Sugata</strong> (forme, figure, taille) et <strong>Ikioi</strong> (force, vigueur, vivacite).
                        </p>
                        <ul class="fondation-card__points">
                            <li>La posture est a la fois physique et mentale</li>
                            <li>Un maintien qui met le pratiquant en eveil, disponible</li>
                            <li>Tete, epaules, hanches et pieds parfaitement alignes</li>
                            <li>Non seulement une attitude externe mais aussi une force interieure visible de l'exterieur</li>
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
                            Au-dela de la simple oxygenation, la respiration controlee offre des benefices
                            depassant la fonction vitale, particulierement lors d'efforts physiques intenses.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Un bon kokyu est lent, profond, long et naturel</li>
                            <li>C'est une respiration abdominale</li>
                            <li>Au debut, accentuer l'expiration puis laisser l'inspiration se faire naturellement</li>
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
                            "Se tenir pret, se mettre en garde." Kamae contient a la fois les forces du ki
                            et le pouvoir de percevoir tous les details. En aikido, on utilise <strong>hanmi no kamae</strong>
                            (garde de profil).
                        </p>
                        <ul class="fondation-card__points">
                            <li>Position qui prepare aux evenements futurs</li>
                            <li>Peut prevenir l'affrontement ou conditionner les premiers echanges</li>
                            <li><strong>Migi hanmi</strong> : garde droite (pied droit avance)</li>
                            <li><strong>Hidari hanmi</strong> : garde gauche (pied gauche avance)</li>
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
                            L'espace "convenable" qui separe deux aikidokas sans qu'il soit possible d'en donner
                            une valeur precise. Certains le ressentent instinctivement, d'autres necessitent un apprentissage.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Notion a la fois spatiale et temporelle</li>
                            <li>Intervalle juste entre les partenaires</li>
                            <li>Varie selon la situation et l'intention</li>
                            <li>Necessite une perception fine et une adaptation constante</li>
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
                        <p class="fondation-card__definition">L'Entree / La Penetration</p>
                        <p class="fondation-card__description">
                            "Entrer, penetrer, transpercer." Quand deux forces se deplacent dans des directions opposees,
                            irimi est l'utilisation de cette force resultante en relation avec sa propre position
                            au moment du croisement.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Avancer en reduisant la distance tout en controlant l'adversaire</li>
                            <li><strong>Irimi issoku</strong> : entrer d'un pas sur le cote du partenaire</li>
                            <li>Retourner la force de l'attaque</li>
                            <li>Rendre l'adversaire moins menacant</li>
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
                            Transformer un mouvement lineaire en mouvement circulaire par changement de direction
                            autour d'un pivot. Le pied avant sert de point de rotation.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Pivot a 180 degres sur le pied avant</li>
                            <li>Rotation du corps tout en gardant le contact</li>
                            <li>Permet de rediriger l'energie de l'attaque</li>
                            <li><strong>Irimi-tenkan</strong> : combinaison entree + rotation</li>
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
                        <p class="fondation-card__definition">Les Aspects Cache / Visible</p>
                        <p class="fondation-card__description">
                            Une technique en aikido a deux aspects : <strong>ura waza</strong> et <strong>omote waza</strong>.
                            Ces deux facettes coexistent dans la plupart des techniques.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Ura</strong> : l'envers, le verso, l'aspect cache des choses</li>
                            <li><strong>Omote</strong> : la surface, l'exterieur, l'aspect apparent</li>
                            <li>Omote : entree vers l'avant du partenaire</li>
                            <li>Ura : entree vers l'arriere du partenaire</li>
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
                        <p class="fondation-card__definition">Le Deplacement du corps</p>
                        <p class="fondation-card__description">
                            "L'essence de l'aikido" : se deplacer pour eviter l'attaque, se positionner favorablement
                            et destabiliser l'adversaire simultanement.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Tsugi ashi</strong> : pas glisse (pied arriere rejoint l'avant)</li>
                            <li><strong>Ayumi ashi</strong> : marche normale alternee</li>
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
                            Les coups existent dans l'aikido pour maintenir la distance ou controler l'adversaire
                            durant les techniques. Ils sont generalement simules en pratique.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Outil de destabilisation et de controle</li>
                            <li>Permet de creer une ouverture</li>
                            <li>Maintient la distance de securite</li>
                            <li>Element essentiel souvent sous-estime</li>
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
                            Depasse la respiration seule en procurant puissance, precision et controle total
                            de l'adversaire. C'est la coordination de la puissance a travers le souffle.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Puissance qui vient du centre (hara)</li>
                            <li>Coordination corps-souffle-esprit</li>
                            <li>Controle sans force musculaire excessive</li>
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
                    (litteralement "corps qui recoit") sont un element fondamental de la pratique,
                    aussi important que les techniques elles-memes.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mae ukemi</h3>
                            <p class="card__text">
                                <strong>Chute avant roulee</strong> : reception souple en roulant vers l'avant.
                                La plus courante, elle permet de se relever rapidement en position de garde.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ushiro ukemi</h3>
                            <p class="card__text">
                                <strong>Chute arriere roulee</strong> : reception en roulant vers l'arriere.
                                Necessite de bien rentrer le menton et d'arrondir le dos.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Yoko ukemi</h3>
                            <p class="card__text">
                                <strong>Chute laterale</strong> : reception sur le cote avec frappe du bras
                                pour amortir. Utilisee pour certaines projections specifiques.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Tobu ukemi</h3>
                            <p class="card__text">
                                <strong>Chute plaquee</strong> : projection aerienne avec reception dynamique.
                                Requiert une bonne maitrise des ukemi de base.
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
                        <h3 class="tamura-bio__name">Maitre Nobuyoshi Tamura</h3>
                        <p class="tamura-bio__dates">2 mars 1933 - 9 juillet 2010</p>
                    </div>
                </div>
                <p>
                    Ne a Osaka en 1933, <strong>Nobuyoshi Tamura</strong> debute la pratique des arts martiaux tres jeune.
                    Il devient rapidement l'un des eleves les plus proches de <strong>O Sensei Morihei Ueshiba</strong>,
                    fondateur de l'aikido, qu'il accompagne pendant de nombreuses annees.
                </p>
                <p>
                    En 1964, il s'installe en France ou il contribue enormement au developpement de l'aikido.
                    Directeur technique de la <strong>FFAB</strong> (Federation Francaise d'Aikido et de Budo),
                    il forme des generations de pratiquants et d'enseignants, laissant un heritage technique
                    et philosophique considerable.
                </p>
                <p>
                    Son ouvrage "<strong>Aikido</strong>" reste une reference pour tous les pratiquants.
                    Les fondations qu'il a formalisees sont aujourd'hui au coeur de l'enseignement FFAB
                    et permettent de transmettre l'essence de la discipline du fondateur.
                </p>
                <p>
                    Maitre Tamura s'est eteint le 9 juillet 2010 a Saint-Maximin-la-Sainte-Baume, laissant derriere lui
                    un heritage immense pour l'aikido mondial.
                </p>
            </div>

            <div class="info-box mt-4" style="max-width: 700px; margin: var(--spacing-xl) auto 0; text-align: center;">
                <h4 class="info-box__title">Citation</h4>
                <blockquote style="font-style: italic; margin: var(--spacing-md) 0;">
                    "L'aikido n'est pas une technique de combat mais un moyen de s'ameliorer soi-meme
                    en harmonie avec les autres et avec la nature."
                </blockquote>
                <p style="color: var(--color-text-light);">- Maitre Nobuyoshi Tamura</p>
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
                    <a href="aikido.php" class="btn btn--outline">Decouvrir l'aikido</a>
                    <a href="grades.php" class="btn btn--outline">Les grades</a>
                </div>
            </div>
        </div>
    </section>



                </blockquote>

                <p>
                    Ces fondations sont les elements structurants avec lesquels il est possible de developper
                    le <strong>sens de la globalite</strong>. Il ne s'agit pas simplement d'accumuler des
                    connaissances techniques mais d'approfondir inlassablement ces notions.
                </p>
            </div>

            <!-- Resume des 10 fondations -->
            <div class="fondation-summary">
                <h3 class="fondation-summary__title">Les 10 Fondations</h3>
                <ul class="fondation-summary__list">
                    <li class="fondation-summary__item"><span>1.</span> Shisei (Posture)</li>
                    <li class="fondation-summary__item"><span>2.</span> Kokyu (Respiration)</li>
                    <li class="fondation-summary__item"><span>3.</span> Kamae (Garde)</li>
                    <li class="fondation-summary__item"><span>4.</span> Ma-ai (Distance)</li>
                    <li class="fondation-summary__item"><span>5.</span> Irimi (Entree)</li>
                    <li class="fondation-summary__item"><span>6.</span> Tenkan (Rotation)</li>
                    <li class="fondation-summary__item"><span>7.</span> Ura / Omote (Aspects)</li>
                    <li class="fondation-summary__item"><span>8.</span> Tai sabaki (Deplacement)</li>
                    <li class="fondation-summary__item"><span>9.</span> Atemi (Coup)</li>
                    <li class="fondation-summary__item"><span>10.</span> Kokyu ryoku (Puissance)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Les 10 Fondations detaillees -->
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
                            <strong>Sugata</strong> (forme, figure, taille) et <strong>Ikioi</strong> (force, vigueur, vivacite).
                        </p>
                        <ul class="fondation-card__points">
                            <li>La posture est a la fois physique et mentale</li>
                            <li>Un maintien qui met le pratiquant en eveil, disponible</li>
                            <li>Tete, epaules, hanches et pieds parfaitement alignes</li>
                            <li>Non seulement une attitude externe mais aussi une force interieure visible de l'exterieur</li>
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
                            Au-dela de la simple oxygenation, la respiration controlee offre des benefices
                            depassant la fonction vitale, particulierement lors d'efforts physiques intenses.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Un bon kokyu est lent, profond, long et naturel</li>
                            <li>C'est une respiration abdominale</li>
                            <li>Au debut, accentuer l'expiration puis laisser l'inspiration se faire naturellement</li>
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
                            "Se tenir pret, se mettre en garde." Kamae contient a la fois les forces du ki
                            et le pouvoir de percevoir tous les details. En aikido, on utilise <strong>hanmi no kamae</strong>
                            (garde de profil).
                        </p>
                        <ul class="fondation-card__points">
                            <li>Position qui prepare aux evenements futurs</li>
                            <li>Peut prevenir l'affrontement ou conditionner les premiers echanges</li>
                            <li><strong>Migi hanmi</strong> : garde droite (pied droit avance)</li>
                            <li><strong>Hidari hanmi</strong> : garde gauche (pied gauche avance)</li>
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
                            L'espace "convenable" qui separe deux aikidokas sans qu'il soit possible d'en donner
                            une valeur precise. Certains le ressentent instinctivement, d'autres necessitent un apprentissage.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Notion a la fois spatiale et temporelle</li>
                            <li>Intervalle juste entre les partenaires</li>
                            <li>Varie selon la situation et l'intention</li>
                            <li>Necessite une perception fine et une adaptation constante</li>
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
                        <p class="fondation-card__definition">L'Entree / La Penetration</p>
                        <p class="fondation-card__description">
                            "Entrer, penetrer, transpercer." Quand deux forces se deplacent dans des directions opposees,
                            irimi est l'utilisation de cette force resultante en relation avec sa propre position
                            au moment du croisement.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Avancer en reduisant la distance tout en controlant l'adversaire</li>
                            <li><strong>Irimi issoku</strong> : entrer d'un pas sur le cote du partenaire</li>
                            <li>Retourner la force de l'attaque</li>
                            <li>Rendre l'adversaire moins menacant</li>
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
                            Transformer un mouvement lineaire en mouvement circulaire par changement de direction
                            autour d'un pivot. Le pied avant sert de point de rotation.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Pivot a 180 degres sur le pied avant</li>
                            <li>Rotation du corps tout en gardant le contact</li>
                            <li>Permet de rediriger l'energie de l'attaque</li>
                            <li><strong>Irimi-tenkan</strong> : combinaison entree + rotation</li>
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
                        <p class="fondation-card__definition">Les Aspects Cache / Visible</p>
                        <p class="fondation-card__description">
                            Une technique en aikido a deux aspects : <strong>ura waza</strong> et <strong>omote waza</strong>.
                            Ces deux facettes coexistent dans la plupart des techniques.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Ura</strong> : l'envers, le verso, l'aspect cache des choses</li>
                            <li><strong>Omote</strong> : la surface, l'exterieur, l'aspect apparent</li>
                            <li>Omote : entree vers l'avant du partenaire</li>
                            <li>Ura : entree vers l'arriere du partenaire</li>
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
                        <p class="fondation-card__definition">Le Deplacement du corps</p>
                        <p class="fondation-card__description">
                            "L'essence de l'aikido" : se deplacer pour eviter l'attaque, se positionner favorablement
                            et destabiliser l'adversaire simultanement.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Tsugi ashi</strong> : pas glisse (pied arriere rejoint l'avant)</li>
                            <li><strong>Ayumi ashi</strong> : marche normale alternee</li>
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
                            Les coups existent dans l'aikido pour maintenir la distance ou controler l'adversaire
                            durant les techniques. Ils sont generalement simules en pratique.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Outil de destabilisation et de controle</li>
                            <li>Permet de creer une ouverture</li>
                            <li>Maintient la distance de securite</li>
                            <li>Element essentiel souvent sous-estime</li>
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
                            Depasse la respiration seule en procurant puissance, precision et controle total
                            de l'adversaire. C'est la coordination de la puissance a travers le souffle.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Puissance qui vient du centre (hara)</li>
                            <li>Coordination corps-souffle-esprit</li>
                            <li>Controle sans force musculaire excessive</li>
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
                    (litteralement "corps qui recoit") sont un element fondamental de la pratique,
                    aussi important que les techniques elles-memes.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mae ukemi</h3>
                            <p class="card__text">
                                <strong>Chute avant roulee</strong> : reception souple en roulant vers l'avant.
                                La plus courante, elle permet de se relever rapidement en position de garde.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ushiro ukemi</h3>
                            <p class="card__text">
                                <strong>Chute arriere roulee</strong> : reception en roulant vers l'arriere.
                                Necessite de bien rentrer le menton et d'arrondir le dos.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Yoko ukemi</h3>
                            <p class="card__text">
                                <strong>Chute laterale</strong> : reception sur le cote avec frappe du bras
                                pour amortir. Utilisee pour certaines projections specifiques.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Tobu ukemi</h3>
                            <p class="card__text">
                                <strong>Chute plaquee</strong> : projection aerienne avec reception dynamique.
                                Requiert une bonne maitrise des ukemi de base.
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
                        <h3 class="tamura-bio__name">Maitre Nobuyoshi Tamura</h3>
                        <p class="tamura-bio__dates">2 mars 1933 - 9 juillet 2010</p>
                    </div>
                </div>
                <p>
                    Ne a Osaka en 1933, <strong>Nobuyoshi Tamura</strong> debute la pratique des arts martiaux tres jeune.
                    Il devient rapidement l'un des eleves les plus proches de <strong>O Sensei Morihei Ueshiba</strong>,
                    fondateur de l'aikido, qu'il accompagne pendant de nombreuses annees.
                </p>
                <p>
                    En 1964, il s'installe en France ou il contribue enormement au developpement de l'aikido.
                    Directeur technique de la <strong>FFAB</strong> (Federation Francaise d'Aikido et de Budo),
                    il forme des generations de pratiquants et d'enseignants, laissant un heritage technique
                    et philosophique considerable.
                </p>
                <p>
                    Son ouvrage "<strong>Aikido</strong>" reste une reference pour tous les pratiquants.
                    Les fondations qu'il a formalisees sont aujourd'hui au coeur de l'enseignement FFAB
                    et permettent de transmettre l'essence de la discipline du fondateur.
                </p>
                <p>
                    Maitre Tamura s'est eteint le 9 juillet 2010 a Saint-Maximin-la-Sainte-Baume, laissant derriere lui
                    un heritage immense pour l'aikido mondial.
                </p>
            </div>

            <div class="info-box mt-4" style="max-width: 700px; margin: var(--spacing-xl) auto 0; text-align: center;">
                <h4 class="info-box__title">Citation</h4>
                <blockquote style="font-style: italic; margin: var(--spacing-md) 0;">
                    "L'aikido n'est pas une technique de combat mais un moyen de s'ameliorer soi-meme
                    en harmonie avec les autres et avec la nature."
                </blockquote>
                <p style="color: var(--color-text-light);">- Maitre Nobuyoshi Tamura</p>
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
                    <a href="aikido.php" class="btn btn--outline">Decouvrir l'aikido</a>
                    <a href="grades.php" class="btn btn--outline">Les grades</a>
                </div>
            </div>
        </div>
    </section>



                </blockquote>

                <p>
                    Ces fondations sont les elements structurants avec lesquels il est possible de developper
                    le <strong>sens de la globalite</strong>. Il ne s'agit pas simplement d'accumuler des
                    connaissances techniques mais d'approfondir inlassablement ces notions.
                </p>
            </div>

            <!-- Resume des 10 fondations -->
            <div class="fondation-summary">
                <h3 class="fondation-summary__title">Les 10 Fondations</h3>
                <ul class="fondation-summary__list">
                    <li class="fondation-summary__item"><span>1.</span> Shisei (Posture)</li>
                    <li class="fondation-summary__item"><span>2.</span> Kokyu (Respiration)</li>
                    <li class="fondation-summary__item"><span>3.</span> Kamae (Garde)</li>
                    <li class="fondation-summary__item"><span>4.</span> Ma-ai (Distance)</li>
                    <li class="fondation-summary__item"><span>5.</span> Irimi (Entree)</li>
                    <li class="fondation-summary__item"><span>6.</span> Tenkan (Rotation)</li>
                    <li class="fondation-summary__item"><span>7.</span> Ura / Omote (Aspects)</li>
                    <li class="fondation-summary__item"><span>8.</span> Tai sabaki (Deplacement)</li>
                    <li class="fondation-summary__item"><span>9.</span> Atemi (Coup)</li>
                    <li class="fondation-summary__item"><span>10.</span> Kokyu ryoku (Puissance)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Les 10 Fondations detaillees -->
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
                            <strong>Sugata</strong> (forme, figure, taille) et <strong>Ikioi</strong> (force, vigueur, vivacite).
                        </p>
                        <ul class="fondation-card__points">
                            <li>La posture est a la fois physique et mentale</li>
                            <li>Un maintien qui met le pratiquant en eveil, disponible</li>
                            <li>Tete, epaules, hanches et pieds parfaitement alignes</li>
                            <li>Non seulement une attitude externe mais aussi une force interieure visible de l'exterieur</li>
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
                            Au-dela de la simple oxygenation, la respiration controlee offre des benefices
                            depassant la fonction vitale, particulierement lors d'efforts physiques intenses.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Un bon kokyu est lent, profond, long et naturel</li>
                            <li>C'est une respiration abdominale</li>
                            <li>Au debut, accentuer l'expiration puis laisser l'inspiration se faire naturellement</li>
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
                            "Se tenir pret, se mettre en garde." Kamae contient a la fois les forces du ki
                            et le pouvoir de percevoir tous les details. En aikido, on utilise <strong>hanmi no kamae</strong>
                            (garde de profil).
                        </p>
                        <ul class="fondation-card__points">
                            <li>Position qui prepare aux evenements futurs</li>
                            <li>Peut prevenir l'affrontement ou conditionner les premiers echanges</li>
                            <li><strong>Migi hanmi</strong> : garde droite (pied droit avance)</li>
                            <li><strong>Hidari hanmi</strong> : garde gauche (pied gauche avance)</li>
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
                            L'espace "convenable" qui separe deux aikidokas sans qu'il soit possible d'en donner
                            une valeur precise. Certains le ressentent instinctivement, d'autres necessitent un apprentissage.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Notion a la fois spatiale et temporelle</li>
                            <li>Intervalle juste entre les partenaires</li>
                            <li>Varie selon la situation et l'intention</li>
                            <li>Necessite une perception fine et une adaptation constante</li>
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
                        <p class="fondation-card__definition">L'Entree / La Penetration</p>
                        <p class="fondation-card__description">
                            "Entrer, penetrer, transpercer." Quand deux forces se deplacent dans des directions opposees,
                            irimi est l'utilisation de cette force resultante en relation avec sa propre position
                            au moment du croisement.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Avancer en reduisant la distance tout en controlant l'adversaire</li>
                            <li><strong>Irimi issoku</strong> : entrer d'un pas sur le cote du partenaire</li>
                            <li>Retourner la force de l'attaque</li>
                            <li>Rendre l'adversaire moins menacant</li>
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
                            Transformer un mouvement lineaire en mouvement circulaire par changement de direction
                            autour d'un pivot. Le pied avant sert de point de rotation.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Pivot a 180 degres sur le pied avant</li>
                            <li>Rotation du corps tout en gardant le contact</li>
                            <li>Permet de rediriger l'energie de l'attaque</li>
                            <li><strong>Irimi-tenkan</strong> : combinaison entree + rotation</li>
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
                        <p class="fondation-card__definition">Les Aspects Cache / Visible</p>
                        <p class="fondation-card__description">
                            Une technique en aikido a deux aspects : <strong>ura waza</strong> et <strong>omote waza</strong>.
                            Ces deux facettes coexistent dans la plupart des techniques.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Ura</strong> : l'envers, le verso, l'aspect cache des choses</li>
                            <li><strong>Omote</strong> : la surface, l'exterieur, l'aspect apparent</li>
                            <li>Omote : entree vers l'avant du partenaire</li>
                            <li>Ura : entree vers l'arriere du partenaire</li>
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
                        <p class="fondation-card__definition">Le Deplacement du corps</p>
                        <p class="fondation-card__description">
                            "L'essence de l'aikido" : se deplacer pour eviter l'attaque, se positionner favorablement
                            et destabiliser l'adversaire simultanement.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Tsugi ashi</strong> : pas glisse (pied arriere rejoint l'avant)</li>
                            <li><strong>Ayumi ashi</strong> : marche normale alternee</li>
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
                            Les coups existent dans l'aikido pour maintenir la distance ou controler l'adversaire
                            durant les techniques. Ils sont generalement simules en pratique.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Outil de destabilisation et de controle</li>
                            <li>Permet de creer une ouverture</li>
                            <li>Maintient la distance de securite</li>
                            <li>Element essentiel souvent sous-estime</li>
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
                            Depasse la respiration seule en procurant puissance, precision et controle total
                            de l'adversaire. C'est la coordination de la puissance a travers le souffle.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Puissance qui vient du centre (hara)</li>
                            <li>Coordination corps-souffle-esprit</li>
                            <li>Controle sans force musculaire excessive</li>
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
                    (litteralement "corps qui recoit") sont un element fondamental de la pratique,
                    aussi important que les techniques elles-memes.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mae ukemi</h3>
                            <p class="card__text">
                                <strong>Chute avant roulee</strong> : reception souple en roulant vers l'avant.
                                La plus courante, elle permet de se relever rapidement en position de garde.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ushiro ukemi</h3>
                            <p class="card__text">
                                <strong>Chute arriere roulee</strong> : reception en roulant vers l'arriere.
                                Necessite de bien rentrer le menton et d'arrondir le dos.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Yoko ukemi</h3>
                            <p class="card__text">
                                <strong>Chute laterale</strong> : reception sur le cote avec frappe du bras
                                pour amortir. Utilisee pour certaines projections specifiques.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Tobu ukemi</h3>
                            <p class="card__text">
                                <strong>Chute plaquee</strong> : projection aerienne avec reception dynamique.
                                Requiert une bonne maitrise des ukemi de base.
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
                        <h3 class="tamura-bio__name">Maitre Nobuyoshi Tamura</h3>
                        <p class="tamura-bio__dates">2 mars 1933 - 9 juillet 2010</p>
                    </div>
                </div>
                <p>
                    Ne a Osaka en 1933, <strong>Nobuyoshi Tamura</strong> debute la pratique des arts martiaux tres jeune.
                    Il devient rapidement l'un des eleves les plus proches de <strong>O Sensei Morihei Ueshiba</strong>,
                    fondateur de l'aikido, qu'il accompagne pendant de nombreuses annees.
                </p>
                <p>
                    En 1964, il s'installe en France ou il contribue enormement au developpement de l'aikido.
                    Directeur technique de la <strong>FFAB</strong> (Federation Francaise d'Aikido et de Budo),
                    il forme des generations de pratiquants et d'enseignants, laissant un heritage technique
                    et philosophique considerable.
                </p>
                <p>
                    Son ouvrage "<strong>Aikido</strong>" reste une reference pour tous les pratiquants.
                    Les fondations qu'il a formalisees sont aujourd'hui au coeur de l'enseignement FFAB
                    et permettent de transmettre l'essence de la discipline du fondateur.
                </p>
                <p>
                    Maitre Tamura s'est eteint le 9 juillet 2010 a Saint-Maximin-la-Sainte-Baume, laissant derriere lui
                    un heritage immense pour l'aikido mondial.
                </p>
            </div>

            <div class="info-box mt-4" style="max-width: 700px; margin: var(--spacing-xl) auto 0; text-align: center;">
                <h4 class="info-box__title">Citation</h4>
                <blockquote style="font-style: italic; margin: var(--spacing-md) 0;">
                    "L'aikido n'est pas une technique de combat mais un moyen de s'ameliorer soi-meme
                    en harmonie avec les autres et avec la nature."
                </blockquote>
                <p style="color: var(--color-text-light);">- Maitre Nobuyoshi Tamura</p>
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
                    <a href="aikido.php" class="btn btn--outline">Decouvrir l'aikido</a>
                    <a href="grades.php" class="btn btn--outline">Les grades</a>
                </div>
            </div>
        </div>
    </section>



                </blockquote>

                <p>
                    Ces fondations sont les elements structurants avec lesquels il est possible de developper
                    le <strong>sens de la globalite</strong>. Il ne s'agit pas simplement d'accumuler des
                    connaissances techniques mais d'approfondir inlassablement ces notions.
                </p>
            </div>

            <!-- Resume des 10 fondations -->
            <div class="fondation-summary">
                <h3 class="fondation-summary__title">Les 10 Fondations</h3>
                <ul class="fondation-summary__list">
                    <li class="fondation-summary__item"><span>1.</span> Shisei (Posture)</li>
                    <li class="fondation-summary__item"><span>2.</span> Kokyu (Respiration)</li>
                    <li class="fondation-summary__item"><span>3.</span> Kamae (Garde)</li>
                    <li class="fondation-summary__item"><span>4.</span> Ma-ai (Distance)</li>
                    <li class="fondation-summary__item"><span>5.</span> Irimi (Entree)</li>
                    <li class="fondation-summary__item"><span>6.</span> Tenkan (Rotation)</li>
                    <li class="fondation-summary__item"><span>7.</span> Ura / Omote (Aspects)</li>
                    <li class="fondation-summary__item"><span>8.</span> Tai sabaki (Deplacement)</li>
                    <li class="fondation-summary__item"><span>9.</span> Atemi (Coup)</li>
                    <li class="fondation-summary__item"><span>10.</span> Kokyu ryoku (Puissance)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Les 10 Fondations detaillees -->
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
                            <strong>Sugata</strong> (forme, figure, taille) et <strong>Ikioi</strong> (force, vigueur, vivacite).
                        </p>
                        <ul class="fondation-card__points">
                            <li>La posture est a la fois physique et mentale</li>
                            <li>Un maintien qui met le pratiquant en eveil, disponible</li>
                            <li>Tete, epaules, hanches et pieds parfaitement alignes</li>
                            <li>Non seulement une attitude externe mais aussi une force interieure visible de l'exterieur</li>
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
                            Au-dela de la simple oxygenation, la respiration controlee offre des benefices
                            depassant la fonction vitale, particulierement lors d'efforts physiques intenses.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Un bon kokyu est lent, profond, long et naturel</li>
                            <li>C'est une respiration abdominale</li>
                            <li>Au debut, accentuer l'expiration puis laisser l'inspiration se faire naturellement</li>
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
                            "Se tenir pret, se mettre en garde." Kamae contient a la fois les forces du ki
                            et le pouvoir de percevoir tous les details. En aikido, on utilise <strong>hanmi no kamae</strong>
                            (garde de profil).
                        </p>
                        <ul class="fondation-card__points">
                            <li>Position qui prepare aux evenements futurs</li>
                            <li>Peut prevenir l'affrontement ou conditionner les premiers echanges</li>
                            <li><strong>Migi hanmi</strong> : garde droite (pied droit avance)</li>
                            <li><strong>Hidari hanmi</strong> : garde gauche (pied gauche avance)</li>
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
                            L'espace "convenable" qui separe deux aikidokas sans qu'il soit possible d'en donner
                            une valeur precise. Certains le ressentent instinctivement, d'autres necessitent un apprentissage.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Notion a la fois spatiale et temporelle</li>
                            <li>Intervalle juste entre les partenaires</li>
                            <li>Varie selon la situation et l'intention</li>
                            <li>Necessite une perception fine et une adaptation constante</li>
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
                        <p class="fondation-card__definition">L'Entree / La Penetration</p>
                        <p class="fondation-card__description">
                            "Entrer, penetrer, transpercer." Quand deux forces se deplacent dans des directions opposees,
                            irimi est l'utilisation de cette force resultante en relation avec sa propre position
                            au moment du croisement.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Avancer en reduisant la distance tout en controlant l'adversaire</li>
                            <li><strong>Irimi issoku</strong> : entrer d'un pas sur le cote du partenaire</li>
                            <li>Retourner la force de l'attaque</li>
                            <li>Rendre l'adversaire moins menacant</li>
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
                            Transformer un mouvement lineaire en mouvement circulaire par changement de direction
                            autour d'un pivot. Le pied avant sert de point de rotation.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Pivot a 180 degres sur le pied avant</li>
                            <li>Rotation du corps tout en gardant le contact</li>
                            <li>Permet de rediriger l'energie de l'attaque</li>
                            <li><strong>Irimi-tenkan</strong> : combinaison entree + rotation</li>
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
                        <p class="fondation-card__definition">Les Aspects Cache / Visible</p>
                        <p class="fondation-card__description">
                            Une technique en aikido a deux aspects : <strong>ura waza</strong> et <strong>omote waza</strong>.
                            Ces deux facettes coexistent dans la plupart des techniques.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Ura</strong> : l'envers, le verso, l'aspect cache des choses</li>
                            <li><strong>Omote</strong> : la surface, l'exterieur, l'aspect apparent</li>
                            <li>Omote : entree vers l'avant du partenaire</li>
                            <li>Ura : entree vers l'arriere du partenaire</li>
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
                        <p class="fondation-card__definition">Le Deplacement du corps</p>
                        <p class="fondation-card__description">
                            "L'essence de l'aikido" : se deplacer pour eviter l'attaque, se positionner favorablement
                            et destabiliser l'adversaire simultanement.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Tsugi ashi</strong> : pas glisse (pied arriere rejoint l'avant)</li>
                            <li><strong>Ayumi ashi</strong> : marche normale alternee</li>
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
                            Les coups existent dans l'aikido pour maintenir la distance ou controler l'adversaire
                            durant les techniques. Ils sont generalement simules en pratique.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Outil de destabilisation et de controle</li>
                            <li>Permet de creer une ouverture</li>
                            <li>Maintient la distance de securite</li>
                            <li>Element essentiel souvent sous-estime</li>
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
                            Depasse la respiration seule en procurant puissance, precision et controle total
                            de l'adversaire. C'est la coordination de la puissance a travers le souffle.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Puissance qui vient du centre (hara)</li>
                            <li>Coordination corps-souffle-esprit</li>
                            <li>Controle sans force musculaire excessive</li>
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
                    (litteralement "corps qui recoit") sont un element fondamental de la pratique,
                    aussi important que les techniques elles-memes.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mae ukemi</h3>
                            <p class="card__text">
                                <strong>Chute avant roulee</strong> : reception souple en roulant vers l'avant.
                                La plus courante, elle permet de se relever rapidement en position de garde.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ushiro ukemi</h3>
                            <p class="card__text">
                                <strong>Chute arriere roulee</strong> : reception en roulant vers l'arriere.
                                Necessite de bien rentrer le menton et d'arrondir le dos.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Yoko ukemi</h3>
                            <p class="card__text">
                                <strong>Chute laterale</strong> : reception sur le cote avec frappe du bras
                                pour amortir. Utilisee pour certaines projections specifiques.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Tobu ukemi</h3>
                            <p class="card__text">
                                <strong>Chute plaquee</strong> : projection aerienne avec reception dynamique.
                                Requiert une bonne maitrise des ukemi de base.
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
                        <h3 class="tamura-bio__name">Maitre Nobuyoshi Tamura</h3>
                        <p class="tamura-bio__dates">2 mars 1933 - 9 juillet 2010</p>
                    </div>
                </div>
                <p>
                    Ne a Osaka en 1933, <strong>Nobuyoshi Tamura</strong> debute la pratique des arts martiaux tres jeune.
                    Il devient rapidement l'un des eleves les plus proches de <strong>O Sensei Morihei Ueshiba</strong>,
                    fondateur de l'aikido, qu'il accompagne pendant de nombreuses annees.
                </p>
                <p>
                    En 1964, il s'installe en France ou il contribue enormement au developpement de l'aikido.
                    Directeur technique de la <strong>FFAB</strong> (Federation Francaise d'Aikido et de Budo),
                    il forme des generations de pratiquants et d'enseignants, laissant un heritage technique
                    et philosophique considerable.
                </p>
                <p>
                    Son ouvrage "<strong>Aikido</strong>" reste une reference pour tous les pratiquants.
                    Les fondations qu'il a formalisees sont aujourd'hui au coeur de l'enseignement FFAB
                    et permettent de transmettre l'essence de la discipline du fondateur.
                </p>
                <p>
                    Maitre Tamura s'est eteint le 9 juillet 2010 a Saint-Maximin-la-Sainte-Baume, laissant derriere lui
                    un heritage immense pour l'aikido mondial.
                </p>
            </div>

            <div class="info-box mt-4" style="max-width: 700px; margin: var(--spacing-xl) auto 0; text-align: center;">
                <h4 class="info-box__title">Citation</h4>
                <blockquote style="font-style: italic; margin: var(--spacing-md) 0;">
                    "L'aikido n'est pas une technique de combat mais un moyen de s'ameliorer soi-meme
                    en harmonie avec les autres et avec la nature."
                </blockquote>
                <p style="color: var(--color-text-light);">- Maitre Nobuyoshi Tamura</p>
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
                    <a href="aikido.php" class="btn btn--outline">Decouvrir l'aikido</a>
                    <a href="grades.php" class="btn btn--outline">Les grades</a>
                </div>
            </div>
        </div>
    </section>



                </blockquote>

                <p>
                    Ces fondations sont les elements structurants avec lesquels il est possible de developper
                    le <strong>sens de la globalite</strong>. Il ne s'agit pas simplement d'accumuler des
                    connaissances techniques mais d'approfondir inlassablement ces notions.
                </p>
            </div>

            <!-- Resume des 10 fondations -->
            <div class="fondation-summary">
                <h3 class="fondation-summary__title">Les 10 Fondations</h3>
                <ul class="fondation-summary__list">
                    <li class="fondation-summary__item"><span>1.</span> Shisei (Posture)</li>
                    <li class="fondation-summary__item"><span>2.</span> Kokyu (Respiration)</li>
                    <li class="fondation-summary__item"><span>3.</span> Kamae (Garde)</li>
                    <li class="fondation-summary__item"><span>4.</span> Ma-ai (Distance)</li>
                    <li class="fondation-summary__item"><span>5.</span> Irimi (Entree)</li>
                    <li class="fondation-summary__item"><span>6.</span> Tenkan (Rotation)</li>
                    <li class="fondation-summary__item"><span>7.</span> Ura / Omote (Aspects)</li>
                    <li class="fondation-summary__item"><span>8.</span> Tai sabaki (Deplacement)</li>
                    <li class="fondation-summary__item"><span>9.</span> Atemi (Coup)</li>
                    <li class="fondation-summary__item"><span>10.</span> Kokyu ryoku (Puissance)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Les 10 Fondations detaillees -->
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
                            <strong>Sugata</strong> (forme, figure, taille) et <strong>Ikioi</strong> (force, vigueur, vivacite).
                        </p>
                        <ul class="fondation-card__points">
                            <li>La posture est a la fois physique et mentale</li>
                            <li>Un maintien qui met le pratiquant en eveil, disponible</li>
                            <li>Tete, epaules, hanches et pieds parfaitement alignes</li>
                            <li>Non seulement une attitude externe mais aussi une force interieure visible de l'exterieur</li>
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
                            Au-dela de la simple oxygenation, la respiration controlee offre des benefices
                            depassant la fonction vitale, particulierement lors d'efforts physiques intenses.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Un bon kokyu est lent, profond, long et naturel</li>
                            <li>C'est une respiration abdominale</li>
                            <li>Au debut, accentuer l'expiration puis laisser l'inspiration se faire naturellement</li>
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
                            "Se tenir pret, se mettre en garde." Kamae contient a la fois les forces du ki
                            et le pouvoir de percevoir tous les details. En aikido, on utilise <strong>hanmi no kamae</strong>
                            (garde de profil).
                        </p>
                        <ul class="fondation-card__points">
                            <li>Position qui prepare aux evenements futurs</li>
                            <li>Peut prevenir l'affrontement ou conditionner les premiers echanges</li>
                            <li><strong>Migi hanmi</strong> : garde droite (pied droit avance)</li>
                            <li><strong>Hidari hanmi</strong> : garde gauche (pied gauche avance)</li>
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
                            L'espace "convenable" qui separe deux aikidokas sans qu'il soit possible d'en donner
                            une valeur precise. Certains le ressentent instinctivement, d'autres necessitent un apprentissage.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Notion a la fois spatiale et temporelle</li>
                            <li>Intervalle juste entre les partenaires</li>
                            <li>Varie selon la situation et l'intention</li>
                            <li>Necessite une perception fine et une adaptation constante</li>
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
                        <p class="fondation-card__definition">L'Entree / La Penetration</p>
                        <p class="fondation-card__description">
                            "Entrer, penetrer, transpercer." Quand deux forces se deplacent dans des directions opposees,
                            irimi est l'utilisation de cette force resultante en relation avec sa propre position
                            au moment du croisement.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Avancer en reduisant la distance tout en controlant l'adversaire</li>
                            <li><strong>Irimi issoku</strong> : entrer d'un pas sur le cote du partenaire</li>
                            <li>Retourner la force de l'attaque</li>
                            <li>Rendre l'adversaire moins menacant</li>
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
                            Transformer un mouvement lineaire en mouvement circulaire par changement de direction
                            autour d'un pivot. Le pied avant sert de point de rotation.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Pivot a 180 degres sur le pied avant</li>
                            <li>Rotation du corps tout en gardant le contact</li>
                            <li>Permet de rediriger l'energie de l'attaque</li>
                            <li><strong>Irimi-tenkan</strong> : combinaison entree + rotation</li>
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
                        <p class="fondation-card__definition">Les Aspects Cache / Visible</p>
                        <p class="fondation-card__description">
                            Une technique en aikido a deux aspects : <strong>ura waza</strong> et <strong>omote waza</strong>.
                            Ces deux facettes coexistent dans la plupart des techniques.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Ura</strong> : l'envers, le verso, l'aspect cache des choses</li>
                            <li><strong>Omote</strong> : la surface, l'exterieur, l'aspect apparent</li>
                            <li>Omote : entree vers l'avant du partenaire</li>
                            <li>Ura : entree vers l'arriere du partenaire</li>
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
                        <p class="fondation-card__definition">Le Deplacement du corps</p>
                        <p class="fondation-card__description">
                            "L'essence de l'aikido" : se deplacer pour eviter l'attaque, se positionner favorablement
                            et destabiliser l'adversaire simultanement.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Tsugi ashi</strong> : pas glisse (pied arriere rejoint l'avant)</li>
                            <li><strong>Ayumi ashi</strong> : marche normale alternee</li>
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
                            Les coups existent dans l'aikido pour maintenir la distance ou controler l'adversaire
                            durant les techniques. Ils sont generalement simules en pratique.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Outil de destabilisation et de controle</li>
                            <li>Permet de creer une ouverture</li>
                            <li>Maintient la distance de securite</li>
                            <li>Element essentiel souvent sous-estime</li>
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
                            Depasse la respiration seule en procurant puissance, precision et controle total
                            de l'adversaire. C'est la coordination de la puissance a travers le souffle.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Puissance qui vient du centre (hara)</li>
                            <li>Coordination corps-souffle-esprit</li>
                            <li>Controle sans force musculaire excessive</li>
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
                    (litteralement "corps qui recoit") sont un element fondamental de la pratique,
                    aussi important que les techniques elles-memes.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mae ukemi</h3>
                            <p class="card__text">
                                <strong>Chute avant roulee</strong> : reception souple en roulant vers l'avant.
                                La plus courante, elle permet de se relever rapidement en position de garde.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ushiro ukemi</h3>
                            <p class="card__text">
                                <strong>Chute arriere roulee</strong> : reception en roulant vers l'arriere.
                                Necessite de bien rentrer le menton et d'arrondir le dos.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Yoko ukemi</h3>
                            <p class="card__text">
                                <strong>Chute laterale</strong> : reception sur le cote avec frappe du bras
                                pour amortir. Utilisee pour certaines projections specifiques.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Tobu ukemi</h3>
                            <p class="card__text">
                                <strong>Chute plaquee</strong> : projection aerienne avec reception dynamique.
                                Requiert une bonne maitrise des ukemi de base.
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
                        <h3 class="tamura-bio__name">Maitre Nobuyoshi Tamura</h3>
                        <p class="tamura-bio__dates">2 mars 1933 - 9 juillet 2010</p>
                    </div>
                </div>
                <p>
                    Ne a Osaka en 1933, <strong>Nobuyoshi Tamura</strong> debute la pratique des arts martiaux tres jeune.
                    Il devient rapidement l'un des eleves les plus proches de <strong>O Sensei Morihei Ueshiba</strong>,
                    fondateur de l'aikido, qu'il accompagne pendant de nombreuses annees.
                </p>
                <p>
                    En 1964, il s'installe en France ou il contribue enormement au developpement de l'aikido.
                    Directeur technique de la <strong>FFAB</strong> (Federation Francaise d'Aikido et de Budo),
                    il forme des generations de pratiquants et d'enseignants, laissant un heritage technique
                    et philosophique considerable.
                </p>
                <p>
                    Son ouvrage "<strong>Aikido</strong>" reste une reference pour tous les pratiquants.
                    Les fondations qu'il a formalisees sont aujourd'hui au coeur de l'enseignement FFAB
                    et permettent de transmettre l'essence de la discipline du fondateur.
                </p>
                <p>
                    Maitre Tamura s'est eteint le 9 juillet 2010 a Saint-Maximin-la-Sainte-Baume, laissant derriere lui
                    un heritage immense pour l'aikido mondial.
                </p>
            </div>

            <div class="info-box mt-4" style="max-width: 700px; margin: var(--spacing-xl) auto 0; text-align: center;">
                <h4 class="info-box__title">Citation</h4>
                <blockquote style="font-style: italic; margin: var(--spacing-md) 0;">
                    "L'aikido n'est pas une technique de combat mais un moyen de s'ameliorer soi-meme
                    en harmonie avec les autres et avec la nature."
                </blockquote>
                <p style="color: var(--color-text-light);">- Maitre Nobuyoshi Tamura</p>
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
                    <a href="aikido.php" class="btn btn--outline">Decouvrir l'aikido</a>
                    <a href="grades.php" class="btn btn--outline">Les grades</a>
                </div>
            </div>
        </div>
    </section>



                </blockquote>

                <p>
                    Ces fondations sont les elements structurants avec lesquels il est possible de developper
                    le <strong>sens de la globalite</strong>. Il ne s'agit pas simplement d'accumuler des
                    connaissances techniques mais d'approfondir inlassablement ces notions.
                </p>
            </div>

            <!-- Resume des 10 fondations -->
            <div class="fondation-summary">
                <h3 class="fondation-summary__title">Les 10 Fondations</h3>
                <ul class="fondation-summary__list">
                    <li class="fondation-summary__item"><span>1.</span> Shisei (Posture)</li>
                    <li class="fondation-summary__item"><span>2.</span> Kokyu (Respiration)</li>
                    <li class="fondation-summary__item"><span>3.</span> Kamae (Garde)</li>
                    <li class="fondation-summary__item"><span>4.</span> Ma-ai (Distance)</li>
                    <li class="fondation-summary__item"><span>5.</span> Irimi (Entree)</li>
                    <li class="fondation-summary__item"><span>6.</span> Tenkan (Rotation)</li>
                    <li class="fondation-summary__item"><span>7.</span> Ura / Omote (Aspects)</li>
                    <li class="fondation-summary__item"><span>8.</span> Tai sabaki (Deplacement)</li>
                    <li class="fondation-summary__item"><span>9.</span> Atemi (Coup)</li>
                    <li class="fondation-summary__item"><span>10.</span> Kokyu ryoku (Puissance)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Les 10 Fondations detaillees -->
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
                            <strong>Sugata</strong> (forme, figure, taille) et <strong>Ikioi</strong> (force, vigueur, vivacite).
                        </p>
                        <ul class="fondation-card__points">
                            <li>La posture est a la fois physique et mentale</li>
                            <li>Un maintien qui met le pratiquant en eveil, disponible</li>
                            <li>Tete, epaules, hanches et pieds parfaitement alignes</li>
                            <li>Non seulement une attitude externe mais aussi une force interieure visible de l'exterieur</li>
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
                            Au-dela de la simple oxygenation, la respiration controlee offre des benefices
                            depassant la fonction vitale, particulierement lors d'efforts physiques intenses.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Un bon kokyu est lent, profond, long et naturel</li>
                            <li>C'est une respiration abdominale</li>
                            <li>Au debut, accentuer l'expiration puis laisser l'inspiration se faire naturellement</li>
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
                            "Se tenir pret, se mettre en garde." Kamae contient a la fois les forces du ki
                            et le pouvoir de percevoir tous les details. En aikido, on utilise <strong>hanmi no kamae</strong>
                            (garde de profil).
                        </p>
                        <ul class="fondation-card__points">
                            <li>Position qui prepare aux evenements futurs</li>
                            <li>Peut prevenir l'affrontement ou conditionner les premiers echanges</li>
                            <li><strong>Migi hanmi</strong> : garde droite (pied droit avance)</li>
                            <li><strong>Hidari hanmi</strong> : garde gauche (pied gauche avance)</li>
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
                            L'espace "convenable" qui separe deux aikidokas sans qu'il soit possible d'en donner
                            une valeur precise. Certains le ressentent instinctivement, d'autres necessitent un apprentissage.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Notion a la fois spatiale et temporelle</li>
                            <li>Intervalle juste entre les partenaires</li>
                            <li>Varie selon la situation et l'intention</li>
                            <li>Necessite une perception fine et une adaptation constante</li>
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
                        <p class="fondation-card__definition">L'Entree / La Penetration</p>
                        <p class="fondation-card__description">
                            "Entrer, penetrer, transpercer." Quand deux forces se deplacent dans des directions opposees,
                            irimi est l'utilisation de cette force resultante en relation avec sa propre position
                            au moment du croisement.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Avancer en reduisant la distance tout en controlant l'adversaire</li>
                            <li><strong>Irimi issoku</strong> : entrer d'un pas sur le cote du partenaire</li>
                            <li>Retourner la force de l'attaque</li>
                            <li>Rendre l'adversaire moins menacant</li>
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
                            Transformer un mouvement lineaire en mouvement circulaire par changement de direction
                            autour d'un pivot. Le pied avant sert de point de rotation.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Pivot a 180 degres sur le pied avant</li>
                            <li>Rotation du corps tout en gardant le contact</li>
                            <li>Permet de rediriger l'energie de l'attaque</li>
                            <li><strong>Irimi-tenkan</strong> : combinaison entree + rotation</li>
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
                        <p class="fondation-card__definition">Les Aspects Cache / Visible</p>
                        <p class="fondation-card__description">
                            Une technique en aikido a deux aspects : <strong>ura waza</strong> et <strong>omote waza</strong>.
                            Ces deux facettes coexistent dans la plupart des techniques.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Ura</strong> : l'envers, le verso, l'aspect cache des choses</li>
                            <li><strong>Omote</strong> : la surface, l'exterieur, l'aspect apparent</li>
                            <li>Omote : entree vers l'avant du partenaire</li>
                            <li>Ura : entree vers l'arriere du partenaire</li>
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
                        <p class="fondation-card__definition">Le Deplacement du corps</p>
                        <p class="fondation-card__description">
                            "L'essence de l'aikido" : se deplacer pour eviter l'attaque, se positionner favorablement
                            et destabiliser l'adversaire simultanement.
                        </p>
                        <ul class="fondation-card__points">
                            <li><strong>Tsugi ashi</strong> : pas glisse (pied arriere rejoint l'avant)</li>
                            <li><strong>Ayumi ashi</strong> : marche normale alternee</li>
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
                            Les coups existent dans l'aikido pour maintenir la distance ou controler l'adversaire
                            durant les techniques. Ils sont generalement simules en pratique.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Outil de destabilisation et de controle</li>
                            <li>Permet de creer une ouverture</li>
                            <li>Maintient la distance de securite</li>
                            <li>Element essentiel souvent sous-estime</li>
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
                            Depasse la respiration seule en procurant puissance, precision et controle total
                            de l'adversaire. C'est la coordination de la puissance a travers le souffle.
                        </p>
                        <ul class="fondation-card__points">
                            <li>Puissance qui vient du centre (hara)</li>
                            <li>Coordination corps-souffle-esprit</li>
                            <li>Controle sans force musculaire excessive</li>
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
                    (litteralement "corps qui recoit") sont un element fondamental de la pratique,
                    aussi important que les techniques elles-memes.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mae ukemi</h3>
                            <p class="card__text">
                                <strong>Chute avant roulee</strong> : reception souple en roulant vers l'avant.
                                La plus courante, elle permet de se relever rapidement en position de garde.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ushiro ukemi</h3>
                            <p class="card__text">
                                <strong>Chute arriere roulee</strong> : reception en roulant vers l'arriere.
                                Necessite de bien rentrer le menton et d'arrondir le dos.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Yoko ukemi</h3>
                            <p class="card__text">
                                <strong>Chute laterale</strong> : reception sur le cote avec frappe du bras
                                pour amortir. Utilisee pour certaines projections specifiques.
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Tobu ukemi</h3>
                            <p class="card__text">
                                <strong>Chute plaquee</strong> : projection aerienne avec reception dynamique.
                                Requiert une bonne maitrise des ukemi de base.
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
                        <h3 class="tamura-bio__name">Maitre Nobuyoshi Tamura</h3>
                        <p class="tamura-bio__dates">2 mars 1933 - 9 juillet 2010</p>
                    </div>
                </div>
                <p>
                    Ne a Osaka en 1933, <strong>Nobuyoshi Tamura</strong> debute la pratique des arts martiaux tres jeune.
                    Il devient rapidement l'un des eleves les plus proches de <strong>O Sensei Morihei Ueshiba</strong>,
                    fondateur de l'aikido, qu'il accompagne pendant de nombreuses annees.
                </p>
                <p>
                    En 1964, il s'installe en France ou il contribue enormement au developpement de l'aikido.
                    Directeur technique de la <strong>FFAB</strong> (Federation Francaise d'Aikido et de Budo),
                    il forme des generations de pratiquants et d'enseignants, laissant un heritage technique
                    et philosophique considerable.
                </p>
                <p>
                    Son ouvrage "<strong>Aikido</strong>" reste une reference pour tous les pratiquants.
                    Les fondations qu'il a formalisees sont aujourd'hui au coeur de l'enseignement FFAB
                    et permettent de transmettre l'essence de la discipline du fondateur.
                </p>
                <p>
                    Maitre Tamura s'est eteint le 9 juillet 2010 a Saint-Maximin-la-Sainte-Baume, laissant derriere lui
                    un heritage immense pour l'aikido mondial.
                </p>
            </div>

            <div class="info-box mt-4" style="max-width: 700px; margin: var(--spacing-xl) auto 0; text-align: center;">
                <h4 class="info-box__title">Citation</h4>
                <blockquote style="font-style: italic; margin: var(--spacing-md) 0;">
                    "L'aikido n'est pas une technique de combat mais un moyen de s'ameliorer soi-meme
                    en harmonie avec les autres et avec la nature."
                </blockquote>
                <p style="color: var(--color-text-light);">- Maitre Nobuyoshi Tamura</p>
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
                    <a href="aikido.php" class="btn btn--outline">Decouvrir l'aikido</a>
                    <a href="grades.php" class="btn btn--outline">Les grades</a>
                </div>
            </div>
        </div>
    </section>



    <!-- JavaScript -->
    <script src="js/main.js"></script>
</body>
</html>
