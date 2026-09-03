<?php require_once __DIR__ . '/includes/data.php'; $club = club_data(); $p = $club['pricing']; $cur = $p['currency']; ?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Inscription | Rejoindre le club d'aïkido de Guyancourt</title>
    <meta name="description" content="Inscription au club Aïkido Kannagara Guyancourt. Cours d'essai gratuits en <?= htmlspecialchars($club['trial']['freePeriod']) ?>, documents nécessaires, équipement. Enfants dès 7 ans, adultes tous niveaux.">
    <meta name="keywords" content="inscription aïkido, cours essai, tarif aïkido, Guyancourt, enfants aïkido, débutant">
    <meta name="author" content="Aïkido Kannagara Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/inscription.php">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/inscription.php">
    <meta property="og:title" content="S'inscrire au club Aïkido Kannagara Guyancourt">
    <meta property="og:description" content="Rejoignez notre club d'aïkido. Cours d'essai gratuits en <?= htmlspecialchars($club['trial']['freePeriod']) ?>.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.jpg">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="S'inscrire au club Aïkido Kannagara Guyancourt">
    <meta name="twitter:description" content="Rejoignez notre club d'aïkido. Cours d'essai gratuits en <?= htmlspecialchars($club['trial']['freePeriod']) ?>.">
    <meta name="twitter:image" content="https://kannagara.fr/images/logo-kannagara.jpg">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Course",
        "name": "Cours d'Aïkido - Kannagara",
        "description": "Inscrivez-vous au club Aïkido Kannagara Guyancourt. Cours d'essai gratuits en <?= htmlspecialchars($club['trial']['freePeriod']) ?>, documents nécessaires, équipement. Enfants dès 7 ans, adultes tous niveaux.",
        "url": "https://kannagara.fr/inscription.php",
        "provider": {
            "@type": "Organization",
            "name": "Aïkido Kannagara Guyancourt",
            "url": "https://kannagara.fr",
            "logo": {
                "@type": "ImageObject",
                "url": "https://kannagara.fr/images/logo-kannagara.jpg"
            }
        },
        "location": {
            "@type": "Place",
            "name": "Gymnase Maurice Baquet",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Mail des Graviers",
                "addressLocality": "Guyancourt",
                "postalCode": "78280",
                "addressCountry": "FR"
            }
        },
        "offers": [
            {
                "@type": "Offer",
                "name": "Enfants (7-14 ans)",
                "price": "<?= $p['children'] ?>",
                "priceCurrency": "<?= $cur ?>",
                "eligibleCustomerType": "http://schema.org/Student",
                "description": "2 cours par semaine, licence FFAB et assurance incluses"
            },
            {
                "@type": "Offer",
                "name": "Adultes (15 ans et +)",
                "price": "<?= $p['adults'] ?>",
                "priceCurrency": "<?= $cur ?>",
                "description": "2 cours par semaine (6h), licence FFAB et assurance incluses, accès aux stages"
            },
            {
                "@type": "Offer",
                "name": "Tarif réduit (étudiants, chômeurs)",
                "price": "<?= $p['reduced'] ?>",
                "priceCurrency": "<?= $cur ?>",
                "description": "Sur justificatif, mêmes avantages adultes, licence FFAB et assurance incluses"
            }
        ],
        "hasCourseInstance": [
            {
                "@type": "CourseInstance",
                "courseMode": "onsite",
                "courseWorkload": "PT6H",
                "inLanguage": "fr"
            }
        ]
    }
    </script>

    <style>
        /* Tarifs */
        .tarifs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-lg);
            margin: var(--spacing-xl) 0;
        }

        .tarif-card {
            background: white;
            border: 2px solid var(--color-border);
            border-radius: 8px;
            padding: var(--spacing-xl);
            text-align: center;
            transition: all 0.3s ease;
        }

        .tarif-card:hover {
            border-color: var(--color-accent);
            box-shadow: var(--shadow-lg);
        }

        .tarif-card--featured {
            border-color: var(--color-accent);
            position: relative;
        }

        .tarif-card--featured::before {
            content: "Populaire";
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--color-accent);
            color: white;
            padding: 4px 16px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .tarif-card__title {
            font-size: 1.3rem;
            color: var(--color-primary);
            margin-bottom: var(--spacing-sm);
        }

        .tarif-card__price {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-secondary);
            margin-bottom: var(--spacing-xs);
        }

        .tarif-card__price span {
            font-size: 1rem;
            font-weight: 400;
            color: var(--color-text-light);
        }

        .tarif-card__description {
            color: var(--color-text-light);
            margin-bottom: var(--spacing-md);
        }

        .tarif-card__features {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .tarif-card__features li {
            padding: var(--spacing-xs) 0;
            padding-left: 24px;
            position: relative;
        }

        .tarif-card__features li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: var(--color-accent);
            font-weight: bold;
        }

        /* Formulaire */
        .form-group {
            margin-bottom: var(--spacing-md);
        }

        .form-group label {
            display: block;
            margin-bottom: var(--spacing-xs);
            font-weight: 600;
            color: var(--color-primary);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: var(--spacing-sm) var(--spacing-md);
            border: 1px solid var(--color-border);
            border-radius: 4px;
            font-family: var(--font-body);
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--color-accent);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-md);
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-checkbox {
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-sm);
        }

        .form-checkbox input {
            width: auto;
            margin-top: 4px;
        }

        .form-checkbox label {
            font-weight: 400;
        }
    </style>
