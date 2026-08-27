<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<div class="admin-panel-card">
    <div class="card-header-flex">
        <h2>Services & Treatments Directory</h2>
        <a href="<?= baseUrl('admin_service_create.php') ?>" class="btn-admin-action">
            <i class="fa-solid fa-plus"></i> Add New Treatment
        </a>
    </div>

    <div class="table-responsive mt-20">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Treatment Name</th>
                    <th>Category</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td>#<?= e((string)$service['id']) ?></td>
                            <td><strong><?= e($service['name']) ?></strong></td>
                            <td><?= e($service['category_name'] ?? 'General') ?></td>
                            <td><?= e((string)$service['duration_minutes']) ?> mins</td>
                            <td><span class="status-pill status-active"><?= e($service['status']) ?></span></td>
                            <td>
                                <a href="<?= baseUrl('admin_service_edit.php?id=' . $service['id']) ?>" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No services found in database. Seed data script available in <code>/database/seed.sql</code>.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
