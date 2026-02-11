/* ============================================
   KANNAGARA AIKIDO - JavaScript principal
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {
    // ---------- Menu Mobile ----------
    const navToggle = document.querySelector('.nav__toggle');
    const navList = document.querySelector('.nav__list');
    const navOverlay = document.querySelector('.nav-overlay');
    const navLinks = document.querySelectorAll('.nav__link');

    function toggleMenu() {
        const isExpanded = navToggle.getAttribute('aria-expanded') === 'true';
        navToggle.classList.toggle('active');
        navList.classList.toggle('active');
        if (navOverlay) {
            navOverlay.classList.toggle('active');
        }
        // Mise à jour des attributs ARIA
        navToggle.setAttribute('aria-expanded', !isExpanded);
        navToggle.setAttribute('aria-label', isExpanded ? 'Ouvrir le menu' : 'Fermer le menu');
        document.body.style.overflow = navList.classList.contains('active') ? 'hidden' : '';
    }

    function closeMenu() {
        navToggle.classList.remove('active');
        navList.classList.remove('active');
        if (navOverlay) {
            navOverlay.classList.remove('active');
        }
        // Mise à jour des attributs ARIA
        navToggle.setAttribute('aria-expanded', 'false');
        navToggle.setAttribute('aria-label', 'Ouvrir le menu');
        document.body.style.overflow = '';
    }

    if (navToggle) {
        // Gestion du clic et du touch pour le bouton menu
        navToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });

        // Support tactile amélioré
        navToggle.addEventListener('touchend', function(e) {
            e.preventDefault();
            toggleMenu();
        });
    }

    if (navOverlay) {
        navOverlay.addEventListener('click', closeMenu);
        navOverlay.addEventListener('touchend', function(e) {
            e.preventDefault();
            closeMenu();
        });
    }

    // Les liens naviguent normalement - pas besoin de closeMenu
    // car la page sera rechargée

    // Fermer le menu avec Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && navList.classList.contains('active')) {
            closeMenu();
        }
    });

    // ---------- Header scroll effect ----------
    const header = document.querySelector('.header');
    let lastScroll = 0;

    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;

        // Ajouter une classe quand on scroll
        if (currentScroll > 50) {
            header.classList.add('header--scrolled');
        } else {
            header.classList.remove('header--scrolled');
        }

        lastScroll = currentScroll;
    });

    // ---------- Smooth scroll pour les ancres ----------
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;

            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ---------- Animation au scroll (fade-in) ----------
    const fadeElements = document.querySelectorAll('.fade-in');

    if (fadeElements.length > 0 && 'IntersectionObserver' in window) {
        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        fadeElements.forEach(el => fadeObserver.observe(el));
    }

    // ---------- Active nav link based on current page ----------
    const currentPage = window.location.pathname.split('/').pop() || 'index.php';
    navLinks.forEach(link => {
        const linkPage = link.getAttribute('href');
        if (linkPage === currentPage ||
            (currentPage === '' && linkPage === 'index.php') ||
            (currentPage === 'index.php' && linkPage === 'index.php')) {
            link.classList.add('nav__link--active');
        }
    });

    // ---------- Formulaire de contact ----------
    // Le formulaire de contact utilise Google Forms (lien externe)

    // ---------- Gestion des tables responsives ----------
    const tables = document.querySelectorAll('.grades-table');
    tables.forEach(table => {
        const headers = table.querySelectorAll('th');
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                if (headers[index]) {
                    cell.setAttribute('data-label', headers[index].textContent);
                }
            });
        });
    });

    // ---------- Lazy loading des images (natif) ----------
    const images = document.querySelectorAll('img[data-src]');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback pour les anciens navigateurs
        images.forEach(img => {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
        });
    }

    // ---------- Teachers Carousel ----------
    const carousel = document.querySelector('.teachers-carousel');
    if (carousel) {
        const slides = carousel.querySelectorAll('.teachers-carousel__slide');
        const dots = carousel.querySelectorAll('.teachers-carousel__dot');
        let currentSlide = 0;
        let autoplayInterval;

        function showSlide(index) {
            // Remove active class from all slides and dots
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Add active class to current slide and dot
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            currentSlide = index;
        }

        function nextSlide() {
            const next = (currentSlide + 1) % slides.length;
            showSlide(next);
        }

        function startAutoplay() {
            autoplayInterval = setInterval(nextSlide, 2000);
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        // Click on dots to navigate
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                stopAutoplay();
                showSlide(index);
                startAutoplay();
            });
        });

        // Pause on hover
        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);

        // Start autoplay
        startAutoplay();
    }

    // ---------- Console log pour debug ----------
    console.log('Kannagara Aïkido - Site chargé');
});
