<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<section class="page-banner banner-for-her">
    <div class="container text-center">
        <h1>For Her — Specialized Wellness</h1>
        <p>Bespoke women's wellness treatments, aromatherapy, prenatal relaxation, and botanical facial therapies.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="services-grid">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="service-card highlight-card">
                        <div class="service-body">
                            <span class="category-badge gold-badge">For Her Exclusive</span>
                            <h3><?= e($service['name']) ?></h3>
                            <p class="service-meta"><i class="fa-regular fa-clock"></i> <?= e($service['duration_minutes']) ?> Minutes</p>
                            <p><?= e($service['short_description'] ?? '') ?></p>
                            <a href="<?= baseUrl('contact.php') ?>" class="btn-primary-gold mt-15"><i class="fa-brands fa-whatsapp"></i> Reserve Package</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="placeholder-box">
                    <p>Exclusive 'For Her' sanctuary packages directory initializing...</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
