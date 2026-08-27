<?php
declare(strict_types=1);

/**
 * Public About Page Entry Point
 */

require_once __DIR__ . '/config/init.php';

$pageTitle = "About Us | " . APP_NAME;
require BASE_PATH . '/views/public/about.php';
