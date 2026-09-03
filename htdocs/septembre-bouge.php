<?php
// Page événementielle : participation du club à l'opération nationale « Septembre Bouge »
// (ministères des Sports et de la Santé), adossée à nos portes ouvertes de septembre.
// Toutes les données club (horaires, lieu, essai) viennent de data/club.json.
require_once __DIR__ . '/includes/data.php';
$club = club_data();
$sch  = $club['schedule'];
$loc  = $club['location'];
$saisonReprise = date('d/m/Y', strtotime($club['seasonStart']));
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Septembre Bouge | Portes ouvertes d'aïkido à Guyancourt</title>
    <meta name="description" content="Le club Aïkido Kannagara Guyancourt participe à Septembre Bouge : cours d'essai gratuits tout le mois de septembre, enfants dès 7 ans et adultes. Fête du Sport le lundi 14 septembre.">
    <meta name="keywords" content="Septembre Bouge, Fête du Sport, portes ouvertes, aïkido, aikido, cours essai gratuit, Guyancourt, sport santé, rentrée sportive">
    <meta name="author" content="Aïkido Kannagara Guyancourt">
    <meta name="geo.region" content="FR-78">
    <meta name="geo.placename" content="Guyancourt">
    <meta name="geo.position" content="48.772739;2.065928">
    <meta name="ICBM" content="48.772739, 2.065928">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://kannagara.fr/septembre-bouge.php">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kannagara.fr/septembre-bouge.php">
    <meta property="og:title" content="Septembre Bouge : portes ouvertes d'aïkido à Guyancourt">
    <meta property="og:description" content="Cours d'essai gratuits tout le mois de septembre au club Kannagara, dans le cadre de l'opération nationale Septembre Bouge.">
    <meta property="og:image" content="https://kannagara.fr/images/logo-kannagara.jpg">
    <meta property="og:locale" content="fr_FR">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Septembre Bouge : portes ouvertes d'aïkido à Guyancourt">
    <meta name="twitter:description" content="Cours d'essai gratuits tout le mois de septembre au club Kannagara.">
    <meta name="twitter:image" content="https://kannagara.fr/images/logo-kannagara.jpg">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/logo-kannagara.jpg">

    <!-- Schema.org : portes ouvertes rattachées à l'opération nationale -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SportsEvent",
        "name": "Portes ouvertes d'aïkido · Septembre Bouge",
        "description": "Cours d'essai gratuits d'aïkido tout le mois de septembre, pour enfants (dès 7 ans) et adultes, dans le cadre de l'opération nationale Septembre Bouge.",
        "url": "https://kannagara.fr/septembre-bouge.php",
        "startDate": "<?= $club['seasonStart'] ?>",
        "endDate": "2026-09-30",
        "isAccessibleForFree": true,
        "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
        "eventStatus": "https://schema.org/EventScheduled",
        "sport": "Aïkido",
        "image": "https://kannagara.fr/images/logo-kannagara.jpg",
        "location": {
            "@type": "Place",
            "name": "<?= $loc['venue'] ?>",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "<?= $loc['street'] ?>",
                "addressLocality": "<?= $loc['city'] ?>",
                "postalCode": "<?= $loc['postalCode'] ?>",
                "addressCountry": "FR"
            },
            "geo": { "@type": "GeoCoordinates", "latitude": <?= $loc['geo']['lat'] ?>, "longitude": <?= $loc['geo']['lng'] ?> }
        },
        "organizer": {
            "@type": "SportsActivityLocation",
            "@id": "https://kannagara.fr/#organization",
            "name": "<?= $club['name'] ?>",
            "url": "https://kannagara.fr"
        },
        "superEvent": {
            "@type": "Event",
            "name": "Septembre Bouge",
            "url": "https://www.sports.gouv.fr/septembre-bouge-2026",
            "startDate": "2026-09-01",
            "endDate": "2026-09-30",
            "organizer": {
                "@type": "GovernmentOrganization",
                "name": "Ministère des Sports, de la Jeunesse et de la Vie associative"
            }
        },
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "EUR",
            "availability": "https://schema.org/InStock",
            "description": "Cours d'essai gratuits pendant tout le mois de septembre"
        }
    }
    </script>
