<?php
declare(strict_types=1);

/**
 * Admin For Her Category Management Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminServiceController();
$controller->index();
