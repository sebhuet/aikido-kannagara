# Fiches Professeurs

## Structure des fiches

Chaque fiche professeur est un fichier Markdown avec frontmatter YAML contenant les métadonnées du professeur.

### Format du fichier

**Nom de fichier** : `XX-prenom-nom.md` où XX est un numéro d'ordre (01, 02, etc.)

**Métadonnées (frontmatter YAML)** :
```yaml
---
name: Prénom Nom            # Nom complet du professeur
initials: XX                # Initiales (utilisées comme fallback si pas de photo)
grade: 7e Dan Aïkido FFAB   # Grade(s) du professeur
diplome: DESJEPS            # (Optionnel) Diplôme d'État
fonction: Cadre technique   # (Optionnel) Fonction fédérale
shortBio: Courte bio...     # Courte présentation pour le carrousel
photo: 01-prenom-nom.jpg    # Nom du fichier image (vignette)
photoCredit: Nom du photographe  # (Optionnel) Crédit photo
---
```

**Contenu** : Le contenu Markdown après le frontmatter représente le parcours détaillé du professeur.

## Vignettes (photos)

### Spécifications techniques

- **Format** : JPG
- **Dimensions** : 200 x 200 pixels (carré)
- **Emplacement** : Même répertoire que les fichiers `.md` (`professeurs/fiches/`)
- **Nommage** : `XX-prenom-nom.jpg` (correspond au nom du fichier `.md`)

### Recommandations

- Photo de portrait de qualité
- Cadrage centré sur le visage
- Fond uni de préférence
- Résolution suffisante pour un affichage net
- Format carré (ratio 1:1)

### Fallback

Si le champ `photo` n'est pas renseigné ou si le fichier image n'existe pas, le système affichera automatiquement un placeholder avec les initiales du professeur.

## Exemple complet

**Fichier** : `01-jean-marc-chamot.md`
**Photo** : `01-jean-marc-chamot.jpg`

```markdown
---
name: Jean-Marc Chamot
initials: JMC
grade: 7e Dan Aïkido - 4e Dan Iaïdo
diplome: DESJEPS
fonction: Cadre technique FFAB
shortBio: Professeur diplômé d'État, cadre technique FFAB.
photo: 01-jean-marc-chamot.jpg
---

Jean-Marc débute l'Aïkido au début des années 70...
```

## Génération des pages HTML

Utilisez le script `build-professeurs.js` pour générer les pages HTML :

```bash
node build-professeurs.js
```

Ce script met à jour :
- `index.html` (carrousel des enseignants)
- `professeurs.html` (liste complète des professeurs)
