<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Ceylon Therapist | Luxury Wellness & Spa') ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= assetUrl('css/main.css') ?>">
    <link rel="stylesheet" href="<?= assetUrl('css/responsive.css') ?>">
</head>
<body class="public-body">

<header class="public-header">
    <div class="header-container">
        <a href="<?= baseUrl('index.php') ?>" class="brand-logo">
            <span class="brand-name">CEYLON THERAPIST</span>
            <span class="brand-sub">LUXURY WELLNESS & SPA</span>
        </a>
        
        <nav class="public-nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="<?= baseUrl('index.php') ?>" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="<?= baseUrl('treatments.php') ?>" class="nav-link">Treatments</a></li>
                <li class="nav-item"><a href="<?= baseUrl('for-her.php') ?>" class="nav-link">For Her</a></li>
                <li class="nav-item"><a href="<?= baseUrl('couples.php') ?>" class="nav-link">Couples</a></li>
                <li class="nav-item"><a href="<?= baseUrl('about.php') ?>" class="nav-link">About</a></li>
                <li class="nav-item"><a href="<?= baseUrl('contact.php') ?>" class="nav-link">Contact</a></li>
            </ul>
        </nav>
        
        <div class="header-actions">
            <a href="<?= baseUrl('contact.php') ?>" class="btn-primary-gold">
                <i class="fa-brands fa-whatsapp"></i> Reserve Now
            </a>
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
