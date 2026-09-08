<?php
declare(strict_types=1);

/**
 * Mail Settings Configuration
 */

return [
    'driver' => env('MAIL_MAILER', 'log'),
    'host' => env('MAIL_HOST', 'smtp.mailtrap.io'),
    'port' => (int)env('MAIL_PORT', 2525),
    'username' => env('MAIL_USERNAME', ''),
    'password' => env('MAIL_PASSWORD', ''),
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'no-reply@ceylontherapist.lk'),
        'name' => env('MAIL_FROM_NAME', 'Ceylon Therapist Website')
    ],
    'admin_notification_address' => env('MAIL_ADMIN_ADDRESS', 'info@ceylontherapist.lk')
];
