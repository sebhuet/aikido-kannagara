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
 * Génère le HTML de l'agenda (tableaux par semaine).
 * Nécessite la fonction slugify() de markdown.php.
 */
function render_agenda(array $weeks): string {
    $html = '';

    foreach ($weeks as $weekIndex => $week) {
        $sectionClass = ($weekIndex % 2 === 1) ? 'section section--alt' : 'section';

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

            foreach ($day['courses'] as $course) {
                if ($course['time'] === 'Fermé') {
                    $html .= '                <tr class="agenda-closed">' . "\n";
                    if ($firstCourse) {
                        $html .= '                    <td class="agenda-day-cell" rowspan="' . $rowCount . '">' . htmlspecialchars($day['name']) . '</td>' . "\n";
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

                    $html .= '                <tr>' . "\n";
                    if ($firstCourse) {
                        $html .= '                    <td class="agenda-day-cell" rowspan="' . $rowCount . '">' . htmlspecialchars($day['name']) . '</td>' . "\n";
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
