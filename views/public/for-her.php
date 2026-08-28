<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<!-- =======================================================
     FOR HER — CEYLON THERAPIST
     Private Wellness | Feminine | Luxury | Dark Candlelit
     ======================================================= -->

<!-- ===========================
     1. HERO SECTION
     =========================== -->
<section class="fh-hero" id="fh-top" aria-label="For Her hero section">
    <div class="fh-hero-bg">
        <img src="<?= assetUrl('images/for_her_banner.jpg') ?>" alt="Private luxury wellness space for her" class="fh-hero-bg-img">
        <div class="fh-hero-overlay"></div>
        <div class="fh-hero-burgundy-glow" aria-hidden="true"></div>
    </div>

    <div class="container fh-hero-content">
        <span class="fh-eyebrow">GENTLE. PRIVATE. MADE FOR YOU.</span>

        <h1 class="fh-hero-title">
            A Private Wellness<br>
            Experience<br>
            <span class="burgundy-gold-text">Designed for Her.</span>
        </h1>

        <p class="fh-hero-body">
            Step into a space of comfort and calm, designed to support your body, mind and spirit. Every session is tailored to you — your needs, your pace, your peace.
        </p>

        <div class="fh-hero-actions">
            <a href="#fh-treatments" class="fh-btn-primary" id="hero-explore-treatments">
                EXPLORE TREATMENTS
            </a>
            <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20book%20a%20For%20Her%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="fh-btn-secondary" id="hero-book-session">
                <i class="fa-brands fa-whatsapp"></i> BOOK A SESSION
            </a>
        </div>

        <!-- Floating accent badge -->
        <div class="fh-hero-accent-badge" aria-hidden="true">
            <i class="fa-solid fa-leaf gold-icon"></i>
            <span>Your Private Sanctuary</span>
        </div>
    </div>
</section>

<!-- ===========================
     2. FEATURED TREATMENT CARDS
     =========================== -->
