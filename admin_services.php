<?php
declare(strict_types=1);

/**
 * Admin Treatments & Services Listing Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminServiceController();

$action = get('action');
$id = (int)get('id', '0');

if ($action === 'delete' && $id > 0) {
    $controller->delete($id);
} elseif ($action === 'toggle' && $id > 0) {
    $controller->toggleStatus($id);
} else {
    $controller->index();
}
