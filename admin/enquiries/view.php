<?php
declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/app/bootstrap.php';

$controller = new EnquiryController();
$id = (int)get('id', '0');

if (isPost()) {
    $controller->updateStatus($id);
} else {
    $controller->view($id);
}
