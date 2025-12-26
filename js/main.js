document.addEventListener('DOMContentLoaded', () => {

    // --- Mobile Menu Toggle ---
    const mobileMenuButton = document.getElementById('mobile-menu-btn');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const header = document.querySelector('header');

    if (mobileMenuButton && mobileMenuOverlay) {
        mobileMenuButton.addEventListener('click', () => {
            const isOpen = mobileMenuOverlay.classList.contains('opacity-100');
            toggleMenu(!isOpen);
        });

        // Close when clicking a link
        document.querySelectorAll('.mobile-menu-link').forEach(link => {
            link.addEventListener('click', () => toggleMenu(false));
        });
    }

    function toggleMenu(show) {
        const iconMenu = document.getElementById('icon-menu');
        const iconClose = document.getElementById('icon-close');

        if (show) {
            mobileMenuOverlay.classList.remove('opacity-0', 'pointer-events-none');
            mobileMenuOverlay.classList.add('opacity-100', 'pointer-events-auto');
            iconMenu?.classList.add('hidden');
            iconClose?.classList.remove('hidden');

            mobileMenuOverlay.querySelectorAll('.mobile-item').forEach((link, idx) => {
                setTimeout(() => {
                    link.classList.remove('-translate-x-10', 'opacity-0');
                    link.classList.add('translate-x-0', 'opacity-100');
                }, idx * 50);
            });
        } else {
            mobileMenuOverlay.classList.remove('opacity-100', 'pointer-events-auto');
            mobileMenuOverlay.classList.add('opacity-0', 'pointer-events-none');
            iconMenu?.classList.remove('hidden');
            iconClose?.classList.add('hidden');

            mobileMenuOverlay.querySelectorAll('.mobile-item').forEach(link => {
                link.classList.add('-translate-x-10', 'opacity-0');
                link.classList.remove('translate-x-0', 'opacity-100');
            });
        }
    }

    // --- Header Scroll Effect ---
    window.addEventListener('scroll', () => {
        const logoWhite = document.querySelector('.logo-white');
        const logoOriginal = document.querySelector('.logo-original');

        if (window.scrollY > 20) {
            header.classList.add('bg-white/95', 'backdrop-blur-md', 'shadow-sm', 'py-2');
            header.classList.remove('bg-transparent', 'py-4');

            document.querySelectorAll('.header-link').forEach(link => {
                link.classList.remove('md:text-white', 'md:mix-blend-overlay');
                link.classList.add('text-lumira-dark');
            });
            document.querySelector('button[aria-label="Menu"]')?.classList.remove('text-white');
            document.querySelector('button[aria-label="Menu"]')?.classList.add('text-lumira-dark');

            // Switch to Original Logo
            if (logoWhite) logoWhite.classList.add('opacity-0');
            if (logoOriginal) logoOriginal.classList.remove('opacity-0');

        } else {
            header.classList.remove('bg-white/95', 'backdrop-blur-md', 'shadow-sm', 'py-2');
            header.classList.add('bg-transparent', 'py-4');

            document.querySelectorAll('.header-link').forEach(link => {
                link.classList.add('md:text-white', 'md:mix-blend-overlay');
                link.classList.remove('text-lumira-dark');
            });
            document.querySelector('button[aria-label="Menu"]')?.classList.add('text-white');
            document.querySelector('button[aria-label="Menu"]')?.classList.remove('text-lumira-dark');

            // Switch to White Logo
            if (logoWhite) logoWhite.classList.remove('opacity-0');
            if (logoOriginal) logoOriginal.classList.add('opacity-0');
        }
    });

    // --- Mega Menu Image Hover ---
    document.querySelectorAll('.nav-item-group').forEach(item => {
        const previewImage = item.querySelector('.mega-menu-image');
        const previewText = item.querySelector('.mega-menu-text');

        item.querySelectorAll('[data-image]').forEach(link => {
            link.addEventListener('mouseenter', () => {
                const imageUrl = link.getAttribute('data-image');
                const description = link.getAttribute('data-description');

                if (previewImage && imageUrl) previewImage.src = imageUrl;
                if (previewText && description) previewText.textContent = description;
            });
        });
    });

    // --- Hero Carousel ---
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        const totalSlides = slides.length;
        const indicators = document.querySelectorAll('.hero-indicator');
        const heroText = document.querySelectorAll('.hero-text');
        const heroBg = document.querySelectorAll('.hero-bg-image');

        function updateSlide(index) {
            slides.forEach((slide, idx) => {
                if (idx === index) {
                    slide.classList.remove('opacity-0', 'z-0');
                    slide.classList.add('opacity-100', 'z-10');
                    heroBg[idx].classList.remove('scale-110');
                    heroBg[idx].classList.add('scale-100');
                } else {
                    slide.classList.remove('opacity-100', 'z-10');
                    slide.classList.add('opacity-0', 'z-0');
                    heroBg[idx].classList.remove('scale-100');
                    heroBg[idx].classList.add('scale-110');
                }
            });

            heroText.forEach((text, idx) => {
                if (idx === index) text.classList.remove('hidden');
                else text.classList.add('hidden');
            });

            indicators.forEach((ind, idx) => {
                if (idx === index) {
                    ind.classList.remove('bg-white/40', 'w-4');
                    ind.classList.add('bg-lumira-orange', 'w-12');
                } else {
                    ind.classList.remove('bg-lumira-orange', 'w-12');
                    ind.classList.add('bg-white/40', 'w-4');
                }
            });
            currentSlide = index;
        }

        setInterval(() => {
            updateSlide((currentSlide + 1) % totalSlides);
        }, 6000);

        document.getElementById('hero-prev')?.addEventListener('click', () => {
            updateSlide((currentSlide - 1 + totalSlides) % totalSlides);
        });
        document.getElementById('hero-next')?.addEventListener('click', () => {
            updateSlide((currentSlide + 1) % totalSlides);
        });
        indicators.forEach((ind, idx) => {
            ind.addEventListener('click', () => updateSlide(idx));
        });
    }

    // --- About Video ---
    const playBtn = document.getElementById('play-video-btn');
    if (playBtn) {
        playBtn.addEventListener('click', () => {
            document.getElementById('video-cover').classList.add('opacity-0', 'pointer-events-none');
            document.getElementById('video-playing').classList.remove('opacity-0');
        });
    }

    // --- School Life Tabs ---
    const activityTabs = document.querySelectorAll('.activity-tab');
    if (activityTabs.length > 0) {
        activityTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const id = tab.getAttribute('data-id');

                // Update Tabs
                activityTabs.forEach(t => {
                    const isActive = t === tab;
                    const iconWrap = t.querySelector('.activity-icon-wrapper');
                    const title = t.querySelector('.activity-title');
                    const arrow = t.querySelector('.activity-arrow');

                    if (isActive) {
                        t.classList.remove('bg-white/50', 'border-transparent', 'hover:bg-white', 'text-slate-500');
                        t.classList.add('bg-white', 'border-lumira-orange/20', 'shadow-lg', 'scale-100', 'lg:scale-105', 'z-10');
                        iconWrap.classList.remove('bg-gray-200', 'text-gray-400');
                        iconWrap.classList.add('bg-lumira-light', 'text-lumira-blue');
                        title.classList.remove('text-slate-500');
                        title.classList.add('text-lumira-dark');
                        arrow.classList.remove('hidden');
                    } else {
                        t.classList.add('bg-white/50', 'border-transparent', 'hover:bg-white', 'text-slate-500');
                        t.classList.remove('bg-white', 'border-lumira-orange/20', 'shadow-lg', 'scale-100', 'lg:scale-105', 'z-10');
                        iconWrap.classList.add('bg-gray-200', 'text-gray-400');
                        iconWrap.classList.remove('bg-lumira-light', 'text-lumira-blue');
                        title.classList.add('text-slate-500');
                        title.classList.remove('text-lumira-dark');
                        arrow.classList.add('hidden');
                    }
                });

                // Update Content
                document.querySelectorAll('.activity-content').forEach(content => {
                    if (content.id === `activity-${id}`) {
                        content.classList.remove('opacity-0', 'absolute', 'z-0', 'pointer-events-none', 'hidden');
                        content.classList.add('opacity-100', 'relative', 'z-10', 'pointer-events-auto');
                    } else {
                        content.classList.add('opacity-0', 'absolute', 'z-0', 'pointer-events-none', 'hidden');
                        content.classList.remove('opacity-100', 'relative', 'z-10', 'pointer-events-auto');
                    }
                });
            });
        });
    }

    // --- Gallery ---
    const filterBtns = document.querySelectorAll('.filter-btn');
    if (filterBtns.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');

                // Update buttons
                filterBtns.forEach(b => {
                    if (b === btn) {
                        b.classList.remove('bg-transparent', 'text-slate-400');
                        b.classList.add('bg-lumira-light', 'text-lumira-blue');
                    } else {
                        b.classList.add('bg-transparent', 'text-slate-400');
                        b.classList.remove('bg-lumira-light', 'text-lumira-blue');
                    }
                });

                // Filter Items
                document.querySelectorAll('.gallery-item').forEach(item => {
                    if (filter === 'todos' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Lightbox
        const lightbox = document.getElementById('lightbox-modal');
        const lightboxImg = document.getElementById('lightbox-image');
        const lightboxCap = document.getElementById('lightbox-caption');
        let currentItem = null;

        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', () => {
                const src = item.getAttribute('data-src');
                const cap = item.getAttribute('data-caption');
                lightboxImg.src = src;
                lightboxCap.textContent = cap;
                lightbox.classList.remove('hidden', 'opacity-0');
                lightbox.classList.add('opacity-100', 'pointer-events-auto');
                currentItem = item;
            });
        });

        document.getElementById('lightbox-close')?.addEventListener('click', closeLightbox);

        function closeLightbox() {
            lightbox.classList.add('opacity-0');
            setTimeout(() => {
                lightbox.classList.add('hidden');
                lightboxImg.src = '';
            }, 300);
        }
    }

    // --- FAQ Accordion ---
    document.querySelectorAll('.faq-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

            // Close all first (optional, for accordion style)
            // document.querySelectorAll('.faq-toggle').forEach(t => {
            //     t.setAttribute('aria-expanded', 'false');
            //     t.nextElementSibling.style.maxHeight = '0px';
            //     t.nextElementSibling.classList.remove('opacity-100');
            //     t.querySelector('.faq-question').classList.remove('text-lumira-blue');
            //     t.querySelector('.faq-icon').classList.remove('rotate-180');
            // });

            if (!isExpanded) {
                toggle.setAttribute('aria-expanded', 'true');
                const answer = toggle.nextElementSibling;
                answer.style.maxHeight = answer.scrollHeight + "px";
                answer.classList.add('opacity-100');
                toggle.querySelector('.faq-question').classList.add('text-lumira-blue');
                toggle.querySelector('.faq-icon').classList.add('rotate-180');
            } else {
                toggle.setAttribute('aria-expanded', 'false');
                const answer = toggle.nextElementSibling;
                answer.style.maxHeight = '0px';
                answer.classList.remove('opacity-100');
                toggle.querySelector('.faq-question').classList.remove('text-lumira-blue');
                toggle.querySelector('.faq-icon').classList.remove('rotate-180');
            }
        });
    });

    // --- Contact Form ---
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            contactForm.classList.add('hidden');
            document.getElementById('contact-success').classList.remove('hidden');
        });
    }

    // --- Marketing Modal ---
    const modal = document.getElementById('marketing-modal');
    if (modal) { // && !sessionStorage.getItem('lumira_promo_2026_seen')) {
        setTimeout(() => {
            modal.classList.remove('invisible', 'pointer-events-none', 'opacity-0');
            modal.querySelector('#marketing-modal-bg').classList.add('bg-black/60', 'backdrop-blur-sm');

            const content = document.getElementById('marketing-modal-content');
            content.classList.remove('scale-95', 'translate-y-10', 'opacity-0');
            content.classList.add('scale-100', 'translate-y-0', 'opacity-100');
        }, 2500);

        function closeModal() {
            const content = document.getElementById('marketing-modal-content');
            content.classList.remove('scale-100', 'translate-y-0', 'opacity-100');
            content.classList.add('scale-95', 'translate-y-10', 'opacity-0');

            modal.querySelector('#marketing-modal-bg').classList.remove('bg-black/60', 'backdrop-blur-sm');

            setTimeout(() => {
                modal.classList.add('opacity-0', 'invisible', 'pointer-events-none');
                sessionStorage.setItem('lumira_promo_2026_seen', 'true');
            }, 500);
        }

        document.getElementById('marketing-modal-close')?.addEventListener('click', closeModal);
        document.getElementById('marketing-modal-dismiss')?.addEventListener('click', closeModal);
        document.getElementById('marketing-modal-bg')?.addEventListener('click', closeModal);
        document.getElementById('marketing-modal-cta')?.addEventListener('click', closeModal);
    }

    // --- Initialize Lucide ---
    if (window.lucide) {
        lucide.createIcons();
    }
});
