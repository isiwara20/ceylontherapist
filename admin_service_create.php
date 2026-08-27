<?php
declare(strict_types=1);

/**
 * Admin Service Create Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminServiceController();
$controller->create();
