<?php
declare(strict_types=1);

/**
 * Data Access Layer for Site & Contact Settings
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
}
