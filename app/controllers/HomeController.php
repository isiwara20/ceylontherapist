<?php
declare(strict_types=1);

/**
 * Controller for Landing / Home Page
 */

class HomeController
{
    private Service $serviceModel;
    private Package $packageModel;

    public function __construct()
    {
        $this->serviceModel = new Service();
        $this->packageModel = new Package();
    }

    /**
     * Render Public Home Page
     * 
     * @return void
     */
    public function index(): void
    {
        $featuredServices = array_slice($this->serviceModel->getActive(), 0, 6);
        $featuredPackages = array_slice($this->packageModel->getActive(), 0, 3);

        $pageTitle = APP_NAME . " | " . APP_TAGLINE;
        $pageCss = 'assets/css/pages/home.css';
        $pageJs = '';

        require BASE_PATH . '/views/public/home.php';
    }
}
