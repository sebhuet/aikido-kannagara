# Règles de nommage des vidéos par technique

Ces règles sont appliquées par la fonction `nom_sortie()` de `decoupe.py`. Un fichier
renommé à la main doit suivre la même règle, et `decoupe.py verifier` signale tout écart.

## Structure

`<Type de travail> - <Attaque> - <Technique> [<Forme>] - <Courant> - <Sensei>.mp4`

| Élément | Contenu | Exemple |
| --- | --- | --- |
| Type de travail | Suwari Waza, Tachi Waza, Ushiro Waza, Hanmi Handachi Waza | `Tachi Waza` |
| Attaque | Forme d'attaque, en tous mots séparés | `Ryote Dori`, `Ai Hanmi Katate Dori` |
| Technique | Nom du règlement CSDGE, tous mots séparés | `Tenchi Nage`, `Ude Kime Nage` |
| Forme | Omote ou Ura, entre crochets, après la technique | `Ikkyo [Omote]` |
| Courant | `FFAB` | `FFAB` |
| Sensei | `ACT` pour les vidéos de passage, `HABERT` pour les préparations de Greg Habert | `HABERT` |

## Règles appliquées

1. **Vidéo source** : le nom de la vidéo d'origine, sans « (préparation) ».
2. **Tiret après « waza »** : `Tachi waza Ryotedori` devient `Tachi Waza - Ryote Dori`.
3. **Katatedori** : `katatedori` devient `Katatedori`, puis `Katate Dori` (règle 4).
4. **Espace devant « Dori »** : `Ryotedori` devient `Ryote Dori`, `Katatedori` devient `Katate Dori`.
5. **Hanmi et Handachi** : `Hanmihandashi` ou `Hanmihandachi` devient `Hanmi Handachi`.
6. **Ai Hanmi** : `Aihanmi` devient `Ai Hanmi`.
7. **Gyaku Hanmi Katate Dori** : `Gyakukatatedori` devient `Gyaku Hanmi Katate Dori`.
8. **Technique** : nom du règlement CSDGE (livre 2, § 4), tous les mots séparés, avec un
   espace avant « Nage ». `Iriminage` devient `Irimi Nage`, `Kokyunage` devient `Kokyu Nage`,
   `Sotokaitennage` devient `Soto Kaiten Nage`, `Uchikaitennage` devient `Uchi Kaiten Nage`,
   `Udekimenage` devient `Ude Kime Nage`.
9. **Forme** : `Omote` ou `Ura` entre crochets, précédés d'un espace : `Ikkyo [Omote]`, `Nikyo [Ura]`.
10. **Majuscule à chaque mot** : tous les mots commencent par une majuscule.
11. **Courant et Sensei** : `FFAB` pour le courant, suivi du sensei. Le suffixe est
    `FFAB - ACT` pour les vidéos de passage et `FFAB - HABERT` pour les préparations.
    Le mot « (préparation) » est retiré du nom.

## Remarques techniques

- Sous Windows, un changement de casse seul (« katatedori » → « Katatedori ») ne prend pas
  dans un renommage direct : passer par un nom temporaire.
- Les caractères `[` et `]` sont autorisés dans les noms de fichiers Windows.

## Liste des fichiers (112)

- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Ikkyo - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Irimi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Kokyu Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Kotegaeshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Nikyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Shiho Nage [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Shiho Nage [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Soto Kaiten Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Sumiotoshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Gyaku Hanmi Katate Dori - Uchi Kaiten Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Hanmi Handachi Waza - Katate Dori - Ikkyo - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Irimi Nage - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Kokyu Nage - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Kotegaeshi - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Nikyo [Ura] - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Shiho Nage [Omote] - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Shiho Nage [Ura] - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Soto Kaiten Nage - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Sumiotoshi - FFAB - HABERT.mp4
- Hanmi Handachi Waza - Katate Dori - Uchi Kaiten Nage - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Gokyo - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Gokyo - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Ikkyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Ikkyo [Omote] - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Ikkyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Ikkyo [Ura] - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Irimi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Irimi Nage - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Kokyu Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Kokyu Nage - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Kotegaeshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Kotegaeshi - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Nikyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Nikyo [Omote] - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Nikyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Nikyo [Ura] - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Sankyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Sankyo [Omote] - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Sankyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Sankyo [Ura] - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Yonkyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Yonkyo [Omote] - FFAB - HABERT.mp4
- Suwari Waza - Shomen Uchi - Yonkyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Suwari Waza - Shomen Uchi - Yonkyo [Ura] - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Ikkyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Ikkyo [Omote] - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Ikkyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Ikkyo [Ura] - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Irimi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Irimi Nage - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Kokyu Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Kokyu Nage - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Koshi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Koshi Nage - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Kotegaeshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Kotegaeshi - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Nikyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Nikyo [Omote] - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Nikyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Nikyo [Ura] - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Shiho Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Shiho Nage - FFAB - HABERT.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Ude Kime Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ai Hanmi Katate Dori - Ude Kime Nage - FFAB - HABERT.mp4
- Tachi Waza - Katate Dori - Ikkyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Ikkyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Irimi Nage [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Irimi Nage [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Kokyu Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Koshi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Kotegaeshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Nikyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Shiho Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Soto Kaiten Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Uchi Kaiten Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Katate Dori - Ude Kime Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ryote Dori - Ikkyo - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ryote Dori - Irimi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ryote Dori - Kokyu Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ryote Dori - Koshi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ryote Dori - Kotegaeshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ryote Dori - Shiho Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ryote Dori - Tenchi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Ryote Dori - Ude Kime Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Shomen Uchi - Ikkyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Shomen Uchi - Ikkyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Shomen Uchi - Irimi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Shomen Uchi - Kokyu Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Shomen Uchi - Koshi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Shomen Uchi - Kotegaeshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Shomen Uchi - Shiho Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Shomen Uchi - Ude Kime Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Ikkyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Ikkyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Irimi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Kokyu Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Koshi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Kotegaeshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Nikyo [Omote] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Nikyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Shiho Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Tachi Waza - Yokomen Uchi - Ude Kime Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Ikkyo - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Irimi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Jujigarami - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Kokyu Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Koshi Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Kotegaeshi - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Nikyo [Ura] - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Sankyo - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Shiho Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
- Ushiro Waza - Ryote Dori - Ude Kime Nage - FFAB - CHARLES, CISSE, LUCCHETTI.mp4
