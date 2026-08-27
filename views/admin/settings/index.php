<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<div class="admin-panel-card">
    <h2>Website & Contact Settings</h2>
    <p class="subtitle">Manage business contact information, default WhatsApp booking number, and business email.</p>

    <div class="settings-form-container mt-20">
        <form action="<?= baseUrl('admin_site_settings.php') ?>" method="POST" class="admin-form">
            <?= CsrfService::getHiddenInput() ?>

            <div class="form-group">
                <label for="whatsapp">Default WhatsApp Booking Number (Sri Lanka Format: 9477XXXXXXX)</label>
                <input type="text" id="whatsapp" name="whatsapp" value="<?= e($contactSettings['whatsapp'] ?? DEFAULT_WHATSAPP_NUMBER) ?>">
            </div>

            <div class="form-group">
                <label for="email">Business Email Address</label>
                <input type="email" id="email" name="email" value="<?= e($contactSettings['email'] ?? DEFAULT_BUSINESS_EMAIL) ?>">
            </div>

            <div class="form-group">
                <label for="phone">Primary Phone Line</label>
                <input type="text" id="phone" name="phone" value="<?= e($contactSettings['phone'] ?? '0771234567') ?>">
            </div>

            <button type="submit" class="btn-admin-submit mt-15">Save Settings</button>
        </form>
    </div>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
