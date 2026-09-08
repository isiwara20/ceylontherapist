<?php
declare(strict_types=1);

/**
 * Admin Login Entry Point
 */

require_once __DIR__ . '/app/bootstrap.php';

$controller = new AuthController();

if (isPost()) {
    $controller->processLogin();
} else {
    $controller->showLogin();
}
