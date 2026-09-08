<?php
declare(strict_types=1);

/**
 * Public Treatments & Services Entry Point
 */

require_once __DIR__ . '/app/bootstrap.php';

$controller = new TreatmentController();
$controller->index();
