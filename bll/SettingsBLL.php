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
        return $this->settingsDAL->getAllSettings();
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
                'phone' => '0771234567',
                'whatsapp' => DEFAULT_WHATSAPP_NUMBER,
                'email' => DEFAULT_BUSINESS_EMAIL,
                'address' => 'Colombo, Sri Lanka',
                'working_hours' => 'Mon - Sun: 9:00 AM - 9:00 PM'
            ];
        }
        return $contact;
    }
}
