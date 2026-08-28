<?php
declare(strict_types=1);

/**
 * Admin Edit Category Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminCategoryController();
$id = (int)get('id', (int)post('id', '0'));

if ($id <= 0) {
    setFlash('error', 'Invalid category ID.');
    redirect('admin_categories.php');
}

if (isPost()) {
    $controller->update($id);
} else {
    $controller->edit($id);
}
