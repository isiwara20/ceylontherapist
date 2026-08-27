<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<section class="page-banner">
    <div class="container text-center">
        <h1>Therapy Services & Treatments</h1>
        <p>Comprehensive therapeutic wellness, restorative bodywork, and stress-release massages.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="services-grid">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="service-card">
                        <div class="service-body">
                            <span class="category-badge"><?= e($service['category_name'] ?? 'General') ?></span>
                            <h3><?= e($service['name']) ?></h3>
                            <p class="service-meta"><i class="fa-regular fa-clock"></i> <?= e($service['duration_minutes']) ?> Minutes</p>
                            <p><?= e($service['short_description'] ?? $service['description'] ?? '') ?></p>
                            <a href="<?= baseUrl('contact.php') ?>" class="btn-primary-gold mt-15"><i class="fa-brands fa-whatsapp"></i> Book via WhatsApp</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No active services listed at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
