<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Site & Contact Settings
 */

class SettingsBLL
{
    private SettingsDAL $settingsDAL;

    public function __construct()
    {
        $this->settingsDAL = new SettingsDAL();
    }

    /**
     * Retrieve all application settings as key-value array
     * 
     * @return array
     */
    public function getSiteSettings(): array
    {
        $defaults = [
            'site_name' => 'Ceylon Therapist',
            'site_tagline' => 'Private Luxury Wellness & Therapy',
            'meta_title' => 'Ceylon Therapist | Private Luxury Wellness & Therapy in Sri Lanka',
            'meta_description' => 'Thoughtfully designed private therapeutic experiences created to help you slow down, release tension and return to a state of balance in Sri Lanka.',
            'footer_copyright' => 'Ceylon Therapist. All Rights Reserved.',
            'business_location_label' => 'Sri Lanka',
            'booking_cta_text' => 'RESERVE PRIVATELY',
            'hero_eyebrow' => 'PRIVATE. PERSONAL. RESTORATIVE.',
            'hero_title' => 'Your Time.<br>Your Space.<br>Your Escape.',
            'hero_desc' => 'Thoughtfully designed therapeutic experiences created to help you slow down, release tension and return to a state of balance.',
            'about_story_heading' => 'More Than a Service. It’s Your Time to Reset.',
            'about_story_desc' => 'Ceylon Therapist was created around a simple belief: meaningful relaxation begins when you feel comfortable, respected and understood.'
        ];

        $settings = $this->settingsDAL->getAllSettings();
        return array_merge($defaults, $settings);
    }

    /**
     * Retrieve single site setting
     * 
     * @param string $key
     * @param string|null $default
     * @return string|null
     */
    public function getSiteSetting(string $key, ?string $default = null): ?string
    {
        return $this->settingsDAL->getSetting($key, $default);
    }

    /**
     * Save site settings
     * 
     * @param array $input
     * @return array
     */
    public function saveSiteSettings(array $input): array
    {
        $ok = $this->settingsDAL->updateSiteSettingsBatch($input);
        return [
            'success' => $ok,
            'message' => $ok ? 'Website settings saved successfully.' : 'Failed to save website settings.'
        ];
    }

    /**
     * Retrieve business contact details
     * 
     * @return array
     */
    public function getContactSettings(): array
    {
        $contact = $this->settingsDAL->getContactSettings();
        if (!$contact) {
            return [
                'phone' => '0762244114',
                'whatsapp' => DEFAULT_WHATSAPP_NUMBER,
                'email' => DEFAULT_BUSINESS_EMAIL,
                'address' => 'Ceylon Therapist, Sri Lanka',
                'working_hours' => 'By Appointment Only'
            ];
        }
        return $contact;
    }

    /**
     * Save contact settings
     * 
     * @param array $input
     * @return array
     */
    public function saveContactSettings(array $input): array
    {
        $ok = $this->settingsDAL->updateContactSettings($input);
        return [
            'success' => $ok,
            'message' => $ok ? 'Contact settings updated successfully.' : 'Failed to update contact settings.'
        ];
    }
}
