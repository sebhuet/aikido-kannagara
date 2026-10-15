<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/equipe.php';
require_once __DIR__ . '/includes/images.php';
require_once __DIR__ . '/includes/jsonld.php';
$club = club_data();
$sch = $club['schedule'];
$partage = image_partage();
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Aïkido Kannagara Guyancourt | Cours d'aïkido pour tous</title>
    <meta name="description" content="Club d'aïkido à Guyancourt (78) affilié FFAB. Cours pour enfants et adultes sous la responsabilité pédagogique de Nacer Chekkaba. Gymnase Maurice Baquet, lundi et jeudi.">
    <meta name="keywords" content="aïkido, aikido, Guyancourt, Saint-Quentin-en-Yvelines, Montigny-le-Bretonneux, Versailles, arts martiaux, FFAB, Jean-Marc Chamot, dojo, Yvelines, 78, cours aïkido">
    <meta name="author" content="Aïkido Kannagara Guyancourt">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/">
    <meta property="og:title" content="Aïkido Kannagara Guyancourt">
    <meta property="og:description" content="Club d'aïkido à Guyancourt (78) affilié FFAB. Responsabilité pédagogique de Nacer Chekkaba. Cours enfants et adultes, lundi et jeudi.">
    <meta property="og:image" content="<?= htmlspecialchars($partage) ?>">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:site_name" content="Aïkido Kannagara Guyancourt">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Aïkido Kannagara Guyancourt">
    <meta name="twitter:description" content="Club d'aïkido à Guyancourt (78) affilié FFAB. Responsabilité pédagogique de Nacer Chekkaba. Cours enfants et adultes, lundi et jeudi.">
    <meta name="twitter:image" content="<?= htmlspecialchars($partage) ?>">

    <!-- Geo Tags -->
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/logo-kannagara.jpg">

    <!-- LLM-friendly content -->
    <link rel="alternate" type="text/plain" href="https://kannagara.fr/llms.txt" title="LLM summary">
    <link rel="alternate" type="text/plain" href="https://kannagara.fr/llms-full.txt" title="LLM full content">

    <!-- Schema.org JSON-LD : le site et le club, une seule identité (includes/jsonld.php) -->
    <?php jsonld_script(jsonld_website(), jsonld_club()); ?>
