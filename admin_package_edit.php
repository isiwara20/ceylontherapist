<?php
declare(strict_types=1);

/**
 * Admin Package Edit Entry Point
 */

require_once __DIR__ . '/config/init.php';

$id = (int)get('id', 0);
$controller = new AdminPackageController();
$controller->edit($id);