</head>
<body>
    <?php $active = 'inscription'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Inscription</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Inscription
            </p>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 900px; margin: 0 auto;">

                <p class="text-center" style="font-size: 1.125rem; margin-bottom: var(--spacing-xl);">
                    Vous souhaitez rejoindre le club Kannagara ? Voici toutes les informations
                    pour vous inscrire et commencer la pratique de l'aïkido.
                </p>

                <h2 id="essai">Essayer avant de s'inscrire</h2>
                <p>
                    <?= htmlspecialchars($club['trial']['invitation']) ?>
                </p>

                <div class="info-box">
                    <h4 class="info-box__title">Portes ouvertes</h4>
                    <p>
                        Pendant tout le mois de <strong><?= htmlspecialchars($club['trial']['freePeriod']) ?></strong>,
                        les cours d'essai sont <strong>gratuits</strong> et ouverts à toutes les personnes
                        souhaitant découvrir l'aïkido. Une tenue de sport (jogging) convient pour les cours d'essai.
                        Ces portes ouvertes s'inscrivent dans l'opération nationale
                        <a href="septembre-bouge.php">Septembre Bouge</a>.
                    </p>
                    <p><a href="actualites.php">Voir les dates des événements</a></p>
                </div>

                <h2 id="temoignage">Le témoignage d'un parent</h2>
                <figure class="temoignage">
                    <blockquote>
                        <p>
                            Mes deux enfants ont pratiqué l’aïkido pendant plusieurs années et sont tous les deux
                            ravis de cette activité. Ils ont pu bénéficier d’un cadre à la fois sérieux et
                            bienveillant, qui leur a permis de progresser continuellement tout en prenant confiance
                            en leurs capacités.
                        </p>
                        <p>
                            Ils attendaient toujours les cours avec impatience et avaient plaisir à nous raconter
                            les nouvelles choses apprises et les petites réussites accomplies. Les professeurs sont
                            très attentionnés, à l’écoute et savent encourager chaque enfant en respectant son
                            rythme et sa personnalité.
                        </p>
                        <p>
                            Les passages de ceinture sont également de grands moments de fierté, très gratifiants
                            pour les enfants et qui leur permettent de mesurer le chemin parcouru. L’ambiance des
                            cours est formidable : il y a de l’exigence et de la discipline, mais toujours dans la
                            bonne humeur et la détente.
                        </p>
                        <p>
                            Ma fille, qui continue l’année prochaine, souligne d’ailleurs que c’est à l’aïkido
                            qu’elle a noué ses meilleures amitiés, et les plus durables !
                        </p>
                        <p>
                            Je recommande donc ce club les yeux fermés à tout parent qui hésiterait à y inscrire
                            son enfant. Et puisque l’on peut toujours commencer par un cours d’essai avant de
                            s’engager, n’hésitez pas à tenter l’expérience : c’est sans doute le meilleur moyen de
                            se faire une idée et de prendre une décision en toute confiance.
                        </p>
                    </blockquote>
                    <figcaption>Laëtitia Coilliot, maman de Niels et Thémis</figcaption>
                </figure>

                <h2>Documents nécessaires</h2>
                <p>Pour vous inscrire, vous devrez fournir les documents suivants :</p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Fiche d'inscription</h3>
                            <p class="card__text">
                                Formulaire d'inscription au club, à compléter et signer.
                            </p>
                            <p class="card__text">
                                <a href="docs/Bulletin%20adh%C3%A9sion%20adulte%202026%20-%202027.pdf" target="_blank">Bulletin adultes 2026-2027 (PDF)</a><br>
                                <a href="docs/Bulletin%20adh%C3%A9sion%20mineur%202026%20-%202027.pdf" target="_blank">Bulletin mineurs 2026-2027 (PDF)</a>
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Attestation de santé</h3>
                            <p class="card__text">
                                Dans la plupart des cas, un simple questionnaire de santé suffit :
                                le certificat médical n'est plus demandé chaque année.
                            </p>
                            <p class="card__text">
                                <a href="#sante">Voir la règle et les documents</a>
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Photo d'identité</h3>
                            <p class="card__text">
                                Une photo d'identité récente pour la licence fédérale.
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Règlement</h3>
                            <p class="card__text">
                                Paiement de la cotisation annuelle. Possibilité de
                                règlement en plusieurs fois.
                            </p>
                        </div>
                    </div>
                </div>

                <h2 id="sante">Certificat médical et questionnaire de santé</h2>
                <p>
                    La réglementation a évolué : le certificat médical annuel n'est plus la règle.
                    Il est le plus souvent remplacé par un <strong>questionnaire de santé</strong> que vous
                    remplissez chez vous. Ce questionnaire est <strong>confidentiel</strong> : il ne se remet
                    ni au club, ni à la fédération. Vous ne nous transmettez que l'<strong>attestation</strong>
                    datée et signée indiquant que toutes vos réponses sont négatives.
                </p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Majeurs (18 ans et plus)</h3>
                            <p class="card__text">
                                Un <strong>certificat médical</strong> de non contre-indication à la pratique de
                                l'aïkido est exigé lors de la <strong>première licence</strong>, puis
                                <strong>tous les 3 ans</strong>.
                            </p>
                            <p class="card__text">
                                Les deux années intermédiaires, il suffit de remplir le questionnaire de santé
                                « QS-Sport » et de remettre l'attestation. Mais si <strong>au moins une réponse
                                est OUI</strong> (traitement de longue durée, problème de santé, avis médical
                                nécessaire…), un <strong>certificat médical doit être fourni cette année-là</strong> :
                                en pratique, les personnes suivies médicalement ou sous traitement le renouvellent
                                chaque année.
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Mineurs (moins de 18 ans)</h3>
                            <p class="card__text">
                                <strong>Aucun certificat médical n'est demandé.</strong> Le questionnaire de santé du
                                sportif mineur est rempli avec l'enfant, et le représentant légal remet l'attestation
                                au club.
                            </p>
                            <p class="card__text">
                                Un certificat médical de <strong>moins de 6 mois</strong> n'est exigé que si
                                <strong>au moins une réponse est OUI</strong>.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="info-box">
                    <h4 class="info-box__title">Documents à télécharger</h4>
                    <ul>
                        <li>
                            <a href="docs/Questionnaire%20sant%C3%A9%20adultes.pdf" target="_blank">Questionnaire de santé « QS-Sport » — majeurs (PDF)</a>
                            — Cerfa n° 15699*01. À conserver, ne pas remettre au club.
                        </li>
                        <li>
                            <a href="docs/Questionnaire%20sant%C3%A9%20mineurs.pdf" target="_blank">Questionnaire de santé du sportif mineur (PDF)</a>
                            — à remplir avec l'enfant. À conserver également.
                        </li>
                        <li>
                            <a href="docs/Attestation%20questionnaire%20sant%C3%A9.pdf" target="_blank">Attestation à remettre au club (PDF)</a>
                            — à dater, signer et joindre au dossier d'inscription.
                        </li>
                    </ul>
                    <p class="mt-2">
                        Si une réponse au questionnaire est positive, présentez-le à votre médecin : c'est lui qui
                        établira le certificat médical.
                    </p>
                </div>

                <p>
                    L'âge qui compte ici est l'âge légal (18 ans), et non la catégorie tarifaire du club :
                    un adhérent de 15 à 17 ans inscrit au tarif adulte relève des règles applicables aux mineurs.
                </p>
                <p>
                    <strong>Passages de grades dan</strong> : la FFAB exige un certificat médical de non
                    contre-indication à la <strong>pratique intensive</strong> de l'aïkido datant de moins d'un an.
                    Voir les <a href="https://www.ffabaikido.com/fr/certificat-m-dical-questionnaire-de-sant-191.html" target="_blank" rel="noopener">informations médicales de la FFAB</a>.
                </p>

                <h2>Tarifs saison <?= htmlspecialchars($club['season']) ?></h2>
                <p>
                    La cotisation annuelle comprend la licence FFAB, l'assurance et l'accès à tous les cours.
                    Le règlement peut s'effectuer en plusieurs fois.
                </p>

                <div class="tarifs-grid">
                    <div class="tarif-card">
                        <h3 class="tarif-card__title">Enfants</h3>
                        <div class="tarif-card__price"><?= $p['children'] ?>€ <span>/ an</span></div>
                        <p class="tarif-card__description">7 à 14 ans</p>
                        <ul class="tarif-card__features">
                            <li>2 cours par semaine</li>
                            <li>Licence FFAB incluse</li>
                            <li>Assurance incluse</li>
                            <li>Passages de grades</li>
                        </ul>
                    </div>

                    <div class="tarif-card tarif-card--featured">
                        <h3 class="tarif-card__title">Adultes</h3>
                        <div class="tarif-card__price"><?= $p['adults'] ?>€ <span>/ an</span></div>
                        <p class="tarif-card__description">À partir de 15 ans</p>
                        <ul class="tarif-card__features">
                            <li>4 cours par semaine (6h)</li>
                            <li>Licence FFAB incluse</li>
                            <li>Assurance incluse</li>
                            <li>Passages de grades</li>
                            <li>Accès aux stages</li>
                        </ul>
                    </div>

                    <div class="tarif-card">
                        <h3 class="tarif-card__title">Tarif réduit</h3>
                        <div class="tarif-card__price"><?= $p['reduced'] ?>€ <span>/ an</span></div>
                        <p class="tarif-card__description">Étudiants, chômeurs</p>
                        <ul class="tarif-card__features">
                            <li>Sur justificatif</li>
                            <li>Mêmes avantages adultes</li>
                            <li>Licence FFAB incluse</li>
                            <li>Assurance incluse</li>
                        </ul>
                    </div>
                </div>

                <div class="info-box">
                    <h4 class="info-box__title">Tarif famille</h4>
                    <p>
                        Une réduction de <strong><?= $p['familyDiscountPercent'] ?>%</strong> est accordée à partir de la <?= $p['familyDiscountFrom'] ?>e inscription
                        d'un même foyer. Contactez-nous pour en bénéficier.
                    </p>
                </div>

                <h2>Ce que comprend l'inscription</h2>
                <ul>
                    <li><strong>Licence FFAB</strong> : Affiliation à la Fédération Française d'Aïkido et de Budo</li>
                    <li><strong>Assurance</strong> : Couverture pour la pratique au dojo et lors des stages</li>
                    <li><strong>Accès aux cours</strong> : Tous les cours de la semaine selon votre catégorie</li>
                    <li><strong>Participation aux stages</strong> : Possibilité de participer aux stages fédéraux</li>
                    <li><strong>Passages de grades</strong> : Organisation des examens de kyu au sein du club</li>
                </ul>

                <h2>Équipement nécessaire</h2>
                <p>
                    Pour pratiquer l'aïkido, vous aurez besoin de :
                </p>
                <ul>
                    <li><strong>Keikogi</strong> (kimono blanc) : Indispensable dès les premiers cours</li>
                    <li><strong>Zoori</strong> (sandales japonaises) : Pour circuler autour du tatami</li>
                    <li><strong>Hakama</strong> : Pantalon traditionnel, à partir du <?= htmlspecialchars(club_data()['hakamaFromGrade']) ?></li>
                    <li><strong>Armes</strong> (optionnel) : Jo (bâton), bokken (sabre en bois), tanto (couteau en bois)</li>
                </ul>
                <p>
                    Pour les premiers cours d'essai, un survêtement propre peut suffire.
                </p>
                <p>
                    Il est possible de commander votre équipement par l'intermédiaire du club
                    auprès de notre partenaire <a href="https://www.budo-fight.com/catalogue/autres-disciplines/aikido" target="_blank" rel="noopener">BudoFight</a>.
                    N'hésitez pas à nous consulter avant tout achat.
                </p>

                <h2>Comment s'inscrire ?</h2>
                <div class="info-box">
                    <h4 class="info-box__title">Procédure d'inscription</h4>
                    <ol>
                        <li>Venez assister à un cours d'essai (gratuit en <?= htmlspecialchars($club['trial']['freePeriod']) ?>)</li>
                        <li>Récupérez la fiche d'inscription auprès des professeurs</li>
                        <li>Complétez le dossier avec les documents demandés</li>
                        <li>Remettez le dossier complet avec le règlement</li>
                    </ol>
                    <p class="mt-2">
                        L'inscription peut se faire directement au dojo, aux horaires des cours.
                    </p>
                </div>

                <h2 id="preinscription">Formulaire de pré-inscription</h2>
                <p>
                    Remplissez ce formulaire pour manifester votre intérêt. Nous vous recontacterons
                    pour organiser votre venue au club et votre cours d'essai.
                </p>

                <?php if (isset($_GET['merci'])): ?>
                <div class="info-box" style="background: #e8f5e9; border-left: 4px solid #4caf50;">
                    <p style="margin: 0; color: #2e7d32;">
                        <strong>Merci pour votre pré-inscription !</strong><br>
                        Nous avons bien reçu votre demande et vous recontacterons rapidement
                        pour organiser votre venue au club.
                    </p>
                </div>
                <?php endif; ?>

                <form class="mt-3" action="https://api.web3forms.com/submit" method="POST" style="background: var(--color-bg-alt); padding: var(--spacing-xl); border-radius: 8px;">
                    <input type="hidden" name="access_key" value="ebb9e2e7-db3b-468a-af9a-26b88981b40d">
                    <input type="hidden" name="subject" value="Nouvelle pré-inscription Kannagara">
                    <input type="hidden" name="from_name" value="Site kannagara.fr">
                    <input type="hidden" name="redirect" value="https://kannagara.fr/inscription.php?merci=1#preinscription">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nom">Nom *</label>
                            <input type="text" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom *</label>
                            <input type="text" id="prenom" name="prenom" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" id="telephone" name="telephone">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="categorie">Catégorie *</label>
                            <select id="categorie" name="categorie" required>
                                <option value="">Choisissez...</option>
                                <option value="enfant">Enfant (7-14 ans)</option>
                                <option value="adulte">Adulte (15 ans et +)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="experience">Expérience en aïkido</label>
                            <select id="experience" name="experience">
                                <option value="">Choisissez...</option>
                                <option value="debutant">Débutant complet</option>
                                <option value="initie">Quelques cours</option>
                                <option value="pratiquant">Pratiquant (précisez le grade)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Message (questions, disponibilités...)</label>
                        <textarea id="message" name="message" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="form-checkbox">
                            <input type="checkbox" id="rgpd" name="rgpd" required>
                            <label for="rgpd">
                                J'accepte que mes données soient utilisées pour me recontacter
                                dans le cadre de ma demande de pré-inscription. *
                            </label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn--primary">Envoyer ma pré-inscription</button>
                    </div>
                </form>

                <p class="mt-3" style="text-align: center; font-size: 0.95em; color: var(--color-text-light);">
                    Nous accueillons des pratiquants de Guyancourt et des communes voisines :
                    Montigny-le-Bretonneux, Voisins-le-Bretonneux, Élancourt, Versailles, Vélizy-Villacoublay
                    et tout Saint-Quentin-en-Yvelines.
                </p>

                <h2>Questions fréquentes</h2>
                <p>
                    Âge minimum, expérience préalable, inscription en cours d'année, équipement...
                    Retrouvez les réponses aux questions les plus courantes sur notre page dédiée.
                </p>
                <div class="text-center mt-3">
                    <a href="faq.php" class="btn btn--outline">Consulter la FAQ</a>
                </div>

                <div class="text-center mt-4">
                    <a href="contact.php" class="btn btn--primary">Nous contacter</a>
                    <a href="actualites.php" class="btn btn--outline">Voir les prochains événements</a>
                </div>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
</body>
</html>
