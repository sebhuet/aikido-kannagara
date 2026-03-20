#!/usr/bin/env node
/**
 * Génération automatique du sitemap.xml
 * Met à jour les dates de modification basées sur les fichiers réels
 *
 * Usage: node build-sitemap.js
 */

const fs = require("fs");
const path = require("path");

// Configuration
const BASE_URL = "https://kannagara.fr";
const SITEMAP_FILE = path.join(__dirname, "htdocs", "sitemap.xml");
const ARTICLES_DIR = path.join(__dirname, "htdocs", "blog", "articles");

// Pages du site avec priorités et fréquences de changement
// URLs canoniques en .html (le .htaccess redirige .html → .php)
// Exclut les pages noindex (mentions-legales, statuts, reglement-interieur)
const PAGES = [
  { url: "/", priority: 1.0, changefreq: "weekly" },
  { url: "/aikido.html", priority: 0.8, changefreq: "monthly" },
  { url: "/club.html", priority: 0.8, changefreq: "monthly" },
  { url: "/professeurs.html", priority: 0.8, changefreq: "monthly" },
  { url: "/inscription.html", priority: 0.9, changefreq: "yearly" },
  { url: "/grades.html", priority: 0.6, changefreq: "yearly" },
  { url: "/contact.html", priority: 0.7, changefreq: "yearly" },
  { url: "/armes.html", priority: 0.7, changefreq: "monthly" },
  { url: "/fondations.html", priority: 0.7, changefreq: "monthly" },
  { url: "/lexique.html", priority: 0.5, changefreq: "yearly" },
  { url: "/faq.html", priority: 0.7, changefreq: "monthly" },
  { url: "/agenda.html", priority: 0.8, changefreq: "weekly" },
  { url: "/actualites.html", priority: 0.8, changefreq: "weekly" },
  { url: "/blog.html", priority: 0.8, changefreq: "weekly" },
  { url: "/galerie.html", priority: 0.6, changefreq: "monthly" },
  { url: "/llms.txt", priority: 0.4, changefreq: "monthly" },
  { url: "/llms-full.txt", priority: 0.4, changefreq: "monthly" }
];

/**
 * Récupère la date de dernière modification d'un fichier
 */
function getLastModified(filePath) {
  try {
    // Les URLs sont en .html mais les fichiers sources sont en .php
    const resolved = filePath.replace(/^\//, "").replace(/\.html$/, ".php");
    const fullPath = path.join(__dirname, "htdocs", resolved || "index.php");
    const stats = fs.statSync(fullPath);
    return stats.mtime.toISOString().split("T")[0]; // Format YYYY-MM-DD
  } catch (error) {
    return new Date().toISOString().split("T")[0];
  }
}

/**
 * Découvre les articles de blog et retourne leurs entrées sitemap
 */
function getBlogArticles() {
  if (!fs.existsSync(ARTICLES_DIR)) return [];

  const files = fs.readdirSync(ARTICLES_DIR).filter((f) => f.endsWith(".md"));
  const articles = [];

  for (const file of files) {
    const content = fs.readFileSync(path.join(ARTICLES_DIR, file), "utf-8");
    const frontmatterMatch = content.match(/^---\n([\s\S]*?)\n---/);
    if (!frontmatterMatch) continue;

    const yaml = frontmatterMatch[1];
    const slugMatch = yaml.match(/^slug:\s*(.+)$/m);
    const dateMatch = yaml.match(/^date:\s*(.+)$/m);

    let slug = slugMatch ? slugMatch[1].trim() : path.basename(file, ".md");
    if (slug.match(/^\d{8}-/)) slug = slug.substring(9);

    const date = dateMatch ? dateMatch[1].trim() : null;

    articles.push({
      url: `/blog/${slug}.html`,
      priority: 0.6,
      changefreq: "yearly",
      lastmod: date || null
    });
  }

  return articles;
}

/**
 * Génère le sitemap XML
 */
function generateSitemap() {
  console.log("🗺️  Génération du sitemap.xml...\n");

  const blogArticles = getBlogArticles();
  const allPages = [...PAGES, ...blogArticles];

  let xml = '<?xml version="1.0" encoding="UTF-8"?>\n';
  xml += '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n';

  // Pages principales + articles de blog
  allPages.forEach((page) => {
    const lastmod = page.lastmod || getLastModified(page.url === "/" ? "index.php" : page.url);
    xml += `    <url>\n`;
    xml += `        <loc>${BASE_URL}${page.url}</loc>\n`;
    xml += `        <lastmod>${lastmod}</lastmod>\n`;
    xml += `        <changefreq>${page.changefreq}</changefreq>\n`;
    xml += `        <priority>${page.priority}</priority>\n`;
    xml += `    </url>\n`;

    console.log(`  ✓ ${page.url.padEnd(40)} (${lastmod})`);
  });

  xml += "</urlset>\n";

  // Écrire le fichier
  fs.writeFileSync(SITEMAP_FILE, xml, "utf-8");

  console.log(`\n✨ Sitemap généré avec succès : ${SITEMAP_FILE}`);
  console.log(`📊 ${allPages.length} URLs incluses (${PAGES.length} pages + ${blogArticles.length} articles)\n`);
}

// Exécution
if (require.main === module) {
  generateSitemap();
}

module.exports = { generateSitemap };
