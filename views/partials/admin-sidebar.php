<?php $admin = currentAdmin(); ?>
<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h2>CEYLON</h2>
        <span class="badge-admin">CONTROL PANEL</span>
    </div>

    <div class="admin-user-profile">
        <img src="https://ui-avatars.com/api/?name=<?= urlencode($admin['name'] ?? 'Admin') ?>&background=8b0000&color=d4af37" alt="Admin Avatar" class="user-avatar">
        <div class="user-info">
            <span class="user-name"><?= e($admin['name'] ?? 'Administrator') ?></span>
            <span class="user-role">System Admin</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="<?= baseUrl('admin_dashboard.php') ?>" class="sidebar-link">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('admin_services.php') ?>" class="sidebar-link">
                    <i class="fa-solid fa-spa"></i> Services & Treatments
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('admin_packages.php') ?>" class="sidebar-link">
                    <i class="fa-solid fa-box-open"></i> Packages
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('admin_for_her.php') ?>" class="sidebar-link">
                    <i class="fa-solid fa-venus"></i> For Her
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('admin_couples.php') ?>" class="sidebar-link">
                    <i class="fa-solid fa-heart"></i> Couples
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('admin_site_settings.php') ?>" class="sidebar-link">
                    <i class="fa-solid fa-sliders"></i> Site Settings
                </a>
            </li>
            <li>
                <a href="<?= baseUrl('admin_contact_settings.php') ?>" class="sidebar-link">
                    <i class="fa-solid fa-address-book"></i> Contact Details
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="<?= baseUrl('logout.php') ?>" class="btn-logout">
            <i class="fa-solid fa-right-from-bracket"></i> Sign Out
        </a>
    </div>
</aside>

<div class="admin-main">
    <header class="admin-topbar">
        <div class="topbar-title">
            <h1><?= e($pageTitle ?? 'Dashboard') ?></h1>
        </div>
    </header>
    
    <div class="admin-content">
        <?php if (hasFlash('success')): ?>
            <div class="alert alert-success">
                <?php foreach (getFlash('success') as $msg): ?>
                    <p><i class="fa-solid fa-circle-check"></i> <?= e($msg) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (hasFlash('error')): ?>
            <div class="alert alert-error">
                <?php foreach (getFlash('error') as $msg): ?>
                    <p><i class="fa-solid fa-circle-exclamation"></i> <?= e($msg) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (hasFlash('info')): ?>
            <div class="alert alert-info">
                <?php foreach (getFlash('info') as $msg): ?>
                    <p><i class="fa-solid fa-circle-info"></i> <?= e($msg) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
