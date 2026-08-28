<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>Home Page Content</h1>
        <p>Edit the hero typography, call-to-actions, and sanctuary copy on the primary landing page.</p>
    </div>
</div>

<!-- Home Content Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_home_content.php') ?>" method="POST">
        <?= CsrfService::getHiddenInput() ?>

        <div class="card-title-group" style="margin-bottom:20px;">
            <h3>Hero Section</h3>
            <p>Controls the primary landing banner seen at the top of the Home page.</p>
        </div>

        <div class="form-group">
            <label for="hero_eyebrow">Hero Eyebrow Tagline</label>
            <input type="text" id="hero_eyebrow" name="hero_eyebrow" class="admin-input" value="<?= e($content['hero_eyebrow'] ?? 'PRIVATE. PERSONAL. RESTORATIVE.') ?>">
        </div>

        <div class="form-group">
            <label for="hero_title">Hero Main Title <span style="color:var(--admin-muted);font-weight:normal;">(HTML &lt;br&gt; tags allowed)</span></label>
            <input type="text" id="hero_title" name="hero_title" class="admin-input" value="<?= e($content['hero_title'] ?? 'Your Time.<br>Your Space.<br>Your Escape.') ?>">
        </div>

        <div class="form-group">
            <label for="hero_desc">Hero Description</label>
            <textarea id="hero_desc" name="hero_desc" class="admin-textarea" rows="3"><?= e($content['hero_desc'] ?? 'Thoughtfully designed therapeutic experiences created to help you slow down, release tension and return to a state of balance.') ?></textarea>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label for="home_cta_primary">Primary Button Label</label>
                <input type="text" id="home_cta_primary" name="home_cta_primary" class="admin-input" value="<?= e($content['home_cta_primary'] ?? 'EXPLORE TREATMENTS') ?>">
            </div>

            <div class="form-group">
                <label for="home_cta_secondary">Secondary Button Label</label>
                <input type="text" id="home_cta_secondary" name="home_cta_secondary" class="admin-input" value="<?= e($content['home_cta_secondary'] ?? 'RESERVE PRIVATELY') ?>">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Save Home Page Content
            </button>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
