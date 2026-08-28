<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<!-- =======================================================
     ABOUT US — CEYLON THERAPIST
     Our Story | Philosophy | Sanctuary Space | Trust
     ======================================================= -->

<!-- ===========================
     1. HERO SECTION
     =========================== -->
<section class="ab-hero" id="ab-top" aria-label="About Ceylon Therapist hero section">
    <div class="ab-hero-bg">
        <img src="<?= assetUrl('images/sanctuary_interior.jpg') ?>" alt="Ceylon Therapist luxury wellness interior" class="ab-hero-bg-img">
        <div class="ab-hero-overlay"></div>
        <div class="ab-hero-gold-glow" aria-hidden="true"></div>
    </div>

    <div class="container ab-hero-content">
        <span class="ab-eyebrow">OUR STORY. OUR PROMISE.</span>

        <h1 class="ab-hero-title">
            A Space Built<br>
            Around Calm,<br>
            <span class="gold-gradient-text">Care &amp; Privacy.</span>
        </h1>

        <p class="ab-hero-body">
            Ceylon Therapist was created for those who value comfort, discretion and meaningful time for themselves. Every detail is thoughtfully designed to help you feel relaxed, respected and completely at ease.
        </p>

        <div class="ab-hero-actions">
            <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20book%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="ab-btn-primary" id="hero-about-book">
                <i class="fa-brands fa-whatsapp"></i> BOOK A SESSION
            </a>
            <a href="#about-space" class="ab-btn-secondary" id="hero-about-space">
                DISCOVER OUR SPACE
            </a>
        </div>

        <!-- Floating accent badge -->
        <div class="ab-hero-accent-badge" aria-hidden="true">
            <i class="fa-solid fa-leaf gold-icon"></i>
            <span>Dedicated to Discretion &amp; Well-being</span>
        </div>
    </div>
</section>

<!-- ===========================
     2. OUR STORY SECTION
     =========================== -->
<section class="section-padding ab-story-section" id="about-story" aria-label="Our Story and heritage">
    <div class="container ab-story-grid">

        <!-- Left Image -->
        <div class="ab-story-img-col">
            <div class="ab-story-img-box">
                <img src="<?= assetUrl('images/treatment_essential.jpg') ?>" alt="Professional wellness therapist providing restorative care" class="ab-story-img">
                <div class="ab-story-img-overlay"></div>
                <div class="ab-story-badge">
                    <i class="fa-solid fa-shield-halved gold-icon"></i>
                    <span>Certified &bull; 100% Private</span>
                </div>
            </div>
        </div>

        <!-- Right Story Content -->
        <div class="ab-story-text-col">
            <span class="section-eyebrow">OUR STORY</span>
            <h2 class="ab-story-title">
                More Than a Service.<br>
                <span class="gold-gradient-text">It’s Your Time to Reset.</span>
            </h2>

            <div class="ab-story-paragraphs">
                <p>
                    Ceylon Therapist was created around a simple belief: meaningful relaxation begins when you feel comfortable, respected and understood.
                </p>
                <p>
                    We combine thoughtful wellness experiences, a calm private setting and personal attention to create moments that help you slow down, release tension and restore balance.
                </p>
                <p>
                    Every visit is designed to feel unhurried, discreet and centered around you.
                </p>
            </div>

            <div class="ab-story-trust-grid">
                <div class="ab-story-trust-item">
                    <i class="fa-solid fa-compass-drafting gold-icon"></i>
                    <span>Thoughtfully Designed</span>
                </div>
                <div class="ab-story-trust-item">
                    <i class="fa-solid fa-lock gold-icon"></i>
                    <span>100% Private &amp; Discreet</span>
                </div>
                <div class="ab-story-trust-item">
                    <i class="fa-solid fa-user-check gold-icon"></i>
                    <span>Professional Care</span>
                </div>
                <div class="ab-story-trust-item">
                    <i class="fa-solid fa-gem gold-icon"></i>
                    <span>Premium Experiences</span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ===========================
     3. PHILOSOPHY SECTION
     =========================== -->
