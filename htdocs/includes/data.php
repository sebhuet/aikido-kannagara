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
