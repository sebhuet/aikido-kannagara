#!/usr/bin/env node
/**
 * Script de génération de l'agenda des cours
 * Lit agenda.md et met à jour agenda.html
 *
 * Usage: node build-agenda.js
 */

const fs = require('fs');
const path = require('path');

const AGENDA_MD = path.join(__dirname, 'agenda.md');
const AGENDA_HTML = path.join(__dirname, 'agenda.html');

/**
 * Parse le fichier agenda.md
 */
function parseAgenda() {
    const content = fs.readFileSync(AGENDA_MD, 'utf-8');
    const lines = content.split('\n');

    const weeks = [];
    let currentWeek = null;
    let currentDay = null;

    for (let line of lines) {
        line = line.trim();

        // Nouvelle semaine
        if (line.startsWith('## Semaine du ')) {
            if (currentWeek) weeks.push(currentWeek);
            currentWeek = {
                title: line.replace('## Semaine du ', ''),
                days: []
            };
            currentDay = null;
        }
        // Nouveau jour
        else if (line.startsWith('### ')) {
            if (currentWeek) {
                currentDay = {
                    name: line.replace('### ', ''),
                    courses: []
                };
                currentWeek.days.push(currentDay);
            }
        }
        // Note (doit être avant les cours pour éviter le conflit avec '- **')
        else if (line.startsWith('- **Note**') && currentDay && currentDay.courses.length > 0) {
            const note = line.replace('- **Note** : ', '').replace('- **Note**: ', '');
            currentDay.courses[currentDay.courses.length - 1].note = note;
        }
        // Cours
        else if (line.startsWith('- **') && currentDay) {
            // Note lines are handled separately
            if (!line.startsWith('- **Note**')) {
                // Format: - **18h30-19h30** | Adultes | Jean-Marc Chamot, Nacer Chekkaba
                const match = line.match(/- \*\*(.+?)\*\* \| (.+?) \|(.*)/);
                if (match) {
                    const teachers = match[3].trim() || 'À confirmer';
                    currentDay.courses.push({
                        time: match[1],
                        type: match[2],
                        teachers: teachers,
                        note: null
                    });
                }
                // Format fermé: - **Fermé** | Vacances scolaires
                const closedMatch = line.match(/- \*\*Fermé\*\* \| (.+)/);
                if (closedMatch) {
                    currentDay.courses.push({
                        time: 'Fermé',
                        type: closedMatch[1],
                        teachers: null,
                        note: null
                    });
                }
            }
        }
    }

    if (currentWeek) weeks.push(currentWeek);

    return weeks;
}

/**
 * Génère le HTML de l'agenda en format tableau
 */
function generateAgendaHtml(weeks) {
    let html = '';

    weeks.forEach((week, weekIndex) => {
        const isAlt = weekIndex % 2 === 1;
        const sectionClass = isAlt ? 'section section--alt' : 'section';

        html += `
    <section class="${sectionClass}">
        <div class="container">
            <h2 class="agenda-week__title">📅 Semaine du ${week.title}</h2>
            <table class="agenda-table">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Horaire</th>
                        <th>Type</th>
                        <th>Professeur(s)</th>
                    </tr>
                </thead>
                <tbody>`;

        week.days.forEach(day => {
            let firstCourse = true;
            const rowCount = day.courses.length;

            day.courses.forEach((course, courseIndex) => {
                if (course.time === 'Fermé') {
                    html += `
                    <tr class="agenda-closed">
                        ${firstCourse ? `<td class="agenda-day-cell" rowspan="${rowCount}">${day.name}</td>` : ''}
                        <td colspan="3" class="agenda-time-cell">Fermé - ${course.type}</td>
                    </tr>`;
                } else {
                    // Créer des liens vers les fiches professeurs
                    const teachersWithLinks = course.teachers.split(',').map(teacher => {
                        const name = teacher.trim();
                        const slug = name.toLowerCase()
                            .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                            .replace(/[^a-z0-9]+/g, '-')
                            .replace(/^-+|-+$/g, '');
                        return `<a href="professeurs.html#${slug}" class="teacher-link">${name}</a>`;
                    }).join(', ');

                    html += `
                    <tr>
                        ${firstCourse ? `<td class="agenda-day-cell" rowspan="${rowCount}">${day.name}</td>` : ''}
                        <td class="agenda-time-cell">${course.time}</td>
                        <td class="agenda-type-cell">${course.type}</td>
                        <td class="agenda-teachers-cell">${teachersWithLinks}${course.note ? `<br><span class="agenda-course__note"><span class="agenda-note-icon">ℹ️</span>${course.note}</span>` : ''}</td>
                    </tr>`;
                }
                firstCourse = false;
            });
        });

        html += `
                </tbody>
            </table>
        </div>
    </section>`;
    });

    return html;
}

/**
 * Met à jour agenda.html
 */
function updateAgendaHtml(weeks) {
    if (!fs.existsSync(AGENDA_HTML)) {
        console.log('⚠️  agenda.html n\'existe pas encore. Créez d\'abord le template.');
        return;
    }

    let html = fs.readFileSync(AGENDA_HTML, 'utf-8');
    const agendaHtml = generateAgendaHtml(weeks);

    // Trouver et remplacer la section agenda
    const startMarker = '<!-- AGENDA_START -->';
    const endMarker = '<!-- AGENDA_END -->';

    const startIndex = html.indexOf(startMarker);
    const endIndex = html.indexOf(endMarker);

    if (startIndex === -1 || endIndex === -1) {
        console.log('⚠️  Marqueurs AGENDA_START/AGENDA_END non trouvés dans agenda.html');
        return;
    }

    html = html.substring(0, startIndex + startMarker.length) +
           '\n' + agendaHtml + '\n    ' +
           html.substring(endIndex);

    fs.writeFileSync(AGENDA_HTML, html, 'utf-8');
    console.log('✓ agenda.html mis à jour');
}

// Exécution
console.log('📅 Génération de l\'agenda des cours...\n');

const weeks = parseAgenda();
console.log(`📚 ${weeks.length} semaines trouvées`);

weeks.forEach(week => {
    console.log(`  • ${week.title} (${week.days.length} jours)`);
});

updateAgendaHtml(weeks);

console.log('\n✨ Génération terminée !');
