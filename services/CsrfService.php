<?php
declare(strict_types=1);

/**
 * CSRF Protection Service
 */

class CsrfService
{
    private const SESSION_KEY = '_csrf_token';

    /**
     * Generate or return existing CSRF token
     * 
     * @return string
     */
    public static function generateToken(): string
    {
        if (empty($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(32));
        }
        return $_SESSION[self::SESSION_KEY];
    }

    /**
     * Get active CSRF token
     * 
     * @return string
     */
    public static function getToken(): string
    {
        return self::generateToken();
    }

    /**
     * Verify CSRF token from request
     * 
     * @param string|null $token
     * @return bool
     */
    public static function validateToken(?string $token): bool
    {
        if (empty($token) || empty($_SESSION[self::SESSION_KEY])) {
            return false;
        }
        return hash_equals($_SESSION[self::SESSION_KEY], $token);
    }

    /**
     * Return HTML hidden form input field
     * 
     * @return string
     */
    public static function getHiddenInput(): string
    {
        $token = self::getToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }
}
