<?php
/**
 * Parser de l'agenda des cours depuis agenda.md
 * Remplace le build Node.js (build-agenda.js) par un rendu PHP dynamique.
 */

/**
 * Parse le fichier agenda.md et retourne un tableau structuré de semaines.
 */
function parse_agenda(string $filepath): array {
    $content = file_get_contents($filepath);
    if ($content === false) return [];

    $lines = explode("\n", $content);
    $weeks = [];
    $wi = -1; // index semaine courante
    $di = -1; // index jour courant

    foreach ($lines as $line) {
        $line = trim($line);

        // Nouvelle semaine : ## Semaine du JJ/MM/YYYY...
        if (strpos($line, '## Semaine du ') === 0) {
            $weeks[] = [
                'title' => substr($line, strlen('## Semaine du ')),
                'days' => []
            ];
            $wi = count($weeks) - 1;
            $di = -1;
        }
        // Nouveau jour : ### Lundi 02/02...
        elseif (strpos($line, '### ') === 0 && $wi >= 0) {
            $weeks[$wi]['days'][] = [
                'name' => substr($line, 4),
                'courses' => []
            ];
            $di = count($weeks[$wi]['days']) - 1;
        }
        // Note sur le dernier cours
        elseif ((strpos($line, '- **Note** : ') === 0 || strpos($line, '- **Note**: ') === 0)
                && $wi >= 0 && $di >= 0 && count($weeks[$wi]['days'][$di]['courses']) > 0) {
            $note = preg_replace('/^- \*\*Note\*\*\s*:\s*/', '', $line);
            $ci = count($weeks[$wi]['days'][$di]['courses']) - 1;
            $weeks[$wi]['days'][$di]['courses'][$ci]['note'] = $note;
        }
        // Cours : - **18h30-19h30** | Type | Professeur(s)
        elseif (strpos($line, '- **') === 0 && strpos($line, '- **Note**') !== 0 && $wi >= 0 && $di >= 0) {
            // Format fermé : - **Fermé** | Vacances scolaires
            if (preg_match('/^- \*\*Fermé\*\* \| (.+)/', $line, $closedMatch)) {
                $weeks[$wi]['days'][$di]['courses'][] = [
                    'time' => 'Fermé',
                    'type' => $closedMatch[1],
                    'teachers' => null,
                    'note' => null
                ];
            }
            // Format normal : - **18h30-19h30** | Adultes | Jean-Marc Chamot
            elseif (preg_match('/^- \*\*(.+?)\*\* \| (.+?) \|(.*)/', $line, $match)) {
                $teachers = trim($match[3]);
                if ($teachers === '') $teachers = 'À confirmer';
                $weeks[$wi]['days'][$di]['courses'][] = [
                    'time' => $match[1],
                    'type' => $match[2],
                    'teachers' => $teachers,
                    'note' => null
                ];
            }
        }
    }

    return $weeks;
}

/**
 * Date (timestamp à minuit) d'un jour de l'agenda : « Lundi 28/09 » dans la
 * « Semaine du 28/09/2026 ». Un jour de janvier dans une semaine de décembre
 * appartient à l'année suivante. Null si une date manque.
 */
function agenda_date_jour(string $titreSemaine, string $nomJour): ?int {
    if (!preg_match('#(\d{2})/(\d{2})/(\d{4})#', $titreSemaine, $s) || !preg_match('#(\d{2})/(\d{2})#', $nomJour, $j)) {
        return null;
    }
    $annee = (int) $s[3] + ((int) $j[2] < (int) $s[2] ? 1 : 0);
    return mktime(0, 0, 0, (int) $j[2], (int) $j[1], $annee);
}

/**
 * Ne garde que les jours à venir (aujourd'hui compris) et retire les semaines vides.
 * Fait côté serveur : la page ne transporte plus la saison passée, que du JavaScript
 * masquait après coup.
 */
function agenda_a_venir(array $weeks, int $aujourdhui): array {
    $resultat = [];
    foreach ($weeks as $week) {
        $week['days'] = array_values(array_filter($week['days'], function ($jour) use ($week, $aujourdhui) {
            $date = agenda_date_jour($week['title'], $jour['name']);
            return $date === null || $date >= $aujourdhui;
        }));
        if ($week['days']) {
            $resultat[] = $week;
        }
    }
    return $resultat;
}

