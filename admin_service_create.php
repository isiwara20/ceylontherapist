<?php
declare(strict_types=1);

/**
 * Admin Create Treatment Service Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminServiceController();

if (isPost()) {
    $controller->store();
} else {
    $controller->create();
}
