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
    
    if (isset($_SERVER['HTTP_HOST'])) {
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? ($_SERVER['PHP_SELF'] ?? '');
        $dir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
        if ($dir !== '' && $dir !== '.') {
            return $dir . ($cleanPath ? '/' . $cleanPath : '');
        }
        return $cleanPath ? $cleanPath : './';
    }

    return rtrim(BASE_URL, '/') . ($cleanPath ? '/' . $cleanPath : '');
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
