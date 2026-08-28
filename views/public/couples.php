<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<!-- =======================================================
     COUPLES — CEYLON THERAPIST
     Luxury Shared Wellness | Intimate | Dark Candlelit | Gold
     ======================================================= -->

<!-- ===========================
     1. COUPLES HERO SECTION
     =========================== -->
<section class="cp-hero" id="cp-top" aria-label="Couples wellness hero section">
    <div class="cp-hero-bg">
        <img src="<?= assetUrl('images/couples_banner.jpg') ?>" alt="Private luxury side-by-side couples wellness suite" class="cp-hero-bg-img">
        <div class="cp-hero-overlay"></div>
        <div class="cp-hero-gold-glow" aria-hidden="true"></div>
    </div>

    <div class="container cp-hero-content">
        <span class="cp-eyebrow">PRIVATE. CONNECTED. UNFORGETTABLE.</span>

        <h1 class="cp-hero-title">
            Shared Calm.<br>
            A Premium<br>
            <span class="gold-gradient-text">Experience for Two.</span>
        </h1>

        <p class="cp-hero-body">
            Relax together, reconnect deeply and enjoy meaningful time in a private setting designed for two. Thoughtful therapies, a calm atmosphere and complete comfort from beginning to end.
        </p>

        <div class="cp-hero-actions">
            <a href="#cp-experiences" class="cp-btn-primary" id="hero-explore-couples">
                EXPLORE COUPLES PACKAGES
            </a>
            <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20Couples%20wellness%20experience." target="_blank" rel="noopener noreferrer" class="cp-btn-secondary" id="hero-reserve-couples">
                <i class="fa-brands fa-whatsapp"></i> RESERVE PRIVATELY
            </a>
        </div>

        <!-- Floating accent badge -->
        <div class="cp-hero-accent-badge" aria-hidden="true">
            <i class="fa-solid fa-heart gold-icon"></i>
            <span>Curated Moments for Two</span>
        </div>
    </div>
</section>

<!-- ===========================
     2. COUPLES EXPERIENCES SECTION
     =========================== -->
