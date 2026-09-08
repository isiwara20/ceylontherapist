<?php 
$admin = currentAdmin(); 
$requestUri = str_replace('\\', '/', $_SERVER['REQUEST_URI'] ?? '');
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
?>

<!-- Mobile Sidebar Backdrop -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<!-- Left Sidebar Navigation -->
<aside class="admin-sidebar" id="adminSidebar">
    <!-- Brand Logo Box -->
    <div class="sidebar-brand">
        <a href="<?= baseUrl('admin/dashboard.php') ?>" class="brand-link">
            <img src="<?= assetUrl('images/branding/logo.png') ?>" alt="Ceylon Therapist" class="admin-sidebar-logo">
        </a>
        <span class="badge-portal">ADMIN PORTAL</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="sidebar-nav" aria-label="Admin Navigation">
        <!-- Section: Core -->
        <div class="nav-section-title">CORE</div>
        <ul class="nav-group">
            <li class="nav-item">
                <a href="<?= baseUrl('admin/dashboard.php') ?>" class="nav-link <?= strpos($scriptName, 'dashboard.php') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-chart-pie nav-icon"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
        </ul>

        <!-- Section: Website Content -->
        <div class="nav-section-title">WEBSITE CONTENT</div>
        <ul class="nav-group">
            <li class="nav-item">
                <a href="<?= baseUrl('admin/content/home.php') ?>" class="nav-link <?= strpos($scriptName, 'content/home.php') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-house nav-icon"></i>
                    <span class="nav-text">Home Page</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= baseUrl('admin/content/about.php') ?>" class="nav-link <?= strpos($scriptName, 'content/about.php') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-feather-pointed nav-icon"></i>
                    <span class="nav-text">About Page</span>
                </a>
            </li>
        </ul>

        <!-- Section: Services -->
        <div class="nav-section-title">SERVICES & EXPERIENCES</div>
        <ul class="nav-group">
            <li class="nav-item">
                <a href="<?= baseUrl('admin/services/index.php') ?>" class="nav-link <?= (strpos($scriptName, 'admin/services/') !== false && !isset($_GET['category'])) ? 'active' : '' ?>">
                    <i class="fa-solid fa-spa nav-icon"></i>
                    <span class="nav-text">Treatments</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= baseUrl('admin/categories/index.php') ?>" class="nav-link <?= strpos($scriptName, 'admin/categories/') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-layer-group nav-icon"></i>
                    <span class="nav-text">Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= baseUrl('admin/services/index.php?category=FOR_HER') ?>" class="nav-link <?= (isset($_GET['category']) && strtoupper((string)$_GET['category']) === 'FOR_HER') ? 'active' : '' ?>">
                    <i class="fa-solid fa-venus nav-icon"></i>
                    <span class="nav-text">For Her Sanctuary</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= baseUrl('admin/services/index.php?category=COUPLES') ?>" class="nav-link <?= (isset($_GET['category']) && strtoupper((string)$_GET['category']) === 'COUPLES') ? 'active' : '' ?>">
                    <i class="fa-solid fa-heart nav-icon"></i>
                    <span class="nav-text">Couples Rituals</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= baseUrl('admin/packages/index.php') ?>" class="nav-link <?= strpos($scriptName, 'admin/packages/') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-box-open nav-icon"></i>
                    <span class="nav-text">Packages</span>
                </a>
            </li>
        </ul>

        <!-- Section: Bookings & Enquiries -->
        <div class="nav-section-title">RESERVATIONS</div>
        <ul class="nav-group">
            <li class="nav-item">
                <a href="<?= baseUrl('admin/enquiries/index.php') ?>" class="nav-link <?= strpos($scriptName, 'admin/enquiries/') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-check nav-icon"></i>
                    <span class="nav-text">Enquiries & Bookings</span>
                </a>
            </li>
        </ul>

        <!-- Section: Media -->
        <div class="nav-section-title">ASSETS</div>
        <ul class="nav-group">
            <li class="nav-item">
                <a href="<?= baseUrl('admin/media/index.php') ?>" class="nav-link <?= strpos($scriptName, 'admin/media/') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-images nav-icon"></i>
                    <span class="nav-text">Media Library</span>
                </a>
            </li>
        </ul>

        <!-- Section: Settings -->
        <div class="nav-section-title">SETTINGS</div>
        <ul class="nav-group">
            <li class="nav-item">
                <a href="<?= baseUrl('admin/settings/contact.php') ?>" class="nav-link <?= strpos($scriptName, 'settings/contact.php') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-address-book nav-icon"></i>
                    <span class="nav-text">Contact Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= baseUrl('admin/settings/site.php') ?>" class="nav-link <?= strpos($scriptName, 'settings/site.php') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-sliders nav-icon"></i>
                    <span class="nav-text">Website Settings</span>
                </a>
            </li>
        </ul>

        <!-- Section: Account -->
        <div class="nav-section-title">ACCOUNT</div>
        <ul class="nav-group">
            <li class="nav-item">
                <a href="<?= baseUrl('admin/profile/index.php') ?>" class="nav-link <?= (strpos($scriptName, 'admin/profile/index.php') !== false || ($scriptName === 'admin/profile/')) ? 'active' : '' ?>">
                    <i class="fa-solid fa-user-gear nav-icon"></i>
                    <span class="nav-text">My Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= baseUrl('admin/profile/change-password.php') ?>" class="nav-link <?= strpos($scriptName, 'change-password.php') !== false ? 'active' : '' ?>">
                    <i class="fa-solid fa-key nav-icon"></i>
                    <span class="nav-text">Change Password</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= baseUrl('logout.php') ?>" class="nav-link nav-logout">
                    <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                    <span class="nav-text">Sign Out</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- Main Wrapper -->
