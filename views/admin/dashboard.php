<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Title & Header Actions -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Overview & Metrics</h1>
        <p>Real-time analytics and management control for Ceylon Therapist website.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_service_create.php') ?>" class="btn-admin btn-admin-gold">
            <i class="fa-solid fa-plus"></i> Add Treatment
        </a>
        <a href="<?= baseUrl('admin_package_create.php') ?>" class="btn-admin btn-admin-secondary">
            <i class="fa-solid fa-box-open"></i> Add Package
        </a>
    </div>
</div>

<!-- Primary Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-content">
            <span class="stat-label">Active Treatments</span>
            <span class="stat-value"><?= (int)($stats['total_treatments'] ?? 0) ?></span>
        </div>
        <div class="stat-icon-wrap">
            <i class="fa-solid fa-spa"></i>
        </div>
    </div>

    <div class="stat-card variant-warning">
        <div class="stat-content">
            <span class="stat-label">Active Packages</span>
            <span class="stat-value"><?= (int)($stats['active_packages'] ?? 0) ?></span>
        </div>
        <div class="stat-icon-wrap">
            <i class="fa-solid fa-box-open"></i>
        </div>
    </div>

    <div class="stat-card variant-burgundy">
        <div class="stat-content">
            <span class="stat-label">New Enquiries</span>
            <span class="stat-value"><?= (int)($stats['new_enquiries'] ?? 0) ?></span>
        </div>
        <div class="stat-icon-wrap">
            <i class="fa-solid fa-envelope-open-text"></i>
        </div>
    </div>

    <div class="stat-card variant-success">
        <div class="stat-content">
            <span class="stat-label">Confirmed Bookings</span>
            <span class="stat-value"><?= (int)($stats['confirmed_bookings'] ?? 0) ?></span>
        </div>
        <div class="stat-icon-wrap">
            <i class="fa-solid fa-calendar-check"></i>
        </div>
    </div>
</div>

<!-- Secondary Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-content">
            <span class="stat-label">For Her Sanctuary</span>
            <span class="stat-value"><?= (int)($stats['for_her_services'] ?? 0) ?></span>
        </div>
        <div class="stat-icon-wrap">
            <i class="fa-solid fa-venus"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <span class="stat-label">Couples Rituals</span>
            <span class="stat-value"><?= (int)($stats['couples_services'] ?? 0) ?></span>
        </div>
        <div class="stat-icon-wrap">
            <i class="fa-solid fa-heart"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <span class="stat-label">Pending Follow-ups</span>
            <span class="stat-value"><?= (int)($stats['pending_enquiries'] ?? 0) ?></span>
        </div>
        <div class="stat-icon-wrap">
            <i class="fa-solid fa-hourglass-half"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <span class="stat-label">Media Assets</span>
            <span class="stat-value"><?= (int)($stats['total_media'] ?? 0) ?></span>
        </div>
        <div class="stat-icon-wrap">
            <i class="fa-solid fa-images"></i>
        </div>
    </div>
</div>

<!-- Recent Booking Enquiries Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="card-title-group">
            <h2>Recent Enquiries & Booking Inquiries</h2>
            <p>Latest reservations submitted through WhatsApp direct booking and online forms.</p>
        </div>
        <a href="<?= baseUrl('admin_enquiries.php') ?>" class="btn-admin btn-admin-secondary btn-admin-sm">
            View All Enquiries <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <?php if (empty($recentEnquiries)): ?>
        <div class="admin-empty-state">
            <i class="fa-solid fa-inbox empty-icon"></i>
            <h3 class="empty-title">No Enquiries Received Yet</h3>
            <p class="empty-desc">When clients request appointments via WhatsApp or contact forms, they will appear here.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Ref #</th>
                        <th>Client Name</th>
                        <th>Phone / Contact</th>
                        <th>Selected Experience</th>
                        <th>Preferred Date & Time</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentEnquiries as $enq): ?>
                        <tr>
                            <td><strong>#<?= (int)$enq['id'] ?></strong></td>
                            <td><strong><?= e($enq['customer_name']) ?></strong></td>
                            <td>
                                <span><?= e($enq['phone'] ?: 'N/A') ?></span>
                                <?php if (!empty($enq['email'])): ?>
                                    <br><small style="color: var(--admin-muted);"><?= e($enq['email']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?= e($enq['service_name'] ?? ($enq['package_title'] ?? 'Custom Request')) ?></td>
                            <td>
                                <span><?= e($enq['preferred_date'] ?: 'Flexible Date') ?></span>
                                <?php if (!empty($enq['preferred_time'])): ?>
                                    <br><small style="color: var(--admin-gold-soft);"><?= e($enq['preferred_time']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge-status badge-<?= strtolower($enq['status']) ?>">
                                    <?= e($enq['status']) ?>
                                </span>
                            </td>
                            <td><small><?= date('M d, Y H:i', strtotime($enq['created_at'])) ?></small></td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= baseUrl('admin_enquiry_view.php?id=' . (int)$enq['id']) ?>" class="btn-table-action" title="View Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <?php if (!empty($enq['phone'])): ?>
                                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $enq['phone']) ?>?text=Hello%20<?= urlencode($enq['customer_name']) ?>%2C%20this%20is%20Ceylon%20Therapist%20regarding%20your%20booking%20enquiry." target="_blank" rel="noopener noreferrer" class="btn-table-action" style="color: #25D366;" title="Direct WhatsApp">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Active Treatments Preview -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="card-title-group">
            <h2>Active Treatments</h2>
            <p>Services currently displayed on public therapy menus.</p>
        </div>
        <a href="<?= baseUrl('admin_services.php') ?>" class="btn-admin btn-admin-secondary btn-admin-sm">
            Manage All Treatments <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <?php if (empty($activeServices)): ?>
        <div class="admin-empty-state">
            <i class="fa-solid fa-spa empty-icon"></i>
            <h3 class="empty-title">No Treatments Found</h3>
            <p class="empty-desc">Add treatments to display them in your online sanctuary catalogue.</p>
            <a href="<?= baseUrl('admin_service_create.php') ?>" class="btn-admin btn-admin-gold">Add Treatment</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Treatment</th>
                        <th>Category</th>
                        <th>Duration</th>
                        <th>Display Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activeServices as $srv): ?>
                        <tr>
                            <td>
                                <strong><?= e($srv['name']) ?></strong>
                                <?php if (!empty($srv['short_description'])): ?>
                                    <br><small style="color: var(--admin-muted);"><?= e(substr($srv['short_description'], 0, 60)) ?>...</small>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge-status badge-new"><?= e($srv['category_name'] ?? 'General') ?></span></td>
                            <td><?= (int)$srv['duration_minutes'] ?> mins</td>
                            <td><?= (int)$srv['display_order'] ?></td>
                            <td><span class="badge-status badge-active"><?= e($srv['status']) ?></span></td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= baseUrl('admin_service_edit.php?id=' . (int)$srv['id']) ?>" class="btn-table-action" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
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
