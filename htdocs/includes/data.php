<?php

/**
 * Source unique de vérité du club.
 * Charge (une seule fois) les données de data/club.json et les expose via club_data().
 *
 * Consommé côté PHP par les pages, les composants (horaires.php, horaires-resume.php,
 * footer.php) et les blocs JSON-LD. Côté Node, seul build-blog.js le lit.
 *
 * ATTENTION : llms.txt et llms-full.txt NE SONT PAS générés — ils recopient ces mêmes
 * données à la main et divergent donc à chaque changement. À corriger (build-llms.js).
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