<section class="section-padding ab-philosophy-section" aria-label="Our Philosophy and pillars">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-eyebrow">OUR PHILOSOPHY</span>
            <h2 class="section-title">The Four Pillars of <span class="gold-gradient-text">Ceylon Therapist</span></h2>
            <div class="gold-line-divider"></div>
        </div>

        <div class="ab-philosophy-grid">

            <!-- Pillar 1 -->
            <article class="ab-pillar-card">
                <div class="ab-pillar-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-user"></i>
                </div>
                <h3 class="ab-pillar-title">Presence</h3>
                <p class="ab-pillar-desc">We give you our full attention so every experience feels calm, considered and unhurried.</p>
            </article>

            <!-- Pillar 2 -->
            <article class="ab-pillar-card">
                <div class="ab-pillar-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h3 class="ab-pillar-title">Personalization</h3>
                <p class="ab-pillar-desc">Every session is adapted to your preferred experience, comfort level and individual needs.</p>
            </article>

            <!-- Pillar 3 -->
            <article class="ab-pillar-card">
                <div class="ab-pillar-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h3 class="ab-pillar-title">Privacy</h3>
                <p class="ab-pillar-desc">Your time, your space and your experience are handled with discretion from beginning to end.</p>
            </article>

            <!-- Pillar 4 -->
            <article class="ab-pillar-card">
                <div class="ab-pillar-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h3 class="ab-pillar-title">Balance</h3>
                <p class="ab-pillar-desc">Our experiences are designed to help restore calm between body, mind and everyday life.</p>
            </article>

        </div><!-- /ab-philosophy-grid -->

    </div>
</section>

<!-- ===========================
     4. OUR SPACE GALLERY SECTION
     =========================== -->
<section class="section-padding ab-space-section" id="about-space" aria-label="Our sanctuary space gallery">
    <div class="container ab-space-grid">

        <!-- Left Text -->
        <div class="ab-space-text">
            <span class="section-eyebrow">OUR SPACE</span>
            <h2 class="ab-space-title">
                Designed for<br>
                <span class="gold-gradient-text">Deep Relaxation.</span>
            </h2>
            <p class="ab-space-desc">
                Every corner of our space is prepared to help you slow down, feel comfortable and enjoy your time in complete calm.
            </p>
            <div class="ab-space-features">
                <div class="ab-space-feature-item">
                    <i class="fa-solid fa-circle-check gold-icon"></i>
                    <span>Private therapy rooms with warm acoustic design</span>
                </div>
                <div class="ab-space-feature-item">
                    <i class="fa-solid fa-circle-check gold-icon"></i>
                    <span>Subtle amber candlelight &amp; botanical scents</span>
                </div>
                <div class="ab-space-feature-item">
                    <i class="fa-solid fa-circle-check gold-icon"></i>
                    <span>Dedicated couples &amp; personal treatment suites</span>
                </div>
            </div>
            <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20take%20a%20tour%20and%20explore%20your%20space." target="_blank" rel="noopener noreferrer" class="btn-gold-outline-lg">
                TAKE A TOUR OF OUR SPACE <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>

        <!-- Right 4-Image Grid -->
        <div class="ab-gallery-grid">
            <div class="ab-gallery-item">
                <img src="<?= assetUrl('images/sanctuary_interior.jpg') ?>" alt="Private therapy room interior with warm lighting" class="ab-gallery-img">
                <div class="ab-gallery-overlay"><span>Private Treatment Room</span></div>
            </div>
            <div class="ab-gallery-item">
                <img src="<?= assetUrl('images/for_her_banner.jpg') ?>" alt="Relaxation lounge and dedicated wellness suite" class="ab-gallery-img">
                <div class="ab-gallery-overlay"><span>Relaxation Suite</span></div>
            </div>
            <div class="ab-gallery-item">
                <img src="<?= assetUrl('images/couples_banner.jpg') ?>" alt="Couples shared wellness sanctuary" class="ab-gallery-img">
                <div class="ab-gallery-overlay"><span>Couples Sanctuary</span></div>
            </div>
            <div class="ab-gallery-item">
                <img src="<?= assetUrl('images/treatment_signature.jpg') ?>" alt="Aromatherapy oils and botanical care details" class="ab-gallery-img">
                <div class="ab-gallery-overlay"><span>Holistic Care Details</span></div>
            </div>
        </div>

    </div>
