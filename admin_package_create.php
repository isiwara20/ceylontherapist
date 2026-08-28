<?php
declare(strict_types=1);

/**
 * Admin Create Package Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminPackageController();

if (isPost()) {
    $controller->store();
} else {
    $controller->create();
}
