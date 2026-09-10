<?php
declare(strict_types=1);

/**
 * Common Output & Request Helper Functions
 */

/**
 * HTML Output Escaping
 * 
 * @param string|null $value
 * @return string
 */
function e(?string $value): string
{
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

/**
 * Check if current HTTP request is POST
 * 
 * @return bool
 */
function isPost(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

/**
 * Get sanitized value from $_POST array
 * 
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function post(string $key, mixed $default = null): mixed
{
    if (!isset($_POST[$key])) {
        return $default;
    }
    return is_string($_POST[$key]) ? trim($_POST[$key]) : $_POST[$key];
}

/**
 * Get sanitized value from $_GET array
 * 
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function get(string $key, mixed $default = null): mixed
{
    if (!isset($_GET[$key])) {
        return $default;
    }
    return is_string($_GET[$key]) ? trim($_GET[$key]) : $_GET[$key];
}

/**
 * Retrieve flashed old input or session input
 * 
 * @param string $key
 * @param string $default
 * @return string
 */
function old(string $key, string $default = ''): string
{
    if (isset($_SESSION['_old_input'][$key])) {
        $val = $_SESSION['_old_input'][$key];
        return e((string)$val);
    }
    return e($default);
}

/**
 * Dump and die helper for debugging
 * 
 * @param mixed ...$vars
 */
function dd(...$vars): void
{
    echo '<pre style="background: #1e1e1e; color: #00ff66; padding: 15px; border-radius: 5px; font-family: monospace;">';
    foreach ($vars as $var) {
        var_dump($var);
    }
    echo '</pre>';
    exit;
}

/**
 * Format currency price
 * 
 * @param float|int|string|null $price
 * @param string|null $currency
 * @return string Formatted price e.g. "LKR 8,500" or empty string if null/0
 */
function formatPrice(mixed $price, ?string $currency = null): string
{
    if ($price === null || $price === '' || (float)$price <= 0) {
        return '';
    }
    $curr = $currency ?? (defined('DEFAULT_CURRENCY') ? DEFAULT_CURRENCY : 'LKR');
    $num = (float)$price;
    $decimals = ($num == floor($num)) ? 0 : 2;
    return $curr . ' ' . number_format($num, $decimals);
}

