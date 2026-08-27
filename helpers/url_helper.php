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
