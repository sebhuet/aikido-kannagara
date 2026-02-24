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

                <!-- Prévisualisation -->
                <div class="affiche-preview-container">
                    <div class="affiche-preview-wrapper">
                        <div class="affiche-preview" id="affiche-preview">

                            <!-- Zone haut-droite : intervenant + date + horaires -->
                            <div class="affiche-text--instructeur" id="preview-instructeur"></div>

                            <!-- Zone gauche : lieu + tarifs -->
                            <div class="affiche-text--infos" id="preview-infos"></div>

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
            field.addEventListener('input', updatePreview);
        });

        // Mise à jour initiale
        updatePreview();
        updatePreviewScale();
        window.addEventListener('resize', updatePreviewScale);

        // === Prévisualisation ===

        function updatePreviewScale() {
            var wrapper = document.querySelector('.affiche-preview-wrapper');
            var preview = document.getElementById('affiche-preview');
            var availableWidth = wrapper.parentElement.clientWidth;
            var scale = availableWidth / 1240;
            if (scale > 1) scale = 1;
            preview.style.transform = 'scale(' + scale + ')';
            wrapper.style.height = (1754 * scale) + 'px';
        }

        function updatePreview() {
            var instructeur = document.getElementById('instructeur').value;
            var grade = document.getElementById('grade').value;
            var instructeur2 = document.getElementById('instructeur-2').value.trim();
            var grade2 = document.getElementById('grade-2').value.trim();
            var dateVal = document.getElementById('date-stage').value;
            var matinDebut = document.getElementById('matin-debut').value.trim();
            var matinFin = document.getElementById('matin-fin').value.trim();
            var apremDebut = document.getElementById('aprem-debut').value.trim();
            var apremFin = document.getElementById('aprem-fin').value.trim();
            var lieu = document.getElementById('lieu').value;
            var adresse = document.getElementById('adresse').value;
            var prixAdulteDemi = document.getElementById('prix-adulte-demi').value.trim();
            var prixAdulteJournee = document.getElementById('prix-adulte-journee').value.trim();
            var prixEtudiantDemi = document.getElementById('prix-etudiant-demi').value.trim();
            var prixEtudiantJournee = document.getElementById('prix-etudiant-journee').value.trim();
            var ouvertA = document.getElementById('ouvert-a').value;

            // Formater la date en français
            var dateFormatted = '';
            if (dateVal) {
                var d = new Date(dateVal + 'T00:00:00');
                var jours = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                var mois = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin',
                            'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
                dateFormatted = jours[d.getDay()] + ' ' + d.getDate() + ' ' + mois[d.getMonth()] + ' ' + d.getFullYear();
            }

            // Construire la chaîne horaires
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

            // Zone intervenant (haut-droite)
            var instrHTML = '';
            if (instructeur) {
                instrHTML += '<div class="nom">' + esc(instructeur) + '</div>';
            }
            if (grade) {
                instrHTML += '<div class="grade">' + esc(grade) + '</div>';
            }
            if (instructeur2) {
                instrHTML += '<div class="nom" style="margin-top: 15px;">' + esc(instructeur2) + '</div>';
                if (grade2) {
                    instrHTML += '<div class="grade">' + esc(grade2) + '</div>';
                }
            }
            if (dateFormatted) {
                instrHTML += '<div class="date">' + esc(dateFormatted) + '</div>';
            }
            if (horaires) {
                instrHTML += '<div class="horaires">' + esc(horaires) + '</div>';
            }
            document.getElementById('preview-instructeur').innerHTML = instrHTML;

            // Zone infos (gauche)
            var infosHTML = '';

            if (ouvertA) {
                infosHTML += '<div class="ouvert">' + esc(ouvertA) + '</div>';
            }

            if (lieu || adresse) {
                infosHTML += '<div class="lieu">';
                infosHTML += '<strong>Lieu :</strong> ';
                if (lieu) infosHTML += esc(lieu);
                if (lieu && adresse) infosHTML += '<br>';
                if (adresse) infosHTML += adresse.split('\n').map(function(l) { return esc(l); }).join('<br>');
                infosHTML += '</div>';
            }

            // Tarifs
            var hasAnyPrice = prixAdulteDemi || prixAdulteJournee || prixEtudiantDemi || prixEtudiantJournee;
            if (hasAnyPrice) {
                infosHTML += '<div class="tarifs">';
                if (prixAdulteDemi || prixAdulteJournee) {
                    var adulte = 'Adultes : ';
                    var parts = [];
                    if (prixAdulteDemi) parts.push(prixAdulteDemi + ' € demi journée');
                    if (prixAdulteJournee) parts.push(prixAdulteJournee + ' € journée');
                    adulte += parts.join(' / ');
                    infosHTML += esc(adulte) + '<br>';
                }
                if (prixEtudiantDemi || prixEtudiantJournee) {
                    var etudiant = 'Étudiants : ';
                    var parts2 = [];
                    if (prixEtudiantDemi) parts2.push(prixEtudiantDemi + ' € demi journée');
                    if (prixEtudiantJournee) parts2.push(prixEtudiantJournee + ' € journée');
                    etudiant += parts2.join(' / ');
                    infosHTML += esc(etudiant);
                }
                infosHTML += '</div>';
            }

            document.getElementById('preview-infos').innerHTML = infosHTML;
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
            var preview = document.getElementById('affiche-preview');
            var originalTransform = preview.style.transform;
            preview.style.transform = 'none';

            // Remonter le wrapper temporairement pour que html2canvas capture tout
            var wrapper = document.querySelector('.affiche-preview-wrapper');
            var originalHeight = wrapper.style.height;
            wrapper.style.height = '1754px';

            html2canvas(preview, {
                scale: 1,
                useCORS: true,
                allowTaint: true,
                width: 1240,
                height: 1754,
                backgroundColor: null
            }).then(function(canvas) {
                preview.style.transform = originalTransform;
                wrapper.style.height = originalHeight;

                if (format === 'png') {
                    var link = document.createElement('a');
                    link.download = 'affiche-stage-aikido.png';
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
                    pdf.save('affiche-stage-aikido.pdf');
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
