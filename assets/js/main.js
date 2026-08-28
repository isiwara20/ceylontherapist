/**
 * Ceylon Therapist - Main Interactive Scripts
 * Pure Vanilla JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Sticky Header Glass Effect on Scroll
    const header = document.getElementById('site-header');
    
    const handleScroll = () => {
        if (window.scrollY > 40) {
            header?.classList.add('scrolled');
        } else {
            header?.classList.remove('scrolled');
        }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll(); // Initial check

    // 2. Mobile Menu Toggle
    const mobileToggle = document.getElementById('mobile-toggle');
    const publicNav = document.getElementById('public-nav');

    if (mobileToggle && publicNav) {
        mobileToggle.addEventListener('click', () => {
            mobileToggle.classList.toggle('active');
            publicNav.classList.toggle('active');
            document.body.classList.toggle('nav-open');
        });

        // Close mobile nav when clicking a nav link
        const navLinks = publicNav.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileToggle.classList.remove('active');
                publicNav.classList.remove('active');
                document.body.classList.remove('nav-open');
            });
        });
    }

    // 3. Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    const headerOffset = 90;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // 4. Subtle Scroll Reveal Observer
    const revealElements = document.querySelectorAll(
        '.experience-card, .feature-card, .step-card, .testimonial-card, ' +
        '.sanctuary-grid, .for-her-grid, .couples-grid, ' +
        '.fh-card, .fh-benefit-item, .fh-testimonial-grid, .fh-booking-grid, ' +
        '.treatment-card, .fh-trust-strip, ' +
        '.cp-card, .cp-moment-item, .cp-sanctuary-grid, .cp-trust-card, .cp-booking-panel, ' +
        '.ab-story-grid, .ab-pillar-card, .ab-gallery-item, .ab-trust-item, .ab-promise-inner, .ab-final-cta-grid, ' +
        '.ct-step-card, .ct-form-card, .ct-info-card, .ct-map-card, .ct-email-card, .ct-trust-item, .ct-closing-strip'
    );




    
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(25px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            revealObserver.observe(el);
        });
    }
});
