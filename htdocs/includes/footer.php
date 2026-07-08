    </main>

    <?php require_once __DIR__ . '/data.php'; $club = club_data(); $loc = $club['location']; $fed = $club['federation']; ?>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer__grid">
                <div class="footer__section">
                    <h4><?= htmlspecialchars($club['name']) ?></h4>
                    <p>Club d'aïkido de <?= htmlspecialchars($loc['city']) ?> depuis <?= (int) $club['foundingYear'] ?>.</p>
                    <p>Agréé Jeunesse et Sports.</p>
                    <p>Affilié à la <?= htmlspecialchars($fed['abbr']) ?>.</p>
                    <?php if (!empty($club['social'])): ?>
                    <p class="footer__social">
                        <?php foreach ($club['social'] as $label => $href): ?>
                        <a href="<?= htmlspecialchars($href) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($label) ?></a>
                        <?php endforeach; ?>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="footer__section">
                    <h4>L'Aïkido</h4>
                    <ul>
                        <li><a href="aikido.php">Présentation</a></li>
                        <li><a href="fondations.php">Fondations</a></li>
                        <li><a href="armes.php">Armes</a></li>
                        <li><a href="grades.php">Grades</a></li>
                        <li><a href="lexique.php">Lexique</a></li>
                    </ul>
                </div>

                <div class="footer__section">
                    <h4>Le Club</h4>
                    <ul>
                        <li><a href="club.php">Présentation</a></li>
                        <li><a href="professeurs.php">Professeurs</a></li>
                        <li><a href="actualites.php">Actualités</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="galerie.php">Galerie</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="agenda.php">Agenda</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>

                <div class="footer__section">
                    <h4>Contact</h4>
                    <p class="footer__address">
                        <?= htmlspecialchars($loc['venue']) ?><br>
                        <?= htmlspecialchars($loc['street']) ?><br>
                        <?= htmlspecialchars($loc['postalCode']) ?> <?= htmlspecialchars($loc['city']) ?>
                    </p>
                    <p><a href="tel:<?= preg_replace('/\s+/', '', $club['contact']['phone']) ?>"><?= htmlspecialchars($club['contact']['phone']) ?></a></p>
                    <p><a href="mailto:<?= htmlspecialchars($club['contact']['email']) ?>"><?= htmlspecialchars($club['contact']['email']) ?></a></p>
                </div>
            </div>

            <div class="footer__bottom">
                <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($club['name']) ?>. Tous droits réservés. | <a href="mentions-legales.php">Mentions légales</a></p>
                <span class="footer__ffab">Affilié à la <?= htmlspecialchars($fed['name']) ?> — Club n° <?= htmlspecialchars($fed['clubNumber']) ?><br><?= htmlspecialchars($fed['agrement']) ?></span>

            </div>
        </div>
    </footer>
