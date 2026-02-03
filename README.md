# Kannagara Aïkido Club de Guyancourt

Site web officiel du club d'aïkido Kannagara de Guyancourt (78).

## Hébergement

Ce site est hébergé sur GitHub Pages.

## Structure du projet

```
├── index.html          # Page d'accueil
├── aikido.html         # Présentation de l'aïkido
├── club.html           # Le club
├── professeurs.html    # Les professeurs
├── actualites.html     # Actualités et événements
├── galerie.html        # Galerie photos
├── blog.html           # Articles du blog
├── inscription.html    # Informations d'inscription
├── contact.html        # Contact
├── faq.html            # Questions fréquentes
├── grades.html         # Système des grades
├── lexique.html        # Lexique japonais
├── armes.html          # Pratique des armes
├── fondations.html     # Fondations de l'aïkido
├── mentions-legales.html
├── css/
│   ├── style.css       # Styles principaux
│   └── responsive.css  # Styles responsive
├── js/
│   └── main.js         # JavaScript
├── images/             # Images du site
├── blog/               # Articles de blog
├── feed.xml            # Flux RSS
├── sitemap.xml         # Plan du site
├── robots.txt          # Directives robots
└── llms.txt            # Informations pour LLMs
```

## Configuration requise

### Domaine personnalisé

Pour utiliser un domaine personnalisé :

1. Créer un fichier `CNAME` à la racine contenant le domaine :
   ```
   www.votre-domaine.fr
   ```

2. Configurer les DNS chez votre registrar :
   - Type A vers les IPs GitHub Pages :
     - 185.199.108.153
     - 185.199.109.153
     - 185.199.110.153
     - 185.199.111.153
   - Ou CNAME vers `username.github.io`

### Formulaire de contact

Le formulaire de contact utilise Google Forms. Pour le configurer :

1. Créer un Google Form avec les champs : Nom, Email, Téléphone, Sujet, Message
2. Récupérer le lien de partage du formulaire
3. Remplacer `https://forms.gle/VOTRE_GOOGLE_FORM_ID` dans `contact.html`

### URLs canoniques

Si vous changez de domaine, mettre à jour les URLs canoniques dans chaque fichier HTML :
- Balise `<link rel="canonical">`
- Balises `<meta property="og:url">`

## Développement local

Ouvrir simplement `index.html` dans un navigateur, ou utiliser un serveur local :

```bash
# Avec Python
python -m http.server 8000

# Avec Node.js (npx)
npx serve
```

## Licence

© 2024 Kannagara Aïkido Club de Guyancourt. Tous droits réservés.
