<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Edit Package</h1>
        <p>Modify package specifications for <strong><?= e($package['title']) ?></strong>.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_packages.php') ?>" class="btn-admin btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Packages
        </a>
    </div>
</div>

<!-- Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_package_edit.php?id=' . (int)$package['id']) ?>" method="POST" enctype="multipart/form-data">
        <?= CsrfService::getHiddenInput() ?>
        <input type="hidden" name="id" value="<?= (int)$package['id'] ?>">
        <input type="hidden" name="existing_image" value="<?= e($package['image'] ?? '') ?>">

        <div class="form-grid-2">
            <div class="form-group">
                <label for="title">Package Title <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="admin-input" required value="<?= e($package['title']) ?>">
            </div>

            <div class="form-group">
                <label for="slug">URL Slug <span class="required">*</span></label>
                <input type="text" id="slug" name="slug" class="admin-input" required value="<?= e($package['slug']) ?>">
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="duration_minutes">Total Duration (Minutes) <span class="required">*</span></label>
                <input type="number" id="duration_minutes" name="duration_minutes" class="admin-input" required min="30" step="15" value="<?= (int)$package['duration_minutes'] ?>">
            </div>

            <div class="form-group">
                <label for="status">Status <span class="required">*</span></label>
                <select id="status" name="status" class="admin-select" required>
                    <option value="ACTIVE" <?= $package['status'] === 'ACTIVE' ? 'selected' : '' ?>>ACTIVE (Visible to Public)</option>
                    <option value="INACTIVE" <?= $package['status'] === 'INACTIVE' ? 'selected' : '' ?>>INACTIVE (Hidden)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="short_description">Short Summary</label>
            <input type="text" id="short_description" name="short_description" class="admin-input" value="<?= e($package['short_description'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" class="admin-textarea" rows="5"><?= e($package['description'] ?? '') ?></textarea>
        </div>

        <!-- Included Services Multi-Select Checkboxes -->
        <div class="form-group">
            <label>Include Individual Treatments In This Package</label>
            <div class="form-checkbox-group">
                <?php foreach ($allServices as $srv): ?>
                    <label class="checkbox-label">
                        <input type="checkbox" name="services[]" value="<?= (int)$srv['id'] ?>" <?= in_array($srv['id'], $selectedServiceIds) ? 'checked' : '' ?>>
                        <span><?= e($srv['name']) ?> (<?= (int)$srv['duration_minutes'] ?>m)</span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="image">Package Image <span style="color:var(--admin-muted);font-weight:normal;">(JPG, PNG, WEBP &bull; Max 5MB)</span></label>
                <?php if (!empty($package['image'])): ?>
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:10px;">
                        <img src="<?= baseUrl($package['image']) ?>" alt="Current Image" style="width:60px;height:60px;object-fit:cover;border-radius:6px;border:1px solid var(--admin-border);">
                        <small style="color:var(--admin-muted);">Current: <?= e($package['image']) ?></small>
                    </div>
                <?php endif; ?>
                <input type="file" id="image" name="image" class="admin-input" accept="image/jpeg,image/png,image/webp">
            </div>

            <div class="form-group">
                <label for="display_order">Display Order</label>
                <input type="number" id="display_order" name="display_order" class="admin-input" value="<?= (int)$package['display_order'] ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Update Package
            </button>
            <a href="<?= baseUrl('admin_packages.php') ?>" class="btn-admin btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
