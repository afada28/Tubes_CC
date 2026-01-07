// ===== INITIALIZE AOS WITH OPTIMIZED SETTINGS =====
AOS.init({
    duration: 800,
    once: true,
    offset: 50, // Konten muncul lebih cepat
    easing: 'ease-out-cubic',
    disable: function() {
        var maxWidth = 768;
        return window.innerWidth < maxWidth;
    }
});

// ===== ENHANCED MOBILE NAVIGATION SYSTEM =====
class MobileNavigation {
    constructor() {
        this.navbar = document.getElementById('mainNavbar');
        this.toggler = document.querySelector('.navbar-toggler-premium');
        this.overlay = null;
        this.isOpen = false;
        this.lastScroll = 0;

        this.init();
    }

    init() {
        this.createMobileOverlay();
        this.bindEvents();
        this.handleScroll();
    }

    createMobileOverlay() {
        // Remove old overlay if exists
        const existingOverlay = document.querySelector('.mobile-menu-overlay');
        if (existingOverlay) {
            existingOverlay.remove();
        }

        // Create new overlay
        this.overlay = document.createElement('div');
        this.overlay.className = 'mobile-menu-overlay';
        this.overlay.innerHTML = `
            <div class="mobile-menu-content">
                <a href="#introduction" class="mobile-nav-link">Tentang</a>
                <a href="#beliefs" class="mobile-nav-link">Prinsip</a>
                <a href="#journey" class="mobile-nav-link">Journey</a>
                <a href="${window.location.origin}" class="mobile-nav-link">Relawan</a>
                <a href="#active-donations" class="mobile-donate-btn">
                    <i class="bi bi-heart-fill"></i>
                    <span>Donasi Sekarang</span>
                </a>
            </div>
        `;

        document.body.appendChild(this.overlay);

        // Add click handlers to menu items
        this.overlay.querySelectorAll('.mobile-nav-link, .mobile-donate-btn').forEach(link => {
            link.addEventListener('click', () => {
                this.closeMenu();

                // Handle smooth scroll for anchor links
                const href = link.getAttribute('href');
                if (href.startsWith('#') && href !== '#') {
                    setTimeout(() => {
                        this.smoothScrollTo(href);
                    }, 300);
                }
            });
        });
    }

    bindEvents() {
        // Toggle button click
        if (this.toggler) {
            this.toggler.addEventListener('click', (e) => {
                e.stopPropagation();
                this.toggleMenu();
            });
        }

        // Close menu when clicking overlay background
        if (this.overlay) {
            this.overlay.addEventListener('click', (e) => {
                if (e.target === this.overlay) {
                    this.closeMenu();
                }
            });
        }

        // Close menu on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeMenu();
            }
        });

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth > 991 && this.isOpen) {
                    this.closeMenu();
                }
            }, 250);
        });
    }

    toggleMenu() {
        if (this.isOpen) {
            this.closeMenu();
        } else {
            this.openMenu();
        }
    }

    openMenu() {
        if (this.overlay && this.toggler) {
            this.isOpen = true;
            this.overlay.classList.add('show');
            this.toggler.classList.add('active');

            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.width = '100%';
            document.body.style.top = `-${window.scrollY}px`;

            // Reset animations
            const menuItems = this.overlay.querySelectorAll('.mobile-nav-link, .mobile-donate-btn');
            menuItems.forEach((item, index) => {
                item.style.animationDelay = `${(index + 1) * 0.1}s`;
            });
        }
    }

    closeMenu() {
        if (this.overlay && this.toggler) {
            this.isOpen = false;
            this.overlay.classList.remove('show');
            this.toggler.classList.remove('active');

            // Restore body scroll
            const scrollY = document.body.style.top;
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
            document.body.style.top = '';
            window.scrollTo(0, parseInt(scrollY || '0') * -1);
        }
    }

    handleScroll() {
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            // Add/remove scrolled class - lebih cepat
            if (currentScroll > 50) {
                this.navbar?.classList.add('scrolled');
            } else {
                this.navbar?.classList.remove('scrolled');
            }

            this.lastScroll = currentScroll;
        });
    }

    smoothScrollTo(target) {
        const element = document.querySelector(target);
        if (element) {
            const offset = window.innerWidth <= 991 ? 70 : 85;
            const targetPosition = element.offsetTop - offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }
}

