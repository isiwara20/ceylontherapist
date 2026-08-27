<?php
declare(strict_types=1);

/**
 * Controller for Admin Dashboard Overview
 */

class AdminDashboardController
{
    private ServiceDAL $serviceDAL;
    private PackageDAL $packageDAL;
    private EnquiryDAL $enquiryDAL;

    public function __construct()
    {
        requireAdmin();
        $this->serviceDAL = new ServiceDAL();
        $this->packageDAL = new PackageDAL();
        $this->enquiryDAL = new EnquiryDAL();
    }

    /**
     * Render Admin Dashboard View
     */
    public function index(): void
    {
        $admin = currentAdmin();
        $services = $this->serviceDAL->getAllActive();
        $packages = $this->packageDAL->getAllActive();
        $recentEnquiries = $this->enquiryDAL->getRecent(5);

        $stats = [
            'total_services' => count($services),
            'total_packages' => count($packages),
            'total_enquiries' => count($recentEnquiries)
        ];

        $pageTitle = "Admin Dashboard | " . APP_NAME;

        require BASE_PATH . '/views/admin/dashboard.php';
    }
}
