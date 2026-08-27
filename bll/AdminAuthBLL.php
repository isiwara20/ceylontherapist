<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Admin Authentication
 */

class AdminAuthBLL
{
    private AdminDAL $adminDAL;

    public function __construct()
    {
        $this->adminDAL = new AdminDAL();
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
        if (!validateRequired($email) || !validateRequired($password)) {
            return ['success' => false, 'message' => 'Please enter both email address and password.'];
        }

        if (!validateEmail($email)) {
            return ['success' => false, 'message' => 'Invalid email address format.'];
        }

        $admin = $this->adminDAL->findByEmail($email);

        if (!$admin) {
            return ['success' => false, 'message' => 'Invalid credentials provided.'];
        }

        if (!password_verify($password, $admin['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials provided.'];
        }

        // Prevent Session Fixation: Regenerate session ID upon successful auth
        session_regenerate_id(true);

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
}
