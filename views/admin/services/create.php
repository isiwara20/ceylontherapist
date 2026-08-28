<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Add New Treatment</h1>
        <p>Create a new wellness therapy experience for the Ceylon Therapist menu.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_services.php') ?>" class="btn-admin btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Treatments
        </a>
    </div>
</div>

<!-- Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_service_create.php') ?>" method="POST" enctype="multipart/form-data">
        <?= CsrfService::getHiddenInput() ?>

        <div class="form-grid-2">
            <!-- Treatment Name -->
            <div class="form-group">
                <label for="name">Treatment Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="admin-input" required placeholder="e.g. Deep Restorative Body Therapy" value="<?= e(post('name', '')) ?>">
            </div>

            <!-- Slug -->
            <div class="form-group">
                <label for="slug">URL Slug <span style="color:var(--admin-muted);font-weight:normal;">(Auto-generated if left empty)</span></label>
                <input type="text" id="slug" name="slug" class="admin-input" placeholder="e.g. deep-restorative-body-therapy" value="<?= e(post('slug', '')) ?>">
            </div>
        </div>

        <div class="form-grid-3">
            <!-- Category -->
            <div class="form-group">
                <label for="category_id">Category <span class="required">*</span></label>
                <select id="category_id" name="category_id" class="admin-select" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= (int)$cat['id'] ?>" <?= post('category_id') == $cat['id'] ? 'selected' : '' ?>>
                            <?= e($cat['name']) ?> (<?= e($cat['code']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Duration -->
            <div class="form-group">
                <label for="duration_minutes">Duration (Minutes) <span class="required">*</span></label>
                <input type="number" id="duration_minutes" name="duration_minutes" class="admin-input" required min="15" step="15" value="<?= e(post('duration_minutes', '60')) ?>">
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status <span class="required">*</span></label>
                <select id="status" name="status" class="admin-select" required>
                    <option value="ACTIVE" <?= post('status', 'ACTIVE') === 'ACTIVE' ? 'selected' : '' ?>>ACTIVE (Visible to Public)</option>
                    <option value="INACTIVE" <?= post('status') === 'INACTIVE' ? 'selected' : '' ?>>INACTIVE (Hidden)</option>
                </select>
            </div>
        </div>

        <!-- Short Description -->
        <div class="form-group">
            <label for="short_description">Short Summary / Tagline</label>
            <input type="text" id="short_description" name="short_description" class="admin-input" placeholder="Brief 1-2 sentence description displayed on catalogue cards" value="<?= e(post('short_description', '')) ?>">
        </div>

        <!-- Full Description -->
        <div class="form-group">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" class="admin-textarea" rows="5" placeholder="Comprehensive description of the therapeutic benefits, technique and atmosphere..."><?= e(post('description', '')) ?></textarea>
        </div>

        <div class="form-grid-2">
            <!-- Image Upload -->
            <div class="form-group">
                <label for="image">Upload Image <span style="color:var(--admin-muted);font-weight:normal;">(JPG, PNG, WEBP &bull; Max 5MB)</span></label>
                <input type="file" id="image" name="image" class="admin-input" accept="image/jpeg,image/png,image/webp">
                <p class="form-help">Leave empty to use the default sanctuary visual asset.</p>
            </div>

            <!-- Display Order -->
            <div class="form-group">
                <label for="display_order">Display Order <span style="color:var(--admin-muted);font-weight:normal;">(Lower numbers show first)</span></label>
                <input type="number" id="display_order" name="display_order" class="admin-input" value="<?= e(post('display_order', '0')) ?>">
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Create Treatment
            </button>
            <a href="<?= baseUrl('admin_services.php') ?>" class="btn-admin btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
