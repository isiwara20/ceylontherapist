<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Change Security Password</h1>
        <p>Update your administrative login credentials with strong password verification.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_profile.php') ?>" class="btn-admin btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Profile
        </a>
    </div>
</div>

<!-- Password Change Form Card -->
<div class="admin-card" style="max-width: 600px;">
    <form action="<?= baseUrl('admin_change_password.php') ?>" method="POST">
        <?= CsrfService::getHiddenInput() ?>

        <div class="form-group">
            <label for="current_password">Current Password <span class="required">*</span></label>
            <div class="input-with-icon">
                <i class="fa-solid fa-lock input-icon-left"></i>
                <input type="password" id="current_password" name="current_password" class="admin-input" required placeholder="Enter your current password" autocomplete="current-password">
                <i class="fa-solid fa-eye password-toggle-icon" title="Toggle visibility"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="new_password">New Password <span class="required">*</span></label>
            <div class="input-with-icon">
                <i class="fa-solid fa-key input-icon-left"></i>
                <input type="password" id="new_password" name="new_password" class="admin-input" required minlength="8" placeholder="Minimum 8 characters" autocomplete="new-password">
                <i class="fa-solid fa-eye password-toggle-icon" title="Toggle visibility"></i>
            </div>
            <p class="form-help">Ensure your password is at least 8 characters with a mix of letters and symbols.</p>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm New Password <span class="required">*</span></label>
            <div class="input-with-icon">
                <i class="fa-solid fa-shield-halved input-icon-left"></i>
                <input type="password" id="confirm_password" name="confirm_password" class="admin-input" required minlength="8" placeholder="Re-enter new password" autocomplete="new-password">
                <i class="fa-solid fa-eye password-toggle-icon" title="Toggle visibility"></i>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-shield-check"></i> Update Password & Re-authenticate
            </button>
            <a href="<?= baseUrl('admin_profile.php') ?>" class="btn-admin btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
