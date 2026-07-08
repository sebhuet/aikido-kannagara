<?php require_once __DIR__ . '/data.php'; $s = club_data()['schedule']; ?>
<div class="schedule-table-wrapper">
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