<section class="section-padding cp-experiences-section" id="cp-experiences" aria-label="Couples shared experiences">
    <div class="container">

        <div class="section-header text-center cp-section-header">
            <span class="section-eyebrow"><i class="fa-solid fa-sparkles gold-icon-sm"></i> OUR COUPLES EXPERIENCES</span>
            <h2 class="section-title">Choose Your Shared Escape</h2>
            <p class="section-subtitle">Thoughtfully designed experiences for relaxation, connection and meaningful time together.</p>
            <div class="gold-line-divider"></div>
        </div>

        <div class="cp-cards-grid">

            <!-- Card 1 — Side-by-Side Massage -->
            <article class="cp-card" id="cp-card-side-by-side">
                <div class="cp-card-img-box">
                    <img src="<?= assetUrl('images/couples_banner.jpg') ?>" alt="Side-by-side synchronized massage for couples" class="cp-card-img">
                    <div class="cp-card-img-overlay"></div>
                    <div class="cp-card-duration-tag">
                        <i class="fa-regular fa-clock"></i> 60 MINUTES
                    </div>
                </div>
                <div class="cp-card-body">
                    <div class="cp-card-icon-wrap" aria-hidden="true">
                        <i class="fa-solid fa-spa"></i>
                    </div>
                    <h3 class="cp-card-title">Side-by-Side Massage</h3>
                    <p class="cp-card-desc">Relax together with synchronized massage techniques designed to melt away stress and restore balance for both of you.</p>
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20view%20details%20and%20book%20the%20Side-by-Side%20Massage%20(60%20min)%20Couples%20experience." target="_blank" rel="noopener noreferrer" class="cp-card-btn">
                        VIEW DETAILS <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>

            <!-- Card 2 — Romantic Reset -->
            <article class="cp-card" id="cp-card-romantic-reset">
                <div class="cp-card-img-box">
                    <img src="<?= assetUrl('images/sanctuary_interior.jpg') ?>" alt="Romantic reset shared wellness therapy" class="cp-card-img">
                    <div class="cp-card-img-overlay"></div>
                    <div class="cp-card-duration-tag">
                        <i class="fa-regular fa-clock"></i> 90 MINUTES
                    </div>
                </div>
                <div class="cp-card-body">
                    <div class="cp-card-icon-wrap" aria-hidden="true">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <h3 class="cp-card-title">Romantic Reset</h3>
                    <p class="cp-card-desc">A calming full-body experience followed by a soothing shared ritual designed to help you slow down, reconnect and enjoy the moment.</p>
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20view%20details%20and%20book%20the%20Romantic%20Reset%20(90%20min)%20Couples%20experience." target="_blank" rel="noopener noreferrer" class="cp-card-btn">
                        VIEW DETAILS <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>

            <!-- Card 3 — Celebration Ritual -->
            <article class="cp-card" id="cp-card-celebration-ritual">
                <div class="cp-card-img-box">
                    <img src="<?= assetUrl('images/treatment_signature.jpg') ?>" alt="Celebration ritual for couples special moments" class="cp-card-img">
                    <div class="cp-card-img-overlay"></div>
                    <div class="cp-card-duration-tag">
                        <i class="fa-regular fa-clock"></i> 120 MINUTES
                    </div>
                </div>
                <div class="cp-card-body">
                    <div class="cp-card-icon-wrap" aria-hidden="true">
                        <i class="fa-solid fa-champagne-glasses"></i>
                    </div>
                    <h3 class="cp-card-title">Celebration Ritual</h3>
                    <p class="cp-card-desc">Celebrate meaningful moments with a luxurious therapy experience and carefully prepared touches for two.</p>
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20view%20details%20and%20book%20the%20Celebration%20Ritual%20(120%20min)%20Couples%20experience." target="_blank" rel="noopener noreferrer" class="cp-card-btn">
                        VIEW DETAILS <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>

            <!-- Card 4 — Weekend Escape -->
            <article class="cp-card" id="cp-card-weekend-escape">
                <div class="cp-card-img-box">
                    <img src="<?= assetUrl('images/hero_bg.jpg') ?>" alt="Weekend escape luxury couples wellness sanctuary" class="cp-card-img">
                    <div class="cp-card-img-overlay"></div>
                    <div class="cp-card-duration-tag">
                        <i class="fa-regular fa-clock"></i> 150 MINUTES
                    </div>
                </div>
                <div class="cp-card-body">
                    <div class="cp-card-icon-wrap" aria-hidden="true">
                        <i class="fa-solid fa-moon"></i>
                    </div>
                    <h3 class="cp-card-title">Weekend Escape</h3>
                    <p class="cp-card-desc">A deeply restorative experience created for couples who want to unwind, slow down and reconnect away from everyday distractions.</p>
                    <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20view%20details%20and%20book%20the%20Weekend%20Escape%20(150%20min)%20Couples%20experience." target="_blank" rel="noopener noreferrer" class="cp-card-btn">
                        VIEW DETAILS <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </article>

        </div><!-- /cp-cards-grid -->

        <!-- Dynamic DB-driven services (if admin has added specific couples records) -->
        <?php if (!empty($services)): ?>
        <div class="cp-db-section">
            <div class="section-header text-center" style="margin-bottom:40px;">
                <span class="section-eyebrow">ADDITIONAL PACKAGES</span>
                <h2 class="section-title cp-db-heading">More Shared Experiences</h2>
                <div class="gold-line-divider"></div>
            </div>
            <div class="cp-services-list" role="list">
                <?php foreach ($services as $service):
                    $waMsg = urlencode('Hello Ceylon Therapist, I would like to book the ' . $service['name'] . ' (' . $service['duration_minutes'] . ' min) Couples experience.');
                    $waLink = 'https://wa.me/' . DEFAULT_WHATSAPP_NUMBER . '?text=' . $waMsg;
                ?>
                <div class="cp-service-row" role="listitem">
                    <div class="cp-service-info">
                        <h4 class="cp-service-name"><?= e($service['name']) ?></h4>
                        <p class="cp-service-desc"><?= e($service['short_description'] ?? $service['description'] ?? '') ?></p>
                    </div>
                    <div class="cp-service-meta">
                        <span class="cp-service-duration">
                            <i class="fa-regular fa-clock gold-icon"></i> <?= e($service['duration_minutes']) ?> Min
                        </span>
                    </div>
                    <a href="<?= $waLink ?>" target="_blank" rel="noopener noreferrer" class="btn-hero-secondary">
                        <i class="fa-brands fa-whatsapp"></i> Reserve
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- ===========================
     3. SPECIAL MOMENTS SECTION
     =========================== -->
