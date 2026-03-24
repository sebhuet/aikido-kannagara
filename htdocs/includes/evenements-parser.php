<?php
/**
 * Parser des événements depuis evenements.md
 * Retourne les événements à venir triés par date croissante.
 */

/**
 * Parse le fichier evenements.md et retourne un tableau d'événements.
 * Seuls les événements futurs (ou du jour) sont retournés.
 */
function parse_evenements(string $filepath): array {
    $content = file_get_contents($filepath);
    if ($content === false) return [];

    $lines = explode("\n", $content);
    $events = [];
    $current = null;

    foreach ($lines as $line) {
        $trimmed = trim($line);

        // Ignorer le bloc Format (entre --- et ---)
        if ($trimmed === '---') continue;
        // Ignorer le titre principal et les lignes de format
        if (strpos($trimmed, '# ') === 0 && strpos($trimmed, '## ') !== 0) continue;
        if (strpos($trimmed, '## Format') === 0) {
            // Sauter jusqu'au prochain ## qui n'est pas Format
            $current = null;
            continue;
        }

        // Nouvel événement : ## Titre
        if (strpos($trimmed, '## ') === 0) {
            if ($current !== null) {
                $current['description'] = trim($current['description']);
                $events[] = $current;
            }
            $current = [
                'title' => substr($trimmed, 3),
                'date' => null,
                'date_raw' => null,
                'horaire' => null,
                'lieu' => null,
                'lieu_url' => null,
                'animateur' => null,
                'description' => '',
            ];
            continue;
        }

        if ($current === null) continue;

        // Métadonnées : - clé: valeur
        if (preg_match('/^- (date|horaire|lieu|lieu_url|animateur):\s*(.+)$/', $trimmed, $m)) {
            $key = $m[1];
            $value = trim($m[2]);
            if ($key === 'date') {
                $current['date_raw'] = $value;
                // Convertir JJ/MM/YYYY en timestamp
                $parts = explode('/', $value);
                if (count($parts) === 3) {
                    $current['date'] = mktime(0, 0, 0, (int)$parts[1], (int)$parts[0], (int)$parts[2]);
                }
            } else {
                $current[$key] = $value;
            }
            continue;
        }

        // Ignorer les lignes de description du format
        if (strpos($trimmed, '- `') === 0) continue;
        if (strpos($trimmed, 'Les événements passés') === 0) continue;

        // Description libre
        if ($trimmed !== '' && strpos($trimmed, '- ') !== 0) {
            $current['description'] .= ($current['description'] ? ' ' : '') . $trimmed;
        }
    }

    // Dernier événement
    if ($current !== null) {
        $current['description'] = trim($current['description']);
        $events[] = $current;
    }

    // Filtrer : ne garder que les événements futurs ou du jour
    $today = strtotime('today');
    $events = array_filter($events, function($e) use ($today) {
        return $e['date'] !== null && $e['date'] >= $today;
    });

    // Trier par date croissante
    usort($events, function($a, $b) {
        return $a['date'] - $b['date'];
    });

    return $events;
}

/**
 * Formate une date timestamp en français.
 */
function format_date_evenement(int $timestamp): string {
    $jours = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    $mois = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin',
             'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

    $dow = (int)date('w', $timestamp);
    $d = (int)date('j', $timestamp);
    $m = (int)date('n', $timestamp) - 1;
    $y = date('Y', $timestamp);

    return $jours[$dow] . ' ' . $d . ' ' . $mois[$m] . ' ' . $y;
}
