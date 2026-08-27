<?php
declare(strict_types=1);

/**
 * Controller for Packages and Package Detail Pages
 */

class PackageController
{
    private PackageBLL $packageBLL;

    public function __construct()
    {
        $this->packageBLL = new PackageBLL();
    }

    /**
     * Display single package detail view
     * 
     * @param string $slug
     */
    public function show(string $slug): void
    {
        $package = $this->packageBLL->getPackageBySlug($slug);

        if (!$package) {
            setFlash('error', 'The requested wellness package could not be found.');
            redirect('index.php');
        }

        $pageTitle = e($package['title']) . " | " . APP_NAME;
        require BASE_PATH . '/views/public/package-detail.php';
    }
}
