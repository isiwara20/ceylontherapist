<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Reservations & Enquiries</h1>
        <p>Monitor private booking requests submitted via WhatsApp and Website forms.</p>
    </div>
</div>

<!-- Filters Bar Card -->
<div class="admin-card">
    <form action="" method="GET" class="filter-form">
        <div class="filter-input-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" class="admin-input" placeholder="Search client name, phone or email..." value="<?= e($_GET['search'] ?? '') ?>">
        </div>

        <div style="min-width: 160px;">
            <select name="status" class="admin-select" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                <option value="NEW" <?= (isset($_GET['status']) && $_GET['status'] === 'NEW') ? 'selected' : '' ?>>NEW</option>
                <option value="CONTACTED" <?= (isset($_GET['status']) && $_GET['status'] === 'CONTACTED') ? 'selected' : '' ?>>CONTACTED</option>
                <option value="CONFIRMED" <?= (isset($_GET['status']) && $_GET['status'] === 'CONFIRMED') ? 'selected' : '' ?>>CONFIRMED</option>
                <option value="CANCELLED" <?= (isset($_GET['status']) && $_GET['status'] === 'CANCELLED') ? 'selected' : '' ?>>CANCELLED</option>
                <option value="COMPLETED" <?= (isset($_GET['status']) && $_GET['status'] === 'COMPLETED') ? 'selected' : '' ?>>COMPLETED</option>
            </select>
        </div>

        <div style="min-width: 140px;">
            <select name="source" class="admin-select" onchange="this.form.submit()">
                <option value="">All Sources</option>
                <option value="WHATSAPP" <?= (isset($_GET['source']) && $_GET['source'] === 'WHATSAPP') ? 'selected' : '' ?>>WHATSAPP</option>
                <option value="EMAIL" <?= (isset($_GET['source']) && $_GET['source'] === 'EMAIL') ? 'selected' : '' ?>>EMAIL</option>
            </select>
        </div>

        <button type="submit" class="btn-admin btn-admin-secondary">Filter</button>
        <?php if (!empty($_GET['search']) || !empty($_GET['status']) || !empty($_GET['source'])): ?>
            <a href="<?= baseUrl('admin_enquiries.php') ?>" class="btn-admin btn-admin-secondary" style="color:var(--admin-muted);">Reset</a>
        <?php endif; ?>
    </form>
</div>

<!-- Enquiries Table Card -->
<div class="admin-card">
    <?php if (empty($enquiries)): ?>
        <div class="admin-empty-state">
            <i class="fa-solid fa-calendar-xmark empty-icon"></i>
            <h3 class="empty-title">No Enquiries Found</h3>
            <p class="empty-desc">No appointment requests matching your current filter filters were found.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Ref #</th>
                        <th>Client Details</th>
                        <th>Service / Package</th>
                        <th>Requested Date & Time</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enquiries as $enq): ?>
                        <tr>
                            <td><strong>#<?= (int)$enq['id'] ?></strong></td>
                            <td>
                                <strong><?= e($enq['customer_name']) ?></strong>
                                <?php if (!empty($enq['phone'])): ?>
                                    <br><small><a href="tel:<?= e($enq['phone']) ?>" style="color:var(--admin-gold-soft);text-decoration:none;"><?= e($enq['phone']) ?></a></small>
                                <?php endif; ?>
                                <?php if (!empty($enq['email'])): ?>
                                    <br><small style="color:var(--admin-muted);"><?= e($enq['email']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= e($enq['service_name'] ?? ($enq['package_title'] ?? 'Custom Inquiry')) ?></strong>
                            </td>
                            <td>
                                <span><?= e($enq['preferred_date'] ?: 'Flexible Date') ?></span>
                                <?php if (!empty($enq['preferred_time'])): ?>
                                    <br><small style="color:var(--admin-gold-soft);"><?= e($enq['preferred_time']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge-status badge-new">
                                    <?= e($enq['source']) ?>
                                </span>
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
                                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $enq['phone']) ?>?text=Hello%20<?= urlencode($enq['customer_name']) ?>%2C%20this%20is%20Ceylon%20Therapist." target="_blank" rel="noopener noreferrer" class="btn-table-action" style="color: #25D366;" title="Contact on WhatsApp">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    <?php endif; ?>

                                    <form action="<?= baseUrl('admin_enquiries.php?action=delete&id=' . (int)$enq['id']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this enquiry record?');">
                                        <?= CsrfService::getHiddenInput() ?>
                                        <button type="submit" class="btn-table-action action-delete" title="Delete Enquiry">
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

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div class="admin-pagination">
                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <a href="?page=<?= $p ?><?= !empty($_GET['status']) ? '&status=' . urlencode($_GET['status']) : '' ?><?= !empty($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>" class="page-btn <?= $page === $p ? 'active' : '' ?>">
                        <?= $p ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