<section class="section-padding fh-treatment-section" id="fh-treatments" aria-label="Featured experiences for her">
    <div class="container">

        <div class="section-header text-center fh-section-header">
            <span class="section-eyebrow fh-eyebrow-rose"><i class="fa-solid fa-heart fh-eyebrow-icon"></i> EXPERIENCES FOR HER</span>
            <h2 class="section-title">Choose Your Moment of Calm</h2>
            <p class="section-subtitle">Each experience is thoughtfully prepared to help you slow down, feel completely cared for and leave feeling renewed.</p>
            <div class="gold-line-divider"></div>
        </div>

        <div class="fh-cards-grid">

            <!-- Card 1 — Relax & Reset -->
            <article class="fh-card" id="fh-card-relax">
                <div class="fh-card-img-box">
                    <img src="<?= assetUrl('images/treatment_essential.jpg') ?>" alt="Relax and Reset massage treatment" class="fh-card-img">
                    <div class="fh-card-img-overlay"></div>
                    <div class="fh-card-duration-tag">
                        <i class="fa-regular fa-clock"></i> 60 Min
                    </div>
                </div>
                <div class="fh-card-body">
                    <div class="fh-card-icon-wrap" aria-hidden="true">
                        <i class="fa-solid fa-wind"></i>
                    </div>
                    <h3 class="fh-card-title">Relax &amp; Reset</h3>
                    <p class="fh-card-desc">A tension-relieving massage designed to melt away stress and help you unwind deeply.</p>
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20book%20the%20Relax%20and%20Reset%20treatment%20(60%20min)." target="_blank" rel="noopener noreferrer" class="fh-card-btn">
                        LEARN MORE <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>

            <!-- Card 2 — Aromatherapy Escape -->
            <article class="fh-card" id="fh-card-aroma">
                <div class="fh-card-img-box">
                    <img src="<?= assetUrl('images/for_her_banner.jpg') ?>" alt="Aromatherapy escape with essential oils" class="fh-card-img">
                    <div class="fh-card-img-overlay"></div>
                    <div class="fh-card-duration-tag">
                        <i class="fa-regular fa-clock"></i> 90 Min
                    </div>
                </div>
                <div class="fh-card-body">
                    <div class="fh-card-icon-wrap" aria-hidden="true">
                        <i class="fa-solid fa-droplet"></i>
                    </div>
                    <h3 class="fh-card-title">Aromatherapy Escape</h3>
                    <p class="fh-card-desc">Calming essential oils combined with flowing massage techniques to soothe your body and mind.</p>
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20book%20the%20Aromatherapy%20Escape%20treatment%20(90%20min)." target="_blank" rel="noopener noreferrer" class="fh-card-btn">
                        LEARN MORE <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>

            <!-- Card 3 — Glow & Restore -->
            <article class="fh-card" id="fh-card-glow">
                <div class="fh-card-img-box">
                    <img src="<?= assetUrl('images/treatment_signature.jpg') ?>" alt="Glow and restore revitalizing treatment" class="fh-card-img">
                    <div class="fh-card-img-overlay"></div>
                    <div class="fh-card-duration-tag">
                        <i class="fa-regular fa-clock"></i> 90 Min
                    </div>
                </div>
                <div class="fh-card-body">
                    <div class="fh-card-icon-wrap" aria-hidden="true">
                        <i class="fa-solid fa-gem"></i>
                    </div>
                    <h3 class="fh-card-title">Glow &amp; Restore</h3>
                    <p class="fh-card-desc">Revitalizing care that nourishes your skin, relaxes your muscles and brings back your natural glow.</p>
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20book%20the%20Glow%20and%20Restore%20treatment%20(90%20min)." target="_blank" rel="noopener noreferrer" class="fh-card-btn">
                        LEARN MORE <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>

            <!-- Card 4 — Mindful Calm Session -->
            <article class="fh-card" id="fh-card-mindful">
                <div class="fh-card-img-box">
                    <img src="<?= assetUrl('images/sanctuary_interior.jpg') ?>" alt="Mindful calm full body session" class="fh-card-img">
                    <div class="fh-card-img-overlay"></div>
                    <div class="fh-card-duration-tag">
                        <i class="fa-regular fa-clock"></i> 120 Min
                    </div>
                </div>
                <div class="fh-card-body">
                    <div class="fh-card-icon-wrap" aria-hidden="true">
                        <i class="fa-solid fa-moon"></i>
                    </div>
                    <h3 class="fh-card-title">Mindful Calm Session</h3>
                    <p class="fh-card-desc">A gentle full-body experience focused on mental clarity, emotional balance and deep rest.</p>
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20book%20the%20Mindful%20Calm%20Session%20(120%20min)." target="_blank" rel="noopener noreferrer" class="fh-card-btn">
                        LEARN MORE <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>

        </div><!-- /fh-cards-grid -->

        <!-- Dynamic DB-driven services (shown if admin has added For Her services) -->
        <?php if (!empty($services)): ?>
        <div class="fh-db-section">
            <div class="section-header text-center" style="margin-bottom:40px;">
                <span class="section-eyebrow fh-eyebrow-rose">CURRENTLY AVAILABLE</span>
                <h2 class="section-title fh-db-heading">Book a Session Now</h2>
                <div class="gold-line-divider"></div>
            </div>
            <div class="fh-services-list" role="list">
                <?php foreach ($services as $service):
                    $waMsg = urlencode('Hello Ceylon Therapist, I would like to book the ' . $service['name'] . ' (' . $service['duration_minutes'] . ' min) For Her session.');
                    $waLink = 'https://wa.me/' . DEFAULT_WHATSAPP_NUMBER . '?text=' . $waMsg;
                ?>
                <div class="fh-service-row" role="listitem">
                    <div class="fh-service-info">
                        <h4 class="fh-service-name"><?= e($service['name']) ?></h4>
                        <p class="fh-service-desc"><?= e($service['short_description'] ?? $service['description'] ?? '') ?></p>
                    </div>
                    <div class="fh-service-meta">
                        <span class="fh-service-duration">
                            <i class="fa-regular fa-clock gold-icon"></i> <?= e($service['duration_minutes']) ?> Min
                        </span>
                    </div>
                    <a href="<?= $waLink ?>" target="_blank" rel="noopener noreferrer" class="btn-burgundy-gold">
                        <i class="fa-brands fa-whatsapp"></i> Book
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- ===========================
     3. WHY WOMEN CHOOSE CEYLON THERAPIST
     =========================== -->
<section class="section-padding fh-benefits-section" aria-label="Why women choose Ceylon Therapist">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-eyebrow fh-eyebrow-rose">WHY WOMEN CHOOSE CEYLON THERAPIST</span>
            <h2 class="section-title">Your Comfort. Your Time. <span class="burgundy-gold-text">Your Space.</span></h2>
            <div class="gold-line-divider"></div>
        </div>

        <div class="fh-benefits-grid">

            <div class="fh-benefit-item">
                <div class="fh-benefit-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h4 class="fh-benefit-title">Total Comfort</h4>
                <p class="fh-benefit-desc">A space designed to help you feel safe, relaxed and completely at ease from the moment you arrive.</p>
            </div>

            <div class="fh-benefit-item">
                <div class="fh-benefit-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h4 class="fh-benefit-title">Complete Privacy</h4>
                <p class="fh-benefit-desc">Your session is always private, discreet and fully confidential — handled with the utmost care.</p>
            </div>

            <div class="fh-benefit-item">
                <div class="fh-benefit-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-user"></i>
                </div>
                <h4 class="fh-benefit-title">Personalized Care</h4>
                <p class="fh-benefit-desc">Every treatment is tailored to your individual needs, preferences and comfort level.</p>
            </div>

            <div class="fh-benefit-item">
                <div class="fh-benefit-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h4 class="fh-benefit-title">Stress Relief</h4>
                <p class="fh-benefit-desc">Let go of everyday tension and return to a state of deep calm and clarity.</p>
            </div>

            <div class="fh-benefit-item">
                <div class="fh-benefit-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-fire-flame-simple"></i>
                </div>
                <h4 class="fh-benefit-title">Peaceful Atmosphere</h4>
                <p class="fh-benefit-desc">A soothing environment with soft lighting, warm aromas and tranquil sensory details.</p>
            </div>

        </div><!-- /fh-benefits-grid -->

    </div>
