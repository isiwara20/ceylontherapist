<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

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
            <p class="meta-info"><strong>Duration:</strong> <?= e($package['duration_minutes'] ?? '60') ?> Minutes</p>

            <div class="cta-box mt-30">
                <a href="<?= baseUrl('contact.php') ?>" class="btn-primary-gold">
                    <i class="fa-brands fa-whatsapp"></i> Reserve Package via WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