</head>
<body>
    <?php $active = ''; include 'includes/header.php'; ?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-header__title">Septembre Bouge</h1>
            <p class="page-header__breadcrumb">
                <a href="index.php">Accueil</a> / Septembre Bouge
            </p>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="section">
        <div class="container">
            <div class="content" style="max-width: 900px; margin: 0 auto;">

                <p class="text-center" style="font-size: 1.125rem; margin-bottom: var(--spacing-xl);">
                    Un mois pour remettre l'activité physique et sportive au cœur du quotidien :
                    le club Kannagara participe à l'opération nationale
                    <strong>Septembre Bouge</strong> avec ses portes ouvertes de septembre.
                </p>

                <h2>Qu'est-ce que Septembre Bouge ?</h2>
                <p>
                    <strong>Septembre Bouge</strong> est une mobilisation nationale portée par les ministères
                    des Sports, de la Jeunesse et de la Vie associative et de la Santé, du
                    <strong>1er au 30 septembre 2026</strong>. Son ambition : faire de l'activité physique
                    un réflexe quotidien et promouvoir le sport comme levier de santé et de bien-être,
                    dans la dynamique des Jeux de Paris 2024.
                </p>
                <p>
                    Partout en France, des clubs et des collectivités proposent des événements
                    <strong>sportifs, festifs et gratuits</strong>, ouverts à tous et accessibles aux
                    personnes en situation de handicap. La rentrée est le moment idéal pour
                    (re)prendre une activité : l'objectif santé, c'est au moins
                    <strong>30 minutes d'activité physique par jour</strong>.
                </p>

                <h2>La participation du club Kannagara</h2>
                <p>
                    Nos <strong>portes ouvertes</strong> s'inscrivent dans cette opération : pendant
                    <strong>tout le mois de septembre</strong>, les cours d'essai sont
                    <strong>gratuits</strong> et ouverts à toutes et à tous, enfants dès 7 ans et adultes,
                    sans aucune expérience préalable. Une tenue de sport (jogging) suffit.
                </p>
                <p>
                    La saison <?= htmlspecialchars($club['season']) ?> reprend le
                    <strong><?= htmlspecialchars($saisonReprise) ?></strong> au
                    <a href="<?= htmlspecialchars($loc['mapsUrl']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($loc['venue']) ?></a>
                    (<?= htmlspecialchars($loc['street']) ?>, <?= htmlspecialchars($loc['postalCode']) ?> <?= htmlspecialchars($loc['city']) ?>).
                    <?= htmlspecialchars($club['trial']['invitation']) ?>
                </p>

                <div class="info-box">
                    <h4 class="info-box__title">Fête du Sport : lundi 14 septembre 2026</h4>
                    <p>
                        Temps fort de Septembre Bouge, la <strong>Fête du Sport</strong> invite chacun à
                        chausser ses baskets et à pratiquer 30 minutes d'une activité de son choix.
                        Bonne nouvelle : le 14 septembre est un <strong>lundi, jour de cours au club</strong>.
                        Poussez la porte du dojo ce soir-là, l'essai est gratuit !
                    </p>
                </div>

                <h2>Les horaires pendant les portes ouvertes</h2>
                <p>
                    Les cours ont lieu le <?= htmlspecialchars(implode(' et le ', array_map('strtolower', $sch['days']))) ?> :
                </p>

                <?php include 'includes/horaires.php'; ?>

                <h2>Un événement dans l'esprit de l'opération</h2>
                <div class="cards-grid">
                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Gratuit</h3>
                            <p class="card__text">
                                Tous les cours d'essai de septembre sont gratuits et sans engagement,
                                pour découvrir l'aïkido en conditions réelles.
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Ouvert à tous</h3>
                            <p class="card__text">
                                Enfants dès 7 ans, adultes, seniors, débutants complets :
                                l'aïkido ne demande aucune aptitude physique particulière.
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Sport et santé</h3>
                            <p class="card__text">
                                Coordination, souplesse, gestion du stress : une pratique complète
                                et harmonieuse, sans compétition.
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card__content">
                            <h3 class="card__title">Convivial</h3>
                            <p class="card__text">
                                Un club familial d'une cinquantaine de licenciés, affilié FFAB,
                                où les anciens accompagnent les débutants.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="inscription.php#essai" class="btn btn--primary">Venir essayer</a>
                    <a href="contact.php" class="btn btn--outline">Nous contacter</a>
                </div>

                <h2 class="mt-4">En savoir plus sur Septembre Bouge</h2>
                <ul>
                    <li>
                        <a href="https://www.sports.gouv.fr/septembre-bouge-2026" target="_blank" rel="noopener">Septembre Bouge sur sports.gouv.fr</a> :
                        présentation de l'opération nationale.
                    </li>
                    <li>
                        <a href="https://livemap.getwemap.com/dom.html?emmid=33289&amp;token=KPP7I766XIMZYDFJF2WUF9XS6" target="_blank" rel="noopener">Carte interactive des événements</a> :
                        tous les événements référencés partout en France.
                    </li>
                    <li>
                        <a href="actualites.php">Nos actualités</a> : les prochains rendez-vous du club.
                    </li>
                </ul>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript -->
    <script src="js/main.js" defer></script>
</body>
</html>
