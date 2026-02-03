# Todo - Déploiement GitHub Pages

## À faire

- [ ] Créer le Google Form (Nom, Email, Téléphone, Sujet, Message)
- [ ] Remplacer l'URL du formulaire dans `contact.html` ligne 201
- [ ] Créer le dépôt GitHub et pousser le code
- [ ] Activer GitHub Pages (Settings > Pages > main)
- [ ] Configurer le domaine personnalisé (CNAME + DNS)

## Détails

### 1. Google Form
Créer un formulaire Google avec les champs :
- Nom et prénom (obligatoire)
- Email (obligatoire)
- Téléphone (optionnel)
- Sujet : Inscription / Demande d'info / Stages / Autre (obligatoire)
- Message (obligatoire)

### 2. URL du formulaire
Dans `contact.html`, remplacer :
```
https://forms.gle/VOTRE_GOOGLE_FORM_ID
```
par le lien de partage de votre Google Form.

### 3. Push GitHub
```bash
git add .
git commit -m "Initial commit - Site Kannagara Aikido"
git remote add origin https://github.com/VOTRE_USERNAME/VOTRE_REPO.git
git push -u origin main
```

### 4. GitHub Pages
1. Aller dans Settings du dépôt
2. Section "Pages"
3. Source : "Deploy from a branch"
4. Branche : main, dossier / (root)
5. Sauvegarder

### 5. Domaine personnalisé
1. Créer un fichier `CNAME` à la racine contenant :
   ```
   www.votre-domaine.fr
   ```
2. Configurer les DNS chez le registrar :
   - Type A vers :
     - 185.199.108.153
     - 185.199.109.153
     - 185.199.110.153
     - 185.199.111.153
   - Ou CNAME vers `username.github.io`
