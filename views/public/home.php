<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<!-- Cinematic Hero Section -->
<section class="hero-section">
    <div class="hero-bg-wrapper">
        <img src="<?= assetUrl('images/hero_bg.jpg') ?>" alt="Ceylon Therapist Luxury Sanctuary" class="hero-bg-img">
        <div class="hero-overlay"></div>
    </div>
    
    <div class="hero-content container">
        <span class="hero-eyebrow"><i class="fa-solid fa-gem gold-icon-sm"></i> PRIVATE. PERSONAL. RESTORATIVE.</span>
        <h1 class="hero-title">
            Your Time.<br>
            Your Space.<br>
            <span class="gold-gradient-text">Your Escape.</span>
        </h1>
        <p class="hero-description">
            Thoughtfully designed therapeutic experiences created to help you slow down, release tension and return to a state of balance.
        </p>
        <div class="hero-actions">
            <a href="<?= baseUrl('treatments.php') ?>" class="btn-hero-primary">EXPLORE TREATMENTS</a>
            <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-hero-secondary">
                <i class="fa-brands fa-whatsapp"></i> RESERVE PRIVATELY
            </a>
        </div>
    </div>

    <!-- Hero Trust Strip -->
    <div class="trust-strip">
        <div class="container trust-strip-grid">
            <div class="trust-item">
                <div class="trust-icon-box"><i class="fa-solid fa-lock"></i></div>
                <div class="trust-text">
                    <strong>100% Private</strong>
                    <span>Exclusive Sanctuary</span>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon-box"><i class="fa-solid fa-star"></i></div>
                <div class="trust-text">
                    <strong>Premium Experience</strong>
                    <span>Refined Luxury</span>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon-box"><i class="fa-solid fa-user-check"></i></div>
                <div class="trust-text">
                    <strong>Professional Care</strong>
                    <span>Attentive Service</span>
                </div>
            </div>
            <div class="trust-item">
                <div class="trust-icon-box"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="trust-text">
                    <strong>Discreet & Secure</strong>
                    <span>Total Peace of Mind</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Treatments Section -->
<section class="section-padding featured-section" id="treatments">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-eyebrow">OUR EXPERIENCES</span>
            <h2 class="section-title">Choose Your Experience</h2>
            <p class="section-subtitle">Every session is designed around your comfort, your needs and your pace.</p>
            <div class="gold-line-divider"></div>
        </div>

        <div class="experiences-grid">
            <!-- Card 1 -->
            <div class="experience-card">
                <div class="card-image-box">
                    <img src="<?= assetUrl('images/treatment_essential.jpg') ?>" alt="The Essential Escape" class="card-img">
                    <div class="card-tag">60 Minutes</div>
                    <div class="card-img-overlay"></div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">The Essential Escape</h3>
                    <p class="card-desc">A focused relaxation experience designed to refresh your body and calm your mind.</p>
                    <a href="<?= baseUrl('treatments.php') ?>" class="card-cta-btn">
                        VIEW EXPERIENCE <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="experience-card">
                <div class="card-image-box">
                    <img src="<?= assetUrl('images/treatment_signature.jpg') ?>" alt="The Signature Experience" class="card-img">
                    <div class="card-tag">120 Minutes</div>
                    <div class="card-img-overlay"></div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">The Signature Experience</h3>
                    <p class="card-desc">An extended private session designed for complete relaxation and deeper restoration.</p>
                    <a href="<?= baseUrl('treatments.php') ?>" class="card-cta-btn">
                        VIEW EXPERIENCE <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="experience-card">
                <div class="card-image-box">
                    <img src="<?= assetUrl('images/for_her_banner.jpg') ?>" alt="Private Wellness Experience for Her" class="card-img">
                    <div class="card-tag tag-burgundy">For Her</div>
                    <div class="card-img-overlay"></div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Private Wellness Experience</h3>
                    <p class="card-desc">A thoughtfully designed experience centred around comfort, relaxation and total privacy.</p>
                    <a href="<?= baseUrl('for-her.php') ?>" class="card-cta-btn">
                        VIEW EXPERIENCE <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="experience-card">
                <div class="card-image-box">
                    <img src="<?= assetUrl('images/couples_banner.jpg') ?>" alt="A Shared Escape for Couples" class="card-img">
                    <div class="card-tag tag-gold">For Couples</div>
                    <div class="card-img-overlay"></div>
                </div>
                <div class="card-content">
                    <h3 class="card-title">A Shared Escape</h3>
                    <p class="card-desc">A calm private experience designed for couples to relax, reconnect and unwind together.</p>
                    <a href="<?= baseUrl('couples.php') ?>" class="card-cta-btn">
                        VIEW EXPERIENCE <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sanctuary / Brand Experience Section -->
