<?php
declare(strict_types=1);

/**
 * Data Access Layer for Customer Booking Enquiries
 * PDO Prepared Statements Only
 */

class EnquiryDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Store new customer enquiry record
     * 
     * @param array $data
     * @return int Inserted enquiry ID
     */
    public function create(array $data): int
    {
        $sql = "INSERT INTO enquiries (service_id, package_id, customer_name, phone, email, preferred_date, preferred_time, message, source, status, created_at)
                VALUES (:service_id, :package_id, :customer_name, :phone, :email, :preferred_date, :preferred_time, :message, :source, :status, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':service_id', !empty($data['service_id']) ? (int)$data['service_id'] : null, PDO::PARAM_INT);
        $stmt->bindValue(':package_id', !empty($data['package_id']) ? (int)$data['package_id'] : null, PDO::PARAM_INT);
        $stmt->bindValue(':customer_name', $data['customer_name'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':preferred_date', $data['preferred_date'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':preferred_time', $data['preferred_time'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':message', $data['message'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':source', $data['source'] ?? 'WHATSAPP', PDO::PARAM_STR);
        $stmt->bindValue(':status', $data['status'] ?? 'NEW', PDO::PARAM_STR);

        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }

    /**
     * Get filtered list of enquiries with pagination
     * 
     * @param array $filters
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getFiltered(array $filters = [], int $limit = 20, int $offset = 0): array
    {
        $sql = "SELECT e.*, s.name AS service_name, p.title AS package_title 
                FROM enquiries e
                LEFT JOIN services s ON e.service_id = s.id
                LEFT JOIN packages p ON e.package_id = p.id
                WHERE 1=1";

        $params = [];

        if (!empty($filters['status'])) {
            $sql .= " AND e.status = :status";
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['source'])) {
            $sql .= " AND e.source = :source";
            $params[':source'] = $filters['source'];
        }

        if (!empty($filters['date'])) {
            $sql .= " AND e.preferred_date = :date";
            $params[':date'] = $filters['date'];
        }

        if (!empty($filters['search'])) {
            $sql .= " AND (e.customer_name LIKE :search OR e.phone LIKE :search OR e.email LIKE :search)";
            $params[':search'] = '%' . $filters['search'] . '%';
        }

        $sql .= " ORDER BY e.created_at DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll() ?: [];
    }

    /**
     * Count total filtered enquiries for pagination
     * 
     * @param array $filters
     * @return int
     */
    public function countFiltered(array $filters = []): int
    {
        $sql = "SELECT COUNT(*) FROM enquiries e WHERE 1=1";
        $params = [];

        if (!empty($filters['status'])) {
            $sql .= " AND e.status = :status";
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['source'])) {
            $sql .= " AND e.source = :source";
            $params[':source'] = $filters['source'];
        }

        if (!empty($filters['date'])) {
            $sql .= " AND e.preferred_date = :date";
            $params[':date'] = $filters['date'];
        }

        if (!empty($filters['search'])) {
            $sql .= " AND (e.customer_name LIKE :search OR e.phone LIKE :search OR e.email LIKE :search)";
            $params[':search'] = '%' . $filters['search'] . '%';
        }

        $stmt = $this->db->prepare($sql);
        foreach ($params as $k => $v) {
            $stmt->bindValue($k, $v, PDO::PARAM_STR);
        }
        $stmt->execute();

        return (int)$stmt->fetchColumn();
    }

    /**
     * Find single enquiry by ID with service/package details
     * 
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT e.*, s.name AS service_name, s.duration_minutes AS service_duration, p.title AS package_title, p.duration_minutes AS package_duration 
                FROM enquiries e
                LEFT JOIN services s ON e.service_id = s.id
                LEFT JOIN packages p ON e.package_id = p.id
                WHERE e.id = :id
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Update enquiry status
     * 
     * @param int $id
     * @param string $status
     * @return bool
     */
    public function updateStatus(int $id, string $status): bool
    {
        $validStatuses = ['NEW', 'CONTACTED', 'CONFIRMED', 'CANCELLED', 'COMPLETED'];
        if (!in_array($status, $validStatuses, true)) {
            return false;
        }

        $sql = "UPDATE enquiries SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Delete an enquiry
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM enquiries WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
