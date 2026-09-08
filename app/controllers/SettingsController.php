<?php
declare(strict_types=1);

/**
 * Controller for Admin Website Settings & CMS Content
 */

class SettingsController
{
    private Setting $settingModel;

    public function __construct()
    {
        requireAdmin();
        $this->settingModel = new Setting();
    }

    /**
     * Display Site Settings Form
     */
    public function siteSettings(): void
    {
        $siteSettings = $this->settingModel->all();
        $pageTitle = "Website Settings | Admin Panel";
        $pageCss = 'assets/css/admin/settings.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/settings/site.php';
    }

    /**
     * Update Site Settings POST
     */
    public function updateSiteSettings(): void
    {
        if (!isPost()) {
            redirect('admin/settings/site.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/settings/site.php');
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

        if ($this->settingModel->setBatch($input)) {
            setFlash('success', 'Website settings saved successfully.');
        } else {
            setFlash('error', 'Failed to update website settings.');
        }

        redirect('admin/settings/site.php');
    }

    /**
     * Display Contact Settings Form
     */
    public function contactSettings(): void
    {
        $contactSettings = $this->settingModel->getContactSettings();
        $pageTitle = "Contact Details & Socials | Admin Panel";
        $pageCss = 'assets/css/admin/settings.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/settings/contact.php';
    }

    /**
     * Update Contact Settings POST
     */
    public function updateContactSettings(): void
    {
        if (!isPost()) {
            redirect('admin/settings/contact.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/settings/contact.php');
        }

        $input = [
            'phone' => post('phone'),
            'whatsapp' => post('whatsapp'),
            'email' => post('email'),
            'address' => post('address'),
            'working_hours' => post('working_hours')
        ];

        if ($this->settingModel->updateContactSettings($input)) {
            setFlash('success', 'Contact settings updated successfully.');
        } else {
            setFlash('error', 'Failed to update contact settings.');
        }

        redirect('admin/settings/contact.php');
    }

    /**
     * Display Home Page Content Form
     */
    public function homeContent(): void
    {
        $content = $this->settingModel->all();
        $pageTitle = "Home Page Content | Admin Panel";
        $pageCss = 'assets/css/admin/settings.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/content/home.php';
    }

    /**
     * Update Home Page Content POST
     */
    public function updateHomeContent(): void
    {
        if (!isPost()) {
            redirect('admin/content/home.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/content/home.php');
        }

        $input = [
            'hero_eyebrow' => post('hero_eyebrow'),
            'hero_title' => post('hero_title'),
            'hero_desc' => post('hero_desc'),
            'home_cta_primary' => post('home_cta_primary', 'EXPLORE TREATMENTS'),
            'home_cta_secondary' => post('home_cta_secondary', 'RESERVE PRIVATELY')
        ];

        if ($this->settingModel->setBatch($input)) {
            setFlash('success', 'Home page content updated successfully.');
        } else {
            setFlash('error', 'Failed to update home content.');
        }

        redirect('admin/content/home.php');
    }

    /**
     * Display About Page Content Form
     */
    public function aboutContent(): void
    {
        $content = $this->settingModel->all();
        $pageTitle = "About Page Content | Admin Panel";
        $pageCss = 'assets/css/admin/settings.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/content/about.php';
    }

    /**
     * Update About Page Content POST
     */
    public function updateAboutContent(): void
    {
        if (!isPost()) {
            redirect('admin/content/about.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/content/about.php');
        }

        $input = [
            'about_hero_title' => post('about_hero_title'),
            'about_hero_desc' => post('about_hero_desc'),
            'about_story_heading' => post('about_story_heading'),
            'about_story_desc' => post('about_story_desc'),
            'about_philosophy_intro' => post('about_philosophy_intro')
        ];

        if ($this->settingModel->setBatch($input)) {
            setFlash('success', 'About page content updated successfully.');
        } else {
            setFlash('error', 'Failed to update about content.');
        }

        redirect('admin/content/about.php');
    }
}
