<?php
declare(strict_types=1);

/**
 * Admin Contact Settings Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminSettingsController();

if (isPost()) {
    $controller->updateContactSettings();
} else {
    $controller->contactSettings();
}
