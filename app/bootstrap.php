<?php
declare(strict_types=1);

/**
 * Ceylon Therapist - Application Bootstrap
 */

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

// 1. Load Environment Helper & Parse .env File
require_once __DIR__ . '/helpers/env.php';
loadEnv(BASE_PATH . '/.env');

// 2. Load Core Application, Database & Mail Configurations
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/mail.php';

// 3. Secure Session Initialization
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_samesite', 'Lax');

    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        ini_set('session.cookie_secure', '1');
    }

    session_start();
}

// 4. Class Autoloader for Models, Controllers, and Services
spl_autoload_register(function (string $className): void {
    $directories = [
        __DIR__ . '/controllers/',
        __DIR__ . '/models/',
        __DIR__ . '/services/'
    ];

    foreach ($directories as $dir) {
        $file = $dir . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// 5. Load Global Functional Helpers
require_once __DIR__ . '/helpers/common.php';
require_once __DIR__ . '/helpers/url.php';
require_once __DIR__ . '/helpers/auth.php';
require_once __DIR__ . '/helpers/flash.php';
require_once __DIR__ . '/helpers/validation.php';
