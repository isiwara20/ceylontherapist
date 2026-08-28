<?php
declare(strict_types=1);

/**
 * Data Access Layer for Admin Dashboard Metrics & Activity
 * PDO Prepared Statements Only
 */

class DashboardDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get aggregate statistics for the dashboard cards
     * 
     * @return array
     */
    public function getSummaryStats(): array
    {
        // 1. Total Treatments
        $totalTreatments = (int)$this->db->query("SELECT COUNT(*) FROM services WHERE status = 'ACTIVE'")->fetchColumn();

        // 2. Active Packages
        $activePackages = (int)$this->db->query("SELECT COUNT(*) FROM packages WHERE status = 'ACTIVE'")->fetchColumn();

        // 3. New Enquiries
        $newEnquiries = (int)$this->db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'NEW'")->fetchColumn();

        // 4. Confirmed Bookings
        $confirmedBookings = (int)$this->db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'CONFIRMED'")->fetchColumn();

        // 5. For Her Services count
        $forHerCount = (int)$this->db->query("
            SELECT COUNT(s.id) 
            FROM services s 
            JOIN service_categories c ON s.category_id = c.id 
            WHERE c.code = 'FOR_HER' AND s.status = 'ACTIVE'
        ")->fetchColumn();

        // 6. Couples Services count
        $couplesCount = (int)$this->db->query("
            SELECT COUNT(s.id) 
            FROM services s 
            JOIN service_categories c ON s.category_id = c.id 
            WHERE c.code = 'COUPLES' AND s.status = 'ACTIVE'
        ")->fetchColumn();

        // 7. Pending / Contacted enquiries
        $pendingEnquiries = (int)$this->db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'CONTACTED'")->fetchColumn();

        // 8. Total media files
        $totalMedia = (int)$this->db->query("SELECT COUNT(*) FROM media")->fetchColumn();

        return [
            'total_treatments' => $totalTreatments,
            'active_packages' => $activePackages,
            'new_enquiries' => $newEnquiries,
            'confirmed_bookings' => $confirmedBookings,
            'for_her_services' => $forHerCount,
            'couples_services' => $couplesCount,
            'pending_enquiries' => $pendingEnquiries,
            'total_media' => $totalMedia
        ];
    }

    /**
     * Get recent enquiries list for dashboard
     * 
     * @param int $limit
     * @return array
     */
    public function getRecentEnquiries(int $limit = 6): array
    {
        $sql = "SELECT e.*, s.name AS service_name, p.title AS package_title 
                FROM enquiries e 
                LEFT JOIN services s ON e.service_id = s.id 
                LEFT JOIN packages p ON e.package_id = p.id 
                ORDER BY e.created_at DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll() ?: [];
    }

    /**
     * Get active treatments list for dashboard
     * 
     * @param int $limit
     * @return array
     */
    public function getActiveServices(int $limit = 5): array
    {
        $sql = "SELECT s.*, c.name AS category_name 
                FROM services s 
                LEFT JOIN service_categories c ON s.category_id = c.id 
                WHERE s.status = 'ACTIVE' 
                ORDER BY s.display_order ASC, s.created_at DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll() ?: [];
    }
}
