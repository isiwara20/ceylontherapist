<?php
declare(strict_types=1);

/**
 * Admin Edit Package Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminPackageController();
$id = (int)get('id', (int)post('id', '0'));

if ($id <= 0) {
    setFlash('error', 'Invalid package ID.');
    redirect('admin_packages.php');
}

if (isPost()) {
    $controller->update($id);
} else {
    $controller->edit($id);
}
