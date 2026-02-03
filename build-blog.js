#!/usr/bin/env node
/**
 * Script de génération des articles de blog
 * Convertit les fichiers Markdown en pages HTML
 *
 * Usage: node build-blog.js
 *
 * Structure attendue:
 *   blog/articles/*.md   - Articles en markdown avec frontmatter YAML
 *   blog/_template.html  - Template HTML pour les articles
 *   blog/*.html          - Pages HTML générées
 */

const fs = require('fs');
const path = require('path');

// Configuration
const ARTICLES_DIR = path.join(__dirname, 'blog', 'articles');
const OUTPUT_DIR = path.join(__dirname, 'blog');
const TEMPLATE_FILE = path.join(__dirname, 'blog', '_template.html');
const BLOG_INDEX = path.join(__dirname, 'blog.html');

// Mois en français
const MONTHS_FR = [
    'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
    'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
];

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

    // Parse YAML simple (supporte les clés simples et les listes)
    let currentKey = null;
    let inList = false;

    yamlContent.split('\n').forEach(line => {
        // Liste item
        if (line.match(/^\s+-\s+(.+)$/)) {
            const value = line.match(/^\s+-\s+(.+)$/)[1].trim();
            if (currentKey && Array.isArray(metadata[currentKey])) {
                metadata[currentKey].push(value);
            }
        }
        // Clé: valeur
        else if (line.match(/^(\w+):\s*(.*)$/)) {
            const [, key, value] = line.match(/^(\w+):\s*(.*)$/);
            currentKey = key;
            if (value === '') {
                // Début d'une liste
                metadata[key] = [];
            } else {
                metadata[key] = value.trim();
            }
        }
    });

    return { metadata, content: markdownContent };
}

/**
 * Convertit le markdown en HTML
 */
