<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<section class="page-banner">
    <div class="container text-center">
        <h1>Curated Wellness Packages</h1>
        <p>Comprehensive therapeutic journeys combining our most restorative treatments for deep rejuvenation.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <?php if (!empty($packages)): ?>
            <div class="packages-grid">
                <?php foreach ($packages as $pkg): ?>
                    <article class="package-card">
                        <?php if (!empty($pkg['image'])): ?>
                            <img src="<?= mediaUrl($pkg['image']) ?>" alt="<?= e($pkg['title']) ?>" class="package-card-img" loading="lazy">
                        <?php else: ?>
                            <img src="<?= assetUrl('images/treatments/treatment-signature.jpg') ?>" alt="<?= e($pkg['title']) ?>" class="package-card-img" loading="lazy">
                        <?php endif; ?>
                        
                        <div class="package-card-body">
                            <h3 class="package-title"><?= e($pkg['title']) ?></h3>
                            <?php if (!empty($pkg['price'])): ?>
                                <div class="package-price-under-title" style="color:var(--color-champagne-gold, #d5a653);font-size:1.15rem;font-weight:700;margin-top:6px;margin-bottom:12px;display:flex;align-items:center;gap:6px;">
                                    <i class="fa-solid fa-tag" style="font-size:0.85rem;opacity:0.85;"></i>
                                    <span><?= formatPrice($pkg['price']) ?></span>
                                </div>
                            <?php endif; ?>
                            <p class="package-desc"><?= e($pkg['short_description'] ?? '') ?></p>
                            
                            <div class="package-meta">
                                <span class="package-duration">
                                    <i class="fa-regular fa-clock"></i> <?= (int)($pkg['duration_minutes'] ?? 90) ?> Minutes
                                </span>
                                <a href="<?= baseUrl('package.php?slug=' . urlencode($pkg['slug'])) ?>" class="btn-primary-gold" style="padding:8px 16px;font-size:0.85rem;">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="treatments-empty text-center" style="padding:60px 20px;">
                <h3 style="font-family:var(--font-heading);font-size:1.8rem;color:var(--color-cream);margin-bottom:12px;">Packages Being Curated</h3>
                <p style="color:var(--color-text-muted);max-width:560px;margin:0 auto 28px;line-height:1.6;">Our specialized wellness packages are currently being updated. Inquire directly via WhatsApp for our tailored private programs.</p>
                <a href="https://wa.me/<?= DEFAULT_WHATSAPP_NUMBER ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20inquire%20about%20wellness%20packages." target="_blank" rel="noopener noreferrer" class="btn-primary-gold">
                    <i class="fa-brands fa-whatsapp"></i> Inquire via WhatsApp
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
