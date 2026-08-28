<?php
declare(strict_types=1);

/**
 * Controller for Admin Dashboard Overview
 */

class AdminDashboardController
{
    private DashboardBLL $dashboardBLL;

    public function __construct()
    {
        requireAdmin();
        $this->dashboardBLL = new DashboardBLL();
    }

    /**
     * Render Admin Dashboard View
     */
    public function index(): void
    {
        $admin = currentAdmin();
        $stats = $this->dashboardBLL->getDashboardStats();
        $recentEnquiries = $this->dashboardBLL->getRecentEnquiries(8);
        $activeServices = $this->dashboardBLL->getActiveServices(5);

        $pageTitle = "Dashboard | " . APP_NAME;

        require BASE_PATH . '/views/admin/dashboard.php';
    }
}
