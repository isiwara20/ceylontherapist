<?php
declare(strict_types=1);

/**
 * Controller for Services, Treatments, For Her, and Couples pages
 */

class TreatmentController
{
    private Service $serviceModel;
    private Setting $settingModel;

    public function __construct()
    {
        $this->serviceModel = new Service();
        $this->settingModel = new Setting();
    }

    /**
     * Render All Treatments / Services List Page
     */
    public function index(): void
    {
        $services = $this->serviceModel->getActive();
        $pageTitle = "Therapy Services & Treatments | " . APP_NAME;
        $pageCss = 'assets/css/pages/treatments.css';
        $pageJs = '';

        require BASE_PATH . '/views/public/treatments.php';
    }

    /**
     * Render "For Her" Specialized Services Page
     */
    public function forHer(): void
    {
        $services = $this->serviceModel->getActive('FOR_HER');
        $contact = $this->settingModel->getContactSettings();
        
        $pageTitle = "For Her - Exclusive Spa & Wellness Sanctuary | " . APP_NAME;
        $pageCss = 'assets/css/pages/for-her.css';
        $pageJs = 'assets/js/pages/for-her.js';

        require BASE_PATH . '/views/public/for-her.php';
    }

    /**
     * Render "Couples" Specialized Services Page
     */
    public function couples(): void
    {
        $services = $this->serviceModel->getActive('COUPLES');
        $pageTitle = "Couples Therapy & Luxury Rituals | " . APP_NAME;
        $pageCss = 'assets/css/pages/couples.css';
        $pageJs = '';

        require BASE_PATH . '/views/public/couples.php';
    }
}
