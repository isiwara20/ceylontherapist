<?php
declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/app/bootstrap.php';

$controller = new SettingsController();

if (isPost()) {
    $controller->updateContactSettings();
} else {
    $controller->contactSettings();
}
