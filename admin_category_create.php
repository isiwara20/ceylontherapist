<?php
declare(strict_types=1);

/**
 * Admin Create Category Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminCategoryController();

if (isPost()) {
    $controller->store();
} else {
    $controller->create();
}
