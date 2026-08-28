<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<!-- =======================================================
     CONTACT & RESERVATIONS — CEYLON THERAPIST
     Private Booking | WhatsApp Direct | Discretion & Trust
     ======================================================= -->

<!-- ===========================
     1. HERO SECTION
     =========================== -->
<section class="ct-hero" id="ct-top" aria-label="Reservations and Contact hero section">
    <div class="ct-hero-bg">
        <img src="<?= assetUrl('images/hero_bg.jpg') ?>" alt="Private candlelit wellness sanctuary" class="ct-hero-bg-img">
        <div class="ct-hero-overlay"></div>
        <div class="ct-hero-gold-glow" aria-hidden="true"></div>
    </div>

    <div class="container ct-hero-content">
        <span class="ct-eyebrow">PRIVATE. PERSONAL. EFFORTLESS.</span>

        <h1 class="ct-hero-title">
            Reserve Your<br>
            <span class="gold-gradient-text">Private Session.</span>
        </h1>

        <p class="ct-hero-body">
            A discreet reservation experience designed around your comfort, convenience and complete peace of mind.
        </p>

        <div class="ct-hero-actions">
            <a href="#ct-booking-area" class="ct-btn-primary" id="hero-book-session">
                <i class="fa-brands fa-whatsapp"></i> BOOK YOUR SESSION
            </a>
            <a href="<?= baseUrl('treatments.php') ?>" class="ct-btn-secondary" id="hero-view-treatments">
                VIEW TREATMENTS
            </a>
        </div>

        <!-- Floating accent badge -->
        <div class="ct-hero-accent-badge" aria-hidden="true">
            <i class="fa-solid fa-shield-halved gold-icon"></i>
            <span>100% Confidential &bull; By Appointment Only</span>
        </div>
    </div>
</section>

<!-- ===========================
     2. BOOKING JOURNEY (4-STEP)
     =========================== -->
<section class="section-padding ct-journey-section" aria-label="How booking works">
    <div class="container">

        <div class="section-header text-center">
            <span class="section-eyebrow">SIMPLE. PRIVATE. EASY.</span>
            <h2 class="section-title">How It <span class="gold-gradient-text">Works</span></h2>
            <div class="gold-line-divider"></div>
        </div>

        <div class="ct-steps-grid">

            <!-- Step 1 -->
            <div class="ct-step-card">
                <div class="ct-step-num">1</div>
                <div class="ct-step-icon-wrap" aria-hidden="true">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h3 class="ct-step-title">CHOOSE TREATMENT</h3>
                <p class="ct-step-desc">Select the therapy or experience that suits you.</p>
            </div>

            <!-- Step 2 -->
            <div class="ct-step-card">
                <div class="ct-step-num">2</div>
                <div class="ct-step-icon-wrap" aria-hidden="true">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <h3 class="ct-step-title">SELECT DURATION</h3>
                <p class="ct-step-desc">Choose the session length that fits your time.</p>
            </div>

            <!-- Step 3 -->
            <div class="ct-step-card">
                <div class="ct-step-num">3</div>
                <div class="ct-step-icon-wrap" aria-hidden="true">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <h3 class="ct-step-title">PICK DATE &amp; TIME</h3>
                <p class="ct-step-desc">Choose your preferred date and time.</p>
            </div>

            <!-- Step 4 -->
            <div class="ct-step-card">
                <div class="ct-step-num">4</div>
                <div class="ct-step-icon-wrap" aria-hidden="true">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <h3 class="ct-step-title">CONFIRM &amp; CONTACT</h3>
                <p class="ct-step-desc">Send your booking details privately through WhatsApp.</p>
            </div>

        </div><!-- /ct-steps-grid -->

    </div>
</section>

<!-- ===========================
     3. MAIN BOOKING AREA (60/40)
     =========================== -->
