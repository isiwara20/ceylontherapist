<?php
declare(strict_types=1);

/**
 * Controller for Admin Website & Contact Settings
 */

class AdminSettingsController
{
    private SettingsBLL $settingsBLL;
    private FileUploadService $uploader;

    public function __construct()
    {
        requireAdmin();
        $this->settingsBLL = new SettingsBLL();
        $this->uploader = new FileUploadService('branding');
    }

    /**
     * Display Site Settings Form
     */
    public function siteSettings(): void
    {
        $siteSettings = $this->settingsBLL->getSiteSettings();
        $pageTitle = "Website Settings | Admin Panel";

        require BASE_PATH . '/views/admin/settings/site.php';
    }

    /**
     * Update Site Settings POST
     */
    public function updateSiteSettings(): void
    {
        if (!isPost()) {
            redirect('admin_site_settings.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_site_settings.php');
        }

        $input = [
            'site_name' => post('site_name'),
            'site_tagline' => post('site_tagline'),
            'meta_title' => post('meta_title'),
            'meta_description' => post('meta_description'),
            'footer_copyright' => post('footer_copyright'),
            'business_location_label' => post('business_location_label'),
            'booking_cta_text' => post('booking_cta_text')
        ];

        $res = $this->settingsBLL->saveSiteSettings($input);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }

        redirect('admin_site_settings.php');
    }

    /**
     * Display Contact Settings Form
     */
    public function contactSettings(): void
    {
        $contactSettings = $this->settingsBLL->getContactSettings();
        $pageTitle = "Contact Details & Socials | Admin Panel";

        require BASE_PATH . '/views/admin/settings/contact.php';
    }

    /**
     * Update Contact Settings POST
     */
    public function updateContactSettings(): void
    {
        if (!isPost()) {
            redirect('admin_contact_settings.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_contact_settings.php');
        }

        $input = [
            'phone' => post('phone'),
            'whatsapp' => post('whatsapp'),
            'email' => post('email'),
            'address' => post('address'),
            'working_hours' => post('working_hours')
        ];

        $res = $this->settingsBLL->saveContactSettings($input);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }

        redirect('admin_contact_settings.php');
    }
}
