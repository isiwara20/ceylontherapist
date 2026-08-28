<?php
declare(strict_types=1);

/**
 * Controller for Admin Home & About Page Content Management
 */

class AdminContentController
{
    private SettingsBLL $settingsBLL;

    public function __construct()
    {
        requireAdmin();
        $this->settingsBLL = new SettingsBLL();
    }

    /**
     * Display Home Page Content Form
     */
    public function homeContent(): void
    {
        $content = $this->settingsBLL->getSiteSettings();
        $pageTitle = "Home Page Content | Admin Panel";

        require BASE_PATH . '/views/admin/content/home.php';
    }

    /**
     * Update Home Page Content POST
     */
    public function updateHomeContent(): void
    {
        if (!isPost()) {
            redirect('admin_home_content.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_home_content.php');
        }

        $input = [
            'hero_eyebrow' => post('hero_eyebrow'),
            'hero_title' => post('hero_title'),
            'hero_desc' => post('hero_desc'),
            'home_cta_primary' => post('home_cta_primary', 'EXPLORE TREATMENTS'),
            'home_cta_secondary' => post('home_cta_secondary', 'RESERVE PRIVATELY')
        ];

        $res = $this->settingsBLL->saveSiteSettings($input);
        if ($res['success']) {
            setFlash('success', 'Home page content updated successfully.');
        } else {
            setFlash('error', 'Failed to update content.');
        }

        redirect('admin_home_content.php');
    }

    /**
     * Display About Page Content Form
     */
    public function aboutContent(): void
    {
        $content = $this->settingsBLL->getSiteSettings();
        $pageTitle = "About Page Content | Admin Panel";

        require BASE_PATH . '/views/admin/content/about.php';
    }

    /**
     * Update About Page Content POST
     */
    public function updateAboutContent(): void
    {
        if (!isPost()) {
            redirect('admin_about_content.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_about_content.php');
        }

        $input = [
            'about_hero_title' => post('about_hero_title'),
            'about_hero_desc' => post('about_hero_desc'),
            'about_story_heading' => post('about_story_heading'),
            'about_story_desc' => post('about_story_desc'),
            'about_philosophy_intro' => post('about_philosophy_intro')
        ];

        $res = $this->settingsBLL->saveSiteSettings($input);
        if ($res['success']) {
            setFlash('success', 'About page content updated successfully.');
        } else {
            setFlash('error', 'Failed to update content.');
        }

        redirect('admin_about_content.php');
    }
}