<section class="section-padding ct-booking-section" id="ct-booking-area" aria-label="Booking and Contact area">
    <div class="container ct-main-grid">

        <!-- Left 60%: Booking Form -->
        <div class="ct-form-col">
            <div class="ct-form-card">
                <div class="ct-card-header">
                    <span class="section-eyebrow"><i class="fa-brands fa-whatsapp gold-icon-sm"></i> DIRECT RESERVATION</span>
                    <h2 class="ct-form-title">Book Your Private Session</h2>
                    <p class="ct-form-sub">All sessions are by appointment only. Submitting connects directly to WhatsApp.</p>
                </div>

                <form action="<?= baseUrl('contact.php') ?>" method="POST" class="ct-form" id="ct-whatsapp-booking-form">
                    <?= CsrfService::getHiddenInput() ?>
                    <input type="hidden" name="action" value="whatsapp">

                    <!-- Name -->
                    <div class="form-group">
                        <label for="booking_name" class="ct-label">YOUR NAME <span class="required">*</span></label>
                        <input type="text" id="booking_name" name="customer_name" class="ct-input" required placeholder="Enter your full name" autocomplete="name">
                        <span class="ct-error-msg" id="err-name" aria-live="polite"></span>
                    </div>

                    <!-- Treatment selection -->
                    <div class="form-group">
                        <label for="booking_treatment" class="ct-label">PREFERRED TREATMENT <span class="required">*</span></label>
                        <select id="booking_treatment" name="service_name" class="ct-select" required>
                            <option value="">Select a treatment</option>
                            <?php if (!empty($services)): ?>
                                <?php foreach ($services as $srv): ?>
                                    <option value="<?= e($srv['name']) ?>"><?= e($srv['name']) ?> (<?= e($srv['duration_minutes']) ?> Min)</option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="Relax & Reset Massage">Relax &amp; Reset Massage (60 Min)</option>
                                <option value="Aromatherapy Escape">Aromatherapy Escape (90 Min)</option>
                                <option value="Glow & Restore">Glow &amp; Restore (90 Min)</option>
                                <option value="Mindful Calm Session">Mindful Calm Session (120 Min)</option>
                                <option value="Side-by-Side Couples Massage">Side-by-Side Couples Massage (60 Min)</option>
                                <option value="Romantic Reset Couples Ritual">Romantic Reset Couples Ritual (90 Min)</option>
                                <option value="Celebration Ritual for Two">Celebration Ritual for Two (120 Min)</option>
                                <option value="Weekend Escape Ritual">Weekend Escape Ritual (150 Min)</option>
                            <?php endif; ?>
                            <option value="Custom Bespoke Session">Custom Bespoke Session</option>
                        </select>
                        <span class="ct-error-msg" id="err-treatment" aria-live="polite"></span>
                    </div>

                    <!-- Duration -->
                    <div class="form-group">
                        <label for="booking_duration" class="ct-label">DURATION</label>
                        <select id="booking_duration" name="duration_minutes" class="ct-select">
                            <option value="60">60 Minutes</option>
                            <option value="90" selected>90 Minutes</option>
                            <option value="120">120 Minutes</option>
                            <option value="150">150 Minutes</option>
                        </select>
                    </div>

                    <!-- Date & Time Row -->
                    <div class="ct-grid-2">
                        <div class="form-group">
                            <label for="booking_date" class="ct-label">DATE <span class="required">*</span></label>
                            <input type="date" id="booking_date" name="preferred_date" class="ct-input" required>
                            <span class="ct-error-msg" id="err-date" aria-live="polite"></span>
                        </div>
                        <div class="form-group">
                            <label for="booking_time" class="ct-label">TIME <span class="required">*</span></label>
                            <input type="time" id="booking_time" name="preferred_time" class="ct-input" required>
                            <span class="ct-error-msg" id="err-time" aria-live="polite"></span>
                        </div>
                    </div>

                    <!-- WhatsApp & Email Row -->
                    <div class="ct-grid-2">
                        <div class="form-group">
                            <label for="booking_phone" class="ct-label">WHATSAPP NUMBER <span class="required">*</span></label>
                            <input type="tel" id="booking_phone" name="phone" class="ct-input" required placeholder="e.g. +94 77 123 4567" autocomplete="tel">
                            <span class="ct-error-msg" id="err-phone" aria-live="polite"></span>
                        </div>
                        <div class="form-group">
                            <label for="booking_email" class="ct-label">EMAIL (OPTIONAL)</label>
                            <input type="email" id="booking_email" name="email" class="ct-input" placeholder="Enter your email address" autocomplete="email">
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div class="form-group">
                        <label for="booking_message" class="ct-label">SPECIAL REQUESTS (OPTIONAL)</label>
                        <textarea id="booking_message" name="message" class="ct-textarea" rows="4" placeholder="Anything we should know to help prepare your experience?"></textarea>
                    </div>

                    <!-- Privacy notice -->
                    <div class="ct-privacy-note">
                        <i class="fa-solid fa-lock gold-icon"></i>
                        <span>Your information is handled privately and used only to assist with your enquiry.</span>
                    </div>

                    <!-- Submit Button -->
                    <div class="ct-form-actions">
                        <button type="submit" class="btn-whatsapp-large ct-btn-submit" id="btn-submit-booking">
                            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i> SEND VIA WHATSAPP
                        </button>
                    </div>

                    <!-- Alternative Toggle -->
                    <div class="ct-alt-option">
                        <span>Prefer email?</span>
                        <a href="#ct-email-section" class="ct-link-gold" id="toggle-email-btn">Contact by Email &darr;</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right 40%: Contact Information Panel & Map Card -->
        <div class="ct-info-col">

            <!-- Information Card -->
            <div class="ct-info-card">
                <div class="ct-card-header">
                    <span class="section-eyebrow">GET IN TOUCH</span>
                    <h3 class="ct-info-title">We’re Here to Assist You</h3>
                    <p class="ct-info-sub">Feel free to reach our concierge desk directly for quick assistance.</p>
                </div>

                <div class="ct-info-list" role="list">

                    <!-- Location -->
                    <div class="ct-info-item" role="listitem">
                        <div class="ct-info-icon-wrap" aria-hidden="true">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="ct-info-content">
                            <h4 class="ct-info-label">OUR LOCATION</h4>
                            <p class="ct-info-val"><?= e($contactInfo['address'] ?? 'Ceylon Therapist, Sri Lanka') ?></p>
                        </div>
                    </div>

                    <!-- Opening Hours -->
                    <div class="ct-info-item" role="listitem">
                        <div class="ct-info-icon-wrap" aria-hidden="true">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="ct-info-content">
                            <h4 class="ct-info-label">OPENING HOURS</h4>
                            <p class="ct-info-val"><?= e($contactInfo['working_hours'] ?? 'By Appointment Only') ?></p>
                        </div>
                    </div>

                    <!-- Call Us -->
                    <div class="ct-info-item" role="listitem">
                        <div class="ct-info-icon-wrap" aria-hidden="true">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="ct-info-content">
                            <h4 class="ct-info-label">CALL US</h4>
                            <p class="ct-info-val">
                                <a href="tel:+<?= e(DEFAULT_WHATSAPP_NUMBER) ?>">+<?= e(DEFAULT_WHATSAPP_NUMBER) ?></a>
                            </p>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="ct-info-item" role="listitem">
                        <div class="ct-info-icon-wrap" aria-hidden="true">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="ct-info-content">
                            <h4 class="ct-info-label">WHATSAPP</h4>
                            <p class="ct-info-val">
                                <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20inquire%20about%20a%20private%20session." target="_blank" rel="noopener noreferrer">+<?= e(DEFAULT_WHATSAPP_NUMBER) ?></a>
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="ct-info-item" role="listitem">
                        <div class="ct-info-icon-wrap" aria-hidden="true">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div class="ct-info-content">
                            <h4 class="ct-info-label">EMAIL</h4>
                            <p class="ct-info-val">
                                <a href="mailto:<?= e($contactInfo['email'] ?? DEFAULT_BUSINESS_EMAIL) ?>"><?= e($contactInfo['email'] ?? DEFAULT_BUSINESS_EMAIL) ?></a>
                            </p>
                        </div>
                    </div>

                </div><!-- /ct-info-list -->
            </div>

            <!-- Map Card -->
            <div class="ct-map-card">
                <div class="ct-map-inner">
                    <div class="ct-map-pin" aria-hidden="true">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h4 class="ct-map-title">Ceylon Therapist Sanctuary</h4>
                    <p class="ct-map-desc">Private Sanctuary Suites &bull; Sri Lanka</p>
                    <a href="https://maps.google.com/?q=Sri+Lanka" target="_blank" rel="noopener noreferrer" class="ct-btn-map">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> VIEW ON MAP
                    </a>
                </div>
            </div>

        </div><!-- /ct-info-col -->

    </div>
