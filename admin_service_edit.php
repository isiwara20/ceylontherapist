<?php
declare(strict_types=1);

/**
 * Admin Service Edit Entry Point
 */

require_once __DIR__ . '/config/init.php';

$id = (int)get('id', 0);
$controller = new AdminServiceController();
$controller->edit($id);
