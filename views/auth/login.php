<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Administrator Login | Ceylon Therapist') ?></title>
    
    <!-- Google Fonts: Inter & Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Admin Stylesheet -->
    <link rel="stylesheet" href="<?= assetUrl('css/admin.css') ?>">
</head>
<body class="login-body">

<div class="login-card-container">
    <div class="login-card">
        <div class="login-header">
            <img src="<?= assetUrl('images/logo.png') ?>" alt="Ceylon Therapist" class="login-logo">
            <h2>ADMIN PORTAL</h2>
            <p>Authorized Personnel Only</p>
        </div>

        <?php if (hasFlash('error')): ?>
            <div class="admin-alert admin-alert-error" role="alert">
                <i class="fa-solid fa-circle-exclamation alert-icon"></i>
                <div class="alert-content">
                    <?php foreach (getFlash('error') as $msg): ?>
                        <p><?= e($msg) ?></p>
                    <?php endforeach; ?>
                </div>
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
            </div>
        <?php endif; ?>

        <?php if (hasFlash('success')): ?>
            <div class="admin-alert admin-alert-success" role="alert">
                <i class="fa-solid fa-circle-check alert-icon"></i>
                <div class="alert-content">
                    <?php foreach (getFlash('success') as $msg): ?>
                        <p><?= e($msg) ?></p>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= baseUrl('login.php') ?>" method="POST" class="login-form">
            <?= CsrfService::getHiddenInput() ?>

            <div class="form-group">
                <label for="email">Admin Email Address</label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-envelope input-icon-left"></i>
                    <input type="email" id="email" name="email" required placeholder="admin@ceylontherapist.lk" autocomplete="email" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Security Password</label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-lock input-icon-left"></i>
                    <input type="password" id="password" name="password" required placeholder="Enter password" autocomplete="current-password">
                    <i class="fa-solid fa-eye password-toggle-icon" title="Toggle password visibility"></i>
                </div>
            </div>

            <button type="submit" class="btn-admin-submit">
                <i class="fa-solid fa-shield-halved"></i> Sign In to Portal
            </button>
        </form>

        <div class="login-footer">
            <small>&copy; <?= date('Y') ?> Ceylon Therapist. Encrypted Management Area.</small>
        </div>
    </div>
</div>

<script src="<?= assetUrl('js/admin.js') ?>"></script>
</body>
</html>
