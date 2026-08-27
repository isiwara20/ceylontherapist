<?php
declare(strict_types=1);

/**
 * Controller for Landing / Home Page
 */

class HomeController
{
    private ServiceBLL $serviceBLL;
    private PackageBLL $packageBLL;

    public function __construct()
    {
        $this->serviceBLL = new ServiceBLL();
        $this->packageBLL = new PackageBLL();
    }

    /**
     * Render Public Home Page
     * 
     * @return void
     */
    public function index(): void
    {
        $featuredServices = array_slice($this->serviceBLL->getPublicServices(), 0, 6);
        $featuredPackages = array_slice($this->packageBLL->getActivePackages(), 0, 3);

        $pageTitle = APP_NAME . " | " . APP_TAGLINE;

        require BASE_PATH . '/views/public/home.php';
    }
}
