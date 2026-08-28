<?php
declare(strict_types=1);

/**
 * Admin Enquiries & Bookings Listing Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminEnquiryController();

$action = get('action');
$id = (int)get('id', '0');

if ($action === 'delete' && $id > 0) {
    $controller->delete($id);
} else {
    $controller->index();
}
