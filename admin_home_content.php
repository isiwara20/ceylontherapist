<?php
declare(strict_types=1);

/**
 * Admin Home Page Content Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminContentController();

if (isPost()) {
    $controller->updateHomeContent();
} else {
    $controller->homeContent();
}
