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
const BASE_URL = 'https://kannagara.fr';
const SITEMAP_FILE = path.join(__dirname, 'htdocs', 'sitemap.xml');

// Pages du site avec priorités et fréquences de changement
const PAGES = [
    { url: '/', priority: 1.0, changefreq: 'weekly' },
    { url: '/index.php', priority: 1.0, changefreq: 'weekly' },
    { url: '/aikido.php', priority: 0.8, changefreq: 'monthly' },
    { url: '/club.php', priority: 0.8, changefreq: 'monthly' },
    { url: '/professeurs.php', priority: 0.8, changefreq: 'monthly' },
    { url: '/inscription.php', priority: 0.9, changefreq: 'yearly' },
    { url: '/grades.php', priority: 0.6, changefreq: 'yearly' },
    { url: '/contact.php', priority: 0.7, changefreq: 'yearly' },
    { url: '/armes.php', priority: 0.7, changefreq: 'monthly' },
    { url: '/fondations.php', priority: 0.7, changefreq: 'monthly' },
    { url: '/lexique.php', priority: 0.5, changefreq: 'yearly' },
    { url: '/faq.php', priority: 0.7, changefreq: 'monthly' },
    { url: '/mentions-legales.php', priority: 0.3, changefreq: 'yearly' },
    { url: '/agenda.php', priority: 0.8, changefreq: 'weekly' },
    { url: '/statuts.php', priority: 0.3, changefreq: 'yearly' },
    { url: '/reglement-interieur.php', priority: 0.3, changefreq: 'yearly' },
    { url: '/llms.txt', priority: 0.4, changefreq: 'monthly' },
    { url: '/llms-full.txt', priority: 0.4, changefreq: 'monthly' },
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
        const lastmod = getLastModified(page.url === '/' ? 'index.php' : page.url);
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