<div class="admin-main-container">
    <!-- Top Bar Navigation -->
    <header class="admin-topbar">
        <div class="topbar-left">
            <button type="button" class="btn-sidebar-toggle" id="sidebarToggleBtn" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="topbar-breadcrumbs">
                <span class="breadcrumb-item"><a href="<?= baseUrl('admin/dashboard.php') ?>"><i class="fa-solid fa-gauge-high"></i> Portal</a></span>
                <span class="breadcrumb-sep"><i class="fa-solid fa-chevron-right"></i></span>
                <span class="breadcrumb-item active"><?= e($pageTitle ?? 'Dashboard') ?></span>
            </div>
        </div>

        <div class="topbar-right">
            <a href="<?= baseUrl('index.php') ?>" target="_blank" class="btn-admin btn-admin-secondary" style="font-size:12px;padding:7px 14px;display:flex;align-items:center;gap:7px;text-decoration:none;" title="Open Public Website in New Tab">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Website
            </a>

            <div class="topbar-badge-live">
                <span class="live-dot"></span>
                <span>Production Mode</span>
            </div>

            <!-- Admin Profile Menu -->
            <div class="admin-profile-pill">
                <div class="profile-avatar-circle">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="profile-meta">
                    <span class="profile-name"><?= e($admin['name'] ?? 'Administrator') ?></span>
                    <span class="profile-role">Senior Admin</span>
                </div>
                <i class="fa-solid fa-chevron-down profile-arrow"></i>

                <!-- Profile Dropdown -->
                <div class="profile-dropdown-menu" id="profileDropdown">
                    <a href="<?= baseUrl('admin/profile/index.php') ?>" class="dropdown-item">
                        <i class="fa-solid fa-user-gear"></i> My Profile
                    </a>
                    <a href="<?= baseUrl('admin/profile/change-password.php') ?>" class="dropdown-item">
                        <i class="fa-solid fa-key"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= baseUrl('logout.php') ?>" class="dropdown-item dropdown-logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Sign Out
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Workspace -->
    <main class="admin-workspace">
        <?php if (hasFlash('success')): ?>
            <div class="admin-alert admin-alert-success" role="alert">
                <i class="fa-solid fa-circle-check alert-icon"></i>
                <div class="alert-content">
                    <?php foreach (getFlash('success') as $msg): ?>
                        <p><?= e($msg) ?></p>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="alert-close" aria-label="Close alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (hasFlash('error')): ?>
            <div class="admin-alert admin-alert-error" role="alert">
                <i class="fa-solid fa-circle-exclamation alert-icon"></i>
                <div class="alert-content">
                    <?php foreach (getFlash('error') as $msg): ?>
                        <p><?= e($msg) ?></p>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="alert-close" aria-label="Close alert">&times;</button>
            </div>
        <?php endif; ?>

        <?php if (hasFlash('info')): ?>
            <div class="admin-alert admin-alert-info" role="alert">
                <i class="fa-solid fa-circle-info alert-icon"></i>
                <div class="alert-content">
                    <?php foreach (getFlash('info') as $msg): ?>
                        <p><?= e($msg) ?></p>
                    <?php endforeach; ?>
                </div>
                <button type="button" class="alert-close" aria-label="Close alert">&times;</button>
            </div>
        <?php endif; ?>
