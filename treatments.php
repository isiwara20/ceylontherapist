<?php
declare(strict_types=1);

/**
 * Public Treatments & Services Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new TreatmentController();
$controller->index();
