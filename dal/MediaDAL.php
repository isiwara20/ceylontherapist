<?php
declare(strict_types=1);

/**
 * Data Access Layer for Media Library
 * PDO Prepared Statements Only
 */

class MediaDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all media files
     * 
     * @return array
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM media ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll() ?: [];
    }

    /**
     * Find media by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM media WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res ?: null;
    }

    /**
     * Save uploaded media record
     * 
     * @param array $data
     * @return int
     */
    public function create(array $data): int
    {
        $sql = "INSERT INTO media (filename, stored_name, path, mime_type, file_size, alt_text, created_at) 
                VALUES (:filename, :stored_name, :path, :mime_type, :file_size, :alt_text, NOW())";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':filename', $data['filename'], PDO::PARAM_STR);
        $stmt->bindValue(':stored_name', $data['stored_name'], PDO::PARAM_STR);
        $stmt->bindValue(':path', $data['path'], PDO::PARAM_STR);
        $stmt->bindValue(':mime_type', $data['mime_type'], PDO::PARAM_STR);
        $stmt->bindValue(':file_size', (int)($data['file_size'] ?? 0), PDO::PARAM_INT);
        $stmt->bindValue(':alt_text', $data['alt_text'] ?? null, PDO::PARAM_STR);
        $stmt->execute();

        return (int)$this->db->lastInsertId();
    }

    /**
     * Delete media record
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM media WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
