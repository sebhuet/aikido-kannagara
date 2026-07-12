<?php
/**
 * Résumé des horaires en une ligne + renvoi vers l'agenda.
 *
 * Le domicile des horaires est agenda.php (tableau complet via horaires.php).
 * Les pages qui ont seulement besoin de *mentionner* les horaires incluent ce
 * résumé plutôt que de réafficher le tableau — ou pire, de réécrire les heures
 * en dur : toutes les valeurs viennent de data/club.json.
 *
 * Usage :
 *   <?php include 'includes/horaires-resume.php'; ?>
 *       → « Cours le lundi et le jeudi : enfants 18h00 - 19h00, adultes 19h00 - 22h00. »
 *
 *   <?php $horaires_resume_public = 'enfants'; include 'includes/horaires-resume.php'; ?>
 *       → « Les cours enfants ont lieu le lundi et le jeudi, de 18h00 à 19h00. »
 */
require_once __DIR__ . '/data.php';

$s = club_data()['schedule'];

$public = $horaires_resume_public ?? null;
$horaires_resume_public = null; // réinitialise : évite toute fuite sur une inclusion ultérieure

// strtolower (et non mb_strtolower) : les jours sont sans accent, inutile de dépendre de mbstring.
$hFmt  = fn($t) => str_replace(':', 'h', $t);
$jours = implode(' et le ', array_map('strtolower', $s['days']));

$enfantsDebut = $hFmt($s['children']['opens']);
$enfantsFin   = $hFmt($s['children']['closes']);
$adultesDebut = $hFmt($s['adultsRange']['opens']);
$adultesFin   = $hFmt($s['adultsRange']['closes']);

if ($public === 'enfants') {
    $resume = 'Les cours enfants ont lieu le ' . $jours . ', de ' . $enfantsDebut . ' à ' . $enfantsFin . '.';
} else {
    $resume = 'Cours le ' . $jours . ' : enfants ' . $enfantsDebut . ' - ' . $enfantsFin
            . ', adultes ' . $adultesDebut . ' - ' . $adultesFin . '.';
}
?>
<p class="horaires-resume">
    <?= htmlspecialchars($resume) ?>
    <a href="agenda.php">Voir l'agenda et les horaires détaillés</a>.
</p>
