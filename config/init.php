<?php
declare(strict_types=1);

/**
 * Bootstrap Initialization File
 * Ceylon Therapist N-Tier Architecture
 */

// Load Application & Database Configurations
require_once __DIR__ . '/app.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/mail.php';

// Secure Session Initialization
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_samesite', 'Lax');

    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        ini_set('session.cookie_secure', '1');
    }

    session_start();
}

// Custom Class Autoloader without Composer
spl_autoload_register(function (string $className): void {
    $dirs = [
        BASE_PATH . '/controllers/',
        BASE_PATH . '/bll/',
        BASE_PATH . '/dal/',
        BASE_PATH . '/services/'
    ];

    foreach ($dirs as $dir) {
        $file = $dir . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Load Global Helpers
require_once BASE_PATH . '/helpers/common_helper.php';
require_once BASE_PATH . '/helpers/url_helper.php';
require_once BASE_PATH . '/helpers/auth_helper.php';
require_once BASE_PATH . '/helpers/flash_helper.php';
require_once BASE_PATH . '/helpers/validation_helper.php';
