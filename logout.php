<?php
declare(strict_types=1);

/**
 * Isolated Admin Logout Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminAuthController();
$controller->logout();
