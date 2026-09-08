<?php
declare(strict_types=1);

/**
 * Service Category Model
 * Pure PDO Prepared Statements
 */

class Category
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all categories with service count
     * 
     * @return array
     */
    public function all(): array
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
     * Find category by primary ID
     * 
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array
    {
        $sql = "SELECT * FROM service_categories WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    /**
     * Find category by unique code
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
        $code = !empty($data['code'])
            ? strtoupper(trim($data['code']))
            : strtoupper(trim((string)preg_replace('/[^A-Za-z0-9_]+/', '_', $data['name'] ?? 'CAT'), '_'));

        $sql = "INSERT INTO service_categories (code, name, description, display_order, created_at) 
                VALUES (:code, :name, :description, :display_order, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':code', $code, PDO::PARAM_STR);
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
        $code = !empty($data['code'])
            ? strtoupper(trim($data['code']))
            : strtoupper(trim((string)preg_replace('/[^A-Za-z0-9_]+/', '_', $data['name'] ?? 'CAT'), '_'));

        $sql = "UPDATE service_categories 
                SET code = :code, name = :name, description = :description, display_order = :display_order 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':code', $code, PDO::PARAM_STR);
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
