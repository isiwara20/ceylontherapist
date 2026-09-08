<?php
declare(strict_types=1);

/**
 * Application Configuration
 */

if (!defined('APP_NAME')) {
    define('APP_NAME', (string)env('APP_NAME', 'Ceylon Therapist'));
}

if (!defined('APP_TAGLINE')) {
    define('APP_TAGLINE', 'Premium Therapist & Wellness Services in Sri Lanka');
}

if (!defined('ENVIRONMENT')) {
    define('ENVIRONMENT', (string)env('APP_ENV', 'development'));
}

// Base URL calculation
$configuredAppUrl = env('APP_URL');
if (!empty($configuredAppUrl) && strpos((string)$configuredAppUrl, 'http') === 0 && (string)$configuredAppUrl !== 'http://localhost' && (string)$configuredAppUrl !== 'http://localhost/') {
    if (!defined('BASE_URL')) {
        define('BASE_URL', rtrim((string)$configuredAppUrl, '/'));
    }
} else {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    
    $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']) ?: $_SERVER['DOCUMENT_ROOT']) : '';
    $appRoot = defined('BASE_PATH') ? str_replace('\\', '/', realpath(BASE_PATH) ?: BASE_PATH) : '';

    if ($docRoot !== '' && $appRoot !== '' && strpos($appRoot, $docRoot) === 0) {
        $subDir = trim(substr($appRoot, strlen($docRoot)), '/');
        $baseDir = $subDir !== '' ? '/' . $subDir : '';
    } else {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? ($_SERVER['PHP_SELF'] ?? '');
        $scriptDir = str_replace('\\', '/', dirname($scriptName));
        $cleanDir = preg_replace('#/(admin|app)(/.*)?$#', '', $scriptDir);
        $baseDir = ($cleanDir === '.' || $cleanDir === '/' || $cleanDir === '\\' || $cleanDir === '') ? '' : '/' . trim($cleanDir, '/');
    }

    if (!defined('BASE_URL')) {
        define('BASE_URL', rtrim($protocol . '://' . $host . $baseDir, '/'));
    }
}

// Business Contact Defaults
if (!defined('DEFAULT_WHATSAPP_NUMBER')) {
    define('DEFAULT_WHATSAPP_NUMBER', (string)env('DEFAULT_WHATSAPP_NUMBER', '94762244114'));
}

if (!defined('DEFAULT_BUSINESS_EMAIL')) {
    define('DEFAULT_BUSINESS_EMAIL', (string)env('DEFAULT_BUSINESS_EMAIL', 'info@ceylontherapist.lk'));
}

if (!defined('DEFAULT_CURRENCY')) {
    define('DEFAULT_CURRENCY', (string)env('DEFAULT_CURRENCY', 'LKR'));
}

// Error reporting configuration based on environment
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
    ini_set('log_errors', '1');
    if (defined('BASE_PATH')) {
        ini_set('error_log', BASE_PATH . '/storage/logs/app.log');
    }
}

return [
    'name' => APP_NAME,
    'url' => BASE_URL,
    'environment' => ENVIRONMENT,
    'whatsapp' => DEFAULT_WHATSAPP_NUMBER,
    'email' => DEFAULT_BUSINESS_EMAIL,
    'currency' => DEFAULT_CURRENCY
];
