<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Ceylon Therapist | Private Luxury Wellness & Therapy') ?></title>
    <meta name="description" content="Thoughtfully designed private therapeutic experiences created to help you slow down, release tension and return to a state of balance in Sri Lanka.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= assetUrl('css/main.css') ?>">
    <link rel="stylesheet" href="<?= assetUrl('css/responsive.css') ?>">
</head>
<body class="public-body">

<header class="public-header" id="site-header">
    <div class="header-container container">
        <a href="<?= baseUrl('index.php') ?>" class="brand-logo" aria-label="Ceylon Therapist Home">
            <img src="<?= assetUrl('images/logo.png') ?>" alt="Ceylon Therapist Logo" class="brand-logo-img">
        </a>
        
        <nav class="public-nav" id="public-nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="<?= baseUrl('index.php') ?>" class="nav-link <?= (basename($_SERVER['PHP_SELF'] ?? '') === 'index.php' || basename($_SERVER['PHP_SELF'] ?? '') === '') ? 'active' : '' ?>">Home</a></li>
                <li class="nav-item"><a href="<?= baseUrl('treatments.php') ?>" class="nav-link <?= (basename($_SERVER['PHP_SELF'] ?? '') === 'treatments.php') ? 'active' : '' ?>">Treatments</a></li>
                <li class="nav-item"><a href="<?= baseUrl('for-her.php') ?>" class="nav-link <?= (basename($_SERVER['PHP_SELF'] ?? '') === 'for-her.php') ? 'active' : '' ?>">For Her</a></li>
                <li class="nav-item"><a href="<?= baseUrl('couples.php') ?>" class="nav-link <?= (basename($_SERVER['PHP_SELF'] ?? '') === 'couples.php') ? 'active' : '' ?>">Couples</a></li>
                <li class="nav-item"><a href="<?= baseUrl('about.php') ?>" class="nav-link <?= (basename($_SERVER['PHP_SELF'] ?? '') === 'about.php') ? 'active' : '' ?>">About</a></li>
                <li class="nav-item"><a href="<?= baseUrl('contact.php') ?>" class="nav-link <?= (basename($_SERVER['PHP_SELF'] ?? '') === 'contact.php') ? 'active' : '' ?>">Contact</a></li>
            </ul>
        </nav>
        
        <div class="header-actions">
            <a href="https://wa.me/94771234567?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-reserve-gold">
                <i class="fa-brands fa-whatsapp"></i> <span>RESERVE PRIVATELY</span>
            </a>
            <button class="mobile-toggle" id="mobile-toggle" aria-label="Toggle navigation menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
    </div>
</header>

<main class="main-content">
    <?php if (hasFlash('success')): ?>
        <div class="alert alert-success container">
            <?php foreach (getFlash('success') as $msg): ?>
                <p><i class="fa-solid fa-circle-check"></i> <?= e($msg) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (hasFlash('error')): ?>
        <div class="alert alert-error container">
            <?php foreach (getFlash('error') as $msg): ?>
                <p><i class="fa-solid fa-circle-exclamation"></i> <?= e($msg) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
