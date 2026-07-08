<?php

/**
 * Source unique de vérité du club.
 * Charge (une seule fois) les données de data/club.json et les expose via club_data().
 * Consommé côté PHP (pages + schema) ; le même fichier alimente aussi la génération
 * des fichiers LLM et du sitemap côté Node.
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
