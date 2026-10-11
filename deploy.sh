#!/bin/bash
set -e

echo "=== Build du site ==="
node build-all.js

echo ""
echo "=== Push vers GitHub ==="
git push origin master

echo ""
echo "=== Push vers Gandi (master + vidéothèque) ==="
# Les vidéos de VideoRef/ ne vont que sur Gandi : tools/commit_gandi.js construit un
# commit master + htdocs/videotheque/ sans toucher aux branches. Forcé, car ce commit
# est recréé à chaque déploiement (son parent reste toujours master).
COMMIT_GANDI=$(node tools/commit_gandi.js)
git push gandi "+$COMMIT_GANDI:refs/heads/master"

echo ""
echo "=== Déploiement sur Gandi ==="
ssh db69af46-028e-11f1-bb34-00163e94b645@git.sd3.gpaas.net 'deploy kannagara.fr.git'

echo ""
echo "=== Déploiement terminé ==="
echo "Le site est en cours de mise à jour sur https://www.kannagara.fr"
