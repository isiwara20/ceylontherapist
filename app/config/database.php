<?php
declare(strict_types=1);

/**
 * Database Configuration & Connection Provider
 * Pure PDO with Prepared Statements
 */

class Database
{
    private static ?PDO $instance = null;

    /**
     * Get Singleton PDO Instance
     * 
     * @return PDO
     * @throws Exception
     */
    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $host = (string)env('DB_HOST', 'localhost');
            $port = (int)env('DB_PORT', 3306);
            $dbName = (string)env('DB_DATABASE', env('DB_NAME', 'ceylon_therapist'));
            $username = (string)env('DB_USERNAME', env('DB_USER', 'root'));
            $password = (string)env('DB_PASSWORD', env('DB_PASS', ''));
            $charset = (string)env('DB_CHARSET', 'utf8mb4');

            $dsn = sprintf(
                "mysql:host=%s;port=%d;dbname=%s;charset=%s",
                $host,
                $port,
                $dbName,
                $charset
            );

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $charset
            ];

            try {
                self::$instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
                    throw new Exception("Database Connection Error: " . $e->getMessage(), (int)$e->getCode());
                } else {
                    error_log("Database Connection Error: " . $e->getMessage());
                    throw new Exception("A database error occurred. Please try again later.", 500);
                }
            }
        }

        return self::$instance;
    }

    private function __clone() {}
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }
}
