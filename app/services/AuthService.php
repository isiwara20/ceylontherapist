<?php
declare(strict_types=1);

/**
 * Admin Authentication & Session Service
 */

class AuthService
{
    private Admin $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    /**
     * Authenticate admin credentials and initialize session
     * 
     * @param string $email
     * @param string $password
     * @return array Array ['success' => bool, 'message' => string]
     */
    public function login(string $email, string $password): array
    {
        $email = trim(strtolower($email));
        $password = trim($password);

        if ($email === '' || $password === '') {
            return ['success' => false, 'message' => 'Please enter both email address and password.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Invalid email address format.'];
        }

        $admin = $this->adminModel->findByEmail($email);

        if (!$admin || !isset($admin['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials provided.'];
        }

        if (!password_verify($password, $admin['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials provided.'];
        }

        // Prevent Session Fixation: Regenerate session ID upon successful auth
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_regenerate_id(true);

        $this->adminModel->updateLastLogin((int)$admin['id']);

        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = (int)$admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_login_time'] = time();

        return ['success' => true, 'message' => 'Login successful. Redirecting to dashboard...'];
    }

    /**
     * Terminate admin session safely
     * 
     * @return void
     */
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset(
            $_SESSION['admin_logged_in'],
            $_SESSION['admin_id'],
            $_SESSION['admin_name'],
            $_SESSION['admin_email'],
            $_SESSION['admin_login_time']
        );

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    /**
     * Check if current session is authenticated admin
     * 
     * @return bool
     */
    public function check(): bool
    {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true && isset($_SESSION['admin_id']);
    }

    /**
     * Get current admin data
     * 
     * @return array|null
     */
    public function user(): ?array
    {
        if (!$this->check()) {
            return null;
        }

        return $this->adminModel->findById((int)$_SESSION['admin_id']);
    }
}
