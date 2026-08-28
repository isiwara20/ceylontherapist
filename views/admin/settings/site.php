<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Website Settings</h1>
        <p>Manage core business metadata, SEO tags, brand title, and footer copyright.</p>
    </div>
</div>

<!-- Site Settings Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_site_settings.php') ?>" method="POST">
        <?= CsrfService::getHiddenInput() ?>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="site_name">Website Name <span class="required">*</span></label>
                <input type="text" id="site_name" name="site_name" class="admin-input" required value="<?= e($siteSettings['site_name'] ?? 'Ceylon Therapist') ?>">
            </div>

            <div class="form-group">
                <label for="site_tagline">Brand Tagline</label>
                <input type="text" id="site_tagline" name="site_tagline" class="admin-input" value="<?= e($siteSettings['site_tagline'] ?? 'Private Luxury Wellness & Therapy') ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="meta_title">Default Meta Title</label>
            <input type="text" id="meta_title" name="meta_title" class="admin-input" value="<?= e($siteSettings['meta_title'] ?? 'Ceylon Therapist | Private Luxury Wellness & Therapy in Sri Lanka') ?>">
            <p class="form-help">Displayed in browser tabs and search engine search results.</p>
        </div>

        <div class="form-group">
            <label for="meta_description">Default Meta Description</label>
            <textarea id="meta_description" name="meta_description" class="admin-textarea" rows="3"><?= e($siteSettings['meta_description'] ?? 'Thoughtfully designed private therapeutic experiences created to help you slow down, release tension and return to a state of balance.') ?></textarea>
        </div>

        <div class="form-grid-3">
            <div class="form-group">
                <label for="business_location_label">Location Label</label>
                <input type="text" id="business_location_label" name="business_location_label" class="admin-input" value="<?= e($siteSettings['business_location_label'] ?? 'Sri Lanka') ?>">
            </div>

            <div class="form-group">
                <label for="booking_cta_text">Global CTA Button Text</label>
                <input type="text" id="booking_cta_text" name="booking_cta_text" class="admin-input" value="<?= e($siteSettings['booking_cta_text'] ?? 'RESERVE PRIVATELY') ?>">
            </div>

            <div class="form-group">
                <label for="footer_copyright">Footer Copyright Text</label>
                <input type="text" id="footer_copyright" name="footer_copyright" class="admin-input" value="<?= e($siteSettings['footer_copyright'] ?? 'Ceylon Therapist. All Rights Reserved.') ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Save Website Settings
            </button>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
