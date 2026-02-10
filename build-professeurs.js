#!/usr/bin/env node
/**
 * Script de génération des sections professeurs
 * Lit les fiches Markdown et met à jour les pages HTML
 *
 * Usage: node build-professeurs.js
 *
 * Structure attendue:
 *   professeurs/fiches/XX-nom.md  - Fiches en markdown avec frontmatter YAML
 *   index.html                    - Page d'accueil (carrousel enseignants)
 *   professeurs.html              - Page complète des professeurs
 */

const fs = require('fs');
const path = require('path');

// Configuration
const FICHES_DIR = path.join(__dirname, 'htdocs', 'professeurs', 'fiches');
const INDEX_FILE = path.join(__dirname, 'htdocs', 'index.php');
const PROFESSEURS_FILE = path.join(__dirname, 'htdocs', 'professeurs.php');

/**
 * Parse le frontmatter YAML d'un fichier markdown
 */
function parseFrontmatter(content) {
    const frontmatterRegex = /^---\n([\s\S]*?)\n---\n([\s\S]*)$/;
    const match = content.match(frontmatterRegex);

    if (!match) {
        return { metadata: {}, content: content };
    }

    const yamlContent = match[1];
    const markdownContent = match[2];
    const metadata = {};

    yamlContent.split('\n').forEach(line => {
        if (line.match(/^(\w+):\s*(.*)$/)) {
            const [, key, value] = line.match(/^(\w+):\s*(.*)$/);
            metadata[key] = value.trim();
        }
    });

    return { metadata, content: markdownContent };
}

/**
 * Convertit le markdown en HTML (version simplifiée)
 */
function markdownToHtml(markdown) {
    let html = markdown;

    // Gras
    html = html.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
    // Italique
    html = html.replace(/\*(.+?)\*/g, '<em>$1</em>');
    // Paragraphes
    html = html.split('\n\n').map(block => {
        block = block.trim();
        if (!block) return '';
        if (block.startsWith('<')) return block;
        return `<p>${block}</p>`;
    }).join('\n');

    return html;
}

/**
 * Lit et traite toutes les fiches
 */
function readFiches() {
    const files = fs.readdirSync(FICHES_DIR).filter(f => f.endsWith('.md'));
    const professeurs = [];

    for (const file of files) {
        const filePath = path.join(FICHES_DIR, file);
        const content = fs.readFileSync(filePath, 'utf-8');
        const { metadata, content: markdown } = parseFrontmatter(content);

        // Extraire l'ordre du préfixe XX-
        let order = 99;
        const orderMatch = file.match(/^(\d+)-/);
        if (orderMatch) {
            order = parseInt(orderMatch[1], 10);
        }

        // Extraire le slug du nom de fichier
        let slug = path.basename(file, '.md');
        if (slug.match(/^\d+-/)) {
            slug = slug.replace(/^\d+-/, '');
        }

        professeurs.push({
            ...metadata,
            markdown,
            htmlContent: markdownToHtml(markdown),
            filename: file,
            slug,
            order
        });
    }

    // Trier par ordre
    professeurs.sort((a, b) => a.order - b.order);

    return professeurs;
}

/**
 * Génère le HTML du carrousel pour index.html
 */
function generateCarouselHtml(professeurs) {
    const slides = professeurs.map((p, index) => {
        const photoHtml = p.photo
            ? `<img src="professeurs/fiches/${p.photo}" alt="${p.name}" class="team-member__photo">`
            : `<img src="images/logo-kannagara.png" alt="Logo Kannagara" class="team-member__photo" style="object-fit: contain; padding: 10px;">`;
        
        return `
                    <div class="team-member teachers-carousel__slide${index === 0 ? ' active' : ''}">
                        ${photoHtml}
                        <h3 class="team-member__name">${p.name}</h3>
                        <p class="team-member__grade">${p.grade}</p>
                    </div>`;
    }).join('');

    const dots = professeurs.map((p, index) =>
        `<button class="teachers-carousel__dot${index === 0 ? ' active' : ''}" data-slide="${index}" aria-label="Voir ${p.name}"></button>`
    ).join('\n                    ');

    return `<div class="teachers-carousel">
                <div class="teachers-carousel__track">${slides}
                </div>
                <div class="teachers-carousel__dots">
                    ${dots}
                </div>
            </div>`;
}

/**
 * Génère le HTML de la liste pour professeurs.html
 */
function generateProfesseursHtml(professeurs) {
    return professeurs.map((p, index) => {
        const isAlt = index % 2 === 0;
        const isReversed = index % 2 === 1;

        const gridStyle = isReversed
            ? 'grid-template-columns: 1fr 250px'
            : 'grid-template-columns: 250px 1fr';

        const photoHtml = p.photo
            ? `
                        <div class="team-member" style="text-align: center;">
                            <img src="professeurs/fiches/${p.photo}" alt="${p.name}" class="team-member__photo" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>`
            : `
                        <div class="team-member" style="text-align: center;">
                            <img src="images/logo-kannagara.png" alt="Logo Kannagara" class="team-member__photo" style="width: 200px; height: 200px; object-fit: contain; padding: 20px;">
                        </div>`;

        const contentHtml = `
                        <div>
                            <h2 style="margin-top: 0;">${p.name}</h2>
                            <p class="team-member__grade" style="font-size: 1.25rem; margin-bottom: var(--spacing-md);">
                                ${p.grade}
                            </p>
                            ${p.diplome ? `<p><strong>Diplôme</strong> : ${p.diplome}</p>` : ''}
                            ${p.fonction ? `<p><strong>Fonction fédérale</strong> : ${p.fonction}</p>` : ''}
                            <h3>Parcours</h3>
                            ${p.htmlContent}
                        </div>`;

        const innerContent = isReversed
            ? contentHtml + photoHtml
            : photoHtml + contentHtml;

        if (isAlt) {
            return `
            <!-- ${p.name} -->
            <div id="${p.slug}" class="section section--alt" style="margin: var(--spacing-xl) calc(-50vw + 50%); padding: var(--spacing-xl) calc(50vw - 50%);">
                <div style="max-width: 900px; margin: 0 auto;">
                    <div class="team-grid" style="${gridStyle}; align-items: start;">
                        ${innerContent}
                    </div>
                </div>
            </div>`;
        } else {
            return `
            <!-- ${p.name} -->
            <div id="${p.slug}" style="max-width: 900px; margin: var(--spacing-xl) auto;">
                <div class="team-grid" style="${gridStyle}; align-items: start;">
                    ${innerContent}
                </div>
            </div>`;
        }
    }).join('\n');
}

