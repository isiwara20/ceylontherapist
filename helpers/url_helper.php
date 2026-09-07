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

    // If APP_URL was explicitly configured in .env with a live domain/custom host, use it
    if (defined('BASE_URL') && BASE_URL !== '' && strpos(BASE_URL, 'http://localhost') !== 0) {
        return rtrim(BASE_URL, '/') . ($cleanPath !== '' ? '/' . $cleanPath : '');
    }

    if (isset($_SERVER['HTTP_HOST'])) {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? ($_SERVER['PHP_SELF'] ?? '');
        $dir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
        if ($dir !== '' && $dir !== '.') {
            return $dir . ($cleanPath !== '' ? '/' . $cleanPath : '');
        }
        // At domain root (live hosting like public_html), prepend '/' so paths are root-relative
        return '/' . $cleanPath;
    }

    return defined('BASE_URL') ? rtrim(BASE_URL, '/') . ($cleanPath !== '' ? '/' . $cleanPath : '') : '/' . $cleanPath;
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
function mediaUrl(?string $path, string $fallback = 'assets/images/treatment_essential.jpg'): string
{
    if (empty($path)) {
        return assetUrl(str_replace('assets/', '', $fallback));
    }

    $trimmed = trim($path);

    // If full URL
    if (strpos($trimmed, 'http://') === 0 || strpos($trimmed, 'https://') === 0) {
        return $trimmed;
    }

    $clean = ltrim($trimmed, '/');

    // 1. Direct file match from project root (e.g. storage/uploads/services/abc.jpg)
    if (file_exists(BASE_PATH . '/' . $clean)) {
        return baseUrl($clean);
    }

    // 2. If path is inside storage/
    if (strpos($clean, 'storage/') === 0 && file_exists(BASE_PATH . '/' . $clean)) {
        return baseUrl($clean);
    }

    // 3. If relative to storage/
    if (file_exists(BASE_PATH . '/storage/' . $clean)) {
        return baseUrl('storage/' . $clean);
    }

    // 4. If relative to storage/uploads/services/
    if (file_exists(BASE_PATH . '/storage/uploads/services/' . $clean)) {
        return baseUrl('storage/uploads/services/' . $clean);
    }

    // 5. If relative to assets/images/
    if (file_exists(BASE_PATH . '/assets/images/' . $clean)) {
        return assetUrl('images/' . $clean);
    }

    // 6. If it's already an assets/ path
    if (strpos($clean, 'assets/') === 0) {
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