</head>
<body>
    <?php $active = 'index'; include 'includes/header.php'; ?>







    <!-- Hero : photo de pratique sur fond noir (variantes WebP de tools/optimiser_images.py).
         Sans elle, le bandeau retrouve sa carte blanche sur le fond du site. -->
    <?php $heroPhoto = image_existe('images/accueil/hero-1600.webp'); ?>
    <section class="hero<?= $heroPhoto ? ' hero--photo' : '' ?>" aria-labelledby="hero-title">
        <?php if ($heroPhoto): ?>
        <img class="hero__photo" src="images/accueil/hero-1600.webp"
             srcset="images/accueil/hero-800.webp 800w, images/accueil/hero-1600.webp 1600w"
             sizes="(max-width: 1023px) 100vw, 70vw" width="1600" height="1073"
             alt="" fetchpriority="high">
        <?php endif; ?>
        <div class="container">
            <div class="hero__content">
                <h1 class="hero__title" id="hero-title">Aïkido Kannagara Guyancourt</h1>
                <p class="hero__subtitle">L'art martial de l'harmonie — enfants dès 7 ans, adultes tous niveaux</p>
                <p class="hero__description">
                    <?= htmlspecialchars(club_essai_accroche()) ?>.
                    Rendez-vous le <?= htmlspecialchars(implode(' et le ', array_map('strtolower', $sch['days']))) ?> à Guyancourt (78).
                </p>
                <div class="hero__buttons">
                    <a href="inscription.php#essai" class="btn btn--primary">Venez essayer</a>
                    <a href="inscription.php#comment" class="btn <?= $heroPhoto ? 'btn--secondary' : 'btn--outline' ?>">S'inscrire</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Moments de pratique : bandeau de 4 visuels sous le hero. Sélection fixe et curatée
         (distincte du bandeau « Le club en images » en bas de page, qui tourne au hasard
         chaque jour depuis la galerie). Les originaux d'images/flyer/ (jusqu'à 1,2 Mo,
         réservés aux flyers imprimés) sont servis en WebP de 480 et 960 px. Pas de
         chargement différé : le bandeau est visible dès l'arrivée sur la page. -->
    <?php
    $pratique = [
        ['file' => 'travail.jpg', 'alt' => "Travail à deux à mains nues, cours d'aïkido adultes"],
        ['file' => 'mixte.jpg', 'alt' => "Projection en aïkido, cours adultes"],
        ['file' => 'enfants.jpg', 'alt' => "Cours enfants d'aïkido, travail au bâton"],
        ['file' => 'self.jpg', 'alt' => "Immobilisation au sol, technique d'aïkido"],
    ];
    ?>
    <section class="section" aria-label="Moments de pratique">
        <div class="container">
            <div class="photo-strip">
                <?php foreach ($pratique as $ph):
                    $img = accueil_photo($ph['file']);
                ?>
                <div class="photo-strip__item">
                    <img src="<?= htmlspecialchars($img['src']) ?>"
                         <?php if ($img['srcset']): ?>srcset="<?= htmlspecialchars($img['srcset']) ?>" sizes="(max-width: 768px) 50vw, 285px"<?php endif; ?>
                         alt="<?= htmlspecialchars($ph['alt']) ?>, Aïkido Kannagara Guyancourt">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Prochains rendez-vous : bandeau auto-extinguible (rien à venir = rien d'affiché) -->
    <?php
    require_once __DIR__ . '/includes/evenements-parser.php';
    $prochains = array_slice(parse_evenements(__DIR__ . '/evenements.md'), 0, 3);
    ?>
    <?php if ($prochains): ?>
    <section class="section section--alt" aria-labelledby="prochains-rdv-title">
        <div class="container">
            <div class="info-box">
                <h2 class="info-box__title" id="prochains-rdv-title">Prochains rendez-vous</h2>
                <p>Venez nous rencontrer :</p>
                <ul style="list-style: none; padding: 0; margin: 0.5rem 0 0;">
                    <?php foreach ($prochains as $evt): ?>
                    <li style="margin-bottom: 0.35rem;">
                        <a href="actualites.php?evenement=<?= urlencode($evt['slug']) ?>"><strong><?= htmlspecialchars($evt['title']) ?></strong></a>
                        — <?= htmlspecialchars(format_date_evenement($evt['date'])) ?><?= $evt['horaire'] ? ', ' . htmlspecialchars($evt['horaire']) : '' ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <p style="margin: 0.75rem 0 0;"><a href="actualites.php">Tous les événements →</a></p>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Bienvenue : présentation factuelle du club, réponse directe pour les moteurs et
         les assistants IA. Elle remplace deux cartes qui répétaient la composition de
         l'équipe, déjà donnée ici et dans le carrousel des enseignants. -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Bienvenue au Club</h2>
                <p class="section__subtitle">L'Aïkido, un art martial pour tous</p>
            </div>

            <div class="content" style="max-width: 800px; margin: 0 auto; text-align: center;">
                <p style="font-size: 1.125rem;">
                    <strong>Kannagara</strong> est un club d'aïkido à Guyancourt (Yvelines), fondé en <?= (int) $club['foundingYear'] ?>
                    et affilié à la FFAB. Le club est placé sous la <strong>responsabilité pédagogique de <?= htmlspecialchars(equipe_responsable()) ?></strong>.
                    <?= equipe_intervenants_html() ?>
                    interviennent régulièrement sur le tatami. Le club propose des cours
                    pour enfants (dès 7 ans) et adultes, le lundi et le jeudi, au Gymnase Maurice Baquet.
                </p>
                <p>
                    Il compte environ <?= (int) $club['membersApprox'] ?> licenciés, dont une vingtaine d'enfants,
                    dans une ambiance familiale et respectueuse des traditions martiales.
                    <a href="agenda.php">Voir le planning des enseignants</a>.
                </p>
            </div>
        </div>
    </section>

    <!-- Horaires -->
    <section class="section section--alt">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Horaires des cours</h2>
                <p class="section__subtitle"><a href="https://maps.app.goo.gl/xuTo7Rqh51XWqWEh6" target="_blank" rel="noopener" title="Voir sur Google Maps">Gymnase Maurice Baquet <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></a></p>
            </div>

            <?php include 'includes/horaires.php'; ?>

            <div class="text-center mt-3">
                <a href="inscription.php" class="btn btn--outline">Nous rejoindre</a>
            </div>
        </div>
    </section>

    <!-- Témoignage (extrait, texte complet sur inscription.php#temoignage) -->
    <section class="section" aria-labelledby="temoignage-title">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title" id="temoignage-title">Témoignage</h2>
            </div>

            <figure class="temoignage" style="max-width: 800px; margin-left: auto; margin-right: auto;">
                <blockquote>
                    <p>
                        Ils ont pu bénéficier d’un cadre à la fois sérieux et bienveillant, qui leur a permis
                        de progresser continuellement tout en prenant confiance en leurs capacités. […]
                        Ma fille, qui continue l’année prochaine, souligne d’ailleurs que c’est à l’aïkido
                        qu’elle a noué ses meilleures amitiés, et les plus durables !
                    </p>
                </blockquote>
                <figcaption>Laëtitia, maman de deux jeunes pratiquants</figcaption>
            </figure>

            <div class="text-center mt-3">
                <a href="inscription.php#temoignage">Lire le témoignage complet →</a>
            </div>
        </div>
    </section>

    <!-- L'Aïkido en bref -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Qu'est-ce que l'Aïkido ?</h2>
            </div>

            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <p>
                    L'Aïkido est un art martial japonais fondé par Maître Morihei Ueshiba (1883-1969).
                    Contrairement à d'autres disciplines, <strong>l'aïkido exclut toute idée de compétition</strong>
                    et privilégie l'harmonie et le respect mutuel.
                </p>
                <p>
                    Les techniques d'aïkido reposent sur <strong>l'utilisation de la force de l'adversaire</strong>
                    et ne nécessitent pas d'aptitudes physiques particulières. Le travail musculaire
                    s'effectue naturellement en accord avec la constitution de chacun.
                </p>
                <p>
                    C'est pourquoi l'aïkido est pratiqué quotidiennement aussi bien par des femmes,
                    des hommes, des enfants que des personnes plus âgées.
                </p>
                <div class="text-center mt-3">
                    <a href="aikido.php" class="btn btn--primary">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Le club en images : 4 photos tirées des galeries, rotation quotidienne.
         Aucune maintenance : toute photo déposée dans galerie/ entre dans la rotation. -->
    <?php
    $stripLabels = ['cours' => 'Cours', 'stages' => 'Stages', 'grades' => 'Passages de grades', 'evenements' => 'Événements', 'vie-club' => 'Vie du club'];
    $stripPool = [];
    foreach ($stripLabels as $stripSlug => $stripLabel) {
        $stripDir = __DIR__ . '/galerie/' . $stripSlug;
        if (!is_dir($stripDir)) continue;
        foreach (scandir($stripDir) as $stripFile) {
            if (in_array(strtolower(pathinfo($stripFile, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp'], true)) {
                $stripPool[] = ['slug' => $stripSlug, 'file' => $stripFile, 'label' => $stripLabel];
            }
        }
    }
    $stripPhotos = [];
    if ($stripPool) {
        // Graine quotidienne : la sélection change chaque jour mais reste stable dans la
        // journée (rendu prévisible, cache-friendly). On rétablit ensuite l'aléa normal.
        mt_srand((int) date('Ymd'));
        shuffle($stripPool);
        mt_srand();
        $stripPhotos = array_slice($stripPool, 0, 4);
    }
    ?>
    <?php if ($stripPhotos): ?>
    <section class="section section--alt" aria-labelledby="club-images-title">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title" id="club-images-title">Le club en images</h2>
            </div>

            <div class="photo-strip">
                <?php foreach ($stripPhotos as $ph):
                    $src = galerie_vignette($ph['slug'], $ph['file']);
                ?>
                <a class="photo-strip__item"
                   href="galerie.php?photo=<?= urlencode($ph['slug'] . '/' . $ph['file']) ?>"
                   title="<?= htmlspecialchars($ph['label']) ?> — voir dans la galerie">
                    <img src="<?= htmlspecialchars($src) ?>"
                         alt="<?= htmlspecialchars($ph['label']) ?> — la vie du club en photo, Aïkido Kannagara Guyancourt"
                         loading="lazy">
                </a>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-3">
                <a href="galerie.php" class="btn btn--outline">Voir toute la galerie</a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Nos professeurs (aperçu) -->
    <section class="section section--dark">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Nos Enseignants</h2>
            </div>

            <div class="teachers-carousel">
                <div class="teachers-carousel__track">
                    <div class="team-member teachers-carousel__slide active">
                        <img src="professeurs/fiches/01-jean-marc-chamot.jpg" alt="Jean-Marc Chamot" class="team-member__photo" loading="lazy">
                        <h3 class="team-member__name">Jean-Marc Chamot</h3>
                        <p class="team-member__grade">7ème Dan Aïkido - 4e Dan Iaïdo</p>
                    </div>
                    <div class="team-member teachers-carousel__slide">
                        <img src="professeurs/fiches/02-nacer-chekkaba.jpg" alt="Nacer Chekkaba" class="team-member__photo" loading="lazy">
                        <h3 class="team-member__name">Nacer Chekkaba</h3>
                        <p class="team-member__grade">4ème Dan Aïkido FFAB</p>
                    </div>
                    <div class="team-member teachers-carousel__slide">
                        <img src="professeurs/fiches/03-thierry-montfort.jpg" alt="Thierry Montfort" class="team-member__photo" loading="lazy">
                        <h3 class="team-member__name">Thierry Montfort</h3>
                        <p class="team-member__grade">3ème Dan Aïkido FFAB</p>
                    </div>
                    <div class="team-member teachers-carousel__slide">
                        <img src="professeurs/fiches/05-sebastien-huet.jpg" alt="Sébastien Huet" class="team-member__photo" loading="lazy">
                        <h3 class="team-member__name">Sébastien Huet</h3>
                        <p class="team-member__grade">1er Dan Aïkido FFAB</p>
                    </div>
                </div>
                <div class="teachers-carousel__dots">
                    <button class="teachers-carousel__dot active" data-slide="0" aria-label="Voir Jean-Marc Chamot"></button>
                    <button class="teachers-carousel__dot" data-slide="1" aria-label="Voir Nacer Chekkaba"></button>
                    <button class="teachers-carousel__dot" data-slide="2" aria-label="Voir Thierry Montfort"></button>
                    <button class="teachers-carousel__dot" data-slide="3" aria-label="Voir Sébastien Huet"></button>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="professeurs.php" class="btn btn--accent">En savoir plus</a>
            </div>
        </div>
    </section>

    <!-- Contact rapide -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Nous contacter</h2>
                <p class="section__subtitle">Une question ? Envie de venir voir un cours ?</p>
            </div>

            <div class="text-center mt-3">
                <a href="contact.php" class="btn btn--primary">Nous contacter</a>
                <a href="inscription.php#comment" class="btn btn--outline">S'inscrire</a>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
</body>
</html>
