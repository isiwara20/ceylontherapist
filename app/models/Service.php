<?php
declare(strict_types=1);

/**
 * Service / Treatment Model
 * Pure PDO Prepared Statements
 */

class Service
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all services with optional category code and search filter
     * 
     * @param string|null $categoryCode
     * @param string|null $search
     * @return array
     */
    public function all(?string $categoryCode = null, ?string $search = null): array
    {
        $sql = "SELECT s.*, c.name AS category_name, c.code AS category_code 
                FROM services s
                LEFT JOIN service_categories c ON s.category_id = c.id
                WHERE 1=1";
        
        $params = [];

        if (!empty($categoryCode)) {
            $sql .= " AND c.code = :cat_code";
            $params[':cat_code'] = strtoupper($categoryCode);
        }

        if (!empty($search)) {
            $sql .= " AND (s.name LIKE :search OR s.short_description LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        $sql .= " ORDER BY s.display_order ASC, s.id DESC";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll() ?: [];
    }

    /**
     * Get active services for public pages
     * 
     * @param string|null $categoryCode
     * @return array
     */
    public function getActive(?string $categoryCode = null): array
    {
        $sql = "SELECT s.*, c.name AS category_name, c.code AS category_code 
                FROM services s
                LEFT JOIN service_categories c ON s.category_id = c.id
                WHERE s.status = 'ACTIVE'";

        $params = [];
        if (!empty($categoryCode)) {
            $sql .= " AND c.code = :cat_code";
            $params[':cat_code'] = strtoupper($categoryCode);
        }

        $sql .= " ORDER BY s.display_order ASC, s.id DESC";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll() ?: [];
    }

    /**
     * Find single service by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array
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
     * Check if slug is unique
     * 
     * @param string $slug
     * @param int|null $excludeId
     * @return bool
     */
    public function isSlugUnique(string $slug, ?int $excludeId = null): bool
    {
        $sql = "SELECT COUNT(*) FROM services WHERE slug = :slug";
        if ($excludeId !== null) {
            $sql .= " AND id != :id";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        if ($excludeId !== null) {
            $stmt->bindValue(':id', $excludeId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn() === 0;
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
        $stmt->bindValue(':category_id', (int)$data['category_id'], PDO::PARAM_INT);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':short_description', $data['short_description'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':duration_minutes', (int)($data['duration_minutes'] ?? 60), PDO::PARAM_INT);
        $stmt->bindValue(':image', $data['image'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['status'] ?? 'ACTIVE', PDO::PARAM_STR);
        $stmt->bindValue(':display_order', (int)($data['display_order'] ?? 0), PDO::PARAM_INT);

        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Update an existing service record
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE services 
                SET category_id = :category_id,
                    name = :name,
                    slug = :slug,
                    short_description = :short_description,
                    description = :description,
                    duration_minutes = :duration_minutes,
                    image = :image,
                    status = :status,
                    display_order = :display_order,
                    updated_at = NOW()
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':category_id', (int)$data['category_id'], PDO::PARAM_INT);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':short_description', $data['short_description'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':description', $data['description'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':duration_minutes', (int)($data['duration_minutes'] ?? 60), PDO::PARAM_INT);
        $stmt->bindValue(':image', $data['image'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['status'] ?? 'ACTIVE', PDO::PARAM_STR);
        $stmt->bindValue(':display_order', (int)($data['display_order'] ?? 0), PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Delete a service record
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM services WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Toggle service status between ACTIVE and INACTIVE
     * 
     * @param int $id
     * @return bool
     */
    public function toggleStatus(int $id): bool
    {
        $sql = "UPDATE services SET status = IF(status = 'ACTIVE', 'INACTIVE', 'ACTIVE'), updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

