<?php
declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . '/app/bootstrap.php';

$controller = new ServiceController();

if (isPost()) {
    $action = get('action');
    $id = (int)get('id', '0');
    if ($action === 'delete') {
        $controller->delete($id);
    } elseif ($action === 'toggle') {
        $controller->toggleStatus($id);
    } else {
        redirect('admin/services/index.php');
    }
} else {
    $view = get('view');
    if ($view === 'for-her') {
        $controller->forHer();
    } elseif ($view === 'couples') {
        $controller->couples();
    } else {
        $controller->index();
    }
}
