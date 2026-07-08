<?php

/**
 * BreadcrumbList JSON-LD, généré à partir de $active (défini par chaque page avant l'include header).
 * Inclus une seule fois depuis header.php : toutes les pages internes obtiennent leur fil d'Ariane balisé,
 * sans balisage à répéter page par page.
 * Les URLs suivent la forme canonique actuelle (.html) — à ajuster ici uniquement si la
 * canonicalisation passe en extensionless.
 */
require_once __DIR__ . '/data.php';

$__bcTitles = [
	'aikido' => "L'Aïkido",
	'club' => 'Le Club',
	'professeurs' => 'Professeurs',
	'agenda' => 'Agenda',
	'actualites' => 'Actualités',
	'galerie' => 'Galerie',
	'blog' => 'Blog',
	'inscription' => 'Inscription',
	'contact' => 'Contact',
	'faq' => 'FAQ',
	'fondations' => 'Fondations',
	'armes' => 'Armes',
	'grades' => 'Grades',
	'lexique' => 'Lexique'
];

if (!empty($active) && isset($__bcTitles[$active])) {
	$__base = club_data()['url'];
	$__ld = [
		'@context' => 'https://schema.org',
		'@type' => 'BreadcrumbList',
		'itemListElement' => [
			['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => $__base . '/'],
			['@type' => 'ListItem', 'position' => 2, 'name' => $__bcTitles[$active], 'item' => $__base . '/' . $active . '.php']
		]
	];
	echo "\n" . '<script type="application/ld+json">' . "\n"
		. json_encode($__ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
		. "\n" . '</script>' . "\n";
}
