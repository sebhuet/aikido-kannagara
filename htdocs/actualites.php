<?php
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/evenements-parser.php';

$club = club_data();
$site = rtrim($club['url'], '/');
$evenements = parse_evenements(__DIR__ . '/evenements.md');

/** Permalien partageable d'un événement. */
function evenement_permalien($site, $slug)
{
    return $site . '/actualites.php?evenement=' . urlencode($slug);
}

/**
 * Lien de partage Facebook. Le « sharer » ne reçoit QUE l'URL : c'est Facebook qui
 * va la crawler et lire ses balises og: — d'où l'importance de les rendre dynamiques.
 */
function partage_facebook($url)
{
    return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
}

// ---- Événement ciblé par un lien de partage (?evenement=slug) ----
// Le slug est comparé aux événements RÉELLEMENT parsés : sans cette validation, on
// pourrait injecter un titre ou une og:image arbitraires via l'URL.
// Effet de bord assumé : un événement passé n'est plus parsé, donc son lien de
// partage retombe proprement sur la page complète (pas d'erreur, pas de 404).
$evtPartage = null;
$demande = $_GET['evenement'] ?? '';
if ($demande !== '') {
    foreach ($evenements as $e) {
        if ($e['slug'] === $demande) {
            $evtPartage = $e;
            break;
        }
    }
}

// ---- Open Graph ----
$ogUrl   = $site . '/actualites.php';
$ogTitle = 'Actualités — ' . $club['name'];
$ogDesc  = 'Portes ouvertes, stages, forums et événements du club d\'aïkido de Guyancourt.';
$ogImage = $club['logo'];

if ($evtPartage) {
    // Un partage doit donner l'essentiel sans cliquer : date, horaire, lieu.
    $bribes = [ucfirst(format_date_evenement($evtPartage['date']))];
    if ($evtPartage['horaire']) $bribes[] = $evtPartage['horaire'];
    if ($evtPartage['lieu'])    $bribes[] = $evtPartage['lieu'];

    $ogUrl   = evenement_permalien($site, $evtPartage['slug']);
    $ogTitle = $evtPartage['title'] . ' — ' . $club['name'];
    $ogDesc  = implode(' · ', $bribes) . ($evtPartage['description'] ? ' — ' . $evtPartage['description'] : '');
    // image: est optionnel dans evenements.md ; sans lui, Facebook affiche le logo.
    // Chaque segment du chemin est encodé : les fichiers de la galerie portent des
    // accents (« baquet-en-fête-… ») et une og:image avec un caractère brut non
    // ASCII peut être rejetée par le crawler Facebook.
    if (!empty($evtPartage['image'])) {
        $segments = array_map('rawurlencode', explode('/', ltrim($evtPartage['image'], '/')));
        $ogImage = $site . '/' . implode('/', $segments);
    }
}
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title><?= htmlspecialchars($ogTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta name="author" content="<?= htmlspecialchars($club['name']) ?>">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">
    <meta name="robots" content="index, follow">
    <?php /* Canonical toujours la page complète : les URL ?evenement= sont des variantes
             de partage, pas des pages à indexer séparément. Facebook se fie à og:url. */ ?>
    <link rel="canonical" href="<?= htmlspecialchars($site) ?>/actualites.php">

    <!-- Open Graph -->
    <meta property="og:type" content="<?= $evtPartage ? 'article' : 'website' ?>">
    <meta property="og:url" content="<?= htmlspecialchars($ogUrl) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
    <meta property="og:locale" content="fr_FR">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="<?= $evtPartage && !empty($evtPartage['image']) ? 'summary_large_image' : 'summary' ?>">
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "Actualités - Aïkido Kannagara Guyancourt",
        "description": "Actualités du club Aïkido Kannagara Guyancourt : portes ouvertes septembre, stages FFAB, passages de grades. Événements à Guyancourt.",
        "url": "https://kannagara.fr/actualites.php",
        "inLanguage": "fr",
        "isPartOf": {
            "@type": "WebSite",
            "name": "Aïkido Kannagara Guyancourt",
            "url": "https://kannagara.fr"
        },
        "publisher": {
            "@type": "Organization",
            "name": "Aïkido Kannagara Guyancourt",
            "url": "https://kannagara.fr",
            "logo": {
                "@type": "ImageObject",
                "url": "https://kannagara.fr/images/logo-kannagara.jpg"
            }
        }
    }
    </script>

    <style>
        /* Calendrier des événements */
        .calendar {
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: var(--spacing-xl);
        }

        .calendar__header {
            background: var(--color-primary);
            color: white;
            padding: var(--spacing-lg);
            text-align: center;
        }

        .calendar__title {
            font-size: 1.5rem;
            margin-bottom: var(--spacing-xs);
        }

        .calendar__subtitle {
            opacity: 0.8;
            font-size: 0.95rem;
        }

        .calendar__body {
            padding: var(--spacing-lg);
        }

        .calendar__month {
            margin-bottom: var(--spacing-lg);
        }

        .calendar__month:last-child {
            margin-bottom: 0;
        }

        .calendar__month-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--color-secondary);
            padding-bottom: var(--spacing-sm);
            border-bottom: 2px solid var(--color-accent);
            margin-bottom: var(--spacing-md);
        }

        .calendar__events {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .calendar__event {
            display: flex;
            gap: var(--spacing-md);
            padding: var(--spacing-sm) 0;
            border-bottom: 1px solid var(--color-border);
        }

        .calendar__event:last-child {
            border-bottom: none;
        }

        .calendar__event-date {
            min-width: 80px;
            font-weight: 600;
            color: var(--color-accent);
        }

        .calendar__event-title {
            flex: 1;
            color: var(--color-text);
        }

        .calendar__event-type {
            font-size: 0.8rem;
            padding: 2px 8px;
            border-radius: 12px;
            background: var(--color-bg-alt);
            color: var(--color-text-light);
        }

        .calendar__event-type--stage {
            background: rgba(139, 0, 0, 0.1);
            color: var(--color-secondary);
        }

        .calendar__event-type--cours {
            background: rgba(201, 162, 39, 0.2);
            color: var(--color-accent);
        }

        .calendar__event-type--grade {
            background: rgba(26, 26, 26, 0.1);
            color: var(--color-primary);
        }

        .calendar__legend {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            background: var(--color-bg-alt);
            border-top: 1px solid var(--color-border);
            justify-content: center;
        }

        .calendar__legend-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            font-size: 0.85rem;
        }

        @media (max-width: 600px) {
            .calendar__event {
                flex-direction: column;
                gap: var(--spacing-xs);
            }
            .calendar__event-date {
                min-width: auto;
            }
        }
    </style>
