<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Service Categories</h1>
        <p>Manage treatment classifications (General, For Her, Couples) and structural sections.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_category_create.php') ?>" class="btn-admin btn-admin-gold">
            <i class="fa-solid fa-plus"></i> Add Category
        </a>
    </div>
</div>

<!-- Categories Table Card -->
<div class="admin-card">
    <?php if (empty($categories)): ?>
        <div class="admin-empty-state">
            <i class="fa-solid fa-layer-group empty-icon"></i>
            <h3 class="empty-title">No Categories Defined</h3>
            <p class="empty-desc">Create your primary service categories to organize therapies across the website.</p>
            <a href="<?= baseUrl('admin_category_create.php') ?>" class="btn-admin btn-admin-gold">Add Category</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Services Assigned</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><span class="badge-status badge-new"><?= e($cat['code']) ?></span></td>
                            <td><strong><?= e($cat['name']) ?></strong></td>
                            <td><small style="color:var(--admin-muted);"><?= e($cat['description'] ?? 'None') ?></small></td>
                            <td><strong><?= (int)($cat['service_count'] ?? 0) ?></strong> treatments</td>
                            <td><?= (int)$cat['display_order'] ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= baseUrl('admin_category_edit.php?id=' . (int)$cat['id']) ?>" class="btn-table-action" title="Edit Category">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="<?= baseUrl('admin_categories.php?action=delete&id=' . (int)$cat['id']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure? Services linked to this category may lose their classification.');">
                                        <?= CsrfService::getHiddenInput() ?>
                                        <button type="submit" class="btn-table-action action-delete" title="Delete Category">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
