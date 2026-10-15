<?php
/**
 * Données structurées Schema.org (JSON-LD) : une seule identité pour le club.
 *
 * Le club apparaissait sous trois formes sans lien entre elles (SportsActivityLocation
 * sur l'accueil, LocalBusiness sur Contact, Organization ailleurs) : ni Google ni les
 * assistants IA ne pouvaient en déduire une entité unique, d'autant que « Kannagara
 * Aikido » désigne aussi une école américaine. Le club est maintenant un SportsClub
 * d'identifiant https://kannagara.fr/#organization, décrit en entier sur l'accueil et
 * la page Contact (jsonld_club()) et désigné ailleurs par cet identifiant
 * (jsonld_club_ref()). Toutes les valeurs viennent de data/club.json et des fiches.
 */
require_once __DIR__ . '/data.php';
require_once __DIR__ . '/equipe.php';
require_once __DIR__ . '/images.php';

function jsonld_site(): string
{
    return rtrim(club_data()['url'], '/');
}

/** Le club, désigné par son identifiant (nom et adresse lisibles sans le reste du graphe). */
function jsonld_club_ref(): array
{
    return [
        '@type' => 'SportsClub',
        '@id' => jsonld_site() . '/#organization',
        'name' => club_data()['name'],
        'url' => jsonld_site() . '/',
    ];
}

function jsonld_website_ref(): array
{
    return ['@id' => jsonld_site() . '/#website'];
}

/** Le club comme auteur ou éditeur d'une page (Article, DefinedTermSet…), avec son logo. */
function jsonld_editeur(): array
{
    return jsonld_club_ref() + ['logo' => ['@type' => 'ImageObject', 'url' => club_data()['logo']]];
}

/** Valeur JSON à insérer dans un bloc JSON-LD écrit à la main dans une page. */
function jsonld_json(array $valeur): string
{
    return json_encode($valeur, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);
}

/** Image de partage du club (1200 × 630), sinon le logo. */
function jsonld_image(): string
{
    return image_partage();
}

function jsonld_adresse(bool $avecLieu = true): array
{
    $loc = club_data()['location'];
    return [
        '@type' => 'PostalAddress',
        'streetAddress' => $avecLieu ? $loc['venue'] . ', ' . $loc['street'] : $loc['street'],
        'addressLocality' => $loc['city'],
        'postalCode' => $loc['postalCode'],
        'addressCountry' => $loc['country'],
    ];
}

function jsonld_geo(): array
{
    $geo = club_data()['location']['geo'];
    return ['@type' => 'GeoCoordinates', 'latitude' => $geo['lat'], 'longitude' => $geo['lng']];
}

/** Le gymnase où ont lieu cours et stages. */
function jsonld_lieu(): array
{
    $loc = club_data()['location'];
    return [
        '@type' => 'Place',
        'name' => $loc['venue'],
        'address' => jsonld_adresse(false),
        'geo' => jsonld_geo(),
        'hasMap' => $loc['mapsUrl'],
    ];
}

/** Ancre d'un enseignant sur professeurs.php (même calcul que la page). */
function jsonld_enseignant_ref(array $fiche): array
{
    $nom = $fiche['meta']['name'] ?? '';
    return [
        '@type' => 'Person',
        '@id' => jsonld_site() . '/professeurs.php#' . slugify($nom),
        'name' => $nom,
    ];
}

/** Horaires de la saison : un créneau enfants, un créneau adultes. */
function jsonld_horaires(): array
{
    $club = club_data();
    $sch = $club['schedule'];
    $creneau = fn($ouvre, $ferme, $public) => [
        '@type' => 'OpeningHoursSpecification',
        'dayOfWeek' => $sch['daysSchemaOrg'],
        'opens' => $ouvre,
        'closes' => $ferme,
        'validFrom' => $club['seasonStart'],
        'description' => $public,
    ];
    return [
        $creneau($sch['children']['opens'], $sch['children']['closes'], 'Cours enfants'),
        $creneau($sch['adultsRange']['opens'], $sch['adultsRange']['closes'], 'Cours adultes'),
    ];
}

/** Le club en entier : accueil et page Contact. */
function jsonld_club(): array
{
    $club = club_data();
    $loc = $club['location'];
    $prix = $club['pricing'];
    $fed = $club['federation'];
    $jours = implode(' et le ', array_map('strtolower', $club['schedule']['days']));

    return array_merge(jsonld_club_ref(), [
        'alternateName' => $club['alternateNames'] ?? [$club['alternateName']],
        'description' => "Club d'aïkido de {$loc['city']} (Yvelines) affilié à la {$fed['abbr']}, fondé en "
            . $club['foundingYear'] . " : cours pour enfants dès 7 ans et adultes, le $jours au {$loc['venue']}.",
        'logo' => $club['logo'],
        'image' => jsonld_image(),
        'telephone' => $club['contact']['phoneIntl'],
        'email' => $club['contact']['email'],
        'foundingDate' => (string) $club['foundingYear'],
        'founder' => ['@type' => 'Person', 'name' => $club['founder']],
        'address' => jsonld_adresse(),
        'geo' => jsonld_geo(),
        'hasMap' => $loc['mapsUrl'],
        'openingHoursSpecification' => jsonld_horaires(),
        'priceRange' => "{$prix['reduced']} € à {$prix['adults']} € par an",
        'sport' => 'Aïkido',
        'memberOf' => [
            '@type' => 'SportsOrganization',
            'name' => $fed['name'],
            'alternateName' => $fed['abbr'],
            'url' => 'https://www.ffabaikido.com/',
        ],
        'identifier' => ['@type' => 'PropertyValue', 'propertyID' => 'Numéro de club ' . $fed['abbr'], 'value' => $fed['clubNumber']],
        'areaServed' => array_map(
            fn($nom) => ['@type' => $nom === 'Saint-Quentin-en-Yvelines' ? 'AdministrativeArea' : 'City', 'name' => $nom],
            $club['areaServed'] ?? [$loc['city']]
        ),
        'employee' => array_map('jsonld_enseignant_ref', equipe_fiches()),
        'sameAs' => $club['sameAs'] ?? [],
    ]);
}

