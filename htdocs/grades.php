<?php require_once __DIR__ . '/includes/jsonld.php'; ?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Grades en Aïkido | Du 6e kyu au dan - Programme technique</title>
    <meta name="description" content="Système de grades en aïkido : kyu (6e au 1er) et dan (ceinture noire). Programme technique FFAB, conditions de passage, techniques par niveau.">
    <meta name="keywords" content="grade aïkido, kyu, dan, ceinture noire, programme technique, passage grade, FFAB">
    <meta name="author" content="Aïkido Kannagara Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/grades.php">

    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://kannagara.fr/grades.php">
    <meta property="og:title" content="Grades en Aïkido - Programme technique">
    <meta property="og:description" content="Du 6e kyu au dan : système de grades et programme technique FFAB.">
    <meta property="og:image" content="https://kannagara.fr/images/partage/kannagara.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Grades en Aïkido - Programme technique">
    <meta name="twitter:description" content="Du 6e kyu au dan : système de grades et programme technique FFAB.">
    <meta name="twitter:image" content="https://kannagara.fr/images/partage/kannagara.jpg">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        /* Liens vers la vidéothèque, sous le programme de chaque kyu */
        .grades-videos {
            display: inline-block;
            margin-top: 4px;
            font-size: 0.9em;
            white-space: nowrap;
        }
    </style>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "Grades en Aïkido - Du 6e kyu au dan, programme technique",
        "description": "Système de grades en aïkido : kyu (6e au 1er) et dan (ceinture noire). Programme technique FFAB, conditions de passage, techniques par niveau.",
        "url": "https://kannagara.fr/grades.php",
        "about": "Grades en Aïkido",
        "inLanguage": "fr",
        "author": <?= jsonld_json(jsonld_club_ref()) ?>,
        "publisher": <?= jsonld_json(jsonld_editeur()) ?>,
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "https://kannagara.fr/grades.php"
        }
    }
    </script>
