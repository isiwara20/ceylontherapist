<?php
declare(strict_types=1);

/**
 * Public Package Detail Entry Point
 */

require_once __DIR__ . '/config/init.php';

$slug = get('slug', '');
$controller = new PackageController();
$controller->show($slug);