/**
 * Génère le JSON-LD pour le SEO
 */
function generateJsonLd(professeurs) {
    const items = professeurs.map((p, index) => `{
                "@type": "Person",
                "position": ${index + 1},
                "name": "${p.name}",
                "jobTitle": "Professeur d'aïkido",
                "description": "${p.grade}.",
                "worksFor": {
                    "@type": "Organization",
                    "name": "Kannagara Aïkido Club de Guyancourt"
                }
            }`).join(',\n            ');

    return `{
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Professeurs d'aïkido du club Kannagara",
        "itemListElement": [
            ${items}
        ]
    }`;
}

/**
 * Met à jour index.html avec le carrousel
 */
function updateIndexHtml(professeurs) {
    let html = fs.readFileSync(INDEX_FILE, 'utf-8');

    const carouselHtml = generateCarouselHtml(professeurs);

    // Trouver le début et la fin du carrousel
    const startMarker = '<div class="teachers-carousel">';
    const startIndex = html.indexOf(startMarker);

    if (startIndex === -1) {
        console.log('⚠ Carrousel non trouvé dans index.html');
        return;
    }

    // Trouver la fin du carrousel (après les 3 div fermantes)
    let endIndex = startIndex;
    let divCount = 0;
    let inCarousel = false;

    for (let i = startIndex; i < html.length; i++) {
        if (html.substring(i, i + 4) === '<div') {
            divCount++;
            inCarousel = true;
        } else if (html.substring(i, i + 6) === '</div>') {
            divCount--;
            if (inCarousel && divCount === 0) {
                endIndex = i + 6;
                break;
            }
        }
    }

    if (endIndex > startIndex) {
        html = html.substring(0, startIndex) + carouselHtml + html.substring(endIndex);
        fs.writeFileSync(INDEX_FILE, html);
        console.log(`✓ index.html mis à jour avec ${professeurs.length} enseignants`);
    } else {
        console.log('⚠ Fin du carrousel non trouvée dans index.html');
    }
}

/**
 * Met à jour professeurs.html avec les fiches complètes
 */
function updateProfesseursHtml(professeurs) {
    let html = fs.readFileSync(PROFESSEURS_FILE, 'utf-8');

    const professeursHtml = generateProfesseursHtml(professeurs);
    const jsonLd = generateJsonLd(professeurs);

    // Remplacer les fiches existantes (entre le paragraphe d'intro et la section "Notre approche")
    const fichesRegex = /(<!-- Jean-Marc Chamot -->[\s\S]*?)(?=\s*<!-- Approche pédagogique -->)/;
    const introEndRegex = /(<\/div>\s*\n\s*<!-- Jean-Marc Chamot -->)/;

    // Trouver et remplacer toutes les fiches des professeurs
    const startMarker = '</div>\n\n            <!-- Jean-Marc Chamot -->';
    const endMarker = '<!-- Approche pédagogique -->';

    const startIndex = html.indexOf('<!-- Jean-Marc Chamot -->');
    const endIndex = html.indexOf('<!-- Approche pédagogique -->');

    if (startIndex !== -1 && endIndex !== -1) {
        html = html.substring(0, startIndex) + professeursHtml.trim() + '\n\n            ' + html.substring(endIndex);

        // Mettre à jour le JSON-LD
        const jsonLdRegex = /<script type="application\/ld\+json">[\s\S]*?<\/script>/;
        html = html.replace(jsonLdRegex, `<script type="application/ld+json">\n    ${jsonLd}\n    </script>`);

        fs.writeFileSync(PROFESSEURS_FILE, html);
        console.log(`✓ professeurs.html mis à jour avec ${professeurs.length} enseignants`);
    } else {
        console.log('⚠ Section professeurs non trouvée dans professeurs.html');
    }
}

/**
 * Fonction principale
 */
function main() {
    console.log('🔨 Génération des pages professeurs...\n');

    // Vérifier que le dossier existe
    if (!fs.existsSync(FICHES_DIR)) {
        console.error(`❌ Dossier fiches non trouvé: ${FICHES_DIR}`);
        process.exit(1);
    }

    // Lire les fiches
    const professeurs = readFiches();
    console.log(`📚 ${professeurs.length} fiches trouvées\n`);

    // Afficher les professeurs
    professeurs.forEach((p, i) => {
        console.log(`  ${i + 1}. ${p.name} (${p.grade})`);
    });
    console.log('');

    // Mettre à jour les fichiers HTML
    updateIndexHtml(professeurs);
    updateProfesseursHtml(professeurs);

    console.log('\n✨ Génération terminée !');
}

// Exécution
main();
