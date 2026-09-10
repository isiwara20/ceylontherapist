<?php
declare(strict_types=1);

/**
 * Controller for Wellness Packages (Public & Admin)
 */

class PackageController
{
    private Package $packageModel;
    private Service $serviceModel;
    private UploadService $uploader;

    public function __construct()
    {
        $this->packageModel = new Package();
        $this->serviceModel = new Service();
        $this->uploader = new UploadService('packages');
    }

    // ==========================================
    // PUBLIC ACTIONS
    // ==========================================

    /**
     * Display public packages listing
     */
    public function index(): void
    {
        $packages = $this->packageModel->getActive();
        $pageTitle = "Wellness Packages | " . APP_NAME;
        $pageCss = 'assets/css/pages/packages.css';
        $pageJs = '';

        require BASE_PATH . '/views/public/packages.php';
    }

    /**
     * Display single package detail view
     * 
     * @param string $slug
     */
    public function show(string $slug): void
    {
        $package = $this->packageModel->findBySlug($slug);

        if (!$package) {
            setFlash('error', 'The requested wellness package could not be found.');
            redirect('packages.php');
        }

        $pageTitle = e($package['title']) . " | " . APP_NAME;
        $pageCss = 'assets/css/pages/package-detail.css';
        $pageJs = '';

        require BASE_PATH . '/views/public/package-detail.php';
    }

    // ==========================================
    // ADMIN ACTIONS
    // ==========================================

    /**
     * Admin packages listing
     */
    public function adminIndex(): void
    {
        requireAdmin();
        $search = get('search');
        $packages = $this->packageModel->all($search);
        $pageTitle = "Wellness Packages | Admin Panel";
        $pageCss = 'assets/css/admin/packages.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/packages/index.php';
    }

    /**
     * Show admin package creation form
     */
    public function create(): void
    {
        requireAdmin();
        $package = null;
        $allServices = $this->serviceModel->all();
        $selectedServiceIds = [];
        $pageTitle = "Add New Wellness Package | Admin Panel";
        $pageCss = 'assets/css/admin/packages.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/packages/create.php';
    }

    /**
     * Store new package
     */
    public function store(): void
    {
        requireAdmin();
        if (!isPost()) {
            redirect('admin/packages/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/packages/create.php');
        }

        $imagePath = null;
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/packages/' . $uploadRes['filename'];
            }
        }

        $title = post('title');
        $slug = post('slug');
        if (empty($slug)) {
            $slug = strtolower(trim((string)preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        if (!$this->packageModel->isSlugUnique($slug)) {
            $slug .= '-' . time();
        }

        $serviceIds = isset($_POST['service_ids']) && is_array($_POST['service_ids']) ? array_map('intval', $_POST['service_ids']) : [];

        $priceInput = post('price');
        $price = ($priceInput !== null && $priceInput !== '' && is_numeric($priceInput)) ? (float)$priceInput : null;

        $data = [
            'title' => $title,
            'slug' => $slug,
            'short_description' => post('short_description'),
            'description' => post('description'),
            'duration_minutes' => (int)post('duration_minutes', '90'),
            'price' => $price,
            'image' => $imagePath,
            'status' => post('status', 'ACTIVE'),
            'display_order' => (int)post('display_order', '0')
        ];

        try {
            $this->packageModel->create($data, $serviceIds);
            setFlash('success', 'Package created successfully.');
            redirect('admin/packages/index.php');
        } catch (Exception $e) {
            setFlash('error', 'Failed to create package: ' . $e->getMessage());
            redirect('admin/packages/create.php');
        }
    }

    /**
     * Show package edit form
     * 
     * @param int $id
     */
    public function edit(int $id): void
    {
        requireAdmin();
        $package = $this->packageModel->find($id);
        if (!$package) {
            setFlash('error', 'Package not found.');
            redirect('admin/packages/index.php');
        }

        $allServices = $this->serviceModel->all();
        $selectedServiceIds = $this->packageModel->getServiceIds($id);
        $pageTitle = "Edit Package: " . $package['title'] . " | Admin Panel";
        $pageCss = 'assets/css/admin/packages.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/packages/edit.php';
    }

    /**
     * Update package
     * 
     * @param int $id
     */
    public function update(int $id): void
    {
        requireAdmin();
        if (!isPost()) {
            redirect('admin/packages/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/packages/edit.php?id=' . $id);
        }

        $existing = $this->packageModel->find($id);
        if (!$existing) {
            setFlash('error', 'Package not found.');
            redirect('admin/packages/index.php');
        }

        $imagePath = $existing['image'];
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/packages/' . $uploadRes['filename'];
            }
        }

        $title = post('title');
        $slug = post('slug');
        if (empty($slug)) {
            $slug = strtolower(trim((string)preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        if (!$this->packageModel->isSlugUnique($slug, $id)) {
            $slug .= '-' . time();
        }

        $serviceIds = isset($_POST['service_ids']) && is_array($_POST['service_ids']) ? array_map('intval', $_POST['service_ids']) : [];

        $priceInput = post('price');
        $price = ($priceInput !== null && $priceInput !== '' && is_numeric($priceInput)) ? (float)$priceInput : null;

        $data = [
            'title' => $title,
            'slug' => $slug,
            'short_description' => post('short_description'),
            'description' => post('description'),
            'duration_minutes' => (int)post('duration_minutes', '90'),
            'price' => $price,
            'image' => $imagePath,
            'status' => post('status', 'ACTIVE'),
            'display_order' => (int)post('display_order', '0')
        ];

        try {
            $this->packageModel->update($id, $data, $serviceIds);
            setFlash('success', 'Package updated successfully.');
            redirect('admin/packages/index.php');
        } catch (Exception $e) {
            setFlash('error', 'Failed to update package: ' . $e->getMessage());
            redirect('admin/packages/edit.php?id=' . $id);
        }
    }

    /**
     * Delete package
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        requireAdmin();
        if (!isPost()) {
            redirect('admin/packages/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/packages/index.php');
        }

        if ($this->packageModel->delete($id)) {
            setFlash('success', 'Package deleted successfully.');
        } else {
            setFlash('error', 'Failed to delete package.');
        }
        redirect('admin/packages/index.php');
    }

    /**
     * Toggle package active status
     * 
     * @param int $id
     */
    public function toggleStatus(int $id): void
    {
        requireAdmin();
        if (!isPost()) {
            redirect('admin/packages/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/packages/index.php');
        }

        if ($this->packageModel->toggleStatus($id)) {
            setFlash('success', 'Package status updated.');
        } else {
            setFlash('error', 'Failed to toggle package status.');
        }

        redirect($_SERVER['HTTP_REFERER'] ?? 'admin/packages/index.php');
    }
}
