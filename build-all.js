#!/usr/bin/env node
/**
 * Script principal de génération
 * Lance tous les scripts de build dans le bon ordre
 *
 * Usage: node build-all.js
 */

const { execSync } = require("child_process");

// facultatif : un échec n'arrête pas le build (sans Python ni Pillow, le site affiche
// les photos originales, seulement plus lourdes)
const scripts = [
  { name: "Blog", cmd: "node build-blog.js" },
  { name: "Sitemap", cmd: "node build-sitemap.js" },
  { name: "Fichiers pour les assistants IA (llms.txt)", cmd: "node build-llms.js" },
  { name: "Images web (vignettes, accueil)", cmd: "python tools/optimiser_images.py", facultatif: true }
];

console.log("🚀 Génération complète du site...\n");

scripts.forEach((script, index) => {
  console.log(`\n[${index + 1}/${scripts.length}] ${script.name}`);
  console.log("─".repeat(50));

  try {
    execSync(script.cmd, { stdio: "inherit" });
  } catch (error) {
    if (script.facultatif) {
      console.warn(`\n⚠️  ${script.name} : étape ignorée (${script.cmd} a échoué)`);
      return;
    }
    console.error(`\n❌ Erreur lors de l'exécution de ${script.name}`);
    process.exit(1);
  }
});

console.log("\n" + "═".repeat(50));
console.log("✨ Génération complète terminée !");
console.log("═".repeat(50));