</section>

<!-- ===========================
     4. EMAIL CONTACT SECTION
     =========================== -->
<section class="section-padding ct-email-section" id="ct-email-section" aria-label="Email Enquiry Form">
    <div class="container ct-email-container">

        <div class="section-header text-center">
            <span class="section-eyebrow"><i class="fa-regular fa-envelope gold-icon-sm"></i> GENERAL ENQUIRIES</span>
            <h2 class="section-title">Send Us an <span class="gold-gradient-text">Email Message</span></h2>
            <p class="section-subtitle">For bespoke requests, group enquiries, or general questions, our concierge desk is available to assist.</p>
            <div class="gold-line-divider"></div>
        </div>

        <div class="ct-email-card">
            <form action="<?= baseUrl('contact.php') ?>" method="POST" class="ct-form" id="ct-email-form">
                <?= CsrfService::getHiddenInput() ?>
                <input type="hidden" name="action" value="email">

                <div class="ct-grid-3">
                    <div class="form-group">
                        <label for="email_name" class="ct-label">YOUR NAME <span class="required">*</span></label>
                        <input type="text" id="email_name" name="name" class="ct-input" required placeholder="Your full name" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="email_addr" class="ct-label">EMAIL ADDRESS <span class="required">*</span></label>
                        <input type="email" id="email_addr" name="email" class="ct-input" required placeholder="your.email@example.com" autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label for="email_phone" class="ct-label">PHONE NUMBER</label>
                        <input type="tel" id="email_phone" name="phone" class="ct-input" placeholder="+94 77 123 4567" autocomplete="tel">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email_msg" class="ct-label">MESSAGE <span class="required">*</span></label>
                    <textarea id="email_msg" name="message" class="ct-textarea" rows="4" required placeholder="How can we assist you?"></textarea>
                </div>

                <div class="text-center" style="margin-top:28px;">
                    <button type="submit" class="btn-hero-primary ct-btn-email-submit" id="btn-submit-email">
                        <i class="fa-regular fa-paper-plane"></i> SEND EMAIL ENQUIRY
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>

