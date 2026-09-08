/**
 * Ceylon Therapist - Navigation & Header Interaction
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
    handleScroll();

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
});
