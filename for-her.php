<?php
declare(strict_types=1);

/**
 * Public "For Her" Services Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new TreatmentController();
$controller->forHer();
