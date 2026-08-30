<?php
declare(strict_types=1);

/**
 * Admin Add Couples Ritual Experience Entry Point
 */

require_once __DIR__ . '/config/init.php';

$_GET['category'] = 'COUPLES';
$controller = new AdminServiceController();

if (isPost()) {
    $controller->store();
} else {
    $controller->create();
}
