<?php
declare(strict_types=1);

/**
 * Controller for Admin Authentication (Login / Logout)
 */

class AdminAuthController
{
    private AdminAuthBLL $authBLL;

    public function __construct()
    {
        $this->authBLL = new AdminAuthBLL();
    }

    /**
     * Show Admin Login Form
     */
    public function showLogin(): void
    {
        if (isAdminLoggedIn()) {
            redirect('admin_dashboard.php');
        }

        $pageTitle = "Administrator Sign In | " . APP_NAME;
        require BASE_PATH . '/views/auth/login.php';
    }

    /**
     * Process Admin Login POST Request
     */
    public function processLogin(): void
    {
        if (!isPost()) {
            redirect('login.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Security token expired. Please try signing in again.');
            redirect('login.php');
        }

        $email = post('email', '');
        $password = post('password', '');

        $result = $this->authBLL->login($email, $password);

        if ($result['success']) {
            setFlash('success', 'Welcome back, Administrator!');
            redirect('admin_dashboard.php');
        } else {
            setFlash('error', $result['message']);
            redirect('login.php');
        }
    }

    /**
     * Handle Admin Logout
     */
    public function logout(): void
    {
        $this->authBLL->logout();
        setFlash('info', 'You have been successfully logged out.');
        redirect('login.php');
    }
}
