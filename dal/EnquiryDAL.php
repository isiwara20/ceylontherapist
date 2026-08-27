<?php
declare(strict_types=1);

/**
 * Data Access Layer for Customer Booking Enquiries
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
        $stmt->bindValue(':service_id', $data['service_id'] ?? null, PDO::PARAM_INT);
        $stmt->bindValue(':package_id', $data['package_id'] ?? null, PDO::PARAM_INT);
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
     * Fetch recent enquiries for admin dashboard
     * 
     * @param int $limit
     * @return array
     */
    public function getRecent(int $limit = 10): array
    {
        $sql = "SELECT e.*, s.name AS service_name, p.title AS package_name
                FROM enquiries e
                LEFT JOIN services s ON e.service_id = s.id
                LEFT JOIN packages p ON e.package_id = p.id
                ORDER BY e.created_at DESC
                LIMIT :limit";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
