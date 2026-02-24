Voici la conversation WhatsApp du groupe du club d'aïkido Kannagara :

--- DÉBUT CONVERSATION WHATSAPP ---
{whatsapp}
--- FIN CONVERSATION WHATSAPP ---

Voici l'agenda actuel (fichier agenda.md) :

--- DÉBUT AGENDA ACTUEL ---
{agenda}
--- FIN AGENDA ACTUEL ---

Voici les règles d'arbitrage du planning :

--- DÉBUT RÈGLES ---
{regles}
--- FIN RÈGLES ---

## Contexte

Nous sommes le {date_du_jour}.

## Ta tâche

Analyse la conversation WhatsApp pour identifier :
1. Qui enseigne quel jour (professeur pour chaque créneau)
2. Les annulations de cours ("Pas de cours")
3. Les changements de jour, de lieu ou d'horaire
4. Les stages ou événements spéciaux
5. Les notes importantes à ajouter

## Règles de mise à jour

- Mets à jour les semaines existantes dans l'agenda si de nouvelles informations sont disponibles dans la conversation.
- Ajoute de nouvelles semaines si la conversation mentionne des dates futures non présentes dans l'agenda.
- Si un professeur est confirmé pour un créneau, indique son nom.
- Si aucune information n'est disponible pour un créneau, laisse le champ professeur vide (après le dernier `|`).
- Si un cours est explicitement annulé, indique "Pas de cours" comme professeur.
- Ne supprime jamais une information existante dans l'agenda sauf si la conversation la contredit explicitement.
- Applique les règles d'arbitrage pour les semaines futures sans information dans la conversation.

## Format de sortie

Retourne UNIQUEMENT le contenu complet du fichier agenda.md mis à jour, en respectant exactement le format suivant :

```
# Agenda des cours - Kannagara Aïkido

## Format

Chaque semaine commence par `## Semaine du JJ/MM/YYYY`
Chaque cours est défini par :

- Jour (lundi, mardi, mercredi, jeudi, vendredi, samedi, dimanche)
- Horaire
- Type (Enfants, Adultes, Tous niveaux)
- Professeur(s) présent(s)
- Notes éventuelles (optionnel)

## Semaine du JJ/MM/YYYY

### Jour JJ/MM

- **HHhMM-HHhMM** | Type | Professeur
- **HHhMM-HHhMM** | Type | Professeur
```

Règles de formatage :
- Titre de semaine : `## Semaine du JJ/MM/YYYY` (lundi de la semaine)
- Titre de jour : `### Jour JJ/MM` (nom du jour avec majuscule + JJ/MM)
- Cours : `- **HHhMM-HHhMM** | Type | Professeur`
- Professeur vide = `- **HHhMM-HHhMM** | Type |` (rien après le dernier pipe)
- Pas de cours = `- **HHhMM-HHhMM** | Type | Pas de cours`
- Fermé = `- **Fermé** | Raison`
- Note = `- **Note** : texte de la note`
- Une ligne vide entre chaque section (semaine, jour, liste de cours)

Ne retourne RIEN d'autre que le contenu du fichier markdown. Pas d'explication, pas de commentaire, pas de code fence autour.
