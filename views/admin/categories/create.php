<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Add New Category</h1>
        <p>Define a new service classification or menu group.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_categories.php') ?>" class="btn-admin btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Categories
        </a>
    </div>
</div>

<!-- Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_category_create.php') ?>" method="POST">
        <?= CsrfService::getHiddenInput() ?>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="name">Category Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="admin-input" required placeholder="e.g. Signature Therapy" value="<?= e(post('name', '')) ?>">
            </div>

            <div class="form-group">
                <label for="code">Category Code <span class="required">*</span></label>
                <input type="text" id="code" name="code" class="admin-input" required placeholder="e.g. SIGNATURE" value="<?= e(post('code', '')) ?>">
                <p class="form-help">Uppercase alphanumeric identifier (e.g. GENERAL, FOR_HER, COUPLES).</p>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="admin-textarea" rows="3" placeholder="Brief summary of treatments in this category..."><?= e(post('description', '')) ?></textarea>
        </div>

        <div class="form-group" style="max-width: 300px;">
            <label for="display_order">Display Order</label>
            <input type="number" id="display_order" name="display_order" class="admin-input" value="<?= e(post('display_order', '0')) ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Create Category
            </button>
            <a href="<?= baseUrl('admin_categories.php') ?>" class="btn-admin btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
