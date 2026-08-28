<?php require BASE_PATH . '/views/partials/admin-header.php'; ?>
<?php require BASE_PATH . '/views/partials/admin-sidebar.php'; ?>

<!-- Page Header -->
<div class="admin-page-header">
    <div class="page-title-wrap">
        <h1>About Page Content</h1>
        <p>Edit the brand story, philosophy statements, and introductory copy on the About Us page.</p>
    </div>
</div>

<!-- About Content Form Card -->
<div class="admin-card">
    <form action="<?= baseUrl('admin_about_content.php') ?>" method="POST">
        <?= CsrfService::getHiddenInput() ?>

        <div class="card-title-group" style="margin-bottom:20px;">
            <h3>Story & Philosophy</h3>
            <p>Controls the narrative copy on the About page.</p>
        </div>

        <div class="form-group">
            <label for="about_story_heading">Our Story Heading</label>
            <input type="text" id="about_story_heading" name="about_story_heading" class="admin-input" value="<?= e($content['about_story_heading'] ?? 'More Than a Service. It’s Your Time to Reset.') ?>">
        </div>

        <div class="form-group">
            <label for="about_story_desc">Our Story Narrative</label>
            <textarea id="about_story_desc" name="about_story_desc" class="admin-textarea" rows="4"><?= e($content['about_story_desc'] ?? 'Ceylon Therapist was created around a simple belief: meaningful relaxation begins when you feel comfortable, respected and understood.') ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-admin btn-admin-gold">
                <i class="fa-solid fa-floppy-disk"></i> Save About Page Content
            </button>
        </div>
    </form>
</div>

<?php require BASE_PATH . '/views/partials/admin-footer.php'; ?>
