<?php
/**
 * Helpers pour parser les fiches professeurs en Markdown avec front matter.
 */

/**
 * Parse une fiche .md : extrait le front matter YAML et le corps Markdown.
 * Retourne ['meta' => [...], 'body' => '...'] ou null si le format est invalide.
 */
function parse_fiche(string $filepath): ?array {
    $content = file_get_contents($filepath);
    if ($content === false) return null;

    // Extraire le front matter entre les deux ---
    if (!preg_match('/\A---\s*\n(.*?)\n---\s*\n(.*)\z/s', $content, $matches)) {
        return null;
    }

    // Parser le YAML simple (clé: valeur sur une ligne)
    $meta = [];
    foreach (explode("\n", $matches[1]) as $line) {
        $line = trim($line);
        if ($line === '') continue;
        $pos = strpos($line, ':');
        if ($pos !== false) {
            $key = trim(substr($line, 0, $pos));
            $value = trim(substr($line, $pos + 1));
            $meta[$key] = $value;
        }
    }

    return ['meta' => $meta, 'body' => trim($matches[2])];
}

/**
 * Convertit du Markdown simple en HTML.
 * Gère : paragraphes, **gras**, _italique_.
 */
function markdown_to_html(string $text): string {
    $text = trim($text);
    if ($text === '' || $text === '.') return '';

    // Découper en paragraphes (séparés par une ou plusieurs lignes vides)
    $paragraphs = preg_split('/\n{2,}/', $text);
    $html = '';

    foreach ($paragraphs as $p) {
        $p = trim($p);
        if ($p === '') continue;

        // Gras : **texte**
        $p = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $p);
        // Italique : _texte_
        $p = preg_replace('/(?<!\w)_(.+?)_(?!\w)/', '<em>$1</em>', $p);

        $html .= '<p>' . $p . "</p>\n";
    }

    return $html;
}

/**
 * Génère un slug à partir d'un nom (ex: "Jean-Marc Chamot" → "jean-marc-chamot").
 */
function slugify(string $name): string {
    $slug = strtolower($name);
    // Translittérer les accents
    $slug = strtr($slug, [
        'à'=>'a','â'=>'a','ä'=>'a','é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
        'î'=>'i','ï'=>'i','ô'=>'o','ö'=>'o','ù'=>'u','û'=>'u','ü'=>'u',
        'ç'=>'c','ñ'=>'n','œ'=>'oe','æ'=>'ae',
    ]);
    // Remplacer tout ce qui n'est pas alphanumérique ou tiret par un tiret
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    return trim($slug, '-');
}
