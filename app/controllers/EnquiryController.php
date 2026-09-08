<?php
declare(strict_types=1);

/**
 * Controller for Customer Booking Enquiries Management
 */

class EnquiryController
{
    private Enquiry $enquiryModel;

    public function __construct()
    {
        requireAdmin();
        $this->enquiryModel = new Enquiry();
    }

    /**
     * Display filtered list of enquiries
     */
    public function index(): void
    {
        $status = get('status');
        $source = get('source');
        $date = get('date');
        $search = get('search');
        $page = max(1, (int)get('page', '1'));
        $limit = 20;
        $offset = ($page - 1) * $limit;

        $filters = [
            'status' => $status,
            'source' => $source,
            'date' => $date,
            'search' => $search
        ];

        $enquiries = $this->enquiryModel->getFiltered($filters, $limit, $offset);
        $totalRecords = $this->enquiryModel->countFiltered($filters);
        $totalPages = (int)ceil($totalRecords / $limit);

        $pageTitle = "Customer Enquiries & Reservations | Admin Panel";
        $pageCss = 'assets/css/admin/enquiries.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/enquiries/index.php';
    }

    /**
     * View single enquiry detail
     * 
     * @param int $id
     */
    public function view(int $id): void
    {
        $enquiry = $this->enquiryModel->find($id);
        if (!$enquiry) {
            setFlash('error', 'Enquiry record not found.');
            redirect('admin/enquiries/index.php');
        }

        $pageTitle = "Enquiry #" . $enquiry['id'] . " - " . $enquiry['customer_name'] . " | Admin Panel";
        $pageCss = 'assets/css/admin/enquiries.css';
        $pageJs = '';

        require BASE_PATH . '/views/admin/enquiries/view.php';
    }

    /**
     * Update enquiry status
     * 
     * @param int $id
     */
    public function updateStatus(int $id): void
    {
        if (!isPost()) {
            redirect('admin/enquiries/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/enquiries/view.php?id=' . $id);
        }

        $status = post('status', '');
        if ($this->enquiryModel->updateStatus($id, $status)) {
            setFlash('success', 'Enquiry status updated successfully.');
        } else {
            setFlash('error', 'Failed to update enquiry status.');
        }

        redirect('admin/enquiries/view.php?id=' . $id);
    }

    /**
     * Delete an enquiry record
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (!isPost()) {
            redirect('admin/enquiries/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/enquiries/index.php');
        }

        if ($this->enquiryModel->delete($id)) {
            setFlash('success', 'Enquiry deleted successfully.');
        } else {
            setFlash('error', 'Failed to delete enquiry.');
        }

        redirect('admin/enquiries/index.php');
    }
}
