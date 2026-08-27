<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<div class="admin-panel-card">
    <div class="card-header-flex">
        <h2>Wellness Packages Directory</h2>
        <a href="<?= baseUrl('admin_package_create.php') ?>" class="btn-admin-action">
            <i class="fa-solid fa-plus"></i> Add New Package
        </a>
    </div>

    <div class="table-responsive mt-20">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Package Title</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($packages)): ?>
                    <?php foreach ($packages as $pkg): ?>
                        <tr>
                            <td>#<?= e((string)$pkg['id']) ?></td>
                            <td><strong><?= e($pkg['title']) ?></strong></td>
                            <td><?= e((string)$pkg['duration_minutes']) ?> mins</td>
                            <td><span class="status-pill status-active"><?= e($pkg['status']) ?></span></td>
                            <td>
                                <a href="<?= baseUrl('admin_package_edit.php?id=' . $pkg['id']) ?>" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No wellness packages found in database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