/**
 * Génère le HTML de l'agenda (tableaux par semaine).
 * Nécessite la fonction slugify() de markdown.php.
 *
 * $aujourdhui : signale le premier jour de cours à venir (« Aujourd'hui » ou
 * « Prochain cours »). $decalage : rang de la première semaine, pour alterner les fonds
 * quand l'agenda est rendu en deux parties.
 */
function render_agenda(array $weeks, ?int $aujourdhui = null, int $decalage = 0): string {
    $html = '';
    $prochainSignale = $aujourdhui === null;

    foreach ($weeks as $weekIndex => $week) {
        $sectionClass = (($weekIndex + $decalage) % 2 === 1) ? 'section section--alt' : 'section';

        $html .= '<section class="' . $sectionClass . '">' . "\n";
        $html .= '    <div class="container">' . "\n";
        $html .= '        <h2 class="agenda-week__title">📅 Semaine du ' . htmlspecialchars($week['title']) . '</h2>' . "\n";
        $html .= '        <table class="agenda-table">' . "\n";
        $html .= '            <thead>' . "\n";
        $html .= '                <tr>' . "\n";
        $html .= '                    <th>Jour</th>' . "\n";
        $html .= '                    <th>Horaire</th>' . "\n";
        $html .= '                    <th>Type</th>' . "\n";
        $html .= '                    <th>Professeur(s)</th>' . "\n";
        $html .= '                </tr>' . "\n";
        $html .= '            </thead>' . "\n";
        $html .= '            <tbody>' . "\n";

        foreach ($week['days'] as $day) {
            $rowCount = count($day['courses']);
            $firstCourse = true;

            // Premier jour où l'on pratique (un jour « Fermé » ne compte pas)
            $badge = '';
            $ouvert = array_filter($day['courses'], fn($c) => $c['time'] !== 'Fermé');
            if (!$prochainSignale && $ouvert) {
                $prochainSignale = true;
                $estAujourdhui = agenda_date_jour($week['title'], $day['name']) === $aujourdhui;
                $badge = ' <span class="agenda-badge">' . ($estAujourdhui ? 'Aujourd\'hui' : 'Prochain cours') . '</span>';
            }
            $dayCell = htmlspecialchars($day['name']) . $badge;

            foreach ($day['courses'] as $course) {
                if ($course['time'] === 'Fermé') {
                    $html .= '                <tr class="agenda-closed">' . "\n";
                    if ($firstCourse) {
                        $html .= '                    <td class="agenda-day-cell" rowspan="' . $rowCount . '">' . $dayCell . '</td>' . "\n";
                    }
                    $html .= '                    <td colspan="3" class="agenda-time-cell">Fermé - ' . htmlspecialchars($course['type']) . '</td>' . "\n";
                    $html .= '                </tr>' . "\n";
                } else {
                    // Liens vers les fiches professeurs
                    $teacherNames = explode(',', $course['teachers']);
                    $teacherLinks = [];
                    foreach ($teacherNames as $name) {
                        $name = trim($name);
                        $slug = slugify($name);
                        $teacherLinks[] = '<a href="professeurs.php#' . $slug . '" class="teacher-link">' . htmlspecialchars($name) . '</a>';
                    }
                    $teachersHtml = implode(', ', $teacherLinks);

                    if ($course['note']) {
                        $teachersHtml .= '<br><span class="agenda-course__note"><span class="agenda-note-icon">ℹ️</span>' . htmlspecialchars($course['note']) . '</span>';
                    }

                    $html .= '                <tr' . ($badge ? ' class="agenda-row--prochain"' : '') . '>' . "\n";
                    if ($firstCourse) {
                        $html .= '                    <td class="agenda-day-cell" rowspan="' . $rowCount . '">' . $dayCell . '</td>' . "\n";
                    }
                    $html .= '                    <td class="agenda-time-cell">' . htmlspecialchars($course['time']) . '</td>' . "\n";
                    $html .= '                    <td class="agenda-type-cell">' . htmlspecialchars($course['type']) . '</td>' . "\n";
                    $html .= '                    <td class="agenda-teachers-cell">' . $teachersHtml . '</td>' . "\n";
                    $html .= '                </tr>' . "\n";
                }
                $firstCourse = false;
            }
        }

        $html .= '            </tbody>' . "\n";
        $html .= '        </table>' . "\n";
        $html .= '    </div>' . "\n";
        $html .= '</section>' . "\n";
    }

    return $html;
}
