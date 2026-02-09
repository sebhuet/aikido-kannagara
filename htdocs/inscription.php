<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Inscription | Rejoindre le club d'aïkido de Guyancourt</title>
    <meta name="description" content="Inscrivez-vous au club Kannagara Aïkido de Guyancourt. Cours d'essai gratuits en septembre, documents nécessaires, équipement. Enfants dès 7 ans, adultes tous niveaux.">
    <meta name="keywords" content="inscription aikido, cours essai, tarif aikido, Guyancourt, enfants aikido, débutant">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/inscription.html">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/inscription.html">
    <meta property="og:title" content="S'inscrire au club Kannagara Aïkido">
    <meta property="og:description" content="Rejoignez notre club d'aïkido. Cours d'essai gratuits en septembre.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

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

                <h2>Essayer avant de s'inscrire</h2>
                <p>
                    Avant de vous engager, nous vous proposons de venir <strong>essayer gratuitement</strong>
                    pendant les cours d'essai en septembre ou lors de nos séances d'initiation.
                </p>

                <div class="info-box">
                    <h4 class="info-box__title">Portes ouvertes</h4>
                    <p>
                        Pendant tout le mois de <strong>septembre</strong>, les cours sont ouverts
                        aux personnes souhaitant découvrir l'aïkido. Prêt de kimono possible.
                    </p>
                    <p><a href="actualites.php">Voir les dates des événements</a></p>
                </div>

                <h2>Documents nécessaires</h2>
                <p>Pour vous inscrire, vous devrez fournir les documents suivants :</p>

                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Fiche d'inscription</h3>
                            <p class="card__text">
                                Formulaire d'inscription au club, à compléter et signer.
                                Disponible sur place ou sur demande par email.
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Certificat médical</h3>
                            <p class="card__text">
                                Certificat médical de non contre-indication à la pratique
                                de l'aïkido, daté de moins d'un an.
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

                <h2>Tarifs saison 2024-2025</h2>
                <p>
                    La cotisation annuelle comprend la licence FFAB, l'assurance et l'accès à tous les cours.
                    Le règlement peut s'effectuer en plusieurs fois.
                </p>

                <div class="tarifs-grid">
                    <div class="tarif-card">
                        <h3 class="tarif-card__title">Enfants</h3>
                        <div class="tarif-card__price">180€ <span>/ an</span></div>
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
                        <div class="tarif-card__price">280€ <span>/ an</span></div>
                        <p class="tarif-card__description">À partir de 15 ans</p>
                        <ul class="tarif-card__features">
                            <li>2 cours par semaine (4h)</li>
                            <li>Licence FFAB incluse</li>
                            <li>Assurance incluse</li>
                            <li>Passages de grades</li>
                            <li>Accès aux stages</li>
                        </ul>
                    </div>

                    <div class="tarif-card">
                        <h3 class="tarif-card__title">Tarif réduit</h3>
                        <div class="tarif-card__price">230€ <span>/ an</span></div>
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
                        Une réduction de <strong>10%</strong> est accordée à partir de la 2e inscription
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
                    <li><strong>Hakama</strong> : Pantalon traditionnel, généralement à partir du 3e kyu</li>
                    <li><strong>Armes</strong> (optionnel) : Jo (bâton), bokken (sabre en bois), tanto (couteau en bois)</li>
                </ul>
                <p>
                    Pour les premiers cours d'essai, un survêtement propre peut suffire.
                    Le club peut prêter un kimono pour les séances d'initiation.
                </p>

                <h2>Comment s'inscrire ?</h2>
                <div class="info-box">
                    <h4 class="info-box__title">Procédure d'inscription</h4>
                    <ol>
                        <li>Venez assister à un cours d'essai (gratuit en septembre)</li>
                        <li>Récupérez la fiche d'inscription auprès des professeurs</li>
                        <li>Complétez le dossier avec les documents demandés</li>
                        <li>Remettez le dossier complet avec le règlement</li>
                    </ol>
                    <p class="mt-2">
                        L'inscription peut se faire directement au dojo, aux horaires des cours.
                    </p>
                </div>

                <h2 id="pre-inscription">Formulaire de pré-inscription</h2>
                <p>
                    Remplissez ce formulaire pour manifester votre intérêt. Nous vous recontacterons
                    pour organiser votre venue au club et votre cours d'essai.
                </p>

                <form class="mt-3" action="https://formspree.io/f/xwpezlgn" method="POST" style="background: var(--color-bg-alt); padding: var(--spacing-xl); border-radius: 8px;">
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

                    <input type="hidden" name="_subject" value="Nouvelle pré-inscription Kannagara">
                    <input type="hidden" name="_next" value="https://kannagara.fr/inscription.html?merci=1">

                    <div class="text-center">
                        <button type="submit" class="btn btn--primary">Envoyer ma pré-inscription</button>
                    </div>
                </form>

                <h2>Questions fréquentes</h2>

                <div class="info-box">
                    <h4 class="info-box__title">À partir de quel âge peut-on s'inscrire ?</h4>
                    <p>
                        Les cours enfants accueillent les jeunes à partir de <strong>7 ans</strong>.
                        Les cours adultes sont ouverts à partir de <strong>15 ans</strong>.
                    </p>
                </div>

                <div class="info-box">
                    <h4 class="info-box__title">Faut-il avoir déjà pratiqué un art martial ?</h4>
                    <p>
                        Non, aucune expérience préalable n'est requise. L'aïkido est accessible
                        à tous, quel que soit le niveau de condition physique.
                    </p>
                </div>

                <div class="info-box">
                    <h4 class="info-box__title">Peut-on s'inscrire en cours d'année ?</h4>
                    <p>
                        Oui, il est possible de rejoindre le club en cours d'année.
                        La cotisation sera ajustée au prorata des mois restants.
                    </p>
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
    <script src="js/main.js"></script>
</body>
</html>
