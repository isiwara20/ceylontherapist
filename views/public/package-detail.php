<?php require BASE_PATH . '/views/layouts/header.php'; ?>

<section class="page-banner">
    <div class="container text-center">
        <h1><?= e($package['title'] ?? 'Wellness Package') ?></h1>
        <p><?= e($package['short_description'] ?? '') ?></p>
    </div>
</section>

<section class="section-padding">
    <div class="container max-800">
        <div class="package-detail-card">
            <h2>Package Overview</h2>
            <p><?= e($package['description'] ?? 'Detailed therapy information.') ?></p>
            <p class="meta-info"><strong>Duration:</strong> <?= (int)($package['duration_minutes'] ?? 60) ?> Minutes</p>
            <?php if (!empty($package['price'])): ?>
                <p class="meta-info"><strong>Price:</strong> <span style="color:var(--color-champagne-gold, #d5a653);font-weight:700;font-size:1.15rem;"><?= formatPrice($package['price']) ?></span></p>
            <?php endif; ?>

            <?php
                $pkgPriceText = !empty($package['price']) ? ' - ' . formatPrice($package['price']) : '';
                $pkgWaMsg = urlencode('Hello Ceylon Therapist, I would like to reserve the ' . ($package['title'] ?? 'Wellness Package') . ' (' . ($package['duration_minutes'] ?? 90) . ' min' . $pkgPriceText . '). Please advise on available appointments.');
                $pkgWaUrl = 'https://wa.me/' . DEFAULT_WHATSAPP_NUMBER . '?text=' . $pkgWaMsg;
            ?>

            <div class="cta-box mt-30" style="display:flex;gap:15px;flex-wrap:wrap;">
                <a href="<?= $pkgWaUrl ?>" target="_blank" rel="noopener noreferrer" class="btn-primary-gold">
                    <i class="fa-brands fa-whatsapp"></i> Reserve Package via WhatsApp
                </a>
                <a href="<?= baseUrl('contact.php?package=' . urlencode($package['slug'] ?? '')) ?>" class="btn-secondary-gold" style="padding:12px 24px;border:1px solid var(--color-border-gold);color:var(--color-cream);text-decoration:none;border-radius:4px;display:inline-flex;align-items:center;">
                    Book via Contact Form
                </a>
            </div>
        </div>
    </div>
</section>

<?php require BASE_PATH . '/views/layouts/footer.php'; ?>
