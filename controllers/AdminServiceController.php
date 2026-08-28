<?php
declare(strict_types=1);

/**
 * Controller for Admin Service / Treatment Management
 */

class AdminServiceController
{
    private ServiceBLL $serviceBLL;
    private FileUploadService $uploader;

    public function __construct()
    {
        requireAdmin();
        $this->serviceBLL = new ServiceBLL();
        $this->uploader = new FileUploadService('services');
    }

    /**
     * Display list of services for management
     */
    public function index(): void
    {
        $categoryCode = get('category');
        $search = get('search');
        $services = $this->serviceBLL->getAllAdminServices($categoryCode, $search);
        $categories = $this->serviceBLL->getAllCategories();
        $pageTitle = "Treatments & Services | Admin Panel";

        require BASE_PATH . '/views/admin/services/index.php';
    }

    /**
     * Display For Her services
     */
    public function forHer(): void
    {
        $search = get('search');
        $services = $this->serviceBLL->getAllAdminServices('FOR_HER', $search);
        $categories = $this->serviceBLL->getAllCategories();
        $pageTitle = "For Her Sanctuary Services | Admin Panel";
        $categoryFilter = 'FOR_HER';

        require BASE_PATH . '/views/admin/services/index.php';
    }

    /**
     * Display Couples services
     */
    public function couples(): void
    {
        $search = get('search');
        $services = $this->serviceBLL->getAllAdminServices('COUPLES', $search);
        $categories = $this->serviceBLL->getAllCategories();
        $pageTitle = "Couples Shared Rituals | Admin Panel";
        $categoryFilter = 'COUPLES';

        require BASE_PATH . '/views/admin/services/index.php';
    }

    /**
     * Show service creation form
     */
    public function create(): void
    {
        $categories = $this->serviceBLL->getAllCategories();
        $service = null;
        $pageTitle = "Add New Treatment | Admin Panel";

        require BASE_PATH . '/views/admin/services/create.php';
    }

    /**
     * Handle service creation POST request
     */
    public function store(): void
    {
        if (!isPost()) {
            redirect('admin_services.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_service_create.php');
        }

        $imagePath = null;
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/services/' . $uploadRes['filename'];
            }
        }

        $input = [
            'category_id' => (int)post('category_id'),
            'name' => post('name'),
            'slug' => post('slug'),
            'short_description' => post('short_description'),
            'description' => post('description'),
            'duration_minutes' => (int)post('duration_minutes', '60'),
            'image' => $imagePath ?: (post('existing_image') ?: 'assets/images/treatment_essential.jpg'),
            'status' => post('status', 'ACTIVE'),
            'display_order' => (int)post('display_order', '0')
        ];

        $res = $this->serviceBLL->saveService($input);
        if ($res['success']) {
            setFlash('success', $res['message']);
            redirect('admin_services.php');
        } else {
            setFlash('error', $res['message']);
            redirect('admin_service_create.php');
        }
    }

    /**
     * Show service edit form
     * 
     * @param int $id
     */
    public function edit(int $id): void
    {
        $service = $this->serviceBLL->getServiceById($id);
        if (!$service) {
            setFlash('error', 'Treatment not found.');
            redirect('admin_services.php');
        }

        $categories = $this->serviceBLL->getAllCategories();
        $pageTitle = "Edit Treatment: " . $service['name'] . " | Admin Panel";

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
            redirect('admin_services.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_service_edit.php?id=' . $id);
        }

        $imagePath = post('existing_image');
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $uploadRes = $this->uploader->uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = 'storage/uploads/services/' . $uploadRes['filename'];
            }
        }

        $input = [
            'category_id' => (int)post('category_id'),
            'name' => post('name'),
            'slug' => post('slug'),
            'short_description' => post('short_description'),
            'description' => post('description'),
            'duration_minutes' => (int)post('duration_minutes', '60'),
            'image' => $imagePath,
            'status' => post('status', 'ACTIVE'),
            'display_order' => (int)post('display_order', '0')
        ];

        $res = $this->serviceBLL->saveService($input, $id);
        if ($res['success']) {
            setFlash('success', $res['message']);
            redirect('admin_services.php');
        } else {
            setFlash('error', $res['message']);
            redirect('admin_service_edit.php?id=' . $id);
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
            redirect('admin_services.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_services.php');
        }

        $res = $this->serviceBLL->deleteService($id);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }
        redirect('admin_services.php');
    }

    /**
     * Toggle status
     * 
     * @param int $id
     */
    public function toggleStatus(int $id): void
    {
        if (!isPost()) {
            redirect('admin_services.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_services.php');
        }

        $res = $this->serviceBLL->toggleStatus($id);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }
        redirect('admin_services.php');
    }
}