</head>
<body>
    <?php $active = 'grades'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Les Grades</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Grades
            </p>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 900px; margin: 0 auto;">

                <h2>Le système de grades en Aïkido</h2>
                <p>
                    En aïkido, le système de grades permet de mesurer la progression technique
                    et l'engagement du pratiquant. Il se compose de deux types de grades :
                </p>
                <ul>
                    <li><strong>Les kyu</strong> (grades inférieurs) : Du 6e kyu au 1er kyu, portés avec une ceinture blanche</li>
                    <li><strong>Les dan</strong> (grades supérieurs) : À partir du 1er dan, portés avec une ceinture noire</li>
                </ul>

                <div class="info-box">
                    <h4 class="info-box__title">Particularité de l'aïkido</h4>
                    <p>
                        En aïkido, la tradition veut que la ceinture reste blanche jusqu'à l'obtention du 1er dan,
                        bien que certains clubs utilisent des ceintures de couleur pour marquer la progression,
                        notamment chez les enfants.
                        Dans notre dojo, le hakama se porte à partir du <?= htmlspecialchars(club_data()['hakamaFromGrade']) ?>.
                    </p>
                </div>

                <h2>Les grades Kyu</h2>
                <table class="grades-table">
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Niveau</th>
                            <th>Programme</th>
                            <th>Pratique minimale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Grade"><span class="grade-badge grade-badge--6kyu">6e Kyu</span></td>
                            <td data-label="Niveau">Débutant</td>
                            <td data-label="Programme">Chutes de base, postures, déplacements fondamentaux<br><span class="grades-videos"><a href="/videotheque/#vue=niveau&amp;niveau=6+Kyu" title="Techniques du 6e kyu en vidéo">En vidéo</a> · <a href="/videotheque/#interro&amp;niveau=6+Kyu" title="Le nom de la technique d'abord, la vidéo ensuite, comme au passage">S'interroger</a></span></td>
                            <td data-label="Pratique">3 mois</td>
                        </tr>
                        <tr>
                            <td data-label="Grade"><span class="grade-badge grade-badge--5kyu">5e Kyu</span></td>
                            <td data-label="Niveau">Débutant avancé</td>
                            <td data-label="Programme">Techniques de base (ikkyo, shihonage, iriminage)<br><span class="grades-videos"><a href="/videotheque/#vue=niveau&amp;niveau=5+Kyu" title="Techniques du 5e kyu en vidéo (niveaux précédents compris)">En vidéo</a> · <a href="/videotheque/#interro&amp;niveau=5+Kyu" title="Le nom de la technique d'abord, la vidéo ensuite, comme au passage">S'interroger</a></span></td>
                            <td data-label="Pratique">6 mois</td>
                        </tr>
                        <tr>
                            <td data-label="Grade"><span class="grade-badge grade-badge--4kyu">4e Kyu</span></td>
                            <td data-label="Niveau">Intermédiaire</td>
                            <td data-label="Programme">Techniques assises (suwari-waza), koshinage<br><span class="grades-videos"><a href="/videotheque/#vue=niveau&amp;niveau=4+Kyu" title="Techniques du 4e kyu en vidéo (niveaux précédents compris)">En vidéo</a> · <a href="/videotheque/#interro&amp;niveau=4+Kyu" title="Le nom de la technique d'abord, la vidéo ensuite, comme au passage">S'interroger</a></span></td>
                            <td data-label="Pratique">1 an</td>
                        </tr>
                        <tr>
                            <td data-label="Grade"><span class="grade-badge grade-badge--3kyu">3e Kyu</span></td>
                            <td data-label="Niveau">Intermédiaire avancé</td>
                            <td data-label="Programme">Techniques debout-assis (hanmi-handachi), armes<br><span class="grades-videos"><a href="/videotheque/#vue=niveau&amp;niveau=3+Kyu" title="Techniques du 3e kyu en vidéo (niveaux précédents compris)">En vidéo</a> · <a href="/videotheque/#interro&amp;niveau=3+Kyu" title="Le nom de la technique d'abord, la vidéo ensuite, comme au passage">S'interroger</a></span></td>
                            <td data-label="Pratique">1,5 an</td>
                        </tr>
                        <tr>
                            <td data-label="Grade"><span class="grade-badge grade-badge--2kyu">2e Kyu</span></td>
                            <td data-label="Niveau">Avancé</td>
                            <td data-label="Programme">Variations des techniques, travail libre<br><span class="grades-videos"><a href="/videotheque/#vue=niveau&amp;niveau=2+Kyu" title="Techniques du 2e kyu en vidéo (niveaux précédents compris)">En vidéo</a> · <a href="/videotheque/#interro&amp;niveau=2+Kyu" title="Le nom de la technique d'abord, la vidéo ensuite, comme au passage">S'interroger</a></span></td>
                            <td data-label="Pratique">2 ans</td>
                        </tr>
                        <tr>
                            <td data-label="Grade"><span class="grade-badge grade-badge--1kyu">1er Kyu</span></td>
                            <td data-label="Niveau">Pré-ceinture noire</td>
                            <td data-label="Programme">Maîtrise de l'ensemble du programme, randori<br><span class="grades-videos"><a href="/videotheque/#vue=niveau&amp;niveau=1+Kyu" title="Techniques du 1er kyu en vidéo (niveaux précédents compris)">En vidéo</a> · <a href="/videotheque/#interro&amp;niveau=1+Kyu" title="Le nom de la technique d'abord, la vidéo ensuite, comme au passage">S'interroger</a></span></td>
                            <td data-label="Pratique">3 ans</td>
                        </tr>
                    </tbody>
                </table>
                <p>
                    Pour réviser, la <a href="/videotheque/">vidéothèque</a> montre les techniques de chaque
                    kyu en vidéo, niveaux précédents compris. « S'interroger » fonctionne comme un passage :
                    le nom de la technique s'affiche, on l'exécute, puis la vidéo sert de corrigé.
                </p>

                <h2>Passages de grades au club</h2>
                <p>
                    Au club Kannagara, les passages de grades kyu sont organisés régulièrement,
                    généralement deux à trois fois par an. Les professeurs évaluent :
                </p>
                <ul>
                    <li>La maîtrise technique des formes demandées</li>
                    <li>La qualité des chutes (ukemi)</li>
                    <li>L'attitude et le comportement sur le tatami</li>
                    <li>L'assiduité aux cours</li>
                    <li>La participation à la vie du club</li>
                </ul>

                <div class="info-box">
                    <h4 class="info-box__title">Grades Dan (ceinture noire)</h4>
                    <p>
                        Les passages de grades dan sont organisés par la fédération (FFAB)
                        lors de stages nationaux ou régionaux. Ils nécessitent une préparation
                        spécifique et plusieurs années de pratique après le 1er kyu.
                    </p>
                    <p>
                        Le 1er dan correspond à environ 4-5 ans de pratique régulière
                        et marque le début du "vrai" apprentissage de l'aïkido.
                    </p>
                </div>

                <h2>Programme technique FFAB</h2>
                <p>
                    Le programme technique de la FFAB définit les connaissances requises
                    pour chaque niveau. Il comprend :
                </p>

                <h3>Techniques de base (Kihon)</h3>
                <ul>
                    <li><strong>Tachi-waza</strong> : Techniques debout</li>
                    <li><strong>Suwari-waza</strong> : Techniques à genoux</li>
                    <li><strong>Hanmi-handachi</strong> : Tori à genoux, uke debout</li>
                </ul>

                <h3>Techniques principales</h3>
                <ul>
                    <li>Ikkyo, Nikyo, Sankyo, Yonkyo, Gokyo (contrôles)</li>
                    <li>Shihonage, Iriminage, Kotegaeshi (projections)</li>
                    <li>Kokyunage, Tenchinage, Koshinage</li>
                    <li>Kaiten-nage, Jujinage, Sumiotoshi</li>
                </ul>

                <h3>Attaques (Kogeki)</h3>
                <ul>
                    <li>Saisies : Katate-dori, Ryote-dori, Kata-dori, Morote-dori...</li>
                    <li>Frappes : Shomen-uchi, Yokomen-uchi, Tsuki...</li>
                </ul>

                <h3>Travail aux armes (Buki-waza)</h3>
                <ul>
                    <li><strong>Jo</strong> : Bâton de 128 cm</li>
                    <li><strong>Bokken</strong> : Sabre en bois</li>
                    <li><strong>Tanto</strong> : Couteau en bois</li>
                </ul>
                <p><a href="armes.php">En savoir plus sur le travail aux armes</a></p>

                <div class="text-center mt-4">
                    <a href="inscription.php" class="btn btn--primary">Commencer l'aïkido</a>
                    <a href="professeurs.php" class="btn btn--outline">Nos professeurs</a>
                </div>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
</body>
</html>
