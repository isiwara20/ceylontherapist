<?php
declare(strict_types=1);

/**
 * Controller for Admin Profile & Password Management
 */

class AdminProfileController
{
    private AdminProfileBLL $profileBLL;

    public function __construct()
    {
        requireAdmin();
        $this->profileBLL = new AdminProfileBLL();
    }

    /**
     * Show Profile Page
     */
    public function profile(): void
    {
        $adminId = (int)$_SESSION['admin_id'];
        $admin = $this->profileBLL->getProfile($adminId);
        $pageTitle = "My Profile | Admin Panel";

        require BASE_PATH . '/views/admin/profile/index.php';
    }

    /**
     * Update Profile POST
     */
    public function updateProfile(): void
    {
        if (!isPost()) {
            redirect('admin_profile.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_profile.php');
        }

        $adminId = (int)$_SESSION['admin_id'];
        $input = [
            'name' => post('name'),
            'email' => post('email')
        ];

        $imageFile = $_FILES['profile_image'] ?? null;
        $res = $this->profileBLL->updateProfile($adminId, $input, $imageFile);

        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }

        redirect('admin_profile.php');
    }

    /**
     * Show Change Password Page
     */
    public function changePassword(): void
    {
        $pageTitle = "Change Password | Admin Panel";
        require BASE_PATH . '/views/admin/profile/password.php';
    }

    /**
     * Update Password POST
     */
    public function updatePassword(): void
    {
        if (!isPost()) {
            redirect('admin_change_password.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_change_password.php');
        }

        $adminId = (int)$_SESSION['admin_id'];
        $currentPassword = post('current_password', '');
        $newPassword = post('new_password', '');
        $confirmPassword = post('confirm_password', '');

        $res = $this->profileBLL->changePassword($adminId, $currentPassword, $newPassword, $confirmPassword);

        if ($res['success']) {
            setFlash('success', $res['message']);
            redirect('admin_profile.php');
        } else {
            setFlash('error', $res['message']);
            redirect('admin_change_password.php');
        }
    }
}
