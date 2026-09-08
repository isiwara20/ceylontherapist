<?php
declare(strict_types=1);

/**
 * Controller for Admin Service / Treatment Management
 */

class ServiceController
{
    private Service $serviceModel;
    private Category $categoryModel;
    private UploadService $uploader;

    public function __construct()
    {
        requireAdmin();
        $this->serviceModel = new Service();
        $this->categoryModel = new Category();
        $this->uploader = new UploadService('services');
    }

    /**
     * Display list of services for management
     */
    public function index(): void
    {
        $categoryCode = get('category');
        $search = get('search');
        $services = $this->serviceModel->all($categoryCode, $search);
        $categories = $this->categoryModel->all();
        $pageTitle = "Treatments & Services | Admin Panel";
        $pageCss = 'assets/css/admin/services.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/services/index.php';
    }

    /**
     * Display For Her services
     */
    public function forHer(): void
    {
        $search = get('search');
        $services = $this->serviceModel->all('FOR_HER', $search);
        $categories = $this->categoryModel->all();
        $pageTitle = "For Her Sanctuary Services | Admin Panel";
        $categoryFilter = 'FOR_HER';
        $pageCss = 'assets/css/admin/services.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/services/index.php';
    }

    /**
     * Display Couples services
     */
    public function couples(): void
    {
        $search = get('search');
        $services = $this->serviceModel->all('COUPLES', $search);
        $categories = $this->categoryModel->all();
        $pageTitle = "Couples Shared Rituals | Admin Panel";
        $categoryFilter = 'COUPLES';
        $pageCss = 'assets/css/admin/services.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/services/index.php';
    }

    /**
     * Show service creation form
     */
    public function create(): void
    {
        $service = null;
        $categories = $this->categoryModel->all();
        $preselectedCategoryCode = get('category');
        $pageTitle = "Add New Treatment | Admin Panel";
        $pageCss = 'assets/css/admin/services.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/services/create.php';
    }

    /**
     * Handle service creation POST request
     */
    public function store(): void
    {
        if (!isPost()) {
            redirect('admin/services/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/services/create.php');
        }

        $name = post('name');
        if (!validateRequired($name)) {
            setFlash('error', 'Treatment name is required.');
            redirect('admin/services/create.php');
        }

        $categoryId = (int)post('category_id', '0');
        if ($categoryId <= 0) {
            setFlash('error', 'Please select a valid category.');
            redirect('admin/services/create.php');
        }

        $imagePath = null;
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/services/' . $uploadRes['filename'];
            }
        }

        $slug = post('slug');
        if (empty($slug)) {
            $slug = strtolower(trim((string)preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        if (!$this->serviceModel->isSlugUnique($slug)) {
            $slug .= '-' . time();
        }

        $data = [
            'category_id' => $categoryId,
            'name' => $name,
            'slug' => $slug,
            'short_description' => post('short_description'),
            'description' => post('description'),
            'duration_minutes' => (int)post('duration_minutes', '60'),
            'image' => $imagePath,
            'status' => post('status', 'ACTIVE'),
            'display_order' => (int)post('display_order', '0')
        ];

        try {
            $newId = $this->serviceModel->create($data);
            if ($newId > 0) {
                setFlash('success', 'Treatment created successfully.');
                redirect('admin/services/index.php');
            } else {
                setFlash('error', 'Failed to save treatment.');
                redirect('admin/services/create.php');
            }
        } catch (Exception $e) {
            setFlash('error', 'Database error: ' . $e->getMessage());
            redirect('admin/services/create.php');
        }
    }

    /**
     * Show service edit form
     * 
     * @param int $id
     */
    public function edit(int $id): void
    {
        $service = $this->serviceModel->find($id);
        if (!$service) {
            setFlash('error', 'Treatment record not found.');
            redirect('admin/services/index.php');
        }

        $categories = $this->categoryModel->all();
        $pageTitle = "Edit Treatment: " . $service['name'] . " | Admin Panel";
        $pageCss = 'assets/css/admin/services.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/services/edit.php';
    }

    /**
     * Handle service update POST request
     * 
     * @param int $id
     */
    public function update(int $id): void
    {
        if (!isPost()) {
            redirect('admin/services/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/services/edit.php?id=' . $id);
        }

        $existing = $this->serviceModel->find($id);
        if (!$existing) {
            setFlash('error', 'Treatment record not found.');
            redirect('admin/services/index.php');
        }

        $name = post('name');
        if (!validateRequired($name)) {
            setFlash('error', 'Treatment name is required.');
            redirect('admin/services/edit.php?id=' . $id);
        }

        $categoryId = (int)post('category_id', '0');
        if ($categoryId <= 0) {
            setFlash('error', 'Please select a valid category.');
            redirect('admin/services/edit.php?id=' . $id);
        }

        $imagePath = $existing['image'];
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/services/' . $uploadRes['filename'];
            }
        }

        $slug = post('slug');
        if (empty($slug)) {
            $slug = strtolower(trim((string)preg_replace('/[^A-Za-z0-9-]+/', '-', $name), '-'));
        }

        if (!$this->serviceModel->isSlugUnique($slug, $id)) {
            $slug .= '-' . time();
        }

        $data = [
            'category_id' => $categoryId,
            'name' => $name,
            'slug' => $slug,
            'short_description' => post('short_description'),
            'description' => post('description'),
            'duration_minutes' => (int)post('duration_minutes', '60'),
            'image' => $imagePath,
            'status' => post('status', 'ACTIVE'),
            'display_order' => (int)post('display_order', '0')
        ];

        try {
            if ($this->serviceModel->update($id, $data)) {
                setFlash('success', 'Treatment updated successfully.');
                redirect('admin/services/index.php');
            } else {
                setFlash('error', 'Failed to update treatment.');
                redirect('admin/services/edit.php?id=' . $id);
            }
        } catch (Exception $e) {
            setFlash('error', 'Database error: ' . $e->getMessage());
            redirect('admin/services/edit.php?id=' . $id);
        }
    }

    /**
     * Handle service delete
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (!isPost()) {
            redirect('admin/services/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/services/index.php');
        }

        if ($this->serviceModel->delete($id)) {
            setFlash('success', 'Treatment deleted successfully.');
        } else {
            setFlash('error', 'Failed to delete treatment.');
        }

        redirect('admin/services/index.php');
    }

    /**
     * Toggle service active status
     * 
     * @param int $id
     */
    public function toggleStatus(int $id): void
    {
        if (!isPost()) {
            redirect('admin/services/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/services/index.php');
        }

        if ($this->serviceModel->toggleStatus($id)) {
            setFlash('success', 'Treatment status updated.');
        } else {
            setFlash('error', 'Failed to toggle treatment status.');
        }

        redirect($_SERVER['HTTP_REFERER'] ?? 'admin/services/index.php');
    }
}
