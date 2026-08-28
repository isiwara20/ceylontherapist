<?php
declare(strict_types=1);

/**
 * Admin For Her Treatments Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminServiceController();
$controller->forHer();
