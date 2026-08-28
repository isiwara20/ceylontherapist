<?php
declare(strict_types=1);

/**
 * Data Access Layer for Wellness Packages
 * PDO Prepared Statements & Transactions Only
 */

class PackageDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all packages for admin with optional search
     * 
     * @param string|null $search
     * @return array
     */
    public function getAllAdmin(?string $search = null): array
    {
        $sql = "SELECT p.*, COUNT(ps.service_id) AS service_count 
                FROM packages p 
                LEFT JOIN package_services ps ON p.id = ps.package_id 
                WHERE 1=1";
        
        $params = [];
        if (!empty($search)) {
            $sql .= " AND (p.title LIKE :search OR p.short_description LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }

        $sql .= " GROUP BY p.id ORDER BY p.display_order ASC, p.id DESC";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, PDO::PARAM_STR);
        }
        $stmt->execute();
        return $stmt->fetchAll() ?: [];
    }

    /**
     * Get all active packages for public pages
     * 
     * @return array
     */
    public function getAllActive(): array
    {
        $sql = "SELECT * FROM packages 
                WHERE status = 'ACTIVE' 
                ORDER BY display_order ASC, id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll() ?: [];
    }

    /**
     * Find package by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM packages WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Find package by slug
     * 
     * @param string $slug
     * @return array|null
     */
    public function findBySlug(string $slug): ?array
    {
        $sql = "SELECT * FROM packages WHERE slug = :slug AND status = 'ACTIVE' LIMIT 1";
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
        $sql = "SELECT COUNT(*) FROM packages WHERE slug = :slug";
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
     * Get included service IDs for a package
     * 
     * @param int $packageId
     * @return array Array of service IDs
     */
    public function getServiceIdsForPackage(int $packageId): array
    {
        $sql = "SELECT service_id FROM package_services WHERE package_id = :package_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':package_id', $packageId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    }

    /**
     * Get included services full details for a package
     * 
     * @param int $packageId
     * @return array
     */
    public function getServicesForPackage(int $packageId): array
    {
        $sql = "SELECT s.* FROM services s 
                INNER JOIN package_services ps ON s.id = ps.service_id 
                WHERE ps.package_id = :package_id 
                ORDER BY s.display_order ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':package_id', $packageId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll() ?: [];
    }

    /**
     * Create package with services (using PDO transaction)
     * 
     * @param array $data
     * @param array $serviceIds
     * @return int
     */
    public function createWithServices(array $data, array $serviceIds = []): int
    {
        $this->db->beginTransaction();
        try {
            $sql = "INSERT INTO packages (title, slug, short_description, description, duration_minutes, image, status, display_order, created_at, updated_at) 
                    VALUES (:title, :slug, :short_description, :description, :duration_minutes, :image, :status, :display_order, NOW(), NOW())";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
            $stmt->bindValue(':short_description', $data['short_description'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['description'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':duration_minutes', (int)($data['duration_minutes'] ?? 90), PDO::PARAM_INT);
            $stmt->bindValue(':image', $data['image'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':status', $data['status'] ?? 'ACTIVE', PDO::PARAM_STR);
            $stmt->bindValue(':display_order', (int)($data['display_order'] ?? 0), PDO::PARAM_INT);
            $stmt->execute();

            $packageId = (int)$this->db->lastInsertId();

            if (!empty($serviceIds)) {
                $psSql = "INSERT INTO package_services (package_id, service_id) VALUES (:package_id, :service_id)";
                $psStmt = $this->db->prepare($psSql);
                foreach ($serviceIds as $srvId) {
                    $psStmt->bindValue(':package_id', $packageId, PDO::PARAM_INT);
                    $psStmt->bindValue(':service_id', (int)$srvId, PDO::PARAM_INT);
                    $psStmt->execute();
                }
            }

            $this->db->commit();
            return $packageId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    /**
     * Update package with services (using PDO transaction)
     * 
     * @param int $id
     * @param array $data
     * @param array $serviceIds
     * @return bool
     */
    public function updateWithServices(int $id, array $data, array $serviceIds = []): bool
    {
        $this->db->beginTransaction();
        try {
            $sql = "UPDATE packages 
                    SET title = :title,
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
            $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindValue(':slug', $data['slug'], PDO::PARAM_STR);
            $stmt->bindValue(':short_description', $data['short_description'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['description'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':duration_minutes', (int)($data['duration_minutes'] ?? 90), PDO::PARAM_INT);
            $stmt->bindValue(':image', $data['image'] ?? null, PDO::PARAM_STR);
            $stmt->bindValue(':status', $data['status'] ?? 'ACTIVE', PDO::PARAM_STR);
            $stmt->bindValue(':display_order', (int)($data['display_order'] ?? 0), PDO::PARAM_INT);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Clear old service associations
            $delSql = "DELETE FROM package_services WHERE package_id = :package_id";
            $delStmt = $this->db->prepare($delSql);
            $delStmt->bindValue(':package_id', $id, PDO::PARAM_INT);
            $delStmt->execute();

            // Insert new service associations
            if (!empty($serviceIds)) {
                $psSql = "INSERT INTO package_services (package_id, service_id) VALUES (:package_id, :service_id)";
                $psStmt = $this->db->prepare($psSql);
                foreach ($serviceIds as $srvId) {
                    $psStmt->bindValue(':package_id', $id, PDO::PARAM_INT);
                    $psStmt->bindValue(':service_id', (int)$srvId, PDO::PARAM_INT);
                    $psStmt->execute();
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    /**
     * Delete package
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM packages WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Toggle package status
     * 
     * @param int $id
     * @return bool
     */
    public function toggleStatus(int $id): bool
    {
        $sql = "UPDATE packages 
                SET status = IF(status = 'ACTIVE', 'INACTIVE', 'ACTIVE'), updated_at = NOW() 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
