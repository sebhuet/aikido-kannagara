<?php
/**
 * Variantes web des images (WebP produites par tools/optimiser_images.py).
 *
 * Chaque fonction retombe sur l'original quand la variante manque (script pas encore
 * lancé, photo tout juste déposée) : le site reste juste, seulement plus lourd.
 */
require_once __DIR__ . '/data.php';

/** Chemin web encodé segment par segment : les noms de photos portent espaces et accents. */
function chemin_web(string $chemin): string
{
    return implode('/', array_map('rawurlencode', explode('/', $chemin)));
}

/** Fichier présent dans htdocs ? */
function image_existe(string $chemin): bool
{
    return is_file(__DIR__ . '/../' . $chemin);
}

/** Nom sans extension (pathinfo() se trompe sur certains noms accentués). */
function nom_sans_extension(string $fichier): string
{
    return preg_replace('/\.[^.]+$/', '', $fichier);
}

/**
 * Vignette d'une photo de la galerie (côté court 540 px), sinon la photo entière.
 * La visionneuse de la galerie garde la photo entière.
 */
function galerie_vignette(string $slug, string $photo): string
{
    $vignette = 'galerie/' . $slug . '/vignettes/' . nom_sans_extension($photo) . '.webp';
    return chemin_web(image_existe($vignette) ? $vignette : 'galerie/' . $slug . '/' . $photo);
}

/**
 * URL absolue de l'image affichée quand une page est partagée (WhatsApp, Facebook) :
 * images/partage/<nom>.jpg en 1200 × 630 (tools/images_partage.js), sinon l'image
 * générale du club, sinon le logo. Un logo carré donnait un aperçu minuscule.
 */
function image_partage(string $nom = 'kannagara'): string
{
    $site = rtrim(club_data()['url'], '/');
    foreach (array_unique([$nom, 'kannagara']) as $candidat) {
        if (image_existe("images/partage/$candidat.jpg")) {
            return "$site/images/partage/$candidat.jpg";
        }
    }
    return club_data()['logo'];
}

/**
 * Attributs src et srcset d'une photo du bandeau d'accueil (images/flyer/).
 * Les originaux en haute définition restent réservés aux flyers imprimés.
 *
 * @return array{src: string, srcset: ?string}
 */
function accueil_photo(string $fichier): array
{
    $nom = 'images/accueil/' . nom_sans_extension($fichier);
    if (!image_existe($nom . '-480.webp') || !image_existe($nom . '-960.webp')) {
        return ['src' => chemin_web('images/flyer/' . $fichier), 'srcset' => null];
    }
    return [
        'src' => chemin_web($nom . '-960.webp'),
        'srcset' => chemin_web($nom . '-480.webp') . ' 480w, ' . chemin_web($nom . '-960.webp') . ' 960w',
    ];
}
