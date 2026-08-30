<?php
declare(strict_types=1);

/**
 * Controller for Services, Treatments, For Her, and Couples pages
 */

class TreatmentController
{
    private ServiceBLL $serviceBLL;

    public function __construct()
    {
        $this->serviceBLL = new ServiceBLL();
    }

    /**
     * Render All Treatments / Services List Page
     */
    public function index(): void
    {
        $services = $this->serviceBLL->getPublicServices();
        $pageTitle = "Therapy Services & Treatments | " . APP_NAME;

        require BASE_PATH . '/views/public/treatments.php';
    }

    /**
     * Render "For Her" Specialized Services Page
     */
    public function forHer(): void
    {
        $services = $this->serviceBLL->getServicesByCategory('FOR_HER');
        $contact = (new SettingsBLL())->getContactSettings();
        $pageTitle = "For Her - Exclusive Spa & Wellness Sanctuary | " . APP_NAME;

        require BASE_PATH . '/views/public/for-her.php';
    }

    /**
     * Render "Couples" Specialized Services Page
     */
    public function couples(): void
    {
        $services = $this->serviceBLL->getServicesByCategory('COUPLES');
        $pageTitle = "Couples Therapy & Luxury Rituals | " . APP_NAME;

        require BASE_PATH . '/views/public/couples.php';
    }
}
