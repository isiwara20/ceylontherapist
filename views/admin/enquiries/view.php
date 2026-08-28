<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Reservation Request #<?= (int)$enquiry['id'] ?></h1>
        <p>Submitted by <strong><?= e($enquiry['customer_name']) ?></strong> on <?= date('F d, Y \a\t H:i', strtotime($enquiry['created_at'])) ?>.</p>
    </div>
    <div class="admin-header-actions">
        <a href="<?= baseUrl('admin_enquiries.php') ?>" class="btn-admin btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to Enquiries
        </a>
    </div>
</div>

<div class="form-grid-2">
    <!-- Client & Request Details Card -->
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="card-title-group">
                <h2>Client & Reservation Details</h2>
            </div>
            <span class="badge-status badge-<?= strtolower($enquiry['status']) ?>">
                <?= e($enquiry['status']) ?>
            </span>
        </div>

        <div style="display:flex;flex-direction:column;gap:18px;font-size:0.9rem;">
            <div>
                <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;text-transform:uppercase;">CLIENT NAME</span>
                <p style="font-size:1.1rem;font-weight:600;color:var(--admin-text-bright);margin-top:2px;"><?= e($enquiry['customer_name']) ?></p>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;text-transform:uppercase;">PHONE NUMBER</span>
                    <p style="margin-top:2px;">
                        <a href="tel:<?= e($enquiry['phone']) ?>" style="color:var(--admin-text-bright);text-decoration:none;font-weight:600;"><?= e($enquiry['phone'] ?: 'N/A') ?></a>
                    </p>
                </div>
                <div>
                    <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;text-transform:uppercase;">EMAIL ADDRESS</span>
                    <p style="margin-top:2px;">
                        <a href="mailto:<?= e($enquiry['email']) ?>" style="color:var(--admin-text-bright);text-decoration:none;"><?= e($enquiry['email'] ?: 'N/A') ?></a>
                    </p>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;text-transform:uppercase;">SELECTED EXPERIENCE</span>
                    <p style="font-weight:600;color:var(--admin-text-bright);margin-top:2px;">
                        <?= e($enquiry['service_name'] ?? ($enquiry['package_title'] ?? 'Custom Request')) ?>
                    </p>
                </div>
                <div>
                    <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;text-transform:uppercase;">ESTIMATED DURATION</span>
                    <p style="margin-top:2px;"><?= (int)($enquiry['service_duration'] ?? ($enquiry['package_duration'] ?? 60)) ?> minutes</p>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;text-transform:uppercase;">PREFERRED DATE</span>
                    <p style="margin-top:2px;font-weight:600;color:var(--admin-text-bright);"><?= e($enquiry['preferred_date'] ?: 'Flexible') ?></p>
                </div>
                <div>
                    <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;text-transform:uppercase;">PREFERRED TIME</span>
                    <p style="margin-top:2px;font-weight:600;color:var(--admin-gold-soft);"><?= e($enquiry['preferred_time'] ?: 'Flexible') ?></p>
                </div>
            </div>

            <div>
                <span style="font-size:0.75rem;font-weight:700;color:var(--admin-gold);letter-spacing:1px;text-transform:uppercase;">SPECIAL INSTRUCTIONS / NOTES</span>
                <div style="background:var(--admin-surface-2);border:1px solid var(--admin-border-subtle);border-radius:6px;padding:12px;margin-top:6px;color:var(--admin-text);line-height:1.6;">
                    <?= nl2br(e($enquiry['message'] ?: 'No special notes provided.')) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions & Status Update Card -->
    <div class="admin-card">
        <div class="admin-card-header">
            <div class="card-title-group">
                <h2>Direct Communication & Actions</h2>
                <p>Respond to the client or update internal reservation status.</p>
            </div>
        </div>

        <!-- Direct Actions -->
        <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:30px;">
            <?php if (!empty($enquiry['phone'])): ?>
                <a href="<?= $whatsAppUrl ?>" target="_blank" rel="noopener noreferrer" class="btn-admin btn-admin-whatsapp" style="width:100%;padding:14px;">
                    <i class="fa-brands fa-whatsapp" style="font-size:1.2rem;"></i> Open WhatsApp Chat with Client
                </a>
                <a href="tel:<?= e($enquiry['phone']) ?>" class="btn-admin btn-admin-secondary" style="width:100%;">
                    <i class="fa-solid fa-phone"></i> Call <?= e($enquiry['phone']) ?>
                </a>
            <?php endif; ?>

            <?php if (!empty($enquiry['email'])): ?>
                <a href="mailto:<?= e($enquiry['email']) ?>?subject=<?= urlencode('Your Booking at Ceylon Therapist - Ref #' . $enquiry['id']) ?>" class="btn-admin btn-admin-secondary" style="width:100%;">
                    <i class="fa-solid fa-envelope"></i> Send Email to Client
                </a>
            <?php endif; ?>
        </div>

        <!-- Update Status Form -->
        <form action="<?= baseUrl('admin_enquiry_view.php?id=' . (int)$enquiry['id']) ?>" method="POST">
            <?= CsrfService::getHiddenInput() ?>
            <input type="hidden" name="id" value="<?= (int)$enquiry['id'] ?>">

            <div class="form-group">
                <label for="status">Update Status <span class="required">*</span></label>
                <select id="status" name="status" class="admin-select" required>
                    <option value="NEW" <?= $enquiry['status'] === 'NEW' ? 'selected' : '' ?>>NEW (Unreviewed)</option>
                    <option value="CONTACTED" <?= $enquiry['status'] === 'CONTACTED' ? 'selected' : '' ?>>CONTACTED (Messaged Client)</option>
                    <option value="CONFIRMED" <?= $enquiry['status'] === 'CONFIRMED' ? 'selected' : '' ?>>CONFIRMED (Appointment Booked)</option>
                    <option value="CANCELLED" <?= $enquiry['status'] === 'CANCELLED' ? 'selected' : '' ?>>CANCELLED (Client or Studio Cancelled)</option>
                    <option value="COMPLETED" <?= $enquiry['status'] === 'COMPLETED' ? 'selected' : '' ?>>COMPLETED (Session Finished)</option>
                </select>
            </div>

            <div class="form-actions" style="margin-top:20px;padding-top:16px;">
                <button type="submit" class="btn-admin btn-admin-gold" style="width:100%;">
                    <i class="fa-solid fa-check"></i> Save Status Update
                </button>
            </div>
        </form>
    </div>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
