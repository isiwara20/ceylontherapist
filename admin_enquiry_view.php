<?php
declare(strict_types=1);

/**
 * Admin Enquiry View & Status Update Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new AdminEnquiryController();
$id = (int)get('id', (int)post('id', '0'));

if ($id <= 0) {
    setFlash('error', 'Invalid enquiry reference.');
    redirect('admin_enquiries.php');
}

if (isPost()) {
    $controller->updateStatus($id);
} else {
    $controller->view($id);
}
