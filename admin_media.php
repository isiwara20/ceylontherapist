<?php
declare(strict_types=1);

/**
 * Admin Media Library Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminMediaController();

$action = get('action');
$id = (int)get('id', '0');

if ($action === 'delete' && $id > 0) {
    $controller->delete($id);
} elseif (isPost()) {
    $controller->upload();
} else {
    $controller->index();
}
