<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Add New Package</h1>
        <p>Design a bespoke wellness combination session.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_packages.php') ?>" class="btn-admin btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Packages
        </a>
    </div>
</div>

<!-- Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_package_create.php') ?>" method="POST" enctype="multipart/form-data">
        <?= CsrfService::getHiddenInput() ?>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="title">Package Title <span class="required">*</span></label>
                <input type="text" id="title" name="title" class="admin-input" required placeholder="e.g. Total Sanctuary Signature Ritual" value="<?= e(post('title', '')) ?>">
            </div>

            <div class="form-group">
                <label for="slug">URL Slug <span style="color:var(--admin-muted);font-weight:normal;">(Auto-generated if empty)</span></label>
                <input type="text" id="slug" name="slug" class="admin-input" placeholder="e.g. total-sanctuary-signature-ritual" value="<?= e(post('slug', '')) ?>">
            </div>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="duration_minutes">Total Duration (Minutes) <span class="required">*</span></label>
                <input type="number" id="duration_minutes" name="duration_minutes" class="admin-input" required min="30" step="15" value="<?= e(post('duration_minutes', '90')) ?>">
            </div>

            <div class="form-group">
                <label for="status">Status <span class="required">*</span></label>
                <select id="status" name="status" class="admin-select" required>
                    <option value="ACTIVE" <?= post('status', 'ACTIVE') === 'ACTIVE' ? 'selected' : '' ?>>ACTIVE (Visible to Public)</option>
                    <option value="INACTIVE" <?= post('status') === 'INACTIVE' ? 'selected' : '' ?>>INACTIVE (Hidden)</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="short_description">Short Summary</label>
            <input type="text" id="short_description" name="short_description" class="admin-input" placeholder="Brief 1-sentence highlight of the combined experience" value="<?= e(post('short_description', '')) ?>">
        </div>

        <div class="form-group">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" class="admin-textarea" rows="5" placeholder="Detailed itinerary and benefits of this combination package..."><?= e(post('description', '')) ?></textarea>
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
                <input type="file" id="image" name="image" class="admin-input" accept="image/jpeg,image/png,image/webp">
            </div>

            <div class="form-group">
                <label for="display_order">Display Order</label>
                <input type="number" id="display_order" name="display_order" class="admin-input" value="<?= e(post('display_order', '0')) ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Create Package
            </button>
            <a href="<?= baseUrl('admin_packages.php') ?>" class="btn-admin btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
