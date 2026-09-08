<?php
declare(strict_types=1);

/**
 * Public Package Detail Entry Point
 */

require_once __DIR__ . '/app/bootstrap.php';

$slug = (string)get('slug', '');
$controller = new PackageController();

if ($slug !== '') {
    $controller->show($slug);
} else {
    $controller->index();
}
