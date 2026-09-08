<?php
declare(strict_types=1);

/**
 * Controller for Authentication (Login / Logout)
 */

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * Show Admin Login Form
     */
    public function showLogin(): void
    {
        if ($this->authService->check()) {
            redirect('admin/dashboard.php');
        }

        $pageTitle = "Administrator Sign In | " . APP_NAME;
        $pageCss = 'assets/css/pages/login.css';
        $pageJs = 'assets/js/pages/login.js';

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

        $result = $this->authService->login($email, $password);

        if ($result['success']) {
            setFlash('success', 'Welcome back, Administrator!');
            redirect('admin/dashboard.php');
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
        $this->authService->logout();
        setFlash('info', 'You have been successfully logged out.');
        redirect('login.php');
    }
}
