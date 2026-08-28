<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Admin Dashboard Metrics
 */

class DashboardBLL
{
    private DashboardDAL $dashboardDAL;

    public function __construct()
    {
        $this->dashboardDAL = new DashboardDAL();
    }

    /**
     * Get aggregate statistics
     * 
     * @return array
     */
    public function getDashboardStats(): array
    {
        return $this->dashboardDAL->getSummaryStats();
    }

    /**
     * Get recent booking enquiries
     * 
     * @param int $limit
     * @return array
     */
    public function getRecentEnquiries(int $limit = 6): array
    {
        return $this->dashboardDAL->getRecentEnquiries($limit);
    }

    /**
     * Get active treatments list
     * 
     * @param int $limit
     * @return array
     */
    public function getActiveServices(int $limit = 5): array
    {
        return $this->dashboardDAL->getActiveServices($limit);
    }
}