// ===== IMPROVED SCROLL REVEAL SYSTEM =====
class ScrollReveal {
    constructor() {
        this.elements = [];
        this.init();
    }

    init() {
        // Find all elements that should be animated
        this.elements = [
            ...document.querySelectorAll('.section-title'),
            ...document.querySelectorAll('.section-subtitle'),
            ...document.querySelectorAll('.value-card-premium'),
            ...document.querySelectorAll('.belief-card-modern'),
            ...document.querySelectorAll('.donation-card-modern'),
            ...document.querySelectorAll('.volunteer-card-modern'),
            ...document.querySelectorAll('.gallery-card'),
            ...document.querySelectorAll('.story-timeline-item')
        ];

        this.createObserver();
    }

    createObserver() {
        const options = {
            threshold: 0.1, // Threshold lebih rendah untuk trigger lebih cepat
            rootMargin: '-20px 0px', // Margin lebih kecil
        };

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('revealed')) {
                    this.revealElement(entry.target);
                }
            });
        }, options);

        this.elements.forEach(element => {
            // Set initial state
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'opacity 0.8s ease, transform 0.8s ease';

            this.observer.observe(element);
        });
    }

    revealElement(element) {
        element.style.opacity = '1';
        element.style.transform = 'translateY(0)';
        element.classList.add('revealed');
    }
}

// ===== COUNTER ANIMATION SYSTEM =====
class CounterAnimation {
    constructor() {
        this.counters = document.querySelectorAll('[data-count]');
        this.init();
    }

    init() {
        if (this.counters.length === 0) return;

        const options = {
            threshold: 0.3,
            rootMargin: '0px'
        };

        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    this.animateCounter(entry.target);
                }
            });
        }, options);

        this.counters.forEach(counter => {
            this.observer.observe(counter);
        });
    }

    animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count') || '0');
        const duration = 1500;
        const increment = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
                element.classList.add('counted');
            } else {
                element.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }
}

// ===== SMOOTH SCROLL FOR ALL LINKS =====
class SmoothScroll {
    constructor() {
        this.init();
    }

    init() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                const href = anchor.getAttribute('href');
                if (href === '#') return;

                e.preventDefault();
                const target = document.querySelector(href);

                if (target) {
                    const offset = window.innerWidth <= 991 ? 70 : 85;
                    const targetPosition = target.offsetTop - offset;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
}

// ===== DONATION & VOLUNTEER CARD ENHANCEMENTS =====
class CardEnhancements {
    constructor() {
        this.init();
    }

    init() {
        this.addHoverEffects();
        this.addRippleEffect();
        this.initProgressBars();
        this.initCountdowns();
        this.addParallaxEffect();
    }

    addHoverEffects() {
        // Only add 3D hover effects on desktop
        if (window.innerWidth > 991) {
            document.querySelectorAll('.donation-card-modern, .volunteer-card-modern').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'transform 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                });

                card.addEventListener('mousemove', function(e) {
                    const cardRect = this.getBoundingClientRect();
                    const centerX = cardRect.left + cardRect.width / 2;
                    const centerY = cardRect.top + cardRect.height / 2;

                    const deltaX = (e.clientX - centerX) / cardRect.width;
                    const deltaY = (e.clientY - centerY) / cardRect.height;

                    const tiltX = deltaY * 2;
                    const tiltY = deltaX * -2;

                    this.style.transform = `translateY(-12px) perspective(1000px) rotateX(${tiltX}deg) rotateY(${tiltY}deg)`;
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) perspective(1000px) rotateX(0) rotateY(0)';
                });
            });
        }
    }

    addRippleEffect() {
        document.querySelectorAll('.btn-donation-cta, .btn-volunteer-cta, .btn-hero-primary').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');

                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    }

    initProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar');

        const progressObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    const progressBar = entry.target;
                    const width = progressBar.style.width || '0%';

                    progressBar.style.width = '0%';
                    setTimeout(() => {
                        progressBar.style.width = width;
                        progressBar.classList.add('animated');
                    }, 200);
                }
            });
        }, { threshold: 0.3 });

        progressBars.forEach(bar => {
            progressObserver.observe(bar);
        });
    }

    initCountdowns() {
        document.querySelectorAll('[data-end-date]').forEach(element => {
            const endDate = new Date(element.getAttribute('data-end-date')).getTime();

            const updateCountdown = () => {
                const now = new Date().getTime();
                const distance = endDate - now;

                if (distance < 0) {
                    element.innerHTML = '<span class="text-danger">Berakhir</span>';
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

                element.innerHTML = `<strong>${days}</strong> hari <strong>${hours}</strong> jam lagi`;
            };

            updateCountdown();
            setInterval(updateCountdown, 60000);
        });
    }

    addParallaxEffect() {
        // Subtle parallax for hero decorations
        const decorations = document.querySelectorAll('.hero-decoration');

        window.addEventListener('scroll', () => {
            const scrollY = window.pageYOffset;

            decorations.forEach((decoration, index) => {
                const speed = 0.5 + (index * 0.1);
                const yPos = -(scrollY * speed);
                decoration.style.transform = `translateY(${yPos}px)`;
            });
        });
    }
}

