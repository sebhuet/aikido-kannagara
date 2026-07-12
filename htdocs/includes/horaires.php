<?php
/**
 * Tableau des horaires (domicile : agenda.php ; rappel : index.php).
 * Valeurs issues de data/club.json — ne jamais réécrire un horaire en dur.
 * Le libellé de saison est obligatoire : club.json porte les horaires de la
 * saison à venir, qui ne prennent effet qu'à seasonStart.
 */
require_once __DIR__ . '/data.php';
$c = club_data();
$s = $c['schedule'];
$saisonDebut = !empty($c['seasonStart']) ? date('d/m/Y', strtotime($c['seasonStart'])) : null;
?>
<div class="schedule-table-wrapper">
<?php if ($saisonDebut): ?>
<p class="schedule-season">
    <strong>Saison <?= htmlspecialchars($c['season']) ?></strong> — horaires en vigueur à partir du <?= htmlspecialchars($saisonDebut) ?>.
</p>
<?php endif; ?>
<table class="schedule-table">
    <thead>
        <tr>
            <th></th>
            <th>Enfants</th>
            <th>Adultes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($s['days'] as $day): ?>
        <tr>
            <td class="schedule-table__day" rowspan="2"><?= htmlspecialchars($day) ?></td>
            <td rowspan="2"><?= htmlspecialchars($s['children']['label']) ?></td>
            <td><?= htmlspecialchars($s['adults'][0]['label']) ?></td>
        </tr>
        <tr>
            <td><?= htmlspecialchars($s['adults'][1]['label']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
