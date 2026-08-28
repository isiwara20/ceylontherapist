<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Wellness Packages</h1>
        <p>Curated wellness journeys combining multiple therapeutic treatments.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_package_create.php') ?>" class="btn-admin btn-admin-gold">
            <i class="fa-solid fa-plus"></i> Add New Package
        </a>
    </div>
</div>

<!-- Filters Bar -->
<div class="admin-card">
    <form action="" method="GET" class="filter-form">
        <div class="filter-input-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" class="admin-input" placeholder="Search package by title..." value="<?= e($_GET['search'] ?? '') ?>">
        </div>
        <button type="submit" class="btn-admin btn-admin-secondary">Search</button>
        <?php if (!empty($_GET['search'])): ?>
            <a href="<?= baseUrl('admin_packages.php') ?>" class="btn-admin btn-admin-secondary" style="color:var(--admin-muted);">Reset</a>
        <?php endif; ?>
    </form>
</div>

<!-- Packages Table Card -->
<div class="admin-card">
    <?php if (empty($packages)): ?>
        <div class="admin-empty-state">
            <i class="fa-solid fa-box-open empty-icon"></i>
            <h3 class="empty-title">No Wellness Packages Found</h3>
            <p class="empty-desc">Create your first wellness combination package to offer bespoke extended rituals.</p>
            <a href="<?= baseUrl('admin_package_create.php') ?>" class="btn-admin btn-admin-gold">Add Package</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">Image</th>
                        <th>Package Title</th>
                        <th>Duration</th>
                        <th>Included Therapies</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($packages as $pkg): ?>
                        <tr>
                            <td>
                                <?php if (!empty($pkg['image'])): ?>
                                    <img src="<?= baseUrl($pkg['image']) ?>" alt="<?= e($pkg['title']) ?>" class="table-thumb">
                                <?php else: ?>
                                    <div class="table-thumb" style="display:flex;align-items:center;justify-content:center;color:var(--admin-gold);">
                                        <i class="fa-solid fa-box-open"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= e($pkg['title']) ?></strong>
                                <?php if (!empty($pkg['short_description'])): ?>
                                    <br><small style="color: var(--admin-muted);"><?= e(substr($pkg['short_description'], 0, 70)) ?>...</small>
                                <?php endif; ?>
                            </td>
                            <td><strong><?= (int)$pkg['duration_minutes'] ?></strong> mins</td>
                            <td>
                                <span class="badge-status badge-new"><?= (int)($pkg['service_count'] ?? 0) ?> services</span>
                            </td>
                            <td><?= (int)$pkg['display_order'] ?></td>
                            <td>
                                <span class="badge-status badge-<?= strtolower($pkg['status']) ?>">
                                    <?= e($pkg['status']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= baseUrl('admin_package_edit.php?id=' . (int)$pkg['id']) ?>" class="btn-table-action" title="Edit Package">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="<?= baseUrl('admin_packages.php?action=toggle&id=' . (int)$pkg['id']) ?>" method="POST" style="display:inline;">
                                        <?= CsrfService::getHiddenInput() ?>
                                        <button type="submit" class="btn-table-action" title="Toggle Status">
                                            <i class="fa-solid fa-power-off"></i>
                                        </button>
                                    </form>

                                    <form action="<?= baseUrl('admin_packages.php?action=delete&id=' . (int)$pkg['id']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this package?');">
                                        <?= CsrfService::getHiddenInput() ?>
                                        <button type="submit" class="btn-table-action action-delete" title="Delete Package">
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