</section>

<!-- ===========================
     5. WHY CLIENTS TRUST US SECTION
     =========================== -->
<section class="section-padding ab-trust-section" aria-label="Why clients trust Ceylon Therapist">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-eyebrow">WHY CLIENTS TRUST CEYLON THERAPIST</span>
            <h2 class="section-title">Discretion. Quality. <span class="gold-gradient-text">Care.</span></h2>
            <div class="gold-line-divider"></div>
        </div>

        <div class="ab-trust-grid">

            <!-- Item 1 -->
            <div class="ab-trust-item">
                <div class="ab-trust-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4 class="ab-trust-title">100% Private Environment</h4>
                <p class="ab-trust-desc">A calm, discreet setting prepared with your comfort and privacy in mind.</p>
            </div>

            <!-- Item 2 -->
            <div class="ab-trust-item">
                <div class="ab-trust-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-award"></i>
                </div>
                <h4 class="ab-trust-title">Professional Care</h4>
                <p class="ab-trust-desc">Every session is handled with attention, respect and a focus on your well-being.</p>
            </div>

            <!-- Item 3 -->
            <div class="ab-trust-item">
                <div class="ab-trust-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h4 class="ab-trust-title">Personalized Approach</h4>
                <p class="ab-trust-desc">Your experience can be selected based on your preferred style, duration and level of relaxation.</p>
            </div>

            <!-- Item 4 -->
            <div class="ab-trust-item">
                <div class="ab-trust-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h4 class="ab-trust-title">Premium Products &amp; Techniques</h4>
                <p class="ab-trust-desc">Carefully selected products and wellness techniques support a refined, high-quality experience.</p>
            </div>

            <!-- Item 5 -->
            <div class="ab-trust-item">
                <div class="ab-trust-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h4 class="ab-trust-title">Easy &amp; Discreet Booking</h4>
                <p class="ab-trust-desc">Choose your experience and continue privately through WhatsApp for quick communication.</p>
            </div>

        </div><!-- /ab-trust-grid -->

    </div>
</section>

<!-- ===========================
     6. BRAND PROMISE SECTION
     =========================== -->
<section class="ab-promise-section" aria-label="Our brand promise">
    <div class="container text-center ab-promise-inner">
        <span class="section-eyebrow">OUR PROMISE</span>
        <h2 class="ab-promise-title">Your Comfort Comes First.</h2>
        <p class="ab-promise-desc">
            From your first message to the moment your session ends, every part of the experience is designed to feel calm, respectful and effortless.
        </p>
    </div>
</section>

<!-- ===========================
     7. FINAL CTA SECTION
     =========================== -->
<section class="ab-final-cta-section" id="ab-book" aria-label="Book a private session">
    <div class="ab-final-cta-grid">

        <!-- Left: Text -->
        <div class="ab-final-cta-text-col">
            <div class="ab-final-cta-text-inner">
                <span class="section-eyebrow">YOUR TIME. YOUR ESCAPE.</span>
                <h2 class="ab-final-cta-title">
                    Reserved for <span class="gold-gradient-text">You.</span>
                </h2>
                <p class="ab-final-cta-desc">
                    Step into a world of calm, care and complete privacy. Choose your preferred experience and contact us when you are ready.
                </p>
                <div class="ab-final-cta-actions">
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20book%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-whatsapp-large" id="ab-final-whatsapp-btn">
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> BOOK A SESSION
                    </a>
                    <a href="<?= baseUrl('contact.php') ?>" class="btn-hero-primary" id="ab-final-contact-btn">
                        CONTACT US
                    </a>
                </div>
                <p class="ab-final-cta-meta"><i class="fa-solid fa-lock gold-icon"></i> Private &bull; Discreet &bull; Easy Booking</p>
            </div>
        </div>

        <!-- Right: Image -->
        <div class="ab-final-cta-img-col" aria-hidden="true">
            <img src="<?= assetUrl('images/sanctuary_interior.jpg') ?>" alt="Private treatment room at Ceylon Therapist" class="ab-final-cta-img">
            <div class="ab-final-cta-img-overlay"></div>
        </div>

    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
