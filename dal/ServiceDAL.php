<?php
declare(strict_types=1);

/**
 * Data Access Layer for Services / Treatments
 */

class ServiceDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all active services with category name
     * 
     * @return array
     */
    public function getAllActive(): array
    {
        $sql = "SELECT s.*, c.name AS category_name, c.slug AS category_slug 
                FROM services s
                LEFT JOIN service_categories c ON s.category_id = c.id
                WHERE s.status = 'ACTIVE'
                ORDER BY s.display_order ASC, s.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get active services filtered by category code (GENERAL, FOR_HER, COUPLES)
     * 
     * @param string $categoryCode
     * @return array
     */
    public function getByCategoryCode(string $categoryCode): array
    {
        $sql = "SELECT s.*, c.name AS category_name, c.code AS category_code
                FROM services s
                INNER JOIN service_categories c ON s.category_id = c.id
                WHERE c.code = :code AND s.status = 'ACTIVE'
                ORDER BY s.display_order ASC, s.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':code', strtoupper($categoryCode), PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Find single service by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT s.*, c.name AS category_name, c.code AS category_code
                FROM services s
                LEFT JOIN service_categories c ON s.category_id = c.id
                WHERE s.id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Find single service by slug
     * 
     * @param string $slug
     * @return array|null
     */
    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT s.*, c.name AS category_name 
                FROM services s
                LEFT JOIN service_categories c ON s.category_id = c.id
                WHERE s.slug = :slug AND s.status = 'ACTIVE'
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Create a new service record
     * 
     * @param array $data
     * @return int Inserted ID
     */
    public function create(array $data): int
    {
        $sql = "INSERT INTO services (category_id, name, slug, short_description, description, duration_minutes, image, status, display_order, created_at, updated_at)
                VALUES (:category_id, :name, :slug, :short_description, :description, :duration_minutes, :image, :status, :display_order, NOW(), NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category_id', $data['category_id'], PDO::PARAM_INT);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':short_description', $data['short_description'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':duration_minutes', $data['duration_minutes'] ?? 60, PDO::PARAM_INT);
        $stmt->bindValue(':image', $data['image'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['status'] ?? 'ACTIVE', PDO::PARAM_STR);
        $stmt->bindValue(':display_order', $data['display_order'] ?? 0, PDO::PARAM_INT);

        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Get all categories
     * 
     * @return array
     */
    public function getAllCategories(): array
    {
        $sql = "SELECT * FROM service_categories ORDER BY display_order ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
