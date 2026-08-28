<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Admin Profile & Password Management
 */

class AdminProfileBLL
{
    private AdminDAL $adminDAL;
    private FileUploadService $uploader;

    public function __construct()
    {
        $this->adminDAL = new AdminDAL();
        $this->uploader = new FileUploadService('profiles');
    }

    /**
     * Get profile info by admin ID
     * 
     * @param int $adminId
     * @return array|null
     */
    public function getProfile(int $adminId): ?array
    {
        return $this->adminDAL->findById($adminId);
    }

    /**
     * Update admin profile
     * 
     * @param int $adminId
     * @param array $input
     * @param array|null $imageFile
     * @return array
     */
    public function updateProfile(int $adminId, array $input, ?array $imageFile = null): array
    {
        if (!validateRequired($input['name'] ?? null)) {
            return ['success' => false, 'message' => 'Admin name is required.'];
        }

        if (!validateEmail($input['email'] ?? null)) {
            return ['success' => false, 'message' => 'Valid email address is required.'];
        }

        $profileImage = null;
        if ($imageFile !== null && isset($imageFile['tmp_name']) && !empty($imageFile['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($imageFile);
            if ($uploadRes['success']) {
                $profileImage = 'storage/uploads/profiles/' . $uploadRes['filename'];
            }
        }

        $ok = $this->adminDAL->updateProfile($adminId, $input['name'], $input['email'], $profileImage);
        if ($ok) {
            $_SESSION['admin_name'] = $input['name'];
            $_SESSION['admin_email'] = $input['email'];
        }

        return [
            'success' => $ok,
            'message' => $ok ? 'Profile updated successfully.' : 'Failed to update profile.'
        ];
    }

    /**
     * Change admin password with current password verification
     * 
     * @param int $adminId
     * @param string $currentPassword
     * @param string $newPassword
     * @param string $confirmPassword
     * @return array
     */
    public function changePassword(int $adminId, string $currentPassword, string $newPassword, string $confirmPassword): array
    {
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            return ['success' => false, 'message' => 'All password fields are required.'];
        }

        if ($newPassword !== $confirmPassword) {
            return ['success' => false, 'message' => 'New password and confirmation do not match.'];
        }

        if (strlen($newPassword) < 8) {
            return ['success' => false, 'message' => 'New password must be at least 8 characters long.'];
        }

        $admin = $this->adminDAL->findWithPasswordById($adminId);
        if (!$admin) {
            return ['success' => false, 'message' => 'Admin account not found.'];
        }

        if (!password_verify($currentPassword, $admin['password'])) {
            return ['success' => false, 'message' => 'Current password is incorrect.'];
        }

        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $ok = $this->adminDAL->updatePassword($adminId, $hashed);

        if ($ok) {
            session_regenerate_id(true);
        }

        return [
            'success' => $ok,
            'message' => $ok ? 'Password changed successfully.' : 'Failed to update password.'
        ];
    }
}
