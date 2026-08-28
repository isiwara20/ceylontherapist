<?php
declare(strict_types=1);

/**
 * Data Access Layer for Site & Contact Settings
 * PDO Prepared Statements Only
 */

class SettingsDAL
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    /**
     * Get all key-value site settings
     * 
     * @return array Key => Value pairs
     */
    public function getAllSettings(): array
    {
        $sql = "SELECT setting_key, setting_value FROM site_settings";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $pairs = [];
        while ($row = $stmt->fetch()) {
            $pairs[$row['setting_key']] = $row['setting_value'];
        }
        return $pairs;
    }

    /**
     * Get single site setting by key
     * 
     * @param string $key
     * @param string|null $default
     * @return string|null
     */
    public function getSetting(string $key, ?string $default = null): ?string
    {
        $sql = "SELECT setting_value FROM site_settings WHERE setting_key = :key LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':key', $key, PDO::PARAM_STR);
        $stmt->execute();
        $val = $stmt->fetchColumn();
        return ($val !== false && $val !== null) ? (string)$val : $default;
    }

    /**
     * Save or update a single site setting
     * 
     * @param string $key
     * @param string|null $value
     * @return bool
     */
    public function updateSiteSetting(string $key, ?string $value): bool
    {
        $sql = "INSERT INTO site_settings (setting_key, setting_value, updated_at) 
                VALUES (:key, :value, NOW()) 
                ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), updated_at = NOW()";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':key', $key, PDO::PARAM_STR);
        $stmt->bindValue(':value', $value, PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * Update multiple site settings in batch
     * 
     * @param array $pairs
     * @return bool
     */
    public function updateSiteSettingsBatch(array $pairs): bool
    {
        foreach ($pairs as $key => $val) {
            $this->updateSiteSetting((string)$key, $val !== null ? (string)$val : null);
        }
        return true;
    }

    /**
     * Get contact settings record
     * 
     * @return array|null
     */
    public function getContactSettings(): ?array
    {
        $sql = "SELECT * FROM contact_settings LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Update contact settings
     * 
     * @param array $data
     * @return bool
     */
    public function updateContactSettings(array $data): bool
    {
        $sql = "INSERT INTO contact_settings (id, phone, whatsapp, email, address, working_hours, updated_at) 
                VALUES (1, :phone, :whatsapp, :email, :address, :working_hours, NOW()) 
                ON DUPLICATE KEY UPDATE 
                    phone = VALUES(phone), 
                    whatsapp = VALUES(whatsapp), 
                    email = VALUES(email), 
                    address = VALUES(address), 
                    working_hours = VALUES(working_hours), 
                    updated_at = NOW()";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':phone', $data['phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':whatsapp', $data['whatsapp'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':address', $data['address'] ?? null, PDO::PARAM_STR);
        $stmt->bindValue(':working_hours', $data['working_hours'] ?? null, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