/**
 * Les cours hebdomadaires de la saison (agenda.php, inscription.php) : un Course et
 * deux sessions, enfants et adultes. L'agenda les déclarait en Event sans date de
 * début, ce que Google refuse : un cours récurrent n'est pas un événement.
 */
function jsonld_cours(): array
{
    $club = club_data();
    $sch = $club['schedule'];
    $finSaison = preg_match('/^\d{4}-(\d{4})$/', $club['season'], $m) ? $m[1] . '-06-30' : null;
    $enseignants = array_map('jsonld_enseignant_ref', equipe_fiches());
    $session = function ($nom, $ouvre, $ferme, $ageMin) use ($club, $sch, $finSaison, $enseignants) {
        return array_filter([
            '@type' => 'CourseInstance',
            'name' => $nom,
            'courseMode' => 'Onsite',
            'location' => jsonld_lieu(),
            'courseSchedule' => array_filter([
                '@type' => 'Schedule',
                'repeatFrequency' => 'P1W',
                'byDay' => $sch['daysSchemaOrg'],
                'startTime' => $ouvre,
                'endTime' => $ferme,
                'startDate' => $club['seasonStart'],
                'endDate' => $finSaison,
                'scheduleTimezone' => 'Europe/Paris',
            ]),
            'audience' => ['@type' => 'PeopleAudience', 'suggestedMinAge' => $ageMin],
            'instructor' => $enseignants,
            'inLanguage' => 'fr',
        ]);
    };
    return [
        '@type' => 'Course',
        '@id' => jsonld_site() . '/#cours',
        'name' => "Cours d'aïkido du club Kannagara",
        'description' => "Cours d'aïkido hebdomadaires à {$club['location']['city']}, saison {$club['season']} : enfants dès 7 ans et adultes tous niveaux, ouverts à tous les licenciés.",
        'url' => jsonld_site() . '/agenda.php',
        'provider' => jsonld_editeur(),
        'inLanguage' => 'fr',
        'hasCourseInstance' => [
            $session('Cours enfants (dès 7 ans)', $sch['children']['opens'], $sch['children']['closes'], 7),
            $session('Cours adultes', $sch['adultsRange']['opens'], $sch['adultsRange']['closes'], 15),
        ],
    ];
}

function jsonld_website(): array
{
    $club = club_data();
    return [
        '@type' => 'WebSite',
        '@id' => jsonld_site() . '/#website',
        'url' => jsonld_site() . '/',
        'name' => $club['name'],
        'alternateName' => $club['alternateName'],
        'inLanguage' => 'fr-FR',
        'publisher' => ['@id' => jsonld_site() . '/#organization'],
    ];
}

/**
 * Un événement de evenements.md (stage, portes ouvertes…).
 * Les heures sont lues dans l'horaire (« Adultes 10h00 - 12h30 · 14h30 - 17h00 » :
 * de 10 h à 17 h) ; sans heure, l'événement porte seulement sa date.
 */
function jsonld_evenement(array $evt, string $permalien): array
{
    $club = club_data();
    $jour = date('Y-m-d', $evt['date']);
    preg_match_all('/\b(\d{1,2})h(\d{2})?/', (string) $evt['horaire'], $heures, PREG_SET_ORDER);
    $instant = function ($h) use ($jour) {
        $d = new DateTime($jour . ' ' . sprintf('%02d:%02d', $h[1], $h[2] ?? 0), new DateTimeZone('Europe/Paris'));
        return $d->format('c');
    };
    $debut = $heures ? $instant($heures[0]) : $jour;
    $fin = count($heures) > 1 ? $instant(end($heures)) : null;

    $lieuParDefaut = !$evt['lieu'] || $evt['lieu'] === $club['location']['venue'];
    $donnees = [
        '@type' => 'EducationEvent',
        'name' => $evt['title'],
        'startDate' => $debut,
        'eventStatus' => 'https://schema.org/EventScheduled',
        'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
        'location' => $lieuParDefaut ? jsonld_lieu() : ['@type' => 'Place', 'name' => $evt['lieu'], 'address' => $evt['lieu']],
        'organizer' => jsonld_club_ref(),
        'description' => $evt['description'] ?: $evt['title'] . ' à ' . $club['location']['city'] . '.',
        'image' => !empty($evt['image']) ? jsonld_site() . '/' . chemin_web(ltrim($evt['image'], '/')) : jsonld_image(),
        'url' => $permalien,
        'inLanguage' => 'fr-FR',
    ];
    if ($fin) {
        $donnees['endDate'] = $fin;
    }
    if (!empty($evt['animateur'])) {
        $donnees['performer'] = ['@type' => 'Person', 'name' => $evt['animateur']];
    }
    return $donnees;
}

/**
 * Écrit le bloc <script type="application/ld+json">. Plusieurs entités : un @graph.
 * JSON_HEX_TAG : aucun « </script> » ne peut sortir d'une valeur.
 */
function jsonld_script(array ...$entites): void
{
    $donnees = count($entites) === 1
        ? ['@context' => 'https://schema.org'] + $entites[0]
        : ['@context' => 'https://schema.org', '@graph' => $entites];
    echo '<script type="application/ld+json">' . "\n"
        . json_encode($donnees, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_HEX_TAG)
        . "\n</script>\n";
}
