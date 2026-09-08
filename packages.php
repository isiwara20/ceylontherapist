<?php
declare(strict_types=1);

/**
 * Public Wellness Packages Collection Entry Point
 */

require_once __DIR__ . '/app/bootstrap.php';

$controller = new PackageController();
$controller->index();
