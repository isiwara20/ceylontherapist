<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Administrator Login') ?></title>
    
    <!-- Google Fonts for Admin: Montserrat & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="<?= assetUrl('css/admin.css') ?>">
</head>
<body class="login-body">

<div class="login-card-container">
    <div class="login-card">
        <div class="login-header text-center">
            <i class="fa-solid fa-user-shield login-icon"></i>
            <h2>ADMINISTRATOR SIGN IN</h2>
            <p>Ceylon Therapist Control Panel</p>
        </div>

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

        <form action="<?= baseUrl('login.php') ?>" method="POST" class="login-form">
            <?= CsrfService::getHiddenInput() ?>

            <div class="form-group">
                <label for="email">Admin Email Address</label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" required placeholder="admin@ceylontherapist.lk" autocomplete="email">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Security Password</label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" required placeholder="••••••••••••" autocomplete="current-password">
                </div>
            </div>

            <button type="submit" class="btn-admin-submit">
                <i class="fa-solid fa-right-to-bracket"></i> Authenticate & Enter
            </button>
        </form>

        <div class="login-footer text-center mt-20">
            <small>&copy; <?= date('Y') ?> Ceylon Therapist Architecture. Protected Management Area.</small>
        </div>
    </div>
</div>

</body>
</html>
