<?php
declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/app/bootstrap.php';

$controller = new ServiceController();
$id = (int)get('id', '0');

if (isPost()) {
    $controller->update($id);
} else {
    $controller->edit($id);
}