// ===== CAROUSEL ENHANCEMENTS =====
class CarouselEnhancements {
    constructor() {
        this.init();
    }

    init() {
        this.enhanceHeroCarousel();
        this.enhanceJourneyCarousel();
        this.addTouchSupport();
    }

    enhanceHeroCarousel() {
        const heroCarousel = document.getElementById('heroCarousel');
        if (heroCarousel) {
            const carousel = new bootstrap.Carousel(heroCarousel, {
                interval: 6000,
                wrap: true,
                pause: 'hover'
            });

            // Add keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (document.activeElement === document.body) {
                    if (e.key === 'ArrowLeft') {
                        carousel.prev();
                    } else if (e.key === 'ArrowRight') {
                        carousel.next();
                    }
                }
            });
        }
    }

    enhanceJourneyCarousel() {
        const journeyCarousel = document.querySelector('#journeyCarousel .carousel');
        if (journeyCarousel) {
            const carousel = new bootstrap.Carousel(journeyCarousel, {
                interval: 5000,
                wrap: true,
                pause: 'hover'
            });
        }
    }

    addTouchSupport() {
        // Enhanced touch support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            this.handleGesture();
        });

        this.handleGesture = () => {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                // Swipe left - next slide
                const activeCarousel = document.querySelector('.carousel.slide');
                if (activeCarousel) {
                    const carousel = bootstrap.Carousel.getInstance(activeCarousel);
                    if (carousel) carousel.next();
                }
            }

            if (touchEndX > touchStartX + swipeThreshold) {
                // Swipe right - previous slide
                const activeCarousel = document.querySelector('.carousel.slide');
                if (activeCarousel) {
                    const carousel = bootstrap.Carousel.getInstance(activeCarousel);
                    if (carousel) carousel.prev();
                }
            }
        };
    }
}

// ===== ACCESSIBILITY ENHANCEMENTS =====
class AccessibilityEnhancements {
    constructor() {
        this.init();
    }

    init() {
        this.addFocusManagement();
        this.addKeyboardNavigation();
        this.addAriaLabels();
    }

    addFocusManagement() {
        // Skip to main content link
        const skipLink = document.createElement('a');
        skipLink.href = '#main-content';
        skipLink.className = 'skip-link';
        skipLink.textContent = 'Skip to main content';
        skipLink.style.cssText = `
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--primary);
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 10000;
            transition: top 0.3s ease;
        `;

        skipLink.addEventListener('focus', () => {
            skipLink.style.top = '6px';
        });

        skipLink.addEventListener('blur', () => {
            skipLink.style.top = '-40px';
        });

        document.body.insertBefore(skipLink, document.body.firstChild);

        // Add main content id if not exists
        const mainContent = document.querySelector('main') || document.querySelector('.hero-section');
        if (mainContent && !mainContent.id) {
            mainContent.id = 'main-content';
        }
    }