</section>

<!-- ===========================
     4. TESTIMONIAL SECTION
     =========================== -->
<section class="section-padding fh-testimonial-section" aria-label="Client testimonials">
    <div class="container fh-testimonial-grid">

        <!-- Left: Lifestyle Image -->
        <div class="fh-testimonial-img-box">
            <img src="<?= assetUrl('images/for_her_banner.jpg') ?>" alt="Woman relaxing in a private wellness environment" class="fh-testimonial-img">
            <div class="fh-testimonial-img-overlay"></div>
            <div class="fh-testimonial-img-badge" aria-label="Verified client">
                <i class="fa-solid fa-shield-halved gold-icon"></i>
                <span>Verified Clients</span>
            </div>
        </div>

        <!-- Right: Testimonial Content -->
        <div class="fh-testimonial-content">
            <span class="section-eyebrow fh-eyebrow-rose">CLIENT REFLECTIONS</span>

            <div class="fh-stars" aria-label="5 star rating">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
            </div>

            <blockquote class="fh-testimonial-quote">
                &ldquo;Ceylon Therapist is my sanctuary. Every visit helps me reset, relax and feel completely taken care of. It&rsquo;s the one place where I can truly let go.&rdquo;
            </blockquote>

            <div class="fh-testimonial-author">
                <div class="fh-author-avatar" aria-hidden="true">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="fh-author-info">
                    <p class="fh-author-label">Verified Client</p>
                    <p class="fh-author-tag">Private For Her Wellness Session</p>
                </div>
            </div>

            <!-- Secondary mini testimonials -->
            <div class="fh-mini-testimonials">
                <div class="fh-mini-card">
                    <div class="fh-stars fh-stars-sm" aria-label="5 stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="fh-mini-quote">&ldquo;A beautiful, calm experience from start to finish. So private and professional. I return every month.&rdquo;</p>
                    <span class="fh-mini-author">— Verified Client</span>
                </div>
                <div class="fh-mini-card">
                    <div class="fh-stars fh-stars-sm" aria-label="5 stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="fh-mini-quote">&ldquo;The level of care and attention here is unlike anything I&rsquo;ve experienced. Truly restorative.&rdquo;</p>
                    <span class="fh-mini-author">— Verified Client</span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ===========================
     5. BOOKING CTA SECTION
     =========================== -->
<section class="fh-booking-section" id="fh-book" aria-label="Book a private session">
    <div class="fh-booking-grid">

        <!-- Left: Text -->
        <div class="fh-booking-text-col">
            <div class="fh-booking-text-inner">
                <span class="section-eyebrow fh-eyebrow-rose">YOUR MOMENT STARTS HERE</span>
                <h2 class="fh-booking-title">
                    Book Your<br>
                    <span class="gold-gradient-text">Private Session.</span>
                </h2>
                <p class="fh-booking-desc">Experience tailored care in a private, beautifully prepared space — designed just for you. Reach us discreetly via WhatsApp for complete privacy.</p>
                <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20book%20a%20For%20Her%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="fh-booking-btn" id="booking-cta-btn">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> BOOK YOUR SESSION
                </a>
                <p class="fh-booking-meta">Private &bull; Discreet &bull; Beautifully Prepared</p>
            </div>
        </div>

        <!-- Right: Image -->
        <div class="fh-booking-image-col" aria-hidden="true">
            <img src="<?= assetUrl('images/sanctuary_interior.jpg') ?>" alt="Private treatment room interior" class="fh-booking-img">
            <div class="fh-booking-img-overlay"></div>
        </div>

    </div>
</section>

<!-- ===========================
     6. BOTTOM TRUST STRIP
     =========================== -->
<div class="fh-trust-strip" role="list" aria-label="Trust indicators">
    <div class="container fh-trust-grid">

        <div class="fh-trust-item" role="listitem">
            <i class="fa-solid fa-user-check fh-trust-icon" aria-hidden="true"></i>
            <span>Professional Care</span>
        </div>

        <div class="fh-trust-item" role="listitem">
            <i class="fa-solid fa-door-closed fh-trust-icon" aria-hidden="true"></i>
            <span>Private Rooms</span>
        </div>

        <div class="fh-trust-item" role="listitem">
            <i class="fa-solid fa-sliders fh-trust-icon" aria-hidden="true"></i>
            <span>Personalized Experience</span>
        </div>

        <div class="fh-trust-item" role="listitem">
            <i class="fa-solid fa-leaf fh-trust-icon" aria-hidden="true"></i>
            <span>Holistic Wellness</span>
        </div>

        <div class="fh-trust-item" role="listitem">
            <i class="fa-solid fa-calendar-check fh-trust-icon" aria-hidden="true"></i>
            <span>Flexible Booking</span>
        </div>

    </div>
</div>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
