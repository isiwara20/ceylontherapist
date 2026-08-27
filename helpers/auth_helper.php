<?php
declare(strict_types=1);

/**
 * Authentication Guard & Session Helpers (Admin Only)
 */

/**
 * Check if Admin user is authenticated
 * 
 * @return bool
 */
function isAdminLoggedIn(): bool
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true && isset($_SESSION['admin_id']);
}

/**
 * Protect Admin Routes: Require Admin Login or Redirect
 * 
 * @return void
 */
function requireAdmin(): void
{
    if (!isAdminLoggedIn()) {
        setFlash('error', 'Please log in to access the administrator panel.');
        redirect('login.php');
    }
}

/**
 * Get current authenticated admin payload array
 * 
 * @return array|null
 */
function currentAdmin(): ?array
{
    if (!isAdminLoggedIn()) {
        return null;
    }

    return [
        'id' => $_SESSION['admin_id'] ?? null,
        'name' => $_SESSION['admin_name'] ?? 'Administrator',
        'email' => $_SESSION['admin_email'] ?? ''
    ];
}
