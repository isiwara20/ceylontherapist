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

        <?php 
        $waNumber = preg_replace('/[^0-9]/', '', (string)($contact['whatsapp'] ?? DEFAULT_WHATSAPP_NUMBER));
        $fallbackImages = ['for_her_banner.jpg', 'treatment_signature.jpg', 'sanctuary_interior.jpg', 'treatment_essential.jpg'];
        $icons = ['fa-spa', 'fa-heart', 'fa-droplet', 'fa-gem', 'fa-moon', 'fa-wind'];
        ?>

        <?php if (!empty($services)): ?>
            <div class="fh-cards-grid">
                <?php 
                $i = 0;
                foreach ($services as $service): 
                    $icon = $icons[$i % count($icons)];
                    $fallback = $fallbackImages[$i % count($fallbackImages)];
                    $img = mediaUrl($service['image'], 'assets/images/' . $fallback);
                    $waMsg = urlencode('Hello Ceylon Therapist, I would like to reserve the ' . $service['name'] . ' (' . $service['duration_minutes'] . ' min) For Her session. Please advise on availability.');
                    $waLink = 'https://wa.me/' . $waNumber . '?text=' . $waMsg;
                    $i++;
                ?>
                    <article class="fh-card" id="fh-card-<?= (int)$service['id'] ?>">
                        <div class="fh-card-img-box">
                            <img src="<?= $img ?>" alt="<?= e($service['name']) ?>" class="fh-card-img" loading="lazy">
                            <div class="fh-card-img-overlay"></div>
                            <div class="fh-card-duration-tag">
                                <i class="fa-regular fa-clock"></i> <?= (int)$service['duration_minutes'] ?> Min
                            </div>
                        </div>
                        <div class="fh-card-body">
                            <div class="fh-card-icon-wrap" aria-hidden="true">
                                <i class="fa-solid <?= $icon ?>"></i>
                            </div>
                            <h3 class="fh-card-title"><?= e($service['name']) ?></h3>
                            <p class="fh-card-desc"><?= e($service['short_description'] ?? $service['description'] ?? 'A gentle and restorative experience designed for your total privacy and comfort.') ?></p>
                            
                            <div class="fh-card-footer" style="margin-top:auto;padding-top:16px;border-top:1px solid rgba(213,166,83,0.15);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                                <a href="<?= $waLink ?>" target="_blank" rel="noopener noreferrer" class="fh-card-btn" id="book-fh-<?= (int)$service['id'] ?>">
                                    RESERVE PRIVATELY <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                                <?php if (!empty($service['description']) && $service['description'] !== $service['short_description']): ?>
                                    <button type="button" class="fh-detail-btn" onclick="openFhModal(<?= htmlspecialchars(json_encode([
                                        'id' => $service['id'],
                                        'name' => $service['name'],
                                        'duration' => $service['duration_minutes'],
                                        'image' => $img,
                                        'short' => $service['short_description'] ?? '',
                                        'desc' => $service['description'],
                                        'waLink' => $waLink
                                    ]), ENT_QUOTES, 'UTF-8') ?>)" style="background:none;border:none;color:var(--color-champagne-gold,#d5a653);font-size:0.75rem;letter-spacing:1px;cursor:pointer;display:inline-flex;align-items:center;gap:4px;font-weight:600;padding:4px 0;">
                                        <i class="fa-solid fa-circle-info"></i> DETAILS
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div><!-- /fh-cards-grid -->
        <?php else: ?>
            <!-- Graceful Empty State -->
            <div class="treatments-empty text-center" style="padding:60px 20px;">
                <div class="empty-icon-box" style="font-size:3rem;color:var(--color-champagne-gold,#d5a653);margin-bottom:20px;">
                    <i class="fa-solid fa-heart"></i>
                </div>
                <h3 style="font-family:var(--font-heading);font-size:1.8rem;color:var(--color-cream);margin-bottom:12px;">Experiences Being Curated</h3>
                <p style="color:var(--color-text-muted);max-width:560px;margin:0 auto 28px;line-height:1.6;">Our specialized sanctuary experiences for women are being refreshed. Inquire directly via WhatsApp for our current private session availability.</p>
                <a href="https://wa.me/<?= $waNumber ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20inquire%20about%20For%20Her%20private%20sessions." target="_blank" rel="noopener noreferrer" class="fh-btn-primary" style="display:inline-block;">
                    <i class="fa-brands fa-whatsapp"></i> Inquire via WhatsApp
                </a>
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

<!-- Experience Detail Modal -->
<div class="fh-modal-backdrop" id="fhDetailModal" onclick="closeFhModal(event)" style="display:none;position:fixed;inset:0;background:rgba(5,5,5,0.85);backdrop-filter:blur(8px);z-index:9999;align-items:center;justify-content:center;padding:20px;">
    <div class="fh-modal-card" style="background:#0e0b0c;border:1px solid rgba(213,166,83,0.35);border-radius:12px;max-width:580px;width:100%;overflow:hidden;box-shadow:0 25px 60px rgba(0,0,0,0.85),0 0 40px rgba(232,155,167,0.12);animation:modalFadeIn 0.25s ease-out;">
        <div style="position:relative;height:200px;overflow:hidden;">
            <img id="fhModalImg" src="" alt="Treatment Experience" style="width:100%;height:100%;object-fit:cover;">
            <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(0,0,0,0.2) 0%,#0e0b0c 100%);"></div>
            <button type="button" onclick="closeFhModalDirect()" aria-label="Close modal" style="position:absolute;top:14px;right:14px;background:rgba(0,0,0,0.7);border:1px solid rgba(255,255,255,0.2);color:#fff;width:34px;height:34px;border-radius:50%;cursor:pointer;font-size:18px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <span id="fhModalDuration" style="position:absolute;bottom:14px;left:20px;background:rgba(7,7,7,0.85);border:1px solid rgba(213,166,83,0.5);color:#d5a653;font-size:0.75rem;font-weight:700;padding:5px 12px;border-radius:4px;letter-spacing:1px;display:inline-flex;align-items:center;gap:6px;">
                <i class="fa-regular fa-clock"></i> <span>60 Min</span>
            </span>
        </div>
        <div style="padding:24px 28px 28px;">
            <span style="font-size:0.75rem;letter-spacing:1.5px;text-transform:uppercase;color:#e89ba7;font-weight:600;display:block;margin-bottom:6px;">FOR HER SANCTUARY</span>
            <h3 id="fhModalTitle" style="font-family:var(--font-heading, 'Playfair Display', serif);font-size:1.6rem;color:#f7f3ee;margin-bottom:12px;line-height:1.25;"></h3>
            <p id="fhModalShort" style="color:#d5a653;font-size:0.92rem;line-height:1.6;margin-bottom:14px;font-style:italic;"></p>
            <div id="fhModalDesc" style="color:#b8b0a5;font-size:0.9rem;line-height:1.7;margin-bottom:24px;max-height:180px;overflow-y:auto;padding-right:6px;"></div>
            
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;padding-top:18px;border-top:1px solid rgba(255,255,255,0.08);">
                <div style="display:flex;align-items:center;gap:8px;font-size:0.78rem;color:#9b9286;">
                    <i class="fa-solid fa-shield-heart" style="color:#d5a653;"></i>
                    <span>100% Private &amp; Confidential</span>
                </div>
                <a id="fhModalBookBtn" href="" target="_blank" rel="noopener noreferrer" class="fh-btn-primary" style="padding:12px 22px;font-size:0.8rem;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                    <i class="fa-brands fa-whatsapp"></i> Reserve Privately
                </a>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.95) translateY(10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
.fh-cards-grid {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)) !important;
}
</style>

<script>
function openFhModal(data) {
    document.getElementById('fhModalTitle').textContent = data.name || '';
    document.getElementById('fhModalShort').textContent = data.short || '';
    document.getElementById('fhModalDesc').textContent = data.desc || data.short || '';
    document.getElementById('fhModalDuration').querySelector('span').textContent = (data.duration || 60) + ' Min';
    document.getElementById('fhModalImg').src = data.image || '';
    document.getElementById('fhModalBookBtn').href = data.waLink || '#';
    
    var modal = document.getElementById('fhDetailModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeFhModal(e) {
    if (e.target.id === 'fhDetailModal') {
        closeFhModalDirect();
    }
}

function closeFhModalDirect() {
    var modal = document.getElementById('fhDetailModal');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeFhModalDirect();
    }
});
</script>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
