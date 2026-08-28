<?php
declare(strict_types=1);

/**
 * Admin Website Settings Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminSettingsController();

if (isPost()) {
    $controller->updateSiteSettings();
} else {
    $controller->siteSettings();
}
