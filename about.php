<?php
declare(strict_types=1);

/**
 * Public About Page Entry Point
 */

require_once __DIR__ . '/app/bootstrap.php';

$controller = new AboutController();
$controller->index();
