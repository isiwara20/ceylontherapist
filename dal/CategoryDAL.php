<?php
declare(strict_types=1);

/**
 * Data Access Layer for Service Categories
 * PDO Prepared Statements Only
 */

class CategoryDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all categories
     * 
     * @return array
     */
    public function getAll(): array
    {
        $sql = "SELECT c.*, COUNT(s.id) AS service_count 
                FROM service_categories c 
                LEFT JOIN services s ON c.id = s.category_id 
                GROUP BY c.id 
                ORDER BY c.display_order ASC, c.name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll() ?: [];
    }

    /**
     * Find category by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM service_categories WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    /**
     * Find category by code
     * 
     * @param string $code
     * @return array|null
     */
    public function findByCode(string $code): ?array
    {
        $sql = "SELECT * FROM service_categories WHERE code = :code LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':code', strtoupper($code), PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    /**
     * Create category
     * 
     * @param array $data
     * @return int
     */
    public function create(array $data): int
    {
        $sql = "INSERT INTO service_categories (code, name, description, display_order, created_at) 
                VALUES (:code, :name, :description, :display_order, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':code', strtoupper($data['code']), PDO::PARAM_STR);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':display_order', (int)($data['display_order'] ?? 0), PDO::PARAM_INT);
        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Update category
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE service_categories 
                SET code = :code, name = :name, description = :description, display_order = :display_order 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':code', strtoupper($data['code']), PDO::PARAM_STR);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':display_order', (int)($data['display_order'] ?? 0), PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Delete category
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM service_categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
