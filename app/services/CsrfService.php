<?php
declare(strict_types=1);

/**
 * Cross-Site Request Forgery (CSRF) Protection Service
 */

class CsrfService
{
    private const TOKEN_KEY = '_csrf_token';

    /**
     * Generate or retrieve existing CSRF token
     * 
     * @return string
     */
    public static function getToken(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION[self::TOKEN_KEY])) {
            $_SESSION[self::TOKEN_KEY] = bin2hex(random_bytes(32));
        }

        return $_SESSION[self::TOKEN_KEY];
    }

    /**
     * Validate incoming CSRF token against session
     * 
     * @param string|null $token
     * @return bool
     */
    public static function validateToken(?string $token): bool
    {
        if (empty($token) || empty($_SESSION[self::TOKEN_KEY])) {
            return false;
        }

        return hash_equals($_SESSION[self::TOKEN_KEY], $token);
    }

    /**
     * Generate HTML hidden input tag for forms
     * 
     * @return string
     */
    public static function getHiddenInput(): string
    {
        $token = self::getToken();
        return sprintf('<input type="hidden" name="csrf_token" value="%s">', htmlspecialchars($token, ENT_QUOTES, 'UTF-8'));
    }
}
