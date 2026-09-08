<?php
declare(strict_types=1);

require_once __DIR__ . '/app/bootstrap.php';

$target = 'admin/packages/edit.php';
$qs = !empty($_SERVER['QUERY_STRING']) ? (strpos($target, '?') !== false ? '&' : '?') . $_SERVER['QUERY_STRING'] : '';
redirect($target . $qs);
