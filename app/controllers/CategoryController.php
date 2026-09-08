<?php
declare(strict_types=1);

/**
 * Controller for Service Categories Management
 */

class CategoryController
{
    private Category $categoryModel;

    public function __construct()
    {
        requireAdmin();
        $this->categoryModel = new Category();
    }

    /**
     * Display categories list
     */
    public function index(): void
    {
        $categories = $this->categoryModel->all();
        $pageTitle = "Service Categories | Admin Panel";
        $pageCss = 'assets/css/admin/categories.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/categories/index.php';
    }

    /**
     * Show create form
     */
    public function create(): void
    {
        $category = null;
        $pageTitle = "Add Category | Admin Panel";
        $pageCss = 'assets/css/admin/categories.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/categories/create.php';
    }

    /**
     * Store new category
     */
    public function store(): void
    {
        if (!isPost()) {
            redirect('admin/categories/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/categories/create.php');
        }

        $name = post('name');
        if (!validateRequired($name)) {
            setFlash('error', 'Category name is required.');
            redirect('admin/categories/create.php');
        }

        $input = [
            'name' => $name,
            'code' => post('code'),
            'description' => post('description'),
            'display_order' => (int)post('display_order', '0')
        ];

        $newId = $this->categoryModel->create($input);
        if ($newId > 0) {
            setFlash('success', 'Category created successfully.');
            redirect('admin/categories/index.php');
        } else {
            setFlash('error', 'Failed to create category.');
            redirect('admin/categories/create.php');
        }
    }

    /**
     * Show edit form
     * 
     * @param int $id
     */
    public function edit(int $id): void
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            setFlash('error', 'Category not found.');
            redirect('admin/categories/index.php');
        }

        $pageTitle = "Edit Category: " . $category['name'] . " | Admin Panel";
        $pageCss = 'assets/css/admin/categories.css';
        $pageJs = '';

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
            redirect('admin/categories/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/categories/edit.php?id=' . $id);
        }

        $name = post('name');
        if (!validateRequired($name)) {
            setFlash('error', 'Category name is required.');
            redirect('admin/categories/edit.php?id=' . $id);
        }

        $input = [
            'name' => $name,
            'code' => post('code'),
            'description' => post('description'),
            'display_order' => (int)post('display_order', '0')
        ];

        if ($this->categoryModel->update($id, $input)) {
            setFlash('success', 'Category updated successfully.');
            redirect('admin/categories/index.php');
        } else {
            setFlash('error', 'Failed to update category.');
            redirect('admin/categories/edit.php?id=' . $id);
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
            redirect('admin/categories/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/categories/index.php');
        }

        if ($this->categoryModel->delete($id)) {
            setFlash('success', 'Category deleted successfully.');
        } else {
            setFlash('error', 'Failed to delete category.');
        }
        redirect('admin/categories/index.php');
    }
}
