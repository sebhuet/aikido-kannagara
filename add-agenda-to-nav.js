#!/usr/bin/env node
/**
 * Script pour ajouter le lien Agenda dans tous les menus de navigation
 * 
 * Usage: node add-agenda-to-nav.js
 */

const fs = require('fs');
const path = require('path');

const PAGES_TO_UPDATE = [
    'aikido.html',
    'club.html',
    'professeurs.html',
    'inscription.html',
    'contact.html',
    'armes.html',
    'fondations.html',
    'grades.html',
    'faq.html',
    'lexique.html',
    'mentions-legales.html',
    'reglement-interieur.html',
    'statuts.html'
];

function addAgendaToNav(filePath) {
    let content = fs.readFileSync(filePath, 'utf-8');
    
    // Vérifier si agenda.html est déjà présent
    if (content.includes('href="agenda.html"')) {
        return false;
    }
    
    // Chercher la ligne avec actualites.html et ajouter agenda.html après
    const actualitesLine = /<li class="nav__item".*?><a href="actualites\.html".*?<\/a><\/li>/;
    
    if (actualitesLine.test(content)) {
        content = content.replace(
            actualitesLine,
            (match) => match + '\n                    <li class="nav__item"><a href="agenda.html" class="nav__link">Agenda</a></li>'
        );
        
        fs.writeFileSync(filePath, content, 'utf-8');
        return true;
    }
    
    return false;
}

console.log('📝 Ajout du lien Agenda dans les menus de navigation...\n');

let updated = 0;
let skipped = 0;

PAGES_TO_UPDATE.forEach(page => {
    const filePath = path.join(__dirname, page);
    
    if (!fs.existsSync(filePath)) {
        console.log(`  ⊘ ${page} (n'existe pas)`);
        return;
    }
    
    if (addAgendaToNav(filePath)) {
        console.log(`  ✓ ${page}`);
        updated++;
    } else {
        console.log(`  ○ ${page} (déjà à jour)`);
        skipped++;
    }
});

console.log(`\n✨ Terminé : ${updated} pages mises à jour, ${skipped} déjà à jour\n`);
