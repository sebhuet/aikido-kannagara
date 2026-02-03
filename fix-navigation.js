#!/usr/bin/env node
/**
 * Script pour uniformiser la navigation sur toutes les pages
 * Ajoute le lien Agenda et s'assure que toutes ont la même structure
 * 
 * Usage: node fix-navigation.js
 */

const fs = require('fs');
const path = require('path');

// Navigation cible (sans le lien actif)
const STANDARD_NAV = `                <ul class="nav__list">
                    <li class="nav__item"><a href="index.html" class="nav__link">Accueil</a></li>
                    <li class="nav__item"><a href="aikido.html" class="nav__link">Aïkido</a></li>
                    <li class="nav__item"><a href="club.html" class="nav__link">Club</a></li>
                    <li class="nav__item"><a href="professeurs.html" class="nav__link">Professeurs</a></li>
                    <li class="nav__item"><a href="actualites.html" class="nav__link">Actualités</a></li>
                    <li class="nav__item"><a href="agenda.html" class="nav__link">Agenda</a></li>
                    <li class="nav__item"><a href="galerie.html" class="nav__link">Galerie</a></li>
                    <li class="nav__item"><a href="blog.html" class="nav__link">Blog</a></li>
                    <li class="nav__item"><a href="inscription.html" class="nav__link">Inscription</a></li>
                    <li class="nav__item"><a href="contact.html" class="nav__link">Contact</a></li>
                </ul>`;

const FILES = [
    'aikido.html',
    'armes.html',
    'club.html',
    'professeurs.html',
    'actualites.html',
    'agenda.html',
    'galerie.html',
    'blog.html',
    'inscription.html',
    'contact.html',
    'fondations.html',
    'grades.html',
    'faq.html',
    'lexique.html',
    'mentions-legales.html'
];

function updateNavigation(filePath, fileName) {
    let content = fs.readFileSync(filePath, 'utf-8');
    
    // Trouver quelle page est active
    let activePage = fileName.replace('.html', '');
    
    // Créer la navigation avec la page active marquée
    let navWithActive = STANDARD_NAV.replace(
        `href="${fileName}"`,
        `href="${fileName}" class="nav__link nav__link--active"`
    );
    
    // Pour index.html, marquer Accueil comme actif
    if (fileName === 'index.html') {
        navWithActive = STANDARD_NAV.replace(
            `href="index.html" class="nav__link"`,
            `href="index.html" class="nav__link nav__link--active"`
        );
    }
    
    // Remplacer la navigation existante
    const navStartRegex = /<ul class="nav__list"[^>]*>/;
    const navEndRegex = /<\/ul>/;
    
    const navStart = content.search(navStartRegex);
    if (navStart === -1) {
        console.log(`  ⚠ ${fileName}: nav__list non trouvé`);
        return false;
    }
    
    // Trouver la fin du ul.nav__list
    let navEnd = content.indexOf('</ul>', navStart);
    if (navEnd === -1) {
        console.log(`  ⚠ ${fileName}: </ul> non trouvé`);
        return false;
    }
    navEnd += 5; // Inclure </ul>
    
    // Remplacer
    content = content.substring(0, navStart) + navWithActive + content.substring(navEnd);
    
    fs.writeFileSync(filePath, content, 'utf-8');
    return true;
}

console.log('🔧 Uniformisation de la navigation...\n');

let updated = 0;
let errors = 0;

FILES.forEach(file => {
    const filePath = path.join(__dirname, file);
    
    if (!fs.existsSync(filePath)) {
        console.log(`  ⊘ ${file} (n'existe pas)`);
        return;
    }
    
    if (updateNavigation(filePath, file)) {
        console.log(`  ✓ ${file}`);
        updated++;
    } else {
        errors++;
    }
});

// Traiter index.html séparément car il a role="menubar"
const indexPath = path.join(__dirname, 'index.html');
if (fs.existsSync(indexPath)) {
    let content = fs.readFileSync(indexPath, 'utf-8');
    
    let navWithActive = STANDARD_NAV
        .replace('<ul class="nav__list">', '<ul class="nav__list" id="nav-list" role="menubar">')
        .replace('href="index.html" class="nav__link"', 'href="index.html" class="nav__link nav__link--active" role="menuitem" aria-current="page"')
        .replace(/class="nav__link"/g, 'class="nav__link" role="menuitem"')
        .replace(/class="nav__link nav__link--active"/g, 'class="nav__link nav__link--active" role="menuitem"')
        .replace(/<li class="nav__item">/g, '<li class="nav__item" role="none">');
    
    const navStart = content.search(/<ul class="nav__list"/);
    let navEnd = content.indexOf('</ul>', navStart) + 5;
    
    content = content.substring(0, navStart) + navWithActive + content.substring(navEnd);
    
    fs.writeFileSync(indexPath, content, 'utf-8');
    console.log(`  ✓ index.html (avec rôles ARIA)`);
    updated++;
}

console.log(`\n✨ Terminé : ${updated} pages mises à jour, ${errors} erreurs\n`);
