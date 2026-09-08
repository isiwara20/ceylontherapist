<?php
declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/app/bootstrap.php';

$controller = new CategoryController();

if (isPost() && get('action') === 'delete') {
    $id = (int)get('id', '0');
    $controller->delete($id);
} else {
    $controller->index();
}
