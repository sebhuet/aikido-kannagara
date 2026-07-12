<?php
/**
 * Équipe enseignante — source unique : les fiches professeurs/fiches/*.md.
 *
 * Pourquoi ce composant : la composition de l'équipe était réécrite à la main dans
 * 5 phrases (index, aikido, faq visible, faq JSON-LD, professeurs). Résultat :
 * Sébastien Huet, qui a pourtant sa fiche et sa photo dans le carrousel, était
 * absent de TOUTES ces phrases — professeurs.php annonçait 4 enseignants et en
 * affichait 5 juste en dessous. Générer la liste rend ce bug impossible.
 *
 * Ajouter un enseignant = déposer une fiche .md. Rien d'autre à toucher.
 */
require_once __DIR__ . '/markdown.php';
require_once __DIR__ . '/data.php';

/** Toutes les fiches enseignants, triées par nom de fichier (01-, 02-, ...). */
function equipe_fiches(): array
{
    static $fiches = null;
    if ($fiches === null) {
        $fiches = [];
        $fichiers = glob(__DIR__ . '/../professeurs/fiches/*.md');
        sort($fichiers);
        foreach ($fichiers as $fichier) {
            $fiche = parse_fiche($fichier);
            if ($fiche) {
                $fiches[] = $fiche;
            }
        }
    }
    return $fiches;
}

/** Nom du responsable pédagogique (défini dans club.json). */
function equipe_responsable(): string
{
    return club_data()['pedagogicalLead']['name'] ?? '';
}

/** Les enseignants, hors responsable pédagogique. Tableau de noms bruts. */
function equipe_intervenants(): array
{
    $responsable = equipe_responsable();
    $noms = array_map(fn($f) => $f['meta']['name'] ?? '', equipe_fiches());

    return array_values(array_filter($noms, fn($n) => $n !== '' && $n !== $responsable));
}

/** Nombre total d'enseignants (responsable pédagogique inclus). */
function equipe_nb(): int
{
    return count(equipe_fiches());
}

/** « A, B, C et D » — texte brut, à échapper par l'appelant (JSON-LD, meta...). */
function equipe_intervenants_txt(): string
{
    $noms = equipe_intervenants();
    if (count($noms) <= 1) {
        return $noms[0] ?? '';
    }
    $dernier = array_pop($noms);

    return implode(', ', $noms) . ' et ' . $dernier;
}

/** « <strong>A</strong>, <strong>B</strong> et <strong>D</strong> » — prêt à afficher. */
function equipe_intervenants_html(): string
{
    $noms = array_map(
        fn($n) => '<strong>' . htmlspecialchars($n) . '</strong>',
        equipe_intervenants()
    );
    if (count($noms) <= 1) {
        return $noms[0] ?? '';
    }
    $dernier = array_pop($noms);

    return implode(', ', $noms) . ' et ' . $dernier;
}
