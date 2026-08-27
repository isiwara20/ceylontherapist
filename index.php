<?php
declare(strict_types=1);

/**
 * Public Landing Page Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new HomeController();
$controller->index();
