<?php
declare(strict_types=1);

/**
 * Controller for Admin Wellness Package Management
 */

class AdminPackageController
{
    private PackageBLL $packageBLL;
    private ServiceBLL $serviceBLL;
    private FileUploadService $uploader;

    public function __construct()
    {
        requireAdmin();
        $this->packageBLL = new PackageBLL();
        $this->serviceBLL = new ServiceBLL();
        $this->uploader = new FileUploadService('packages');
    }

    /**
     * Display packages management list
     */
    public function index(): void
    {
        $search = get('search');
        $packages = $this->packageBLL->getAllAdminPackages($search);
        $pageTitle = "Wellness Packages | Admin Panel";

        require BASE_PATH . '/views/admin/packages/index.php';
    }

    /**
     * Show package creation form
     */
    public function create(): void
    {
        $package = null;
        $allServices = $this->serviceBLL->getAllAdminServices();
        $selectedServiceIds = [];
        $pageTitle = "Add New Wellness Package | Admin Panel";

        require BASE_PATH . '/views/admin/packages/create.php';
    }

    /**
     * Handle package creation POST request
     */
    public function store(): void
    {
        if (!isPost()) {
            redirect('admin_packages.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_package_create.php');
        }

        $imagePath = null;
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/packages/' . $uploadRes['filename'];
            }
        }

        $input = [
            'title' => post('title'),
            'slug' => post('slug'),
            'short_description' => post('short_description'),
            'description' => post('description'),
            'duration_minutes' => (int)post('duration_minutes', '90'),
            'image' => $imagePath ?: (post('existing_image') ?: 'assets/images/sanctuary_interior.jpg'),
            'status' => post('status', 'ACTIVE'),
            'display_order' => (int)post('display_order', '0')
        ];

        $serviceIds = post('services', []);
        if (!is_array($serviceIds)) {
            $serviceIds = [];
        }

        $res = $this->packageBLL->savePackage($input, $serviceIds);
        if ($res['success']) {
            setFlash('success', $res['message']);
            redirect('admin_packages.php');
        } else {
            setFlash('error', $res['message']);
            redirect('admin_package_create.php');
        }
    }

    /**
     * Show package edit form
     * 
     * @param int $id
     */
    public function edit(int $id): void
    {
        $package = $this->packageBLL->getPackageById($id);
        if (!$package) {
            setFlash('error', 'Package not found.');
            redirect('admin_packages.php');
        }

        $allServices = $this->serviceBLL->getAllAdminServices();
        $selectedServiceIds = $this->packageBLL->getServiceIdsForPackage($id);
        $pageTitle = "Edit Package: " . $package['title'] . " | Admin Panel";

        require BASE_PATH . '/views/admin/packages/edit.php';
    }

    /**
     * Handle package update POST request
     * 
     * @param int $id
     */
    public function update(int $id): void
    {
        if (!isPost()) {
            redirect('admin_packages.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_package_edit.php?id=' . $id);
        }

        $imagePath = post('existing_image');
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/packages/' . $uploadRes['filename'];
            }
        }

        $input = [
            'title' => post('title'),
            'slug' => post('slug'),
            'short_description' => post('short_description'),
            'description' => post('description'),
            'duration_minutes' => (int)post('duration_minutes', '90'),
            'image' => $imagePath,
            'status' => post('status', 'ACTIVE'),
            'display_order' => (int)post('display_order', '0')
        ];

        $serviceIds = post('services', []);
        if (!is_array($serviceIds)) {
            $serviceIds = [];
        }

        $res = $this->packageBLL->savePackage($input, $serviceIds, $id);
        if ($res['success']) {
            setFlash('success', $res['message']);
            redirect('admin_packages.php');
        } else {
            setFlash('error', $res['message']);
            redirect('admin_package_edit.php?id=' . $id);
        }
    }

    /**
     * Delete package
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (!isPost()) {
            redirect('admin_packages.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_packages.php');
        }

        $res = $this->packageBLL->deletePackage($id);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }
        redirect('admin_packages.php');
    }

    /**
     * Toggle status
     * 
     * @param int $id
     */
    public function toggleStatus(int $id): void
    {
        if (!isPost()) {
            redirect('admin_packages.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_packages.php');
        }

        $res = $this->packageBLL->toggleStatus($id);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }
        redirect('admin_packages.php');
    }
}
