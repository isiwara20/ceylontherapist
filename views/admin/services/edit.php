<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Edit Treatment</h1>
        <p>Modify therapy specifications, descriptions, duration, and status for <strong><?= e($service['name']) ?></strong>.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_services.php') ?>" class="btn-admin btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Treatments
        </a>
    </div>
</div>

<!-- Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_service_edit.php?id=' . (int)$service['id']) ?>" method="POST" enctype="multipart/form-data">
        <?= CsrfService::getHiddenInput() ?>
        <input type="hidden" name="id" value="<?= (int)$service['id'] ?>">
        <input type="hidden" name="existing_image" value="<?= e($service['image'] ?? '') ?>">

        <div class="form-grid-2">
            <!-- Treatment Name -->
            <div class="form-group">
                <label for="name">Treatment Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="admin-input" required value="<?= e($service['name']) ?>">
            </div>

            <!-- Slug -->
            <div class="form-group">
                <label for="slug">URL Slug <span class="required">*</span></label>
                <input type="text" id="slug" name="slug" class="admin-input" required value="<?= e($service['slug']) ?>">
            </div>
        </div>

        <div class="form-grid-3">
            <!-- Category -->
            <div class="form-group">
                <label for="category_id">Category <span class="required">*</span></label>
                <select id="category_id" name="category_id" class="admin-select" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= (int)$cat['id'] ?>" <?= (int)$service['category_id'] === (int)$cat['id'] ? 'selected' : '' ?>>
                            <?= e($cat['name']) ?> (<?= e($cat['code']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Duration -->
            <div class="form-group">
                <label for="duration_minutes">Duration (Minutes) <span class="required">*</span></label>
                <input type="number" id="duration_minutes" name="duration_minutes" class="admin-input" required min="15" step="15" value="<?= (int)$service['duration_minutes'] ?>">
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status <span class="required">*</span></label>
                <select id="status" name="status" class="admin-select" required>
                    <option value="ACTIVE" <?= $service['status'] === 'ACTIVE' ? 'selected' : '' ?>>ACTIVE (Visible to Public)</option>
                    <option value="INACTIVE" <?= $service['status'] === 'INACTIVE' ? 'selected' : '' ?>>INACTIVE (Hidden)</option>
                </select>
            </div>
        </div>

        <!-- Short Description -->
        <div class="form-group">
            <label for="short_description">Short Summary / Tagline</label>
            <input type="text" id="short_description" name="short_description" class="admin-input" value="<?= e($service['short_description'] ?? '') ?>">
        </div>

        <!-- Full Description -->
        <div class="form-group">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" class="admin-textarea" rows="6"><?= e($service['description'] ?? '') ?></textarea>
        </div>

        <div class="form-grid-2">
            <!-- Image Upload & Preview -->
            <div class="form-group">
                <label for="image">Replace Image <span style="color:var(--admin-muted);font-weight:normal;">(JPG, PNG, WEBP &bull; Max 5MB)</span></label>
                <?php if (!empty($service['image'])): ?>
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:10px;">
                        <img src="<?= baseUrl($service['image']) ?>" alt="Current Image" style="width:60px;height:60px;object-fit:cover;border-radius:6px;border:1px solid var(--admin-border);">
                        <small style="color:var(--admin-muted);">Current: <?= e($service['image']) ?></small>
                    </div>
                <?php endif; ?>
                <input type="file" id="image" name="image" class="admin-input" accept="image/jpeg,image/png,image/webp">
            </div>

            <!-- Display Order -->
            <div class="form-group">
                <label for="display_order">Display Order <span style="color:var(--admin-muted);font-weight:normal;">(Lower numbers show first)</span></label>
                <input type="number" id="display_order" name="display_order" class="admin-input" value="<?= (int)$service['display_order'] ?>">
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Update Treatment
            </button>
            <a href="<?= baseUrl('admin_services.php') ?>" class="btn-admin btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
