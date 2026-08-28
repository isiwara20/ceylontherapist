<?php
declare(strict_types=1);

/**
 * Isolated Admin Login Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminAuthController();

if (isPost()) {
    $controller->processLogin();
} else {
    $controller->showLogin();
}
