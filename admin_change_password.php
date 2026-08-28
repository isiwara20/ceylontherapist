<?php
declare(strict_types=1);

/**
 * Admin Change Password Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminProfileController();

if (isPost()) {
    $controller->updatePassword();
} else {
    $controller->changePassword();
}
