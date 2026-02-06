#!/usr/bin/env node
/**
 * Génération automatique du sitemap.xml
 * Met à jour les dates de modification basées sur les fichiers réels
 * 
 * Usage: node build-sitemap.js
 */

const fs = require('fs');
const path = require('path');

// Configuration
const BASE_URL = 'https://sebhuet.github.io/aikido-kannagara';
const SITEMAP_FILE = path.join(__dirname, 'htdocs', 'sitemap.xml');

// Pages du site avec priorités et fréquences de changement
const PAGES = [
    { url: '/', priority: 1.0, changefreq: 'weekly' },
    { url: '/index.html', priority: 1.0, changefreq: 'weekly' },
    { url: '/aikido.html', priority: 0.8, changefreq: 'monthly' },
    { url: '/club.html', priority: 0.8, changefreq: 'monthly' },
    { url: '/professeurs.html', priority: 0.8, changefreq: 'monthly' },
    { url: '/inscription.html', priority: 0.9, changefreq: 'yearly' },
    { url: '/grades.html', priority: 0.6, changefreq: 'yearly' },
    { url: '/contact.html', priority: 0.7, changefreq: 'yearly' },
    { url: '/armes.html', priority: 0.7, changefreq: 'monthly' },
    { url: '/fondations.html', priority: 0.7, changefreq: 'monthly' },
    { url: '/lexique.html', priority: 0.5, changefreq: 'yearly' },
    { url: '/faq.html', priority: 0.7, changefreq: 'monthly' },
    { url: '/mentions-legales.html', priority: 0.3, changefreq: 'yearly' },
    { url: '/agenda.html', priority: 0.8, changefreq: 'weekly' },
    { url: '/statuts.html', priority: 0.3, changefreq: 'yearly' },
    { url: '/reglement-interieur.html', priority: 0.3, changefreq: 'yearly' },
];

/**
 * Récupère la date de dernière modification d'un fichier
 */
function getLastModified(filePath) {
    try {
        const fullPath = path.join(__dirname, 'htdocs', filePath.replace(/^\//, ''));
        const stats = fs.statSync(fullPath);
        return stats.mtime.toISOString().split('T')[0]; // Format YYYY-MM-DD
    } catch (error) {
        return new Date().toISOString().split('T')[0];
    }
}

/**
 * Génère le sitemap XML
 */
function generateSitemap() {
    console.log('🗺️  Génération du sitemap.xml...\n');

    let xml = '<?xml version="1.0" encoding="UTF-8"?>\n';
    xml += '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n';

    // Pages principales
    PAGES.forEach(page => {
        const lastmod = getLastModified(page.url === '/' ? 'index.html' : page.url);
        xml += `    <url>\n`;
        xml += `        <loc>${BASE_URL}${page.url}</loc>\n`;
        xml += `        <lastmod>${lastmod}</lastmod>\n`;
        xml += `        <changefreq>${page.changefreq}</changefreq>\n`;
        xml += `        <priority>${page.priority}</priority>\n`;
        xml += `    </url>\n`;
        
        console.log(`  ✓ ${page.url.padEnd(30)} (${lastmod})`);
    });

    xml += '</urlset>\n';

    // Écrire le fichier
    fs.writeFileSync(SITEMAP_FILE, xml, 'utf-8');

    console.log(`\n✨ Sitemap généré avec succès : ${SITEMAP_FILE}`);
    console.log(`📊 ${PAGES.length} URLs incluses\n`);
}

// Exécution
if (require.main === module) {
    generateSitemap();
}

module.exports = { generateSitemap };
