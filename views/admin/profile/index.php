<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Administrator Profile</h1>
        <p>Manage your account name, administrative email address, and security preferences.</p>
    </div>
</div>

<div class="form-grid-2">
    <!-- Profile Edit Form -->
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="card-title-group">
                <h2>Profile Details</h2>
            </div>
        </div>

        <form action="<?= baseUrl('admin_profile.php') ?>" method="POST" enctype="multipart/form-data">
            <?= CsrfService::getHiddenInput() ?>

            <div class="form-group">
                <label for="name">Full Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="admin-input" required value="<?= e($admin['name'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="email">Administrator Email Address <span class="required">*</span></label>
                <input type="email" id="email" name="email" class="admin-input" required value="<?= e($admin['email'] ?? '') ?>">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-admin btn-admin-gold">
                    <i class="fa-solid fa-floppy-disk"></i> Update Profile
                </button>
            </div>
        </form>
    </div>

    <!-- Security & Account Info Card -->
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="card-title-group">
                <h2>Account Security</h2>
                <p>System credentials and activity log.</p>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;font-size:0.9rem;margin-bottom:24px;">
            <div>
                <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;">ACCOUNT STATUS</span>
                <p style="margin-top:2px;"><span class="badge-status badge-active"><?= e($admin['status'] ?? 'ACTIVE') ?></span></p>
            </div>

            <div>
                <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;">LAST LOGIN RECORDED</span>
                <p style="margin-top:2px;color:var(--admin-text-bright);">
                    <?= !empty($admin['last_login_at']) ? date('F d, Y \a\t H:i:s', strtotime($admin['last_login_at'])) : 'Recent Session' ?>
                </p>
            </div>

            <div>
                <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;">ACCOUNT CREATED</span>
                <p style="margin-top:2px;color:var(--admin-muted);">
                    <?= !empty($admin['created_at']) ? date('F d, Y', strtotime($admin['created_at'])) : 'System Default' ?>
                </p>
            </div>
        </div>

        <a href="<?= baseUrl('admin_change_password.php') ?>" class="btn-admin btn-admin-secondary" style="width:100%;">
            <i class="fa-solid fa-key"></i> Change Security Password
        </a>
    </div>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
