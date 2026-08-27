<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content container">
        <span class="sub-heading">ANCIENT WISDOM & LUXURY THERAPY</span>
        <h1 class="hero-title">Tranquility & Rejuvenation in Sri Lanka</h1>
        <p class="hero-description">Experience bespoke therapeutic massage, ancient herbal body healing, and private sanctuary rituals curated for deep renewal.</p>
        <div class="hero-buttons">
            <a href="<?= baseUrl('treatments.php') ?>" class="btn-gold-outline">Explore Treatments</a>
            <a href="<?= baseUrl('contact.php') ?>" class="btn-gold-filled"><i class="fa-brands fa-whatsapp"></i> Reserve Session</a>
        </div>
    </div>
</section>

<section class="section-padding services-preview">
    <div class="container">
        <div class="section-header text-center">
            <span class="gold-subtitle">OUR OFFERINGS</span>
            <h2>Signature Therapeutic Treatments</h2>
            <div class="gold-divider"></div>
        </div>

        <div class="services-grid">
            <?php if (!empty($featuredServices)): ?>
                <?php foreach ($featuredServices as $service): ?>
                    <div class="service-card">
                        <div class="service-image-placeholder">
                            <i class="fa-solid fa-spa icon-gold"></i>
                        </div>
                        <div class="service-body">
                            <h3><?= e($service['name']) ?></h3>
                            <p class="service-meta"><i class="fa-regular fa-clock"></i> <?= e($service['duration_minutes']) ?> Minutes</p>
                            <p class="service-desc"><?= e($service['short_description'] ?? 'Exclusive luxury treatment session.') ?></p>
                            <a href="<?= baseUrl('contact.php') ?>" class="btn-text-gold">Book via WhatsApp &rarr;</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="placeholder-box">
                    <p>Therapy treatments directory loading...</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
