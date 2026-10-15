<?php

/**
 * Source unique de vérité du club.
 * Charge (une seule fois) les données de data/club.json et les expose via club_data().
 *
 * Consommé côté PHP par les pages, les composants (horaires.php, horaires-resume.php,
 * footer.php) et les blocs JSON-LD (jsonld.php). Côté Node, build-blog.js et
 * build-llms.js le lisent : llms.txt et llms-full.txt en sont régénérés à chaque build.
 */
function club_data()
{
	static $data = null;
	if ($data === null) {
		$json = file_get_contents(__DIR__ . '/../data/club.json');
		$data = $json === false ? [] : (json_decode($json, true) ?? []);
	}
	return $data;
}

/**
 * Équipe dirigeante (club.json > board), chaque membre enrichi de son téléphone.
 *
 * Le numéro du club (contact.phone) EST celui de la présidente : il n'est donc pas
 * recopié dans board (ce serait deux endroits à corriger le jour où il change).
 * On le résout ici, à la lecture.
 *
 * @return array<int, array{key:string, role:string, name:string, photo:string, phone:?string}>
 */
function club_board()
{
	$club = club_data();
	$phoneClub = $club['contact']['phone'] ?? null;

	return array_map(function ($membre) use ($phoneClub) {
		$membre['phone'] = $membre['phone']
			?? (($membre['key'] ?? '') === 'president' ? $phoneClub : null);
		return $membre;
	}, $club['board'] ?? []);
}

/**
 * Phrase d'accroche du cours d'essai, selon la période.
 *
 * De juillet à septembre, on annonce les cours d'essai gratuits des portes ouvertes de
 * septembre. Le reste de l'année, cette phrase faisait croire qu'il était trop tard :
 * on rappelle qu'on peut essayer à tout moment, en début de séance.
 */
function club_essai_accroche(?int $mois = null): string
{
    $essai = club_data()['trial'] ?? [];
    $mois = $mois ?? (int) date('n');
    return in_array($mois, [7, 8, 9], true)
        ? ($essai['label'] ?? '')
        : ($essai['yearRound'] ?? $essai['label'] ?? '');
}

/**
 * Membre de l'équipe dirigeante par sa clé ('president', 'tresorier', 'secretaire').
 */
function club_board_member($key)
{
	foreach (club_board() as $membre) {
		if (($membre['key'] ?? '') === $key) {
			return $membre;
		}
	}
	return null;
}
