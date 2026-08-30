<?php
declare(strict_types=1);

/**
 * Admin Add For Her Sanctuary Experience Entry Point
 */

require_once __DIR__ . '/config/init.php';

$_GET['category'] = 'FOR_HER';
$controller = new AdminServiceController();

if (isPost()) {
    $controller->store();
} else {
    $controller->create();
}
