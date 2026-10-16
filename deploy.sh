#!/bin/bash
set -e

# Sous Windows, le ssh de Git Bash ne voit pas l'agent OpenSSH de Windows (clé à
# passphrase) : on prend les binaires Windows quand ils existent.
OPENSSH_WIN="/c/Windows/System32/OpenSSH"
[ -x "$OPENSSH_WIN/ssh.exe" ] && PATH="$OPENSSH_WIN:$PATH"

echo "=== Build du site ==="
node build-all.js

echo ""
echo "=== Push vers GitHub ==="
git push origin master

echo ""
echo "=== Push vers Gandi ==="
git push gandi master

echo ""
echo "=== Déploiement sur Gandi ==="
ssh db69af46-028e-11f1-bb34-00163e94b645@git.sd3.gpaas.net 'deploy kannagara.fr.git'

echo ""
echo "=== Déploiement terminé ==="
echo "Le site est en cours de mise à jour sur https://www.kannagara.fr"
