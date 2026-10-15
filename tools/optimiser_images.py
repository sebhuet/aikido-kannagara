#!/usr/bin/env python3
"""
Variantes web des images du site (WebP), sans jamais toucher aux originaux.

  python tools/optimiser_images.py

Produit :
  - les vignettes de la galerie : galerie/<catégorie>/vignettes/<nom>.webp
    (côté court 540 px), affichées dans la grille de la galerie et dans le bandeau
    « Le club en images » de l'accueil ; la visionneuse garde la photo entière ;
  - les photos du bandeau « Moments de pratique » de l'accueil, tirées de
    images/flyer/ : images/accueil/<nom>-480.webp et -960.webp (les originaux, en
    haute définition, servent aux flyers imprimés) ;
  - la photo d'en-tête de l'accueil : images/accueil/hero-800.webp et -1600.webp.

Avant : l'accueil chargeait 3,9 Mo de photos en pleine résolution (10 s d'affichage
sur un téléphone en 4G lente). Une variante n'est refaite que si sa source est plus
récente ; une vignette dont la photo a disparu de la galerie est supprimée.
Lancé par build-all.js. Les fichiers produits sont à commiter avec les photos.
Nécessite Pillow (pip install Pillow) ; sans lui, le site affiche les originaux.
"""

import sys
from pathlib import Path

# Console Windows : sans cela, les accents des messages sortent illisibles
sys.stdout.reconfigure(encoding="utf-8")

try:
    from PIL import Image, ImageOps
except ImportError:
    print("Pillow absent (pip install Pillow) : variantes web non produites, le site affiche les originaux.")
    sys.exit(0)

HTDOCS = Path(__file__).resolve().parent.parent / "htdocs"
EXTENSIONS = {".jpg", ".jpeg", ".png", ".webp"}
QUALITE = 78

# Photo d'en-tête de l'accueil : studio sur fond noir, sobre et contrastée, elle laisse
# la place au titre. La changer ici, puis relancer le script.
HERO = HTDOCS / "galerie" / "vie-club" / "vie-du-club-02.jpg"


def ouvrir(chemin):
    image = ImageOps.exif_transpose(Image.open(chemin))
    return image.convert("RGB")


def a_refaire(source, cible):
    return not cible.exists() or cible.stat().st_mtime < source.stat().st_mtime


def enregistrer(image, cible):
    cible.parent.mkdir(parents=True, exist_ok=True)
    image.save(cible, "WEBP", quality=QUALITE, method=6)


def largeur(source, cible, px):
    """Redimensionne à px de large (jamais d'agrandissement)."""
    if not a_refaire(source, cible):
        return False
    image = ouvrir(source)
    if image.width > px:
        image = image.resize((px, round(image.height * px / image.width)), Image.LANCZOS)
    enregistrer(image, cible)
    return True


def cote_court(source, cible, px):
    """Redimensionne pour que le plus petit côté fasse px (jamais d'agrandissement)."""
    if not a_refaire(source, cible):
        return False
    image = ouvrir(source)
    ratio = px / min(image.size)
    if ratio < 1:
        image = image.resize((round(image.width * ratio), round(image.height * ratio)), Image.LANCZOS)
    enregistrer(image, cible)
    return True


def main():
    faits = 0

    # Vignettes de la galerie : la grille affiche des cases 4:3 d'environ 300 px de
    # large, 540 px de côté court couvrent les écrans haute densité.
    galerie = HTDOCS / "galerie"
    for dossier in sorted(p for p in galerie.iterdir() if p.is_dir()):
        sources = {p.stem: p for p in dossier.iterdir() if p.is_file() and p.suffix.lower() in EXTENSIONS}
        vignettes = dossier / "vignettes"
        for nom, source in sorted(sources.items()):
            faits += cote_court(source, vignettes / f"{nom}.webp", 540)
        if vignettes.is_dir():
            for orpheline in vignettes.glob("*.webp"):
                if orpheline.stem not in sources:
                    orpheline.unlink()
                    print(f"  vignette retirée : {dossier.name}/{orpheline.name}")

    # Bandeau « Moments de pratique » : cases 4:3 de 175 px (mobile, 2 colonnes) à
    # 285 px (ordinateur, 4 colonnes).
    accueil = HTDOCS / "images" / "accueil"
    for source in sorted((HTDOCS / "images" / "flyer").glob("*.jpg")):
        for px in (480, 960):
            faits += largeur(source, accueil / f"{source.stem}-{px}.webp", px)

    # Photo d'en-tête : toute la largeur de l'écran.
    if HERO.exists():
        for px in (800, 1600):
            faits += largeur(HERO, accueil / f"hero-{px}.webp", px)
    else:
        print(f"  photo d'en-tête introuvable : {HERO.relative_to(HTDOCS)}")

    print(f"Images web : {faits} variante(s) produite(s)" if faits else "Images web : à jour")


if __name__ == "__main__":
    main()
