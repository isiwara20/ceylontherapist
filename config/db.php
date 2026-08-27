<?php
declare(strict_types=1);

/**
 * Database Configuration & Connection Class
 * Pure PHP with PDO Prepared Statements
 */

class Database
{
    private static ?PDO $instance = null;

    private static string $host = 'localhost';
    private static int $port = 3306;
    private static string $dbName = 'ceylon_therapist';
    private static string $username = 'root';
    private static string $password = '';
    private static string $charset = 'utf8mb4';

    /**
     * Get Singleton PDO Instance
     * 
     * @return PDO
     * @throws PDOException
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $dsn = sprintf(
                "mysql:host=%s;port=%d;dbname=%s;charset=%s",
                self::$host,
                self::$port,
                self::$dbName,
                self::$charset
            );

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . self::$charset
            ];

            try {
                self::$instance = new PDO($dsn, self::$username, self::$password, $options);
            } catch (PDOException $e) {
                // Log error safely in production
                if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
                    throw new Exception("Database Connection Error: " . $e->getMessage(), (int)$e->getCode());
                } else {
                    throw new Exception("A database error occurred. Please try again later.", 500);
                }
            }
        }

        return self::$instance;
    }

    /**
     * Prevent cloning of singleton instance
     */
    private function __clone() {}

    /**
     * Prevent unserializing of singleton instance
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }
}
