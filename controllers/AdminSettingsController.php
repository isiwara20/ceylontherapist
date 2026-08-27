<?php
declare(strict_types=1);

/**
 * Controller for Admin Website & Contact Settings
 */

class AdminSettingsController
{
    private SettingsBLL $settingsBLL;

    public function __construct()
    {
        requireAdmin();
        $this->settingsBLL = new SettingsBLL();
    }

    /**
     * Display settings page
     */
    public function index(): void
    {
        $siteSettings = $this->settingsBLL->getSiteSettings();
        $contactSettings = $this->settingsBLL->getContactSettings();
        $pageTitle = "Website Settings | Admin Panel";

        require BASE_PATH . '/views/admin/settings/index.php';
    }
}
