<?php
declare(strict_types=1);

/**
 * Admin Logout Entry Point
 */

require_once __DIR__ . '/app/bootstrap.php';

$controller = new AuthController();
$controller->logout();
