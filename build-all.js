#!/usr/bin/env node
/**
 * Script principal de génération
 * Lance tous les scripts de build dans le bon ordre
 *
 * Usage: node build-all.js
 */

const { execSync } = require("child_process");

const scripts = [
  { name: "Blog", cmd: "node build-blog.js" },
  { name: "Sitemap", cmd: "node build-sitemap.js" }
];

console.log("🚀 Génération complète du site...\n");

scripts.forEach((script, index) => {
  console.log(`\n[${index + 1}/${scripts.length}] ${script.name}`);
  console.log("─".repeat(50));

  try {
    execSync(script.cmd, { stdio: "inherit" });
  } catch (error) {
    console.error(`\n❌ Erreur lors de l'exécution de ${script.name}`);
    process.exit(1);
  }
});

console.log("\n" + "═".repeat(50));
console.log("✨ Génération complète terminée !");
console.log("═".repeat(50));
