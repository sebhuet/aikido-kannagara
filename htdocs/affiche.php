<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Générateur d'affiches | Kannagara Aïkido</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <style>
        /* Layout formulaire au-dessus de la prévisualisation */
        .affiche-layout {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-xl);
            max-width: 900px;
            margin: 0 auto;
        }

        .affiche-form {
            background: white;
            padding: var(--spacing-xl);
            border-radius: 8px;
            box-shadow: var(--shadow-md);
        }

        .affiche-form h2 {
            margin-top: 0;
            color: var(--color-primary);
        }

        .affiche-form h3 {
            margin-top: var(--spacing-lg);
            margin-bottom: var(--spacing-sm);
            color: var(--color-secondary);
            font-size: 1.1rem;
        }

        .form-hint {
            font-size: 0.85rem;
            color: var(--color-text-light);
            font-style: italic;
            margin-bottom: var(--spacing-md);
        }

        .form-group {
            margin-bottom: var(--spacing-md);
        }

        .form-group label {
            display: block;
            margin-bottom: var(--spacing-xs);
            font-weight: 600;
            color: var(--color-primary);
        }

        .form-group input {
            width: 100%;
            padding: var(--spacing-sm) var(--spacing-md);
            border: 1px solid var(--color-border);
            border-radius: 4px;
            font-family: var(--font-body);
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--color-accent);
        }

        .form-group textarea {
            width: 100%;
            padding: var(--spacing-sm) var(--spacing-md);
            border: 1px solid var(--color-border);
            border-radius: 4px;
            font-family: var(--font-body);
            font-size: 1rem;
            transition: border-color 0.3s ease;
            resize: vertical;
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

        /* Prévisualisation */
        .affiche-preview-container {
        }

        .affiche-preview-wrapper {
            overflow: hidden;
            position: relative;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
        }

        .affiche-preview {
            width: 1240px;
            height: 1754px;
            position: relative;
            background-image: url('images/affiche-fond.jpg');
            background-size: cover;
            background-position: center;
            background-color: #1a2a4a;
            font-family: 'Century Gothic', 'Avenir', 'Helvetica Neue', sans-serif;
            transform-origin: top left;
        }

        /* Zone texte haut-droite : intervenant, date, horaires */
        .affiche-text--instructeur {
            position: absolute;
            top: 17%;
            right: 5%;
            text-align: right;
            max-width: 55%;
        }

        .affiche-text--instructeur .nom {
            font-size: 48px;
            font-weight: bold;
            color: #000;
            line-height: 1.15;
        }

        .affiche-text--instructeur .grade {
            font-size: 32px;
            font-weight: bold;
            color: #CE3030;
            line-height: 1.3;
            margin-top: 5px;
        }

        .affiche-text--instructeur .date {
            font-size: 30px;
            font-weight: bold;
            color: #000;
            margin-top: 20px;
        }

        .affiche-text--instructeur .horaires {
            font-size: 26px;
            color: #333;
            margin-top: 8px;
        }

        /* Zone texte gauche : lieu, tarifs, ouvert à */
        .affiche-text--infos {
            position: absolute;
            top: 55%;
            left: 5%;
            max-width: 42%;
        }

        .affiche-text--infos .ouvert {
            font-size: 26px;
            font-weight: bold;
            color: #000;
            margin-bottom: 15px;
        }

        .affiche-text--infos .lieu {
            font-size: 28px;
            color: #000;
            line-height: 1.5;
        }

        .affiche-text--infos .lieu strong {
            font-size: 30px;
        }

        .affiche-text--infos .tarifs {
            font-size: 26px;
            color: #000;
            margin-top: 15px;
            line-height: 1.6;
        }

        /* Boutons export */
        .affiche-export-buttons {
            display: flex;
            gap: var(--spacing-md);
            margin-top: var(--spacing-xl);
            flex-wrap: wrap;
        }

        .affiche-export-buttons .btn {
            flex: 1;
            min-width: 180px;
            text-align: center;
        }

        /* Photo intervenant — Codep */
        .affiche-photo {
            position: absolute;
            top: 35%;
            right: 5%;
            width: 280px;
            height: 350px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            border: 4px solid rgba(255,255,255,0.8);
        }

        .affiche-photo[src=""] {
            display: none;
        }

        /* Photo intervenant — Kannagara */
        .kn-photo {
            position: absolute;
            right: 80px;
            top: 440px;
            width: 240px;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border: 3px solid #e8e8f0;
            z-index: 5;
        }

        .kn-photo[src=""] {
            display: none;
        }

        /* Upload photo */
        .photo-upload {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
        }

        .photo-upload__preview {
            width: 60px;
            height: 75px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid var(--color-border);
            background: var(--color-bg-alt);
        }

        .photo-upload__preview[src=""] {
            display: none;
        }

        .photo-upload__clear {
            font-size: 0.85rem;
            color: var(--color-text-light);
            cursor: pointer;
            text-decoration: underline;
            border: none;
            background: none;
            padding: 0;
        }

        .photo-upload__clear:hover {
            color: #c0392b;
        }

        /* Sélecteur de template */
        .template-selector {
            display: flex;
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-lg);
        }

        .template-option {
            flex: 1;
            position: relative;
        }

        .template-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .template-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--spacing-sm);
            padding: var(--spacing-md);
            border: 2px solid var(--color-border);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 600;
        }

        .template-option label:hover {
            border-color: var(--color-accent);
        }

        .template-option input:checked + label {
            border-color: var(--color-accent);
            background: rgba(201, 163, 56, 0.08);
            box-shadow: 0 0 0 1px var(--color-accent);
        }

        .template-option__preview {
            width: 100%;
            height: 80px;
            border-radius: 4px;
            object-fit: cover;
        }

        .template-option__preview--codep {
            background: linear-gradient(135deg, #1a2a4a 60%, #2a3a5a);
        }

        .template-option__preview--kannagara {
            background: linear-gradient(to bottom, #fff 50%, #1a1a3e);
            position: relative;
            overflow: hidden;
        }

        .template-option__preview--kannagara::after {
            content: "";
            position: absolute;
            right: 15%;
            top: 10%;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #c0392b;
        }

        /* ===== TEMPLATE KANNAGARA ===== */
        .affiche-preview--kannagara {
            width: 1240px;
            height: 1754px;
            position: relative;
            background: #fff;
            font-family: 'Century Gothic', 'Avenir', 'Helvetica Neue', sans-serif;
            transform-origin: top left;
            overflow: hidden;
        }

        /* En-tête */
        .kn-header {
            text-align: center;
            padding: 60px 80px 30px;
        }

        .kn-header__stage {
            position: absolute;
            top: 60px;
            left: 80px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 6px;
            text-transform: uppercase;
            writing-mode: vertical-rl;
            color: #1a1a2e;
        }

        .kn-header__aikido {
            font-size: 96px;
            font-weight: 900;
            letter-spacing: 5px;
            color: #1a1a2e;
            line-height: 1;
        }

        .kn-header__sub {
            font-size: 18px;
            color: #666;
            margin-top: 8px;
            letter-spacing: 2px;
        }

        /* Professeur */
        .kn-prof {
            text-align: center;
            margin-top: 40px;
        }

        .kn-prof__name {
            font-size: 52px;
            font-weight: 700;
            color: #1a1a2e;
        }

        .kn-prof__grade {
            font-size: 52px;
            font-weight: 300;
            color: #1a1a2e;
        }

        .kn-prof__name2 {
            font-size: 42px;
            font-weight: 700;
            color: #1a1a2e;
            margin-top: 10px;
        }

        .kn-prof__grade2 {
            font-size: 42px;
            font-weight: 300;
            color: #1a1a2e;
        }

        /* Date */
        .kn-date {
            text-align: center;
            margin-top: 40px;
            color: #8b1a1a;
        }

        .kn-date__day {
            font-size: 38px;
            font-weight: 700;
        }

        .kn-date__hours {
            font-size: 30px;
            margin-top: 5px;
        }

        /* Logos */
        .kn-logos {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            margin-top: 50px;
        }

        .kn-logos img {
            height: 80px;
            object-fit: contain;
        }

        /* Infos */
        .kn-infos {
            position: absolute;
            left: 80px;
            top: 780px;
            max-width: 500px;
            font-size: 26px;
            line-height: 1.8;
            color: #1a1a2e;
            z-index: 5;
        }

        .kn-infos__label {
            font-weight: 700;
        }

        .kn-infos__row {
            margin-bottom: 8px;
        }

        /* Soleil rouge */
        .kn-sun {
            position: absolute;
            right: 80px;
            top: 650px;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: radial-gradient(circle at 40% 40%, #e84545, #c0392b);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
        }

        .kn-sun__kanji {
            font-size: 100px;
            color: rgba(255, 255, 255, 0.88);
            font-weight: 700;
            writing-mode: vertical-rl;
            letter-spacing: 12px;
            font-family: "MS Mincho", "Yu Mincho", "Hiragino Mincho Pro", serif;
        }

        /* Nuages SVG */
        .kn-clouds {
            position: absolute;
            right: 350px;
            top: 680px;
            z-index: 4;
        }

        /* Mont Fuji */
        .kn-fuji {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 4;
        }

        /* Footer contact */
        .kn-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: #1a1a3e;
            color: #fff;
            text-align: center;
            padding: 18px 40px;
            font-size: 18px;
            line-height: 1.7;
            z-index: 10;
        }
    </style>
</head>
<body>
    <?php $active = ''; include 'includes/header.php'; ?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Générateur d'affiches</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Affiches
            </p>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="section">
        <div class="container">
            <div class="affiche-layout">

                <!-- Formulaire -->
                <div class="affiche-form">
                    <h2>Informations du stage</h2>

                    <h3>Modèle d'affiche</h3>
                    <div class="template-selector">
                        <div class="template-option">
                            <input type="radio" name="template" id="tpl-codep" value="codep" checked>
                            <label for="tpl-codep">
                                <div class="template-option__preview template-option__preview--codep"></div>
                                Codep 78
                            </label>
                        </div>
                        <div class="template-option">
                            <input type="radio" name="template" id="tpl-kannagara" value="kannagara">
                            <label for="tpl-kannagara">
                                <div class="template-option__preview template-option__preview--kannagara"></div>
                                Kannagara
                            </label>
                        </div>
                    </div>

                    <h3>Intervenant 1</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="instructeur">Nom *</label>
                            <input type="text" id="instructeur" value="Jean-Marc CHAMOT">
                        </div>
                        <div class="form-group">
                            <label for="grade">Grade</label>
                            <input type="text" id="grade" value="7ème Dan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo-upload">Photo de l'intervenant</label>
                        <div class="photo-upload">
                            <input type="file" id="photo-upload" accept="image/*">
                            <img src="" alt="" class="photo-upload__preview" id="photo-thumb">
                            <button type="button" class="photo-upload__clear" id="photo-clear" style="display:none;">Supprimer</button>
                        </div>
                    </div>

                    <h3>Intervenant 2</h3>
                    <p class="form-hint">Laissez vide s'il n'y a qu'un seul intervenant</p>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="instructeur-2">Nom</label>
                            <input type="text" id="instructeur-2" value="" placeholder="ex : Nacer CHEKKABA">
                        </div>
                        <div class="form-group">
                            <label for="grade-2">Grade</label>
                            <input type="text" id="grade-2" value="" placeholder="ex : 4ème Dan">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date-stage">Date du stage *</label>
                        <input type="date" id="date-stage">
                    </div>

                    <h3>Horaires</h3>
                    <p class="form-hint">Laissez vide les créneaux non concernés</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="matin-debut">Matin : début</label>
                            <input type="text" id="matin-debut" value="10h" placeholder="ex : 10h">
                        </div>
                        <div class="form-group">
                            <label for="matin-fin">Matin : fin</label>
                            <input type="text" id="matin-fin" value="12h30" placeholder="ex : 12h30">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="aprem-debut">Après-midi : début</label>
                            <input type="text" id="aprem-debut" value="14h30" placeholder="ex : 14h30">
                        </div>
                        <div class="form-group">
                            <label for="aprem-fin">Après-midi : fin</label>
                            <input type="text" id="aprem-fin" value="17h" placeholder="ex : 17h">
                        </div>
                    </div>

                    <h3>Lieu</h3>

                    <div class="form-group">
                        <label for="lieu">Nom du lieu *</label>
                        <input type="text" id="lieu" value="Gymnase Maurice Baquet">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <textarea id="adresse" rows="3">Mail des Graviers
78280 Guyancourt</textarea>
                    </div>

                    <h3>Tarifs</h3>
                    <p class="form-hint">Laissez vide si pas de tarif spécifique</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="prix-adulte-demi">Adulte demi-journée (€)</label>
                            <input type="text" id="prix-adulte-demi" value="15" placeholder="ex : 15">
                        </div>
                        <div class="form-group">
                            <label for="prix-adulte-journee">Adulte journée (€)</label>
                            <input type="text" id="prix-adulte-journee" value="20" placeholder="ex : 20">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="prix-etudiant-demi">Étudiant demi-journée (€)</label>
                            <input type="text" id="prix-etudiant-demi" value="10" placeholder="ex : 10">
                        </div>
                        <div class="form-group">
                            <label for="prix-etudiant-journee">Étudiant journée (€)</label>
                            <input type="text" id="prix-etudiant-journee" value="15" placeholder="ex : 15">
                        </div>
                    </div>

                    <h3>Autres</h3>

                    <div class="form-group">
                        <label for="ouvert-a">Mention "Ouvert à..."</label>
                        <input type="text" id="ouvert-a" value="Ouvert à tous à partir de 15 ans">
                    </div>

                    <!-- Boutons export -->
                    <div class="affiche-export-buttons">
                        <button type="button" id="btn-export-png" class="btn btn--primary">
                            Télécharger en PNG
                        </button>
                        <button type="button" id="btn-export-pdf" class="btn btn--outline">
                            Télécharger en PDF
                        </button>
                    </div>
                </div>

                <!-- Prévisualisation Codep 78 -->
                <div class="affiche-preview-container" id="container-codep">
                    <div class="affiche-preview-wrapper">
                        <div class="affiche-preview" id="affiche-preview">

                            <!-- Zone haut-droite : intervenant + date + horaires -->
                            <div class="affiche-text--instructeur" id="preview-instructeur"></div>

                            <!-- Photo intervenant -->
                            <img src="" alt="" class="affiche-photo" id="preview-photo-codep">

                            <!-- Zone gauche : lieu + tarifs -->
                            <div class="affiche-text--infos" id="preview-infos"></div>

                        </div>
                    </div>
                </div>

                <!-- Prévisualisation Kannagara -->
                <div class="affiche-preview-container" id="container-kannagara" style="display: none;">
                    <div class="affiche-preview-wrapper">
                        <div class="affiche-preview--kannagara" id="affiche-preview-kn">

                            <!-- En-tête -->
                            <div class="kn-header">
                                <span class="kn-header__stage">STAGE</span>
                                <div class="kn-header__aikido">AÏKIDO</div>
                                <div class="kn-header__sub">Organisé par le club Kannagara — Guyancourt</div>
                            </div>

                            <!-- Professeur -->
                            <div class="kn-prof" id="kn-prof"></div>

                            <!-- Date -->
                            <div class="kn-date" id="kn-date"></div>

                            <!-- Logos -->
                            <div class="kn-logos">
                                <img src="images/logo-kannagara.png" alt="Kannagara Aïkido">
                            </div>

                            <!-- Photo intervenant -->
                            <img src="" alt="" class="kn-photo" id="preview-photo-kn">

                            <!-- Infos -->
                            <div class="kn-infos" id="kn-infos"></div>

                            <!-- Soleil rouge + kanji -->
                            <div class="kn-sun">
                                <span class="kn-sun__kanji">合気道</span>
                            </div>

                            <!-- Nuages -->
                            <svg class="kn-clouds" width="200" height="100" viewBox="0 0 120 60">
                                <path fill="rgba(200,160,160,0.3)" d="M20,40 Q10,40 10,30 Q10,20 20,20 Q22,10 35,12 Q45,5 55,15 Q65,8 72,18 Q82,15 85,25 Q95,22 95,32 Q95,42 85,42 Z"/>
                                <path fill="rgba(200,160,160,0.3)" d="M50,55 Q42,55 42,47 Q42,40 50,40 Q52,33 62,35 Q70,30 77,38 Q85,35 87,43 Q92,42 92,48 Q92,56 85,56 Z"/>
                            </svg>

                            <!-- Mont Fuji -->
                            <svg class="kn-fuji" viewBox="0 0 800 300" preserveAspectRatio="none" style="height: 350px;">
                                <path fill="#1a1a3e" d="M0,300 L0,240 Q50,220 100,210 Q200,170 300,130 Q350,110 400,90 Q420,80 430,85 Q440,90 450,100 Q460,95 470,88 Q480,82 490,85 Q500,90 510,100 Q550,120 600,150 Q700,200 800,240 L800,300 Z"/>
                                <path fill="#e8e8f0" d="M370,115 Q380,105 400,90 Q420,80 430,85 Q440,90 450,100 Q460,95 470,88 Q480,82 490,85 Q500,90 510,100 Q520,108 530,118 Q500,125 470,120 Q440,128 410,122 Q390,118 370,115 Z"/>
                                <path fill="#1a1a3e" d="M0,270 Q100,250 200,255 Q300,240 400,260 Q500,245 600,255 Q700,250 800,270 L800,300 L0,300 Z" opacity="0.7"/>
                            </svg>

                            <!-- Footer contact -->
                            <div class="kn-footer" id="kn-footer">
                                <strong>Contact :</strong> Sébastien HUET — 06 76 48 16 01 — aikido.kannagara.guyancourt@gmail.com<br>
                                Kannagara Aïkido Club de Guyancourt — Affilié à la FFAB
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        var currentTemplate = 'codep';
        var photoDataUrl = '';

        // Gestion upload photo
        var photoInput = document.getElementById('photo-upload');
        var photoThumb = document.getElementById('photo-thumb');
        var photoClear = document.getElementById('photo-clear');

        photoInput.addEventListener('change', function(e) {
            var file = e.target.files[0];
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function(ev) {
                photoDataUrl = ev.target.result;
                photoThumb.src = photoDataUrl;
                photoClear.style.display = '';
                updatePhotoPreview();
            };
            reader.readAsDataURL(file);
        });

        photoClear.addEventListener('click', function() {
            photoDataUrl = '';
            photoInput.value = '';
            photoThumb.src = '';
            photoClear.style.display = 'none';
            updatePhotoPreview();
        });

        function updatePhotoPreview() {
            document.getElementById('preview-photo-codep').src = photoDataUrl;
            document.getElementById('preview-photo-kn').src = photoDataUrl;
        }

        // Date par défaut : aujourd'hui
        var dateInput = document.getElementById('date-stage');
        if (!dateInput.value) {
            var today = new Date();
            var yyyy = today.getFullYear();
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var dd = String(today.getDate()).padStart(2, '0');
            dateInput.value = yyyy + '-' + mm + '-' + dd;
        }

        // Écouter tous les champs
        var fields = document.querySelectorAll('.affiche-form input, .affiche-form textarea');
        fields.forEach(function(field) {
            field.addEventListener('input', updateAllPreviews);
        });

        // Écouter le sélecteur de template
        document.querySelectorAll('input[name="template"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                currentTemplate = this.value;
                document.getElementById('container-codep').style.display = currentTemplate === 'codep' ? '' : 'none';
                document.getElementById('container-kannagara').style.display = currentTemplate === 'kannagara' ? '' : 'none';
                updatePreviewScale();
            });
        });

        // Mise à jour initiale
        updateAllPreviews();
        updatePreviewScale();
        window.addEventListener('resize', updatePreviewScale);

        // === Données partagées ===

        function getFormData() {
            var dateVal = document.getElementById('date-stage').value;
            var matinDebut = document.getElementById('matin-debut').value.trim();
            var matinFin = document.getElementById('matin-fin').value.trim();
            var apremDebut = document.getElementById('aprem-debut').value.trim();
            var apremFin = document.getElementById('aprem-fin').value.trim();

            var dateFormatted = '';
            if (dateVal) {
                var d = new Date(dateVal + 'T00:00:00');
                var jours = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                var mois = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin',
                            'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
                dateFormatted = jours[d.getDay()] + ' ' + d.getDate() + ' ' + mois[d.getMonth()] + ' ' + d.getFullYear();
            }

            var horaires = '';
            var hasMatin = matinDebut && matinFin;
            var hasAprem = apremDebut && apremFin;
            if (hasMatin && hasAprem) {
                horaires = matinDebut + ' - ' + matinFin + ' et ' + apremDebut + ' - ' + apremFin;
            } else if (hasMatin) {
                horaires = matinDebut + ' - ' + matinFin;
            } else if (hasAprem) {
                horaires = apremDebut + ' - ' + apremFin;
            }

            return {
                instructeur: document.getElementById('instructeur').value,
                grade: document.getElementById('grade').value,
                instructeur2: document.getElementById('instructeur-2').value.trim(),
                grade2: document.getElementById('grade-2').value.trim(),
                dateFormatted: dateFormatted,
                horaires: horaires,
                lieu: document.getElementById('lieu').value,
                adresse: document.getElementById('adresse').value,
                prixAdulteDemi: document.getElementById('prix-adulte-demi').value.trim(),
                prixAdulteJournee: document.getElementById('prix-adulte-journee').value.trim(),
                prixEtudiantDemi: document.getElementById('prix-etudiant-demi').value.trim(),
                prixEtudiantJournee: document.getElementById('prix-etudiant-journee').value.trim(),
                ouvertA: document.getElementById('ouvert-a').value
            };
        }

        function updateAllPreviews() {
            var data = getFormData();
            updatePreviewCodep(data);
            updatePreviewKannagara(data);
        }

        // === Prévisualisation ===

        function updatePreviewScale() {
            // Codep
            var containerCodep = document.getElementById('container-codep');
            if (containerCodep.style.display !== 'none') {
                var wrapper = containerCodep.querySelector('.affiche-preview-wrapper');
                var preview = document.getElementById('affiche-preview');
                var availableWidth = wrapper.parentElement.clientWidth;
                var scale = availableWidth / 1240;
                if (scale > 1) scale = 1;
                preview.style.transform = 'scale(' + scale + ')';
                wrapper.style.height = (1754 * scale) + 'px';
            }

            // Kannagara
            var containerKn = document.getElementById('container-kannagara');
            if (containerKn.style.display !== 'none') {
                var wrapperKn = containerKn.querySelector('.affiche-preview-wrapper');
                var previewKn = document.getElementById('affiche-preview-kn');
                var availableWidthKn = wrapperKn.parentElement.clientWidth;
                var scaleKn = availableWidthKn / 1240;
                if (scaleKn > 1) scaleKn = 1;
                previewKn.style.transform = 'scale(' + scaleKn + ')';
                wrapperKn.style.height = (1754 * scaleKn) + 'px';
            }
        }

        // === Codep 78 (existant) ===

        function updatePreviewCodep(data) {
            var instrHTML = '';
            if (data.instructeur) {
                instrHTML += '<div class="nom">' + esc(data.instructeur) + '</div>';
            }
            if (data.grade) {
                instrHTML += '<div class="grade">' + esc(data.grade) + '</div>';
            }
            if (data.instructeur2) {
                instrHTML += '<div class="nom" style="margin-top: 15px;">' + esc(data.instructeur2) + '</div>';
                if (data.grade2) {
                    instrHTML += '<div class="grade">' + esc(data.grade2) + '</div>';
                }
            }
            if (data.dateFormatted) {
                instrHTML += '<div class="date">' + esc(data.dateFormatted) + '</div>';
            }
            if (data.horaires) {
                instrHTML += '<div class="horaires">' + esc(data.horaires) + '</div>';
            }
            document.getElementById('preview-instructeur').innerHTML = instrHTML;

            var infosHTML = '';
            if (data.ouvertA) {
                infosHTML += '<div class="ouvert">' + esc(data.ouvertA) + '</div>';
            }
            if (data.lieu || data.adresse) {
                infosHTML += '<div class="lieu"><strong>Lieu :</strong> ';
                if (data.lieu) infosHTML += esc(data.lieu);
                if (data.lieu && data.adresse) infosHTML += '<br>';
                if (data.adresse) infosHTML += data.adresse.split('\n').map(function(l) { return esc(l); }).join('<br>');
                infosHTML += '</div>';
            }
            var hasAnyPrice = data.prixAdulteDemi || data.prixAdulteJournee || data.prixEtudiantDemi || data.prixEtudiantJournee;
            if (hasAnyPrice) {
                infosHTML += '<div class="tarifs">';
                if (data.prixAdulteDemi || data.prixAdulteJournee) {
                    var parts = [];
                    if (data.prixAdulteDemi) parts.push(data.prixAdulteDemi + ' € demi journée');
                    if (data.prixAdulteJournee) parts.push(data.prixAdulteJournee + ' € journée');
                    infosHTML += esc('Adultes : ' + parts.join(' / ')) + '<br>';
                }
                if (data.prixEtudiantDemi || data.prixEtudiantJournee) {
                    var parts2 = [];
                    if (data.prixEtudiantDemi) parts2.push(data.prixEtudiantDemi + ' € demi journée');
                    if (data.prixEtudiantJournee) parts2.push(data.prixEtudiantJournee + ' € journée');
                    infosHTML += esc('Étudiants : ' + parts2.join(' / '));
                }
                infosHTML += '</div>';
            }
            document.getElementById('preview-infos').innerHTML = infosHTML;
        }

        // === Kannagara ===

        function updatePreviewKannagara(data) {
            // Professeur
            var profHTML = '';
            if (data.instructeur) {
                profHTML += '<div class="kn-prof__name">' + esc(data.instructeur);
                if (data.grade) profHTML += ' <span class="kn-prof__grade">- ' + esc(data.grade) + '</span>';
                profHTML += '</div>';
            }
            if (data.instructeur2) {
                profHTML += '<div class="kn-prof__name2">' + esc(data.instructeur2);
                if (data.grade2) profHTML += ' <span class="kn-prof__grade2">- ' + esc(data.grade2) + '</span>';
                profHTML += '</div>';
            }
            document.getElementById('kn-prof').innerHTML = profHTML;

            // Date
            var dateHTML = '';
            if (data.dateFormatted) {
                dateHTML += '<div class="kn-date__day">' + esc(data.dateFormatted) + '</div>';
            }
            if (data.horaires) {
                dateHTML += '<div class="kn-date__hours">' + esc(data.horaires) + '</div>';
            }
            document.getElementById('kn-date').innerHTML = dateHTML;

            // Infos
            var infosHTML = '';
            if (data.ouvertA) {
                infosHTML += '<div class="kn-infos__row"><em>' + esc(data.ouvertA) + '</em></div>';
            }
            if (data.lieu || data.adresse) {
                infosHTML += '<div class="kn-infos__row"><span class="kn-infos__label">Lieu :</span> ';
                if (data.lieu) infosHTML += esc(data.lieu);
                if (data.adresse) infosHTML += '<br>' + data.adresse.split('\n').map(function(l) { return esc(l); }).join('<br>');
                infosHTML += '</div>';
            }
            if (data.prixAdulteDemi || data.prixAdulteJournee) {
                var parts = [];
                if (data.prixAdulteDemi) parts.push(data.prixAdulteDemi + '€ demi journée');
                if (data.prixAdulteJournee) parts.push(data.prixAdulteJournee + '€ journée');
                infosHTML += '<div class="kn-infos__row"><span class="kn-infos__label">Tarifs adultes :</span> ' + esc(parts.join(' — ')) + '</div>';
            }
            if (data.prixEtudiantDemi || data.prixEtudiantJournee) {
                var parts2 = [];
                if (data.prixEtudiantDemi) parts2.push(data.prixEtudiantDemi + '€ demi journée');
                if (data.prixEtudiantJournee) parts2.push(data.prixEtudiantJournee + '€ journée');
                infosHTML += '<div class="kn-infos__row"><span class="kn-infos__label">Tarifs étudiants :</span> ' + esc(parts2.join(' — ')) + '</div>';
            }
            document.getElementById('kn-infos').innerHTML = infosHTML;
        }

        function esc(str) {
            var div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        // === Export PNG ===

        document.getElementById('btn-export-png').addEventListener('click', function() {
            exportAffiche('png');
        });

        // === Export PDF ===

        document.getElementById('btn-export-pdf').addEventListener('click', function() {
            exportAffiche('pdf');
        });

        function exportAffiche(format) {
            var previewId = currentTemplate === 'kannagara' ? 'affiche-preview-kn' : 'affiche-preview';
            var preview = document.getElementById(previewId);
            var originalTransform = preview.style.transform;
            preview.style.transform = 'none';

            var wrapper = preview.closest('.affiche-preview-wrapper');
            var originalHeight = wrapper.style.height;
            wrapper.style.height = '1754px';

            html2canvas(preview, {
                scale: 1,
                useCORS: true,
                allowTaint: true,
                width: 1240,
                height: 1754,
                backgroundColor: currentTemplate === 'kannagara' ? '#ffffff' : null
            }).then(function(canvas) {
                preview.style.transform = originalTransform;
                wrapper.style.height = originalHeight;

                var suffix = currentTemplate === 'kannagara' ? '-kannagara' : '';
                if (format === 'png') {
                    var link = document.createElement('a');
                    link.download = 'affiche-stage-aikido' + suffix + '.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                } else {
                    var jsPDF = window.jspdf.jsPDF;
                    var pdf = new jsPDF({
                        orientation: 'portrait',
                        unit: 'mm',
                        format: 'a4'
                    });
                    var imgData = canvas.toDataURL('image/jpeg', 0.95);
                    pdf.addImage(imgData, 'JPEG', 0, 0, 210, 297);
                    pdf.save('affiche-stage-aikido' + suffix + '.pdf');
                }
            }).catch(function(err) {
                preview.style.transform = originalTransform;
                wrapper.style.height = originalHeight;
                alert('Erreur lors de l\'export : ' + err.message);
            });
        }

    });
    </script>
</body>
</html>
