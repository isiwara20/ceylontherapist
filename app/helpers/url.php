<?php
declare(strict_types=1);

/**
 * URL and Navigation Helper Functions
 */

/**
 * Build base URL appended with path
 * 
 * @param string $path
 * @return string
 */
function baseUrl(string $path = ''): string
{
    $cleanPath = ltrim($path, '/');

    if (defined('BASE_URL') && !empty(BASE_URL)) {
        return rtrim(BASE_URL, '/') . ($cleanPath !== '' ? '/' . $cleanPath : '');
    }

    if (isset($_SERVER['HTTP_HOST'])) {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];

        // Determine base path relative to DOCUMENT_ROOT
        $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']) ?: $_SERVER['DOCUMENT_ROOT']) : '';
        $appRoot = defined('BASE_PATH') ? str_replace('\\', '/', realpath(BASE_PATH) ?: BASE_PATH) : '';

        if ($docRoot !== '' && $appRoot !== '' && strpos($appRoot, $docRoot) === 0) {
            $subDir = trim(substr($appRoot, strlen($docRoot)), '/');
            $prefix = $subDir !== '' ? '/' . $subDir : '';
            return $protocol . '://' . $host . $prefix . ($cleanPath !== '' ? '/' . $cleanPath : '');
        }

        // Fallback using SCRIPT_NAME if BASE_PATH matching is not possible
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        $dir = trim(dirname($script), '/');
        // Remove admin / subdirectories if in script name
        $dir = preg_replace('#/(admin|app)(/.*)?$#', '', '/' . $dir);
        $prefix = ($dir !== '/' && $dir !== '') ? $dir : '';
        return $protocol . '://' . $host . $prefix . ($cleanPath !== '' ? '/' . $cleanPath : '');
    }

    return '/' . $cleanPath;
}

/**
 * Build asset URL
 * 
 * @param string $path
 * @return string
 */
function assetUrl(string $path = ''): string
{
    return baseUrl('assets/' . ltrim($path, '/'));
}

/**
 * Build media asset URL for uploaded and static images
 * 
 * @param string|null $path
 * @param string $fallback
 * @return string
 */
function mediaUrl(?string $path, string $fallback = 'assets/images/treatments/treatment_essential.jpg'): string
{
    if (empty($path)) {
        return baseUrl(ltrim($fallback, '/'));
    }

    $trimmed = trim($path);

    // Full URL check
    if (strpos($trimmed, 'http://') === 0 || strpos($trimmed, 'https://') === 0) {
        return $trimmed;
    }

    $clean = ltrim($trimmed, '/');

    // 1. Check direct path from project root
    if (defined('BASE_PATH') && file_exists(BASE_PATH . '/' . $clean)) {
        return baseUrl($clean);
    }

    // 2. Check storage/
    if (defined('BASE_PATH') && file_exists(BASE_PATH . '/storage/' . $clean)) {
        return baseUrl('storage/' . $clean);
    }

    // 3. Check storage/uploads/services/
    if (defined('BASE_PATH') && file_exists(BASE_PATH . '/storage/uploads/services/' . $clean)) {
        return baseUrl('storage/uploads/services/' . $clean);
    }

    // 4. Check storage/uploads/packages/
    if (defined('BASE_PATH') && file_exists(BASE_PATH . '/storage/uploads/packages/' . $clean)) {
        return baseUrl('storage/uploads/packages/' . $clean);
    }

    // 5. Check in assets/images/
    if (defined('BASE_PATH') && file_exists(BASE_PATH . '/assets/images/' . $clean)) {
        return assetUrl('images/' . $clean);
    }

    // 6. Check categorized image directories
    $categories = ['treatments', 'home', 'branding', 'couples', 'for-her', 'packages'];
    foreach ($categories as $cat) {
        if (defined('BASE_PATH') && file_exists(BASE_PATH . '/assets/images/' . $cat . '/' . $clean)) {
            return assetUrl('images/' . $cat . '/' . $clean);
        }
    }

    // If starts with assets/ or storage/
    if (strpos($clean, 'assets/') === 0 || strpos($clean, 'storage/') === 0) {
        return baseUrl($clean);
    }

    return baseUrl($clean);
}

/**
 * Perform HTTP Redirect and exit
 * 
 * @param string $url
 * @return void
 */
function redirect(string $url): void
{
    if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
        $url = baseUrl($url);
    }
    header("Location: " . $url);
    exit;
}
