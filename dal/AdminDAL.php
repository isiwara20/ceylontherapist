<?php
declare(strict_types=1);

/**
 * Data Access Layer for Admin Data Operations
 * PDO Prepared Statements Only
 */

class AdminDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Find admin record by email
     * 
     * @param string $email
     * @return array|null
     */
    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT id, name, email, password, profile_image, status, last_login_at, created_at, updated_at 
                FROM admins 
                WHERE email = :email AND status = 'ACTIVE' 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Find admin by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT id, name, email, profile_image, status, last_login_at, created_at, updated_at 
                FROM admins 
                WHERE id = :id 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Find admin with password by ID (for password verification)
     * 
     * @param int $id
     * @return array|null
     */
    public function findWithPasswordById(int $id): ?array
    {
        $sql = "SELECT id, name, email, password, profile_image, status, last_login_at, created_at, updated_at 
                FROM admins 
                WHERE id = :id 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Update admin profile details
     * 
     * @param int $adminId
     * @param string $name
     * @param string $email
     * @param string|null $profileImage
     * @return bool
     */
    public function updateProfile(int $adminId, string $name, string $email, ?string $profileImage = null): bool
    {
        if ($profileImage !== null) {
            $sql = "UPDATE admins 
                    SET name = :name, email = :email, profile_image = :profile_image, updated_at = NOW() 
                    WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':profile_image', $profileImage, PDO::PARAM_STR);
        } else {
            $sql = "UPDATE admins 
                    SET name = :name, email = :email, updated_at = NOW() 
                    WHERE id = :id";
            $stmt = $this->db->prepare($sql);
        }
        
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $adminId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Update admin password
     * 
     * @param int $adminId
     * @param string $hashedPassword
     * @return bool
     */
    public function updatePassword(int $adminId, string $hashedPassword): bool
    {
        $sql = "UPDATE admins 
                SET password = :password, updated_at = NOW() 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':id', $adminId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Update last login timestamp
     * 
     * @param int $adminId
     * @return bool
     */
    public function updateLastLogin(int $adminId): bool
    {
        $sql = "UPDATE admins 
                SET last_login_at = NOW() 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $adminId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