function markdownToHtml(markdown) {
    let html = markdown;

    // Blocs de code
    html = html.replace(/```(\w*)\n([\s\S]*?)```/g, '<pre><code class="language-$1">$2</code></pre>');

    // Citations
    html = html.replace(/^>\s+(.+)$/gm, '<blockquote>$1</blockquote>');
    // Fusionner les blockquotes consécutifs
    html = html.replace(/<\/blockquote>\n<blockquote>/g, '\n');

    // Blocs info custom (:::info ... :::)
    html = html.replace(/:::info\s+([^\n]+)\n([\s\S]*?):::/g, (match, title, content) => {
        return `<div class="info-box">
            <h4 class="info-box__title">${title}</h4>
            ${markdownToHtml(content.trim())}
        </div>`;
    });

    // Titres
    html = html.replace(/^######\s+(.+)$/gm, '<h6>$1</h6>');
    html = html.replace(/^#####\s+(.+)$/gm, '<h5>$1</h5>');
    html = html.replace(/^####\s+(.+)$/gm, '<h4>$1</h4>');
    html = html.replace(/^###\s+(.+)$/gm, '<h3>$1</h3>');
    html = html.replace(/^##\s+(.+)$/gm, '<h2>$1</h2>');
    html = html.replace(/^#\s+(.+)$/gm, '<h1>$1</h1>');

    // Gras et italique
    html = html.replace(/\*\*\*(.+?)\*\*\*/g, '<strong><em>$1</em></strong>');
    html = html.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
    html = html.replace(/\*(.+?)\*/g, '<em>$1</em>');
    html = html.replace(/__(.+?)__/g, '<strong>$1</strong>');
    html = html.replace(/_(.+?)_/g, '<em>$1</em>');

    // Liens
    html = html.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2">$1</a>');

    // Images
    html = html.replace(/!\[([^\]]*)\]\(([^)]+)\)/g, '<img src="$2" alt="$1">');

    // Listes non ordonnées
    html = html.replace(/^(\s*)-\s+(.+)$/gm, (match, indent, content) => {
        const level = indent.length / 2;
        return `<li data-level="${level}">${content}</li>`;
    });

    // Envelopper les listes
    let inList = false;
    const lines = html.split('\n');
    const result = [];

    for (let i = 0; i < lines.length; i++) {
        const line = lines[i];
        const isListItem = line.startsWith('<li');

        if (isListItem && !inList) {
            result.push('<ul>');
            inList = true;
        } else if (!isListItem && inList) {
            result.push('</ul>');
            inList = false;
        }

        // Nettoyer l'attribut data-level
        result.push(line.replace(/ data-level="\d+"/, ''));
    }
    if (inList) result.push('</ul>');
    html = result.join('\n');

    // Paragraphes
    html = html.split('\n\n').map(block => {
        block = block.trim();
        if (!block) return '';
        if (block.startsWith('<')) return block;
        return `<p>${block.replace(/\n/g, ' ')}</p>`;
    }).join('\n\n');

    // Nettoyer les sauts de ligne excessifs
    html = html.replace(/\n{3,}/g, '\n\n');

    return html;
}

/**
 * Formate une date en français
 */
function formatDate(dateStr) {
    const date = new Date(dateStr);
    const day = date.getDate();
    const month = MONTHS_FR[date.getMonth()];
    const year = date.getFullYear();
    return `${day} ${month} ${year}`;
}

/**
 * Génère le HTML des tags
 */
function generateTagsHtml(tags) {
    if (!Array.isArray(tags)) return '';
    return tags.map(tag => `<span class="blog-card__tag">${tag}</span>`).join('\n                        ');
}

/**
 * Lit et traite tous les articles
 */
function readArticles() {
    const files = fs.readdirSync(ARTICLES_DIR).filter(f => f.endsWith('.md'));
    const articles = [];

    for (const file of files) {
        const filePath = path.join(ARTICLES_DIR, file);
        const content = fs.readFileSync(filePath, 'utf-8');
        const { metadata, content: markdown } = parseFrontmatter(content);

        articles.push({
            ...metadata,
            markdown,
            filename: file,
            slug: metadata.slug || path.basename(file, '.md')
        });
    }

    // Trier par date décroissante
    articles.sort((a, b) => new Date(b.date) - new Date(a.date));

    return articles;
}

/**
 * Génère une page HTML pour un article
 */
function generateArticlePage(article, prevArticle, template) {
    let html = template;

    // Remplacements
    html = html.replace(/\{\{title\}\}/g, article.title);
    html = html.replace(/\{\{description\}\}/g, article.description || '');
    html = html.replace(/\{\{slug\}\}/g, article.slug);
    html = html.replace(/\{\{date_formatted\}\}/g, formatDate(article.date));
    html = html.replace(/\{\{title_encoded\}\}/g, encodeURIComponent(article.title));
    html = html.replace(/\{\{tags_html\}\}/g, generateTagsHtml(article.tags));
    html = html.replace(/\{\{content\}\}/g, markdownToHtml(article.markdown));

    // Article précédent
    if (prevArticle) {
        html = html.replace(/\{\{prev_article\}\}/g,
            `<span class="card__meta">Article précédent</span><br>
                        <a href="${prevArticle.slug}.html">${prevArticle.title}</a>`);
    } else {
        html = html.replace(/\{\{prev_article\}\}/g, '');
    }

    return html;
}

/**
 * Met à jour la page blog.html avec la liste des articles
 */
function updateBlogIndex(articles) {
    let blogHtml = fs.readFileSync(BLOG_INDEX, 'utf-8');

    // Générer le HTML des cartes d'articles
    const cardsHtml = articles.map(article => `
                <!-- Article: ${article.title} -->
                <article class="blog-card fade-in">
                    <div class="blog-card__image"></div>
                    <div class="blog-card__content">
                        <span class="blog-card__date">${formatDate(article.date)}</span>
                        <h3 class="blog-card__title">
                            <a href="blog/${article.slug}.html">${article.title}</a>
                        </h3>
                        <p class="blog-card__excerpt">
                            ${article.description || ''}
                        </p>
                        <div class="blog-card__tags">
                            ${(article.tags || []).map(t => `<span class="blog-card__tag">${t}</span>`).join('\n                            ')}
                        </div>
                    </div>
                </article>`).join('\n');

    // Remplacer le contenu de la grille blog
    const gridRegex = /<div class="blog-grid">([\s\S]*?)<\/div>\s*<!-- Pagination/;
    blogHtml = blogHtml.replace(gridRegex, `<div class="blog-grid">${cardsHtml}
            </div>

            <!-- Pagination`);

    // Mettre à jour le compteur
    blogHtml = blogHtml.replace(/Affichage des \d+ articles/, `Affichage des ${articles.length} articles`);

    fs.writeFileSync(BLOG_INDEX, blogHtml);
    console.log(`✓ blog.html mis à jour avec ${articles.length} articles`);
}

/**
 * Fonction principale
 */
function main() {
    console.log('🔨 Génération du blog Kannagara...\n');

    // Vérifier que les dossiers existent
    if (!fs.existsSync(ARTICLES_DIR)) {
        console.error(`❌ Dossier articles non trouvé: ${ARTICLES_DIR}`);
        process.exit(1);
    }

    if (!fs.existsSync(TEMPLATE_FILE)) {
        console.error(`❌ Template non trouvé: ${TEMPLATE_FILE}`);
        process.exit(1);
    }

    // Lire le template
    const template = fs.readFileSync(TEMPLATE_FILE, 'utf-8');

    // Lire les articles
    const articles = readArticles();
    console.log(`📚 ${articles.length} articles trouvés\n`);

    // Générer les pages HTML
    for (let i = 0; i < articles.length; i++) {
        const article = articles[i];
        const prevArticle = articles[i + 1] || null; // Article plus ancien

        const html = generateArticlePage(article, prevArticle, template);
        const outputPath = path.join(OUTPUT_DIR, `${article.slug}.html`);

        fs.writeFileSync(outputPath, html);
        console.log(`✓ ${article.slug}.html généré`);
    }

    // Mettre à jour blog.html
    console.log('');
    updateBlogIndex(articles);

    console.log('\n✨ Génération terminée !');
}

// Exécution
main();
