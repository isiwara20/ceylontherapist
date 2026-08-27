<?php
declare(strict_types=1);

/**
 * Admin Packages Management Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminPackageController();
$controller->index();
