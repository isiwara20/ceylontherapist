<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon icon-bg-burgundy">
            <i class="fa-solid fa-spa"></i>
        </div>
        <div class="stat-details">
            <h3><?= e((string)($stats['total_services'] ?? 0)) ?></h3>
            <p>Active Services & Treatments</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-bg-gold">
            <i class="fa-solid fa-box-open"></i>
        </div>
        <div class="stat-details">
            <h3><?= e((string)($stats['total_packages'] ?? 0)) ?></h3>
            <p>Wellness Packages</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon icon-bg-dark">
            <i class="fa-brands fa-whatsapp"></i>
        </div>
        <div class="stat-details">
            <h3><?= e((string)($stats['total_enquiries'] ?? 0)) ?></h3>
            <p>Booking Enquiries Recorded</p>
        </div>
    </div>
</div>

<div class="admin-panel-card mt-30">
    <div class="card-header-flex">
        <h2>Recent Booking Enquiries</h2>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Service / Package</th>
                    <th>Date & Time</th>
                    <th>Source</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($recentEnquiries)): ?>
                    <?php foreach ($recentEnquiries as $enquiry): ?>
                        <tr>
                            <td>#<?= e((string)$enquiry['id']) ?></td>
                            <td>
                                <strong><?= e($enquiry['customer_name']) ?></strong><br>
                                <small><?= e($enquiry['phone'] ?? $enquiry['email'] ?? 'N/A') ?></small>
                            </td>
                            <td><?= e($enquiry['service_name'] ?? $enquiry['package_name'] ?? 'General Inquiry') ?></td>
                            <td><?= e($enquiry['preferred_date'] ?? 'Flexible') ?> <?= e($enquiry['preferred_time'] ?? '') ?></td>
                            <td><span class="badge-source"><?= e($enquiry['source'] ?? 'WHATSAPP') ?></span></td>
                            <td><span class="status-pill status-new"><?= e($enquiry['status'] ?? 'NEW') ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No recent booking enquiries recorded yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
