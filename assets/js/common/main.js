/**
 * Ceylon Therapist - Shared Interactive Utilities
 * Pure Vanilla JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Smooth Scroll for Anchor Links
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

    // 2. Subtle Scroll Reveal Observer
    const revealElements = document.querySelectorAll(
        '.experience-card, .feature-card, .step-card, .testimonial-card, ' +
        '.sanctuary-grid, .for-her-grid, .couples-grid, ' +
        '.fh-card, .fh-benefit-item, .fh-testimonial-grid, .fh-booking-grid, ' +
        '.treatment-card, .fh-trust-strip, ' +
        '.cp-card, .cp-moment-item, .cp-sanctuary-grid, .cp-trust-card, .cp-booking-panel, ' +
        '.ab-story-grid, .ab-pillar-card, .ab-gallery-item, .ab-trust-item, .ab-promise-inner, .ab-final-cta-grid, ' +
        '.ct-step-card, .ct-form-card, .ct-info-card, .ct-map-card, .ct-email-card, .ct-trust-item, .ct-closing-strip, ' +
        '.package-card, .package-detail-card'
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
