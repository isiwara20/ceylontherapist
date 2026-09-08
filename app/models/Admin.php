<?php
declare(strict_types=1);

/**
 * Admin Model
 * Handles administrator database operations
 */

class Admin
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Find admin by email
     * 
     * @param string $email
     * @return array|null
     */
    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM admins WHERE email = :email AND status = 'ACTIVE' LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', strtolower(trim($email)), PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    /**
     * Find admin by primary ID
     * 
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT id, name, email, profile_image, status, last_login_at, created_at, updated_at 
                FROM admins 
                WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    /**
     * Update last login timestamp
     * 
     * @param int $id
     * @return bool
     */
    public function updateLastLogin(int $id): bool
    {
        $sql = "UPDATE admins SET last_login_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Update admin profile details
     * 
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string|null $profileImage
     * @return bool
     */
    public function updateProfile(int $id, string $name, string $email, ?string $profileImage = null): bool
    {
        if ($profileImage !== null) {
            $sql = "UPDATE admins SET name = :name, email = :email, profile_image = :profile_image WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':profile_image', $profileImage, PDO::PARAM_STR);
        } else {
            $sql = "UPDATE admins SET name = :name, email = :email WHERE id = :id";
            $stmt = $this->db->prepare($sql);
        }

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', strtolower(trim($email)), PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Verify if current plain password matches stored hash
     * 
     * @param int $id
     * @param string $plainPassword
     * @return bool
     */
    public function verifyPassword(int $id, string $plainPassword): bool
    {
        $sql = "SELECT password FROM admins WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return false;
        }

        return password_verify($plainPassword, $row['password']);
    }

    /**
     * Update admin hashed password
     * 
     * @param int $id
     * @param string $hashedPassword
     * @return bool
     */
    public function updatePassword(int $id, string $hashedPassword): bool
    {
        $sql = "UPDATE admins SET password = :password WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
