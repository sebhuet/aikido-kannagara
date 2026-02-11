<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Agenda des cours | Planning et présence des professeurs - Kannagara Aïkido</title>
    <meta name="description" content="Agenda et planning des cours d'aïkido du club Kannagara avec présence des professeurs. Cours ouverts à tous les licenciés, quelle que soit leur fédération.">
    <meta name="keywords" content="agenda aikido, planning cours aikido, horaires aikido Guyancourt, professeurs présents">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/agenda.html">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/agenda.html">
    <meta property="og:title" content="Agenda des cours - Kannagara Aïkido">
    <meta property="og:description" content="Planning des cours et présence des professeurs. Cours ouverts à tous les licenciés.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.png">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <style>
        .info-box {
            background: linear-gradient(135deg, #8B0000 0%, #660000 100%);
            color: white;
            padding: var(--spacing-xl);
            border-radius: 12px;
            margin-bottom: var(--spacing-xxl);
            box-shadow: 0 4px 15px rgba(139, 0, 0, 0.2);
        }

        .info-box h3 {
            margin-top: 0;
            margin-bottom: var(--spacing-md);
            font-size: 1.3rem;
            color: white;
        }

        .info-box p {
            margin-bottom: var(--spacing-sm);
            line-height: 1.7;
            color: white;
        }

        .info-box strong {
            color: white;
        }

        .info-box a {
            color: #FFD700;
        }

        .info-box a:hover {
            color: white;
        }

        .agenda-week__title {
            font-size: 1.5rem;
            color: var(--color-primary);
            margin: var(--spacing-lg) 0 var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--color-bg-alt);
            border-left: 4px solid var(--color-accent);
            border-radius: 4px;
        }

        .agenda-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: var(--spacing-xl);
        }

        .agenda-table thead {
            background: linear-gradient(135deg, var(--color-primary) 0%, #2c3e50 100%);
            color: white;
        }

        .agenda-table th {
            padding: var(--spacing-md);
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .agenda-table td {
            padding: var(--spacing-md);
            border-bottom: 1px solid var(--color-border);
        }

        .agenda-table tbody tr:hover {
            background: var(--color-bg-alt);
        }

        .agenda-table tbody tr:last-child td {
            border-bottom: none;
        }

        .agenda-day-cell {
            font-weight: 600;
            color: var(--color-primary);
            white-space: nowrap;
            min-width: 120px;
        }

        .agenda-time-cell {
            color: var(--color-accent);
            font-weight: 700;
            font-size: 0.95rem;
            white-space: nowrap;
        }

        .agenda-type-cell {
            color: var(--color-text);
            font-weight: 500;
        }

        .agenda-teachers-cell {
            color: var(--color-text);
        }

        .agenda-closed {
            background: #f9f9f9;
            color: #999;
            font-style: italic;
        }

        .teacher-link {
            color: var(--color-accent);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .teacher-link:hover {
            color: var(--color-primary);
            text-decoration: underline;
        }

        .agenda-course__reason {
            color: #666;
            font-style: italic;
        }

        .agenda-course__note {
            margin-top: var(--spacing-xs);
            padding: var(--spacing-xs) var(--spacing-sm);
            background: rgba(139, 0, 0, 0.1);
            border-radius: 4px;
            font-size: 0.85rem;
            color: var(--color-accent);
            display: inline-block;
        }

        .agenda-note-icon {
            margin-right: var(--spacing-xs);
        }

        @media (max-width: 768px) {
            .agenda-table {
                font-size: 0.9rem;
            }
            
            .agenda-table th,
            .agenda-table td {
                padding: var(--spacing-sm);
            }
            
            .agenda-day-cell {
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <?php $active = 'agenda'; include 'includes/header.php'; ?>




    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Agenda des Cours</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Agenda
            </p>
        </div>
    </section>

    <!-- Introduction et infos -->
    <section class="section">
        <div class="container">
            <!-- Info cours ouverts -->
            <div class="info-box">
                <h3>🥋 Cours ouverts à tous les licenciés</h3>
                <p>
                    Les cours sont <strong>ouverts à tous les pratiquants licenciés</strong>, quelle que soit leur fédération (FFAB, FFAAA, etc.). 
                    Participation : <strong>10€/cours</strong> pour les pratiquants extérieurs au club.
                </p>
                <p style="margin-bottom: 0;">
                    📍 <a href="https://maps.app.goo.gl/xuTo7Rqh51XWqWEh6" target="_blank" rel="noopener" style="color: #FFD700;">Gymnase Maurice Baquet</a>, Mail des Graviers, 78280 Guyancourt
                </p>
            </div>

            <!-- Horaires réguliers résumé -->
            <div style="background: white; padding: var(--spacing-lg); border-radius: 8px; margin-bottom: var(--spacing-xl); box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
                <h3 style="margin-top: 0; text-align: center; color: var(--color-primary);">Horaires hebdomadaires</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--spacing-md); text-align: center;">
                    <div>
                        <strong style="color: var(--color-accent);">Lundi</strong><br>
                        <span style="font-size: 0.9rem;">Enfants : 18h30-19h30</span><br>
                        <span style="font-size: 0.9rem;">Adultes : 19h30-21h30</span>
                    </div>
                    <div>
                        <strong style="color: var(--color-accent);">Jeudi</strong><br>
                        <span style="font-size: 0.9rem;">Enfants : 18h30-19h30</span><br>
                        <span style="font-size: 0.9rem;">Adultes : 19h30-21h30</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Agenda généré -->
    <!-- AGENDA_START -->

    <section class="section">
        <div class="container">
            <h2 class="agenda-week__title">📅 Semaine du 02/02/2026</h2>
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Type</th>
                        <th>Professeur(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Lundi 02/02</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#jean-marc-chamot" class="teacher-link">Jean-Marc Chamot</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#jean-marc-chamot" class="teacher-link">Jean-Marc Chamot</a></td>
                    </tr>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Jeudi 05/02</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="section section--alt">
        <div class="container">
            <h2 class="agenda-week__title">📅 Semaine du 09/02/2026</h2>
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Type</th>
                        <th>Professeur(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Lundi 09/02</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#nacer-chekkaba" class="teacher-link">Nacer Chekkaba</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#nacer-chekkaba" class="teacher-link">Nacer Chekkaba</a></td>
                    </tr>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Jeudi 12/02</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Dimanche 15/02</td>
                        <td class="agenda-time-cell">10h00-12h30</td>
                        <td class="agenda-type-cell">Stage Codep78</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#jean-marc-chamot" class="teacher-link">Jean-Marc Chamot</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">14h30-17h00</td>
                        <td class="agenda-type-cell">Stage Codep78</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#jean-marc-chamot" class="teacher-link">Jean-Marc Chamot</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <h2 class="agenda-week__title">📅 Semaine du 16/02/2026</h2>
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Type</th>
                        <th>Professeur(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Lundi 16/02</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#germain-chamot" class="teacher-link">Germain Chamot</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#germain-chamot" class="teacher-link">Germain Chamot</a></td>
                    </tr>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Jeudi 19/02</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="section section--alt">
        <div class="container">
            <h2 class="agenda-week__title">📅 Semaine du 23/02/2026</h2>
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Type</th>
                        <th>Professeur(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Lundi 23/02</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#thierry-montfort" class="teacher-link">Thierry Montfort</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#thierry-montfort" class="teacher-link">Thierry Montfort</a></td>
                    </tr>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Jeudi 26/02</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#a-confirmer" class="teacher-link">À confirmer</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#a-confirmer" class="teacher-link">À confirmer</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <h2 class="agenda-week__title">📅 Semaine du 02/03/2026 - Vacances Scolaire</h2>
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Type</th>
                        <th>Professeur(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Mardi 03/03</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#pas-de-cours" class="teacher-link">Pas de cours</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Jeudi 05/03</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#pas-de-cours" class="teacher-link">Pas de cours</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="section section--alt">
        <div class="container">
            <h2 class="agenda-week__title">📅 Semaine du 09/03/2026 - Vacances Scolaire</h2>
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Type</th>
                        <th>Professeur(s)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Mardi 10/03</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#pas-de-cours" class="teacher-link">Pas de cours</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                    <tr>
                        <td class="agenda-day-cell" rowspan="2">Jeudi 12/03</td>
                        <td class="agenda-time-cell">18h30-19h30</td>
                        <td class="agenda-type-cell">Enfants</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#pas-de-cours" class="teacher-link">Pas de cours</a></td>
                    </tr>
                    <tr>
                        
                        <td class="agenda-time-cell">19h30-21h30</td>
                        <td class="agenda-type-cell">Adultes</td>
                        <td class="agenda-teachers-cell"><a href="professeurs.php#sebastien-huet" class="teacher-link">Sébastien Huet</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <!-- AGENDA_END -->

    <?php include 'includes/footer.php'; ?>




    <!-- JavaScript -->
    <script src="js/main.js"></script>
    <script>
        // Filtrer les cours passés
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Récupérer toutes les cellules de jour
            const dayCells = document.querySelectorAll('.agenda-day-cell');
            
            dayCells.forEach(cell => {
                const dayText = cell.textContent.trim();
                // Parser "Lundi 03/02" -> extraire "03/02"
                const dateMatch = dayText.match(/(\d{2})\/(\d{2})/);
                
                if (dateMatch) {
                    const day = parseInt(dateMatch[1], 10);
                    const month = parseInt(dateMatch[2], 10);
                    
                    // Trouver l'année depuis le titre de la semaine
                    const weekTitle = cell.closest('section').querySelector('.agenda-week__title').textContent;
                    const yearMatch = weekTitle.match(/\/(\d{4})/);
                    const year = yearMatch ? parseInt(yearMatch[1], 10) : new Date().getFullYear();
                    
                    const courseDate = new Date(year, month - 1, day);
                    
                    // Si la date est passée, masquer toutes les lignes de ce jour
                    if (courseDate < today) {
                        const rowspan = parseInt(cell.getAttribute('rowspan') || '1', 10);
                        let row = cell.closest('tr');
                        
                        // Masquer la première ligne
                        row.style.display = 'none';
                        
                        // Masquer les lignes suivantes (rowspan - 1)
                        for (let i = 1; i < rowspan; i++) {
                            row = row.nextElementSibling;
                            if (row) row.style.display = 'none';
                        }
                    }
                }
            });
            
            // Masquer les sections vides
            document.querySelectorAll('.agenda-table tbody').forEach(tbody => {
                const visibleRows = Array.from(tbody.querySelectorAll('tr')).filter(row => row.style.display !== 'none');
                if (visibleRows.length === 0) {
                    tbody.closest('section').style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
