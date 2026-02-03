#!/usr/bin/env node
/**
 * Script pour synchroniser le header et footer sur toutes les pages
 * Utilise les fichiers partials/header.html et partials/footer.html
 * 
 * Usage: node sync-layout.js
 */

const fs = require('fs');
const path = require('path');

const HEADER_PARTIAL = path.join(__dirname, 'partials', 'header.html');
const FOOTER_PARTIAL = path.join(__dirname, 'partials', 'footer.html');

const NAV_TEMPLATE = `                <ul class="nav__list">
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
    'index.html',
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

function getActiveNav(fileName) {
    let nav = NAV_TEMPLATE;
    
    // Marquer la page active
    if (fileName === 'index.html') {
        nav = nav.replace(
            'href="index.html" class="nav__link"',
            'href="index.html" class="nav__link nav__link--active" role="menuitem" aria-current="page"'
        );
        // Ajouter les rôles ARIA pour index
        nav = nav
            .replace('<ul class="nav__list">', '<ul class="nav__list" id="nav-list" role="menubar">')
            .replace(/class="nav__link"/g, 'class="nav__link" role="menuitem"')
            .replace(/<li class="nav__item">/g, '<li class="nav__item" role="none">');
    } else {
        nav = nav.replace(
            `href="${fileName}"`,
            `href="${fileName}" class="nav__link nav__link--active"`
        );
    }
    
    return nav;
}

function syncHeader(filePath, fileName) {
    let content = fs.readFileSync(filePath, 'utf-8');
    let header = fs.readFileSync(HEADER_PARTIAL, 'utf-8');
    
    // Remplacer le placeholder par la navigation avec la page active
    const nav = getActiveNav(fileName);
    header = header.replace('<!-- NAV_PLACEHOLDER -->', nav);
    
    // Trouver et remplacer le header
    const headerStart = content.indexOf('<!-- Header -->');
    const headerEnd = content.indexOf('</header>');
    
    if (headerStart === -1 || headerEnd === -1) {
        console.log(`  ⚠ ${fileName}: Header non trouvé`);
        return false;
    }
    
    content = content.substring(0, headerStart) + 
              header + 
              content.substring(headerEnd + 9); // 9 = length of </header>
    
    fs.writeFileSync(filePath, content, 'utf-8');
    return true;
}

function syncFooter(filePath, fileName) {
    let content = fs.readFileSync(filePath, 'utf-8');
    let footer = fs.readFileSync(FOOTER_PARTIAL, 'utf-8');
    
    // Trouver et remplacer le footer
    const footerStart = content.indexOf('<!-- Footer -->');
    const footerEnd = content.indexOf('</footer>');
    
    if (footerStart === -1 || footerEnd === -1) {
        console.log(`  ⚠ ${fileName}: Footer non trouvé`);
        return false;
    }
    
    content = content.substring(0, footerStart) + 
              footer + 
              content.substring(footerEnd + 9); // 9 = length of </footer>
    
    fs.writeFileSync(filePath, content, 'utf-8');
    return true;
}

console.log('🔄 Synchronisation du layout (header + footer)...\n');

let headerUpdated = 0;
let footerUpdated = 0;

FILES.forEach(file => {
    const filePath = path.join(__dirname, file);
    
    if (!fs.existsSync(filePath)) {
        console.log(`  ⊘ ${file} (n'existe pas)`);
        return;
    }
    
    console.log(`  📄 ${file}`);
    
    if (syncHeader(filePath, file)) {
        console.log(`    ✓ Header`);
        headerUpdated++;
    }
    
    if (syncFooter(filePath, file)) {
        console.log(`    ✓ Footer`);
        footerUpdated++;
    }
});

console.log(`\n✨ Terminé :`);
console.log(`   ${headerUpdated} headers synchronisés`);
console.log(`   ${footerUpdated} footers synchronisés\n`);

console.log('💡 Pour modifier le header/footer, éditez les fichiers dans partials/');
console.log('   puis relancez : node sync-layout.js\n');
