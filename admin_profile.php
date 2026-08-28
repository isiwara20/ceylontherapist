<?php
declare(strict_types=1);

/**
 * Admin Profile Management Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminProfileController();

if (isPost()) {
    $controller->updateProfile();
} else {
    $controller->profile();
}
