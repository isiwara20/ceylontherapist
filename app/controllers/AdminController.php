<?php
declare(strict_types=1);

/**
 * Controller for Admin Dashboard, Profile, and Password Management
 */

class AdminController
{
    private Admin $adminModel;
    private Service $serviceModel;
    private Package $packageModel;
    private Enquiry $enquiryModel;
    private Media $mediaModel;
    private UploadService $uploader;

    public function __construct()
    {
        requireAdmin();
        $this->adminModel = new Admin();
        $this->serviceModel = new Service();
        $this->packageModel = new Package();
        $this->enquiryModel = new Enquiry();
        $this->mediaModel = new Media();
        $this->uploader = new UploadService('profiles');
    }

    /**
     * Render Admin Dashboard Overview
     */
    public function dashboard(): void
    {
        $admin = currentAdmin();
        $db = Database::getConnection();

        $stats = [
            'total_treatments' => (int)$db->query("SELECT COUNT(*) FROM services WHERE status = 'ACTIVE'")->fetchColumn(),
            'active_packages' => (int)$db->query("SELECT COUNT(*) FROM packages WHERE status = 'ACTIVE'")->fetchColumn(),
            'new_enquiries' => (int)$db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'NEW'")->fetchColumn(),
            'confirmed_bookings' => (int)$db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'CONFIRMED'")->fetchColumn(),
            'for_her_services' => (int)$db->query("
                SELECT COUNT(s.id) 
                FROM services s 
                JOIN service_categories c ON s.category_id = c.id 
                WHERE c.code = 'FOR_HER' AND s.status = 'ACTIVE'
            ")->fetchColumn(),
            'couples_services' => (int)$db->query("
                SELECT COUNT(s.id) 
                FROM services s 
                JOIN service_categories c ON s.category_id = c.id 
                WHERE c.code = 'COUPLES' AND s.status = 'ACTIVE'
            ")->fetchColumn(),
            'pending_enquiries' => (int)$db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'CONTACTED'")->fetchColumn(),
            'total_media' => (int)$db->query("SELECT COUNT(*) FROM media")->fetchColumn()
        ];

        $recentEnquiries = $this->enquiryModel->getRecent(8);
        $activeServices = array_slice($this->serviceModel->all(), 0, 5);

        $pageTitle = "Dashboard | " . APP_NAME;
        $pageCss = 'assets/css/admin/dashboard.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/dashboard.php';
    }

    /**
     * Show Profile Page
     */
    public function profile(): void
    {
        $adminId = (int)$_SESSION['admin_id'];
        $admin = $this->adminModel->findById($adminId);
        $pageTitle = "My Profile | Admin Panel";
        $pageCss = 'assets/css/admin/profile.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/profile/index.php';
    }

    /**
     * Update Profile POST
     */
    public function updateProfile(): void
    {
        if (!isPost()) {
            redirect('admin/profile/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/profile/index.php');
        }

        $adminId = (int)$_SESSION['admin_id'];
        $name = post('name');
        $email = post('email');

        if (!validateRequired($name) || !validateRequired($email)) {
            setFlash('error', 'Name and email are required.');
            redirect('admin/profile/index.php');
        }

        if (!validateEmail((string)$email)) {
            setFlash('error', 'Invalid email address format.');
            redirect('admin/profile/index.php');
        }

        $imagePath = null;
        if (isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['profile_image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/profiles/' . $uploadRes['filename'];
            }
        }

        if ($this->adminModel->updateProfile($adminId, (string)$name, (string)$email, $imagePath)) {
            $_SESSION['admin_name'] = $name;
            $_SESSION['admin_email'] = $email;
            setFlash('success', 'Profile updated successfully.');
        } else {
            setFlash('error', 'Failed to update profile.');
        }

        redirect('admin/profile/index.php');
    }

    /**
     * Show Change Password Page
     */
    public function changePassword(): void
    {
        $pageTitle = "Change Password | Admin Panel";
        $pageCss = 'assets/css/admin/profile.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/profile/password.php';
    }

    /**
     * Update Password POST
     */
    public function updatePassword(): void
    {
        if (!isPost()) {
            redirect('admin/profile/change-password.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/profile/change-password.php');
        }

        $adminId = (int)$_SESSION['admin_id'];
        $currentPassword = (string)post('current_password', '');
        $newPassword = (string)post('new_password', '');
        $confirmPassword = (string)post('confirm_password', '');

        if ($currentPassword === '' || $newPassword === '') {
            setFlash('error', 'Please fill in all password fields.');
            redirect('admin/profile/change-password.php');
        }

        if ($newPassword !== $confirmPassword) {
            setFlash('error', 'New password and confirmation password do not match.');
            redirect('admin/profile/change-password.php');
        }

        if (strlen($newPassword) < 8) {
            setFlash('error', 'New password must be at least 8 characters long.');
            redirect('admin/profile/change-password.php');
        }

        if (!$this->adminModel->verifyPassword($adminId, $currentPassword)) {
            setFlash('error', 'Current password is incorrect.');
            redirect('admin/profile/change-password.php');
        }

        $hashed = password_hash($newPassword, PASSWORD_BCRYPT);
        if ($this->adminModel->updatePassword($adminId, $hashed)) {
            setFlash('success', 'Password changed successfully.');
            redirect('admin/profile/index.php');
        } else {
            setFlash('error', 'Failed to update password.');
            redirect('admin/profile/change-password.php');
        }
    }
}