</head>
<body>
    <?php $active = 'actualites'; include 'includes/header.php'; ?>







    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Actualités du Club</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Actualités
            </p>
        </div>
    </section>

    <!-- Événements à venir — parsés dans le prélude (le <head> en a besoin pour les og:) -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Événements à venir</h2>
                <p class="section__subtitle">Retrouvez ici les prochains rendez-vous du club</p>
            </div>

            <?php if (!empty($evenements)): ?>
            <div class="text-center" style="margin-bottom: var(--spacing-lg);">
                <a class="btn btn--outline fb-share-btn"
                   href="<?= htmlspecialchars(partage_facebook($site . '/actualites.php')) ?>"
                   target="_blank" rel="noopener"
                   aria-label="Partager les actualités du club sur Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.25h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07z"/></svg>
                    Partager les actualités sur Facebook
                </a>
            </div>

            <div class="cards-grid">
                <?php foreach ($evenements as $evt):
                    $cible = $evtPartage && $evtPartage['slug'] === $evt['slug'];
                ?>
                <div class="card fade-in<?= $cible ? ' is-ciblee' : '' ?>" data-evenement="<?= htmlspecialchars($evt['slug']) ?>">
                    <?php if (!empty($evt['image'])):
                        // Même visuel que l'aperçu Facebook. Segments encodés : certains
                        // fichiers de la galerie portent des accents.
                        $imgSrc = implode('/', array_map('rawurlencode', explode('/', ltrim($evt['image'], '/'))));
                    ?>
                    <img src="<?= htmlspecialchars($imgSrc) ?>"
                         alt="<?= htmlspecialchars($evt['title']) ?>"
                         class="card__image" loading="lazy">
                    <?php endif; ?>
                    <div class="card__content">
                        <span class="blog-card__date"><?= htmlspecialchars(format_date_evenement($evt['date'])) ?></span>
                        <h3 class="card__title"><?= htmlspecialchars($evt['title']) ?></h3>
                        <?php if ($evt['description']): ?>
                        <p class="card__text"><?= htmlspecialchars($evt['description']) ?></p>
                        <?php endif; ?>
                        <p class="card__meta">
                            <?php if ($evt['horaire']): ?>
                                <strong>Horaire :</strong> <?= htmlspecialchars($evt['horaire']) ?><br>
                            <?php endif; ?>
                            <?php if ($evt['animateur']): ?>
                                <strong>Animé par :</strong> <?= htmlspecialchars($evt['animateur']) ?><br>
                            <?php endif; ?>
                            <?php if ($evt['lieu']): ?>
                                <strong>Lieu :</strong>
                                <?php if ($evt['lieu_url']): ?>
                                    <a href="<?= htmlspecialchars($evt['lieu_url']) ?>" target="_blank" rel="noopener" title="Voir sur Google Maps"><?= htmlspecialchars($evt['lieu']) ?> <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg></a>
                                <?php else: ?>
                                    <?= htmlspecialchars($evt['lieu']) ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </p>
                        <a class="fb-share fb-share--card"
                           href="<?= htmlspecialchars(partage_facebook(evenement_permalien($site, $evt['slug']))) ?>"
                           target="_blank" rel="noopener"
                           title="Partager cet événement sur Facebook"
                           aria-label="Partager l'événement « <?= htmlspecialchars($evt['title']) ?> » sur Facebook">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.25h3.33l-.53 3.49h-2.8V24C19.61 23.1 24 18.1 24 12.07z"/></svg>
                            Partager
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="info-box" style="max-width: 700px; margin: 0 auto; text-align: center;">
                <p>Aucun événement à venir pour le moment. Revenez bientôt !</p>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Actualités régulières -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Activités régulières</h2>
            </div>

            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <div class="info-box">
                    <h3 class="info-box__title">Cours hebdomadaires</h3>
                    <p>
                        Les cours reprennent chaque année début septembre et se poursuivent
                        jusqu'à fin juin, hors vacances scolaires.
                    </p>
                    <p>
                        Ils ont lieu le lundi et le jeudi.
                        <a href="agenda.php">Voir les horaires et l'agenda</a>.
                    </p>
                </div>

                <div class="info-box">
                    <h3 class="info-box__title">Stages fédéraux</h3>
                    <p>
                        Le club participe régulièrement aux stages organisés par la FFAB
                        au niveau régional et national. Ces stages sont l'occasion de
                        pratiquer avec des experts de haut niveau et de rencontrer
                        des pratiquants d'autres clubs.
                    </p>
                </div>

                <div class="info-box">
                    <h3 class="info-box__title">Passages de grades</h3>
                    <p>
                        Des sessions de passage de grades (kyu) sont organisées régulièrement
                        au sein du club. Les examens pour les grades dan (ceinture noire)
                        se passent lors des stages fédéraux.
                    </p>
                    <p>
                        <a href="grades.php">En savoir plus sur les grades</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Archives / Annonces passées -->
    <section class="section">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">Vie du club</h2>
            </div>

            <div class="content" style="max-width: 800px; margin: 0 auto;">
                <p>
                    Tout au long de l'année, le club organise et participe à de nombreux événements :
                </p>

                <ul>
                    <li>Stages internes avec les professeurs du club</li>
                    <li>Échanges avec d'autres clubs de la région</li>
                    <li>Démonstrations lors d'événements locaux</li>
                    <li>Moments conviviaux (galette des rois, repas de fin d'année...)</li>
                </ul>

                <p>
                    Les comptes-rendus de ces temps forts sont publiés sur le
                    <a href="blog.php">blog du club</a>.
                </p>

                <p>
                    Pour être tenu informé des prochains événements, n'hésitez pas à nous contacter
                    ou à suivre les annonces sur cette page.
                </p>

                <div class="text-center mt-4">
                    <a href="contact.php" class="btn btn--primary">Nous contacter</a>
                    <a href="inscription.php" class="btn btn--outline">S'inscrire</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>







    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
    <script>
        // Arrivée depuis un lien de partage (?evenement=…) : amener la carte à l'écran.
        document.addEventListener('DOMContentLoaded', function() {
            var ciblee = document.querySelector('.is-ciblee');
            if (ciblee) {
                ciblee.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>
