<?php
declare(strict_types=1);

/**
 * Controller for Admin Service / Treatment Management
 */

class AdminServiceController
{
    private ServiceBLL $serviceBLL;

    public function __construct()
    {
        requireAdmin();
        $this->serviceBLL = new ServiceBLL();
    }

    /**
     * Display list of services for management
     */
    public function index(): void
    {
        $services = $this->serviceBLL->getPublicServices();
        $pageTitle = "Manage Services & Treatments | Admin Panel";

        require BASE_PATH . '/views/admin/services/index.php';
    }

    /**
     * Show service creation form
     */
    public function create(): void
    {
        $pageTitle = "Add New Treatment Service | Admin Panel";
        setFlash('info', 'Service creation placeholder initialized for step 1 bootstrap.');
        redirect('admin_services.php');
    }

    /**
     * Show service edit form
     * 
     * @param int $id
     */
    public function edit(int $id): void
    {
        setFlash('info', "Service edit placeholder for ID {$id} initialized for step 1 bootstrap.");
        redirect('admin_services.php');
    }
}