<!-- ===========================
     5. TRUST STRIP (4 ITEMS)
     =========================== -->
<section class="ct-trust-strip" aria-label="Trust and privacy assurance">
    <div class="container ct-trust-grid">

        <!-- Item 1 -->
        <div class="ct-trust-item">
            <div class="ct-trust-icon-box" aria-hidden="true">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h4 class="ct-trust-title">PRIVATE COMMUNICATION</h4>
            <p class="ct-trust-desc">Your booking enquiry is handled discreetly and only for reservation purposes.</p>
        </div>

        <!-- Item 2 -->
        <div class="ct-trust-item">
            <div class="ct-trust-icon-box" aria-hidden="true">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h4 class="ct-trust-title">FAST CONFIRMATION</h4>
            <p class="ct-trust-desc">We aim to respond quickly and confirm available appointment times.</p>
        </div>

        <!-- Item 3 -->
        <div class="ct-trust-item">
            <div class="ct-trust-icon-box" aria-hidden="true">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
            <h4 class="ct-trust-title">DIRECT WHATSAPP CONTACT</h4>
            <p class="ct-trust-desc">Continue directly to WhatsApp for simple, personal communication.</p>
        </div>

        <!-- Item 4 -->
        <div class="ct-trust-item">
            <div class="ct-trust-icon-box" aria-hidden="true">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <h4 class="ct-trust-title">PROFESSIONAL CARE</h4>
            <p class="ct-trust-desc">Every enquiry and appointment is handled respectfully and thoughtfully.</p>
        </div>

    </div>
</section>

<!-- ===========================
     6. FINAL CLOSING LINE
     =========================== -->
<div class="ct-closing-strip text-center" aria-label="Closing message">
    <div class="container">
        <p class="ct-closing-text">&ldquo;We look forward to welcoming you to your private moment of calm.&rdquo;</p>
        <div class="ct-closing-icon" aria-hidden="true">
            <i class="fa-solid fa-spa gold-icon"></i>
        </div>
    </div>
</div>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
