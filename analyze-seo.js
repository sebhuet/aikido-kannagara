#!/usr/bin/env node
/**
 * Script d'optimisation des performances et SEO
 * 
 * Fonctionnalités:
 * - Analyse des images et suggestions d'optimisation
 * - Vérification des métadonnées SEO
 * - Analyse de performance basique
 * 
 * Usage: node analyze-seo.js
 */

const fs = require('fs');
const path = require('path');

const IMAGES_DIR = path.join(__dirname, 'images');

/**
 * Analyse les images du site
 */
function analyzeImages() {
    console.log('🖼️  Analyse des images...\n');
    
    if (!fs.existsSync(IMAGES_DIR)) {
        console.log('❌ Répertoire images/ non trouvé\n');
        return;
    }

    const files = fs.readdirSync(IMAGES_DIR, { recursive: true })
        .filter(f => /\.(jpg|jpeg|png|gif|svg)$/i.test(f));

    let totalSize = 0;
    const largeImages = [];

    files.forEach(file => {
        const filePath = path.join(IMAGES_DIR, file);
        const stats = fs.statSync(filePath);
        const sizeKB = (stats.size / 1024).toFixed(2);
        totalSize += stats.size;

        if (stats.size > 200 * 1024) { // > 200 KB
            largeImages.push({ file, sizeKB });
        }
    });

    console.log(`📊 Statistiques images:`);
    console.log(`  • Total: ${files.length} images`);
    console.log(`  • Taille totale: ${(totalSize / 1024 / 1024).toFixed(2)} MB`);
    console.log(`  • Taille moyenne: ${(totalSize / files.length / 1024).toFixed(2)} KB\n`);

    if (largeImages.length > 0) {
        console.log(`⚠️  Images volumineuses (> 200 KB):`);
        largeImages.forEach(img => {
            console.log(`  • ${img.file}: ${img.sizeKB} KB`);
        });
        console.log('\n💡 Recommandation: Optimiser ces images avec TinyPNG ou ImageOptim\n');
    } else {
        console.log('✅ Toutes les images sont bien optimisées!\n');
    }
}

/**
 * Vérifie les métadonnées SEO des pages HTML
 */
function checkSEO() {
    console.log('🔍 Vérification SEO...\n');

    const htmlFiles = fs.readdirSync(__dirname)
        .filter(f => f.endsWith('.html') && f !== '_template.html');

    const issues = [];

    htmlFiles.forEach(file => {
        const content = fs.readFileSync(path.join(__dirname, file), 'utf-8');
        const fileIssues = [];

        // Vérifier title
        if (!content.match(/<title>(.+?)<\/title>/)) {
            fileIssues.push('Pas de <title>');
        }

        // Vérifier meta description
        if (!content.match(/<meta name="description" content="(.+?)">/)) {
            fileIssues.push('Pas de meta description');
        }

        // Vérifier canonical
        if (!content.match(/<link rel="canonical"/)) {
            fileIssues.push('Pas de canonical URL');
        }

        // Vérifier Open Graph
        if (!content.match(/<meta property="og:title"/)) {
            fileIssues.push('Pas de Open Graph');
        }

        if (fileIssues.length > 0) {
            issues.push({ file, issues: fileIssues });
        }
    });

    if (issues.length > 0) {
        console.log('⚠️  Pages avec problèmes SEO:\n');
        issues.forEach(({ file, issues }) => {
            console.log(`  ${file}:`);
            issues.forEach(issue => console.log(`    • ${issue}`));
        });
        console.log();
    } else {
        console.log('✅ Toutes les pages HTML ont des métadonnées SEO complètes!\n');
    }

    console.log(`📈 Pages analysées: ${htmlFiles.length}`);
    console.log(`✓ Pages OK: ${htmlFiles.length - issues.length}`);
    console.log(`⚠ Pages à améliorer: ${issues.length}\n`);
}

/**
 * Génère un rapport de performance
 */
function performanceReport() {
    console.log('⚡ Rapport de performance...\n');

    const recommendations = [
        '✓ Minifier CSS et JavaScript pour réduire la taille',
        '✓ Activer la compression GZIP sur le serveur',
        '✓ Utiliser le format WebP pour les images (90% plus léger)',
        '✓ Lazy loading pour les images hors viewport',
        '✓ Précharger les polices critiques',
        '✓ Mettre en cache les ressources statiques',
    ];

    console.log('💡 Recommandations:');
    recommendations.forEach(rec => console.log(`  ${rec}`));
    console.log();
}

// Exécution
console.log('🚀 Analyse SEO et Performance - Kannagara Aïkido\n');
console.log('═'.repeat(60) + '\n');

analyzeImages();
console.log('─'.repeat(60) + '\n');
checkSEO();
console.log('─'.repeat(60) + '\n');
performanceReport();

console.log('═'.repeat(60));
console.log('✨ Analyse terminée!\n');
