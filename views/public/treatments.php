<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<!-- =======================================
     TREATMENTS PAGE — CEYLON THERAPIST
     ======================================= -->

<!-- Page Banner -->
<section class="page-banner-treatments">
    <div class="page-banner-overlay"></div>
    <div class="container page-banner-content text-center">
        <span class="section-eyebrow"><i class="fa-solid fa-spa gold-icon-sm"></i> CEYLON THERAPIST</span>
        <h1 class="page-banner-title">Therapy Services <span class="gold-gradient-text">&amp; Treatments</span></h1>
        <p class="page-banner-subtitle">Comprehensive therapeutic wellness, restorative bodywork and stress-release massages — each session curated for your personal comfort and total privacy.</p>
        <div class="gold-line-divider" style="margin-top:28px;"></div>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding treatments-section">
    <div class="container">

        <!-- Section Header -->
        <div class="section-header text-center" style="margin-bottom:60px;">
            <span class="section-eyebrow">OUR SERVICES</span>
            <h2 class="section-title">Choose Your Treatment</h2>
            <p class="section-subtitle">Every session is tailored to your needs, delivered in a fully private, professional environment at your pace.</p>
            <div class="gold-line-divider"></div>
        </div>

        <?php if (!empty($services)): ?>
            <div class="treatments-grid">
                <?php
                $fallbackImages = ['treatment_essential.jpg', 'treatment_signature.jpg', 'sanctuary_interior.jpg', 'hero_bg.jpg'];
                $imgIndex = 0;
                foreach ($services as $service):
                    $categoryCode = strtoupper($service['category_code'] ?? 'GENERAL');

                    // Image selection logic
                    if (!empty($service['image']) && file_exists(BASE_PATH . '/storage/' . $service['image'])) {
                        $imgSrc = baseUrl('storage/' . $service['image']);
                    } elseif ($categoryCode === 'FOR_HER') {
                        $imgSrc = assetUrl('images/for_her_banner.jpg');
                    } elseif ($categoryCode === 'COUPLES') {
                        $imgSrc = assetUrl('images/couples_banner.jpg');
                    } else {
                        $imgSrc = assetUrl('images/' . ($fallbackImages[$imgIndex % count($fallbackImages)]));
                        $imgIndex++;
                    }

                    // WhatsApp link with service pre-fill
                    $waMsg = urlencode('Hello Ceylon Therapist, I would like to book the ' . $service['name'] . ' (' . $service['duration_minutes'] . ' min) treatment. Please advise on availability.');
                    $waLink = 'https://wa.me/' . DEFAULT_WHATSAPP_NUMBER . '?text=' . $waMsg;

                    // Badge class by category
                    $badgeClass = 'treatment-badge';
                    if ($categoryCode === 'FOR_HER')   $badgeClass .= ' badge-rose';
                    elseif ($categoryCode === 'COUPLES') $badgeClass .= ' badge-couples';
                ?>
                <div class="treatment-card">
                    <div class="treatment-card-img-box">
                        <img src="<?= $imgSrc ?>" alt="<?= e($service['name']) ?>" class="treatment-card-img">
                        <div class="treatment-card-img-overlay"></div>
                        <div class="treatment-duration-badge">
                            <i class="fa-regular fa-clock"></i> <?= e($service['duration_minutes']) ?> Min
                        </div>
                    </div>
                    <div class="treatment-card-body">
                        <span class="<?= $badgeClass ?>"><?= e($service['category_name'] ?? 'General Wellness') ?></span>
                        <h3 class="treatment-card-title"><?= e($service['name']) ?></h3>
                        <p class="treatment-card-desc"><?= e($service['short_description'] ?? $service['description'] ?? 'A thoughtfully designed therapeutic experience crafted for your personal comfort and privacy.') ?></p>
                        <a href="<?= $waLink ?>" target="_blank" rel="noopener noreferrer" class="btn-book-treatment" id="book-<?= (int)$service['id'] ?>">
                            <i class="fa-brands fa-whatsapp"></i> Book This Treatment
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <!-- Empty State -->
            <div class="treatments-empty text-center">
                <div class="empty-icon-box">
                    <i class="fa-solid fa-spa"></i>
                </div>
                <h3>Treatment Menu Coming Soon</h3>
                <p>We are currently refining our service offerings. Contact us directly for immediate availability and private session enquiries.</p>
                <a href="<?= baseUrl('contact.php') ?>" class="btn-gold-outline-lg">
                    Contact Us <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Booking CTA Strip -->
<section class="treatments-cta-section">
    <div class="container treatments-cta-inner text-center">
        <span class="section-eyebrow">READY TO BEGIN</span>
        <h2 class="treatments-cta-title">Reserve Your Private Session</h2>
        <p class="treatments-cta-sub">All bookings are arranged personally via WhatsApp for complete privacy and discretion. Choose a time that suits you.</p>
        <div class="treatments-cta-buttons">
            <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-hero-secondary">
                <i class="fa-brands fa-whatsapp"></i> Reserve Privately via WhatsApp
            </a>
            <a href="<?= baseUrl('contact.php') ?>" class="btn-hero-primary">Contact &amp; Enquire</a>
        </div>
        <p class="treatments-cta-meta">Private &bull; Discreet &bull; Professional</p>
    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
