<?php
declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/app/bootstrap.php';

$controller = new AdminController();

if (isPost()) {
    $controller->updatePassword();
} else {
    $controller->changePassword();
}