    addKeyboardNavigation() {
        // Make cards keyboard accessible
        document.querySelectorAll('.donation-card-modern, .volunteer-card-modern').forEach(card => {
            card.setAttribute('tabindex', '0');
            card.setAttribute('role', 'button');

            card.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const link = card.querySelector('.btn-donation-cta, .btn-volunteer-cta');
                    if (link) {
                        link.click();
                    }
                }
            });
        });
    }

    addAriaLabels() {
        // Add aria labels to interactive elements
        document.querySelectorAll('.carousel-control-prev').forEach(el => {
            el.setAttribute('aria-label', 'Previous slide');
        });

        document.querySelectorAll('.carousel-control-next').forEach(el => {
            el.setAttribute('aria-label', 'Next slide');
        });

        document.querySelectorAll('.progress-bar').forEach(el => {
            el.setAttribute('role', 'progressbar');
        });
    }
}

// ===== ERROR HANDLING =====
class ErrorHandler {
    constructor() {
        this.init();
    }

    init() {
        window.addEventListener('error', (e) => {
            console.error('JavaScript Error:', e.error);
            this.handleError(e.error);
        });

        window.addEventListener('unhandledrejection', (e) => {
            console.error('Unhandled Promise Rejection:', e.reason);
        });
    }

    handleError(error) {
        // Ensure critical functionality still works
        if (error.message.includes('AOS')) {
            console.warn('AOS library failed to load, continuing without animations');
        }

        if (error.message.includes('Bootstrap')) {
            console.warn('Bootstrap failed to load, using fallback navigation');
            this.initFallbackNavigation();
        }
    }

    initFallbackNavigation() {
        const toggler = document.querySelector('.navbar-toggler-premium');
        const overlay = document.querySelector('.mobile-menu-overlay');

        if (toggler && overlay) {
            toggler.addEventListener('click', () => {
                overlay.classList.toggle('show');
                toggler.classList.toggle('active');
            });
        }
    }
}

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', function() {
    try {
        // Initialize all systems
        const mobileNav = new MobileNavigation();
        const scrollReveal = new ScrollReveal();
        const counterAnimation = new CounterAnimation();
        const smoothScroll = new SmoothScroll();
        const cardEnhancements = new CardEnhancements();
        const carouselEnhancements = new CarouselEnhancements();
        const accessibilityEnhancements = new AccessibilityEnhancements();
        const errorHandler = new ErrorHandler();

        console.log('✅ All systems initialized successfully!');

        // Add custom styles for enhanced features
        if (!document.getElementById('enhanced-styles')) {
            const style = document.createElement('style');
            style.id = 'enhanced-styles';
            style.textContent = `
                .ripple-effect {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.4);
                    transform: scale(0);
                    animation: ripple-animation 0.6s ease-out;
                    pointer-events: none;
                }

                @keyframes ripple-animation {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }

                .btn-donation-cta,
                .btn-volunteer-cta,
                .btn-hero-primary {
                    position: relative;
                    overflow: hidden;
                }

                .skip-link:focus {
                    top: 6px !important;
                }

                @media (prefers-reduced-motion: reduce) {
                    *, *::before, *::after {
                        animation-duration: 0.01ms !important;
                        animation-iteration-count: 1 !important;
                        transition-duration: 0.01ms !important;
                        scroll-behavior: auto !important;
                    }
                }
            `;
            document.head.appendChild(style);
        }

    } catch (error) {
        console.error('Initialization error:', error);

        // Fallback for basic functionality
        const navbar = document.getElementById('mainNavbar');
        if (navbar) {
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        }

        // Basic mobile navigation fallback
        const toggler = document.querySelector('.navbar-toggler-premium');
        const overlay = document.querySelector('.mobile-menu-overlay');
        if (toggler && overlay) {
            toggler.addEventListener('click', () => {
                overlay.classList.toggle('show');
                toggler.classList.toggle('active');
            });
        }
    }
});

// ===== UTILITY FUNCTIONS =====
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ===== GLOBAL API FOR EXTERNAL USE =====
window.GrahaAlfaAmertha = {
    scrollToSection: function(sectionId) {
        const element = document.querySelector(sectionId);
        if (element) {
            const offset = window.innerWidth <= 991 ? 70 : 85;
            const targetPosition = element.offsetTop - offset;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }
};

// ===== EXPORT FOR TESTING =====
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        MobileNavigation,
        ScrollReveal,
        CounterAnimation,
        CardEnhancements
    };
}