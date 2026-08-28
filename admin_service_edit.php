<?php
declare(strict_types=1);

/**
 * Admin Edit Treatment Service Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminServiceController();
$id = (int)get('id', (int)post('id', '0'));

if ($id <= 0) {
    setFlash('error', 'Invalid treatment ID.');
    redirect('admin_services.php');
}

if (isPost()) {
    $controller->update($id);
} else {
    $controller->edit($id);
}
