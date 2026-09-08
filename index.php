<?php
declare(strict_types=1);

/**
 * Public Landing Page Entry Point
 */

require_once __DIR__ . '/app/bootstrap.php';

$controller = new HomeController();
$controller->index();
