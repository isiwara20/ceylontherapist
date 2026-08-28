<?php
declare(strict_types=1);

/**
 * Controller for Admin Service Categories Management
 */

class AdminCategoryController
{
    private CategoryBLL $categoryBLL;

    public function __construct()
    {
        requireAdmin();
        $this->categoryBLL = new CategoryBLL();
    }

    /**
     * Display categories list
     */
    public function index(): void
    {
        $categories = $this->categoryBLL->getAllCategories();
        $pageTitle = "Service Categories | Admin Panel";

        require BASE_PATH . '/views/admin/categories/index.php';
    }

    /**
     * Show create form
     */
    public function create(): void
    {
        $category = null;
        $pageTitle = "Add Category | Admin Panel";

        require BASE_PATH . '/views/admin/categories/create.php';
    }

    /**
     * Store new category
     */
    public function store(): void
    {
        if (!isPost()) {
            redirect('admin_categories.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_category_create.php');
        }

        $input = [
            'name' => post('name'),
            'code' => post('code'),
            'description' => post('description'),
            'display_order' => (int)post('display_order', '0')
        ];

        $res = $this->categoryBLL->saveCategory($input);
        if ($res['success']) {
            setFlash('success', $res['message']);
            redirect('admin_categories.php');
        } else {
            setFlash('error', $res['message']);
            redirect('admin_category_create.php');
        }
    }

    /**
     * Show edit form
     * 
     * @param int $id
     */
    public function edit(int $id): void
    {
        $category = $this->categoryBLL->getCategoryById($id);
        if (!$category) {
            setFlash('error', 'Category not found.');
            redirect('admin_categories.php');
        }

        $pageTitle = "Edit Category: " . $category['name'] . " | Admin Panel";
        require BASE_PATH . '/views/admin/categories/edit.php';
    }

    /**
     * Update category
     * 
     * @param int $id
     */
    public function update(int $id): void
    {
        if (!isPost()) {
            redirect('admin_categories.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_category_edit.php?id=' . $id);
        }

        $input = [
            'name' => post('name'),
            'code' => post('code'),
            'description' => post('description'),
            'display_order' => (int)post('display_order', '0')
        ];

        $res = $this->categoryBLL->saveCategory($input, $id);
        if ($res['success']) {
            setFlash('success', $res['message']);
            redirect('admin_categories.php');
        } else {
            setFlash('error', $res['message']);
            redirect('admin_category_edit.php?id=' . $id);
        }
    }

    /**
     * Delete category
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (!isPost()) {
            redirect('admin_categories.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_categories.php');
        }

        $res = $this->categoryBLL->deleteCategory($id);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }
        redirect('admin_categories.php');
    }
}
