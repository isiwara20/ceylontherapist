<?php
declare(strict_types=1);

/**
 * Admin Package Create Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminPackageController();
$controller->create();
