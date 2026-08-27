<?php
declare(strict_types=1);

/**
 * Controller for Admin Wellness Package Management
 */

class AdminPackageController
{
    private PackageBLL $packageBLL;

    public function __construct()
    {
        requireAdmin();
        $this->packageBLL = new PackageBLL();
    }

    /**
     * Display packages management list
     */
    public function index(): void
    {
        $packages = $this->packageBLL->getActivePackages();
        $pageTitle = "Manage Wellness Packages | Admin Panel";

        require BASE_PATH . '/views/admin/packages/index.php';
    }

    /**
     * Package create placeholder
     */
    public function create(): void
    {
        setFlash('info', 'Package creation placeholder initialized.');
        redirect('admin_packages.php');
    }

    /**
     * Package edit placeholder
     */
    public function edit(int $id): void
    {
        setFlash('info', "Package edit placeholder for ID {$id} initialized.");
        redirect('admin_packages.php');
    }
}