<section class="section-padding cp-moments-section" aria-label="Special moments for couples">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-eyebrow">PERFECT FOR SPECIAL MOMENTS</span>
            <h2 class="section-title">Moments You’ll Treasure <span class="gold-gradient-text">Together</span></h2>
            <div class="gold-line-divider"></div>
        </div>

        <div class="cp-moments-grid">

            <div class="cp-moment-item">
                <div class="cp-moment-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h4 class="cp-moment-title">Anniversaries</h4>
                <p class="cp-moment-desc">Celebrate your journey together with a private wellness experience that feels truly special.</p>
            </div>

            <div class="cp-moment-item">
                <div class="cp-moment-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-link"></i>
                </div>
                <h4 class="cp-moment-title">Reconnection</h4>
                <p class="cp-moment-desc">Step away from everyday life, slow down and rediscover time for one another.</p>
            </div>

            <div class="cp-moment-item">
                <div class="cp-moment-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h4 class="cp-moment-title">Relaxation</h4>
                <p class="cp-moment-desc">Unwind together and release the tension you have both been carrying.</p>
            </div>

            <div class="cp-moment-item">
                <div class="cp-moment-icon-box" aria-hidden="true">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <h4 class="cp-moment-title">Quality Time</h4>
                <p class="cp-moment-desc">Disconnect from distractions and enjoy calm, uninterrupted time together.</p>
            </div>

        </div><!-- /cp-moments-grid -->

    </div>
</section>

<!-- ===========================
     4. PRIVATE SANCTUARY SECTION
     =========================== -->
<section class="section-padding cp-sanctuary-section" aria-label="Private couples sanctuary">
    <div class="container cp-sanctuary-grid">

        <!-- Left Content -->
        <div class="cp-sanctuary-text">
            <span class="section-eyebrow">YOUR PRIVATE SANCTUARY</span>
            <h2 class="cp-sanctuary-title">
                Designed for Two.<br>
                <span class="gold-gradient-text">Perfected for You.</span>
            </h2>
            <p class="cp-sanctuary-desc">
                Our private couples space is prepared with warm lighting, comfortable treatment beds and thoughtful details to create a calm shared experience from the moment you arrive.
            </p>

            <div class="cp-sanctuary-points">
                <div class="cp-point-item">
                    <i class="fa-solid fa-circle-check gold-icon"></i>
                    <span>Dedicated side-by-side therapy suite</span>
                </div>
                <div class="cp-point-item">
                    <i class="fa-solid fa-circle-check gold-icon"></i>
                    <span>Aromatherapy &amp; warm candlelit ambiance</span>
                </div>
                <div class="cp-point-item">
                    <i class="fa-solid fa-circle-check gold-icon"></i>
                    <span>100% secluded, private and discreet</span>
                </div>
            </div>

            <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20explore%20your%20Couples%20private%20sanctuary." target="_blank" rel="noopener noreferrer" class="btn-gold-outline-lg">
                EXPLORE OUR SPACE <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>

        <!-- Right Image -->
        <div class="cp-sanctuary-img-box">
            <img src="<?= assetUrl('images/sanctuary_interior.jpg') ?>" alt="Private luxury couples treatment room with two beds and candlelight" class="cp-sanctuary-img">
            <div class="cp-sanctuary-img-overlay"></div>
            <div class="cp-sanctuary-badge">
                <i class="fa-solid fa-shield-halved gold-icon"></i>
                <span>Completely Private Space</span>
            </div>
        </div>

    </div>
