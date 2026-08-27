<?php
declare(strict_types=1);

/**
 * Public Contact & Booking Entry Point
 */

require_once __DIR__ . '/config/init.php';

$controller = new ContactController();

if (isPost()) {
    $action = post('action', 'whatsapp');
    if ($action === 'email') {
        $controller->handleEmailContact();
    } else {
        $controller->handleBooking();
    }
} else {
    $controller->index();
}
