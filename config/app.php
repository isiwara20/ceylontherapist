<?php
declare(strict_types=1);

/**
 * Application Configuration
 * Ceylon Therapist
 */

define('APP_NAME', env('APP_NAME', 'Ceylon Therapist'));
define('APP_TAGLINE', 'Premium Therapist & Wellness Services in Sri Lanka');

// Base URL configuration for XAMPP / Production environment
$envAppUrl = function_exists('env') ? env('APP_URL') : null;
if (!empty($envAppUrl) && $envAppUrl !== 'http://localhost') {
    define('BASE_URL', rtrim((string)$envAppUrl, '/'));
} else {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $scriptDir = str_replace('\\', '/', dirname($scriptName));
    
    if ($scriptDir === '.' || $scriptDir === '/' || $scriptDir === '\\') {
        $baseDir = '';
    } else {
        $baseDir = '/' . trim($scriptDir, '/');
    }

    define('BASE_URL', rtrim($protocol . '://' . $host . $baseDir, '/'));
}

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

define('ENVIRONMENT', env('APP_ENV', 'development')); // 'development' or 'production'

// Default Business Contact Configuration
define('DEFAULT_WHATSAPP_NUMBER', env('DEFAULT_WHATSAPP_NUMBER', '94771234567'));
define('DEFAULT_BUSINESS_EMAIL', env('DEFAULT_BUSINESS_EMAIL', 'info@ceylontherapist.lk'));
define('DEFAULT_CURRENCY', env('DEFAULT_CURRENCY', 'LKR'));

// Error reporting setup based on environment
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}