</section>

<!-- ===========================
     5. COUPLES TRUST / VALUE SECTION
     =========================== -->
<section class="section-padding cp-trust-section" aria-label="Why couples choose Ceylon Therapist">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-eyebrow">WHY COUPLES CHOOSE CEYLON THERAPIST</span>
            <h2 class="section-title">Private. Comfortable. <span class="gold-gradient-text">Designed for Two.</span></h2>
            <div class="gold-line-divider"></div>
        </div>

        <div class="cp-trust-cards-grid">

            <div class="cp-trust-card">
                <div class="cp-trust-card-icon" aria-hidden="true">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <h4 class="cp-trust-card-title">Complete Privacy</h4>
                <p class="cp-trust-card-desc">Your shared experience takes place in a calm, discreet environment designed around comfort and privacy.</p>
            </div>

            <div class="cp-trust-card">
                <div class="cp-trust-card-icon" aria-hidden="true">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <h4 class="cp-trust-card-title">Personalized Experience</h4>
                <p class="cp-trust-card-desc">Select the duration and style of experience that best suits both of you.</p>
            </div>

            <div class="cp-trust-card">
                <div class="cp-trust-card-icon" aria-hidden="true">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <h4 class="cp-trust-card-title">Professional Care</h4>
                <p class="cp-trust-card-desc">Every session is handled respectfully and thoughtfully from start to finish.</p>
            </div>

            <div class="cp-trust-card">
                <div class="cp-trust-card-icon" aria-hidden="true">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <h4 class="cp-trust-card-title">Easy Booking</h4>
                <p class="cp-trust-card-desc">Choose your preferred experience and continue directly to WhatsApp for quick private communication.</p>
            </div>

        </div><!-- /cp-trust-cards-grid -->

    </div>
</section>

<!-- ===========================
     6. TESTIMONIAL SECTION
     =========================== -->
<section class="cp-testimonial-strip" aria-label="Couples testimonial">
    <div class="container text-center cp-testimonial-inner">
        <div class="cp-stars" aria-label="5 star review">
            <i class="fa-solid fa-star" aria-hidden="true"></i>
            <i class="fa-solid fa-star" aria-hidden="true"></i>
            <i class="fa-solid fa-star" aria-hidden="true"></i>
            <i class="fa-solid fa-star" aria-hidden="true"></i>
            <i class="fa-solid fa-star" aria-hidden="true"></i>
        </div>

        <blockquote class="cp-testimonial-quote">
            &ldquo;A peaceful experience that gave us time to relax, reset and simply enjoy being together.&rdquo;
        </blockquote>

        <div class="cp-testimonial-meta">
            <span class="cp-testimonial-author">Verified Couple</span>
            <span class="cp-testimonial-bullet">&bull;</span>
            <span class="cp-testimonial-tag">Private Couples Sanctuary Ritual</span>
        </div>
    </div>
</section>

<!-- ===========================
     7. FINAL COUPLES RESERVATION CTA
     =========================== -->
<section class="section-padding cp-final-cta-section" id="cp-reservation" aria-label="Final couples reservation panel">
    <div class="container">
        <div class="cp-booking-panel">

            <!-- Left Icon -->
            <div class="cp-panel-left" aria-hidden="true">
                <div class="cp-lock-icon-wrap">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
            </div>

            <!-- Center Text -->
            <div class="cp-panel-center">
                <h3 class="cp-panel-title">Reserve Your Time Together</h3>
                <p class="cp-panel-subtitle">Private. Discreet. Effortless.</p>
                <p class="cp-panel-desc">Choose your preferred couples experience and contact us privately in just a few steps.</p>
            </div>

            <!-- Right CTA -->
            <div class="cp-panel-right">
                <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20Couples%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-whatsapp-large" id="cp-final-booking-btn">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> RESERVE PRIVATELY NOW
                </a>
                <span class="cp-security-note"><i class="fa-solid fa-lock gold-icon"></i> 100% Private &amp; Secure</span>
            </div>

        </div><!-- /cp-booking-panel -->
    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
