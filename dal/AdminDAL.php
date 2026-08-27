<?php
declare(strict_types=1);

/**
 * Data Access Layer for Admin Data Operations
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
        $sql = "SELECT id, name, email, password, status, created_at, updated_at 
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
        $sql = "SELECT id, name, email, status, created_at, updated_at 
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
}
