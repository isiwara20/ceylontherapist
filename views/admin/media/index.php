<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Media Library</h1>
        <p>Upload and manage high-resolution imagery for treatments, banners, and atmosphere showcases.</p>
    </div>
</div>

<!-- Upload New Media Card -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="card-title-group">
            <h3>Upload New Image</h3>
            <p>Supported formats: JPG, PNG, WEBP &bull; Max file size: 5MB</p>
        </div>
    </div>

    <form action="<?= baseUrl('admin_media.php') ?>" method="POST" enctype="multipart/form-data" class="form-grid-2" style="align-items:flex-end;">
        <?= CsrfService::getHiddenInput() ?>

        <div class="form-group" style="margin-bottom:0;">
            <label for="media_file">Choose Image File <span class="required">*</span></label>
            <input type="file" id="media_file" name="media_file" class="admin-input" required accept="image/jpeg,image/png,image/webp">
        </div>

        <div class="form-group" style="margin-bottom:0;">
            <label for="alt_text">Descriptive Label / Alt Text</label>
            <div style="display:flex;gap:12px;">
                <input type="text" id="alt_text" name="alt_text" class="admin-input" placeholder="e.g. Aromatherapy Treatment Oil">
                <button type="submit" class="btn-admin btn-admin-gold" style="white-space:nowrap;">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Media Gallery Grid Card -->
<div class="admin-card">
    <div class="admin-card-header">
        <div class="card-title-group">
            <h2>Available Media Assets (<?= count($mediaList) ?>)</h2>
        </div>
    </div>

    <?php if (empty($mediaList)): ?>
        <div class="admin-empty-state">
            <i class="fa-solid fa-images empty-icon"></i>
            <h3 class="empty-title">No Media Uploaded</h3>
            <p class="empty-desc">Upload your first image to populate your media assets library.</p>
        </div>
    <?php else: ?>
        <div class="media-grid">
            <?php foreach ($mediaList as $item): ?>
                <div class="media-item-card">
                    <div class="media-thumb-wrap">
                        <img src="<?= e($item['url']) ?>" alt="<?= e($item['alt_text'] ?? $item['filename']) ?>" class="media-thumb-img" loading="lazy">
                    </div>
                    <div class="media-item-info">
                        <span class="media-filename" title="<?= e($item['filename']) ?>"><?= e($item['filename']) ?></span>
                        <span class="media-meta-tag"><?= round($item['file_size'] / 1024, 1) ?> KB &bull; <?= e($item['mime_type']) ?></span>
                    </div>
                    <div class="media-card-actions">
                        <button type="button" class="btn-admin btn-admin-secondary btn-admin-sm" onclick="copyToClipboard('<?= e($item['path']) ?>', this)" title="Copy path for treatments">
                            <i class="fa-solid fa-copy"></i> Path
                        </button>

                        <?php if (empty($item['is_static'])): ?>
                            <form action="<?= baseUrl('admin_media.php?action=delete&id=' . (int)$item['id']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Delete this media file?');">
                                <?= CsrfService::getHiddenInput() ?>
                                <button type="submit" class="btn-admin btn-admin-danger btn-admin-sm" title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        <?php else: ?>
                            <span style="font-size:0.7rem;color:var(--admin-muted);padding:4px 6px;">System Asset</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
