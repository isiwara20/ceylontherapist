<?php
declare(strict_types=1);

/**
 * Admin Service Categories Listing Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminCategoryController();

$action = get('action');
$id = (int)get('id', '0');

if ($action === 'delete' && $id > 0) {
    $controller->delete($id);
} else {
    $controller->index();
}