<section class="section-padding sanctuary-section">
    <div class="container sanctuary-grid">
        <div class="sanctuary-text-content">
            <span class="section-eyebrow">YOUR TIME. YOUR SPACE.</span>
            <h2 class="section-title">A Private Sanctuary <br><span class="gold-gradient-text">Designed Around You.</span></h2>
            <p class="sanctuary-lead">
                Step into a calm, carefully prepared environment where every detail is designed for comfort, privacy and complete peace of mind.
            </p>
            
            <div class="sanctuary-points">
                <div class="point-item">
                    <div class="point-icon"><i class="fa-solid fa-check"></i></div>
                    <div class="point-info">
                        <h4>Private & Discreet</h4>
                        <p>Dedicated personal attention in an undisturbed private environment.</p>
                    </div>
                </div>
                <div class="point-item">
                    <div class="point-icon"><i class="fa-solid fa-check"></i></div>
                    <div class="point-info">
                        <h4>Calming Atmosphere</h4>
                        <p>Soft candlelight, warm tones and curated ambient soothing sounds.</p>
                    </div>
                </div>
                <div class="point-item">
                    <div class="point-icon"><i class="fa-solid fa-check"></i></div>
                    <div class="point-info">
                        <h4>Thoughtful Details</h4>
                        <p>Organic oils, premium linens and personalized thermal comfort.</p>
                    </div>
                </div>
            </div>

            <a href="<?= baseUrl('about.php') ?>" class="btn-gold-outline-lg">
                DISCOVER OUR SPACE <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="sanctuary-image-box">
            <div class="image-frame-gold">
                <img src="<?= assetUrl('images/sanctuary_interior.jpg') ?>" alt="Ceylon Therapist Private Sanctuary Interior" class="sanctuary-img">
            </div>
            <div class="sanctuary-badge">
                <i class="fa-solid fa-leaf gold-icon"></i>
                <span>Pure Serenity</span>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Ceylon Therapist Section -->
<section class="section-padding why-choose-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-eyebrow">WHY CEYLON THERAPIST</span>
            <h2 class="section-title">Care Designed Around You</h2>
            <div class="gold-line-divider"></div>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-shield-heart feature-icon"></i>
                </div>
                <h3>Private Environment</h3>
                <p>Every visit is handled with care, discretion and respect for your privacy.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-sliders feature-icon"></i>
                </div>
                <h3>Personalized Experience</h3>
                <p>Sessions can be selected based on your preferred duration and type of relaxation.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-spa feature-icon"></i>
                </div>
                <h3>Calm Professional Service</h3>
                <p>A respectful, relaxing experience designed to help you fully unwind.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper">
                    <i class="fa-solid fa-comment-dots feature-icon"></i>
                </div>
                <h3>Easy Private Booking</h3>
                <p>Select your experience and continue directly to WhatsApp for quick communication.</p>
            </div>
        </div>
    </div>
</section>

<!-- For Her Preview Section -->
<section class="section-padding for-her-preview">
    <div class="container for-her-grid">
        <div class="for-her-image-box">
            <img src="<?= assetUrl('images/for_her_banner.jpg') ?>" alt="Private Wellness Experience for Her" class="for-her-img">
            <div class="for-her-overlay"></div>
        </div>
        <div class="for-her-content">
            <span class="section-eyebrow eyebrow-burgundy">FOR HER</span>
            <h2 class="section-title">A Private Wellness Experience <br><span class="burgundy-gold-text">Designed for Her.</span></h2>
            <p class="section-subtitle-left">
                A carefully prepared experience focused on comfort, calm and personal well-being.
            </p>
            <a href="<?= baseUrl('for-her.php') ?>" class="btn-burgundy-gold">
                EXPLORE FOR HER <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Couples Preview Section -->
