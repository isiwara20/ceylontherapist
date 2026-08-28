<?php
declare(strict_types=1);

/**
 * Admin About Page Content Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminContentController();

if (isPost()) {
    $controller->updateAboutContent();
} else {
    $controller->aboutContent();
}
