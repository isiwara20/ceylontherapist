<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Contact & Communication Details</h1>
        <p>Manage the dynamic phone numbers, WhatsApp reservation destination, and business email.</p>
    </div>
</div>

<!-- Contact Settings Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_contact_settings.php') ?>" method="POST">
        <?= CsrfService::getHiddenInput() ?>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="whatsapp">WhatsApp Number (International Format) <span class="required">*</span></label>
                <input type="text" id="whatsapp" name="whatsapp" class="admin-input" required placeholder="e.g. 94762244114" value="<?= e($contactSettings['whatsapp'] ?? '94762244114') ?>">
                <p class="form-help">Country code + Number without '+' or dashes (e.g. <strong>94762244114</strong>). Used for all wa.me links.</p>
            </div>

            <div class="form-group">
                <label for="phone">Display & Call Phone Number <span class="required">*</span></label>
                <input type="text" id="phone" name="phone" class="admin-input" required placeholder="e.g. 0762244114" value="<?= e($contactSettings['phone'] ?? '0762244114') ?>">
                <p class="form-help">Formatted for direct calls and on-page display (e.g. <strong>0762244114</strong>).</p>
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="email">Business Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="email" class="admin-input" required placeholder="info@ceylontherapist.lk" value="<?= e($contactSettings['email'] ?? 'info@ceylontherapist.lk') ?>">
            </div>

            <div class="form-group">
                <label for="working_hours">Operating Hours / Availability</label>
                <input type="text" id="working_hours" name="working_hours" class="admin-input" value="<?= e($contactSettings['working_hours'] ?? 'By Appointment Only') ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="address">Sanctuary Location / Address</label>
            <input type="text" id="address" name="address" class="admin-input" value="<?= e($contactSettings['address'] ?? 'Ceylon Therapist, Sri Lanka') ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Update Contact Details
            </button>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
