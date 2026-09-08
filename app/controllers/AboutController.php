<?php
declare(strict_types=1);

/**
 * Controller for Public About Page
 */

class AboutController
{
    private Setting $settingModel;

    public function __construct()
    {
        $this->settingModel = new Setting();
    }

    /**
     * Render Public About Page
     * 
     * @return void
     */
    public function index(): void
    {
        $settings = $this->settingModel->all();

        $pageTitle = "About Us | " . APP_NAME;
        $pageCss = 'assets/css/pages/about.css';
        $pageJs = '';

        require BASE_PATH . '/views/public/about.php';
    }
}
