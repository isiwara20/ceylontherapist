<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Title & Header Actions -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1><?= e($pageTitle ?? 'Treatments & Services') ?></h1>
        <p>Manage all therapeutic experiences, descriptions, duration, and display settings.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_service_create.php') ?>" class="btn-admin btn-admin-gold">
            <i class="fa-solid fa-plus"></i> Add New Treatment
        </a>
    </div>
</div>

<!-- Filters Bar -->
<div class="admin-card">
    <form action="" method="GET" class="filter-form">
        <div class="filter-input-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" class="admin-input" placeholder="Search treatment by name or keyword..." value="<?= e($_GET['search'] ?? '') ?>">
        </div>

        <?php if (!isset($categoryFilter)): ?>
            <div style="min-width: 200px;">
                <select name="category" class="admin-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= e($cat['code']) ?>" <?= (isset($_GET['category']) && $_GET['category'] === $cat['code']) ? 'selected' : '' ?>>
                            <?= e($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn-admin btn-admin-secondary">Filter</button>
        <?php if (!empty($_GET['search']) || !empty($_GET['category'])): ?>
            <a href="<?= baseUrl(basename($_SERVER['PHP_SELF'])) ?>" class="btn-admin btn-admin-secondary" style="color: var(--admin-muted);">Reset</a>
        <?php endif; ?>
    </form>
</div>

<!-- Treatments Table Card -->
<div class="admin-card">
    <?php if (empty($services)): ?>
        <div class="admin-empty-state">
            <i class="fa-solid fa-spa empty-icon"></i>
            <h3 class="empty-title">No Treatments Found</h3>
            <p class="empty-desc">No treatments matched your criteria. Add a new service to enrich your sanctuary menu.</p>
            <a href="<?= baseUrl('admin_service_create.php') ?>" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-plus"></i> Add Treatment
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">Image</th>
                        <th>Treatment Name</th>
                        <th>Category</th>
                        <th>Duration</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $srv): ?>
                        <tr>
                            <td>
                                <?php if (!empty($srv['image'])): ?>
                                    <img src="<?= baseUrl($srv['image']) ?>" alt="<?= e($srv['name']) ?>" class="table-thumb">
                                <?php else: ?>
                                    <div class="table-thumb" style="display:flex;align-items:center;justify-content:center;color:var(--admin-gold);">
                                        <i class="fa-solid fa-spa"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= e($srv['name']) ?></strong>
                                <?php if (!empty($srv['short_description'])): ?>
                                    <br><small style="color: var(--admin-muted);"><?= e(substr($srv['short_description'], 0, 70)) ?>...</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge-status badge-new"><?= e($srv['category_name'] ?? 'General') ?></span>
                            </td>
                            <td><strong><?= (int)$srv['duration_minutes'] ?></strong> mins</td>
                            <td><?= (int)$srv['display_order'] ?></td>
                            <td>
                                <span class="badge-status badge-<?= strtolower($srv['status']) ?>">
                                    <?= e($srv['status']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= baseUrl('admin_service_edit.php?id=' . (int)$srv['id']) ?>" class="btn-table-action" title="Edit Treatment">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="<?= baseUrl('admin_services.php?action=toggle&id=' . (int)$srv['id']) ?>" method="POST" style="display:inline;">
                                        <?= CsrfService::getHiddenInput() ?>
                                        <button type="submit" class="btn-table-action" title="Toggle Status (Active / Inactive)">
                                            <i class="fa-solid fa-power-off"></i>
                                        </button>
                                    </form>

                                    <form action="<?= baseUrl('admin_services.php?action=delete&id=' . (int)$srv['id']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to permanently delete this treatment?');">
                                        <?= CsrfService::getHiddenInput() ?>
                                        <button type="submit" class="btn-table-action action-delete" title="Delete Treatment">
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