<section class="section-padding couples-preview">
    <div class="container couples-grid">
        <div class="couples-content">
            <span class="section-eyebrow">FOR TWO</span>
            <h2 class="section-title">Share the Calm. <br><span class="gold-gradient-text">Reconnect Together.</span></h2>
            <p class="section-subtitle-left">
                Enjoy a private shared experience designed to help you slow down, reconnect and enjoy meaningful time together.
            </p>
            <a href="<?= baseUrl('couples.php') ?>" class="btn-gold-outline-lg">
                EXPLORE COUPLES <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
        <div class="couples-image-box">
            <img src="<?= assetUrl('images/couples_banner.jpg') ?>" alt="Shared Couples Escape" class="couples-img">
            <div class="couples-overlay"></div>
        </div>
    </div>
</section>

<!-- Booking Journey Section -->
<section class="section-padding booking-journey-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-eyebrow">HOW IT WORKS</span>
            <h2 class="section-title">Reserve Your Experience</h2>
            <p class="section-subtitle">Simple. Private. Effortless.</p>
            <div class="gold-line-divider"></div>
        </div>

        <div class="journey-steps-grid">
            <div class="step-card">
                <div class="step-number">01</div>
                <div class="step-icon-box"><i class="fa-solid fa-hand-holding-heart"></i></div>
                <h3>Choose Experience</h3>
                <p>Browse our curated therapeutic sessions.</p>
            </div>

            <div class="step-card">
                <div class="step-number">02</div>
                <div class="step-icon-box"><i class="fa-regular fa-clock"></i></div>
                <h3>Select Duration</h3>
                <p>Choose 60 min, 90 min or 120 min sessions.</p>
            </div>

            <div class="step-card">
                <div class="step-number">03</div>
                <div class="step-icon-box"><i class="fa-regular fa-calendar-check"></i></div>
                <h3>Choose Date & Time</h3>
                <p>Pick your preferred schedule and location.</p>
            </div>

            <div class="step-card">
                <div class="step-number">04</div>
                <div class="step-icon-box"><i class="fa-brands fa-whatsapp"></i></div>
                <h3>Send via WhatsApp</h3>
                <p>Instantly confirm availability privately.</p>
            </div>
        </div>

        <div class="text-center journey-cta-wrapper mt-50">
            <a href="https://wa.me/94771234567?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-whatsapp-large">
                <i class="fa-brands fa-whatsapp"></i> RESERVE PRIVATELY NOW
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section-padding testimonials-section">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-eyebrow">CLIENT REFLECTIONS</span>
            <h2 class="section-title">Words of Sanctuary</h2>
            <p class="section-subtitle">Discreet feedback from those who have experienced our private therapy.</p>
            <div class="gold-line-divider"></div>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-quote">“The entire experience felt calm, private and thoughtfully arranged.”</p>
                <div class="testimonial-author">
                    <div class="author-icon"><i class="fa-solid fa-user-shield"></i></div>
                    <span class="author-label">Verified Client</span>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-quote">“Easy communication, peaceful atmosphere and very professional service.”</p>
                <div class="testimonial-author">
                    <div class="author-icon"><i class="fa-solid fa-user-shield"></i></div>
                    <span class="author-label">Verified Client</span>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="testimonial-quote">“A beautiful space to relax and take some time away from everything.”</p>
                <div class="testimonial-author">
                    <div class="author-icon"><i class="fa-solid fa-user-shield"></i></div>
                    <span class="author-label">Verified Client</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="final-cta-section">
    <div class="final-cta-bg">
        <img src="<?= assetUrl('images/hero_bg.jpg') ?>" alt="Ceylon Therapist Luxury Ambiance" class="cta-bg-img">
        <div class="final-cta-overlay"></div>
    </div>
    
    <div class="container final-cta-content text-center">
        <h2 class="final-cta-title">Your Moment Starts Here.</h2>
        <p class="final-cta-sub">Choose your preferred experience and contact us privately through WhatsApp.</p>
        
        <div class="final-cta-buttons">
            <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-hero-secondary">
                <i class="fa-brands fa-whatsapp"></i> RESERVE PRIVATELY
            </a>
            <a href="<?= baseUrl('contact.php') ?>" class="btn-hero-primary">CONTACT US</a>
        </div>

        <p class="final-cta-meta">Private &bull; Discreet &bull; Easy Booking</p>
    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>

