<?php
declare(strict_types=1);

/**
 * Controller for Admin Booking / Enquiry Management
 */

class AdminEnquiryController
{
    private EnquiryBLL $enquiryBLL;

    public function __construct()
    {
        requireAdmin();
        $this->enquiryBLL = new EnquiryBLL();
    }

    /**
     * Display filtered enquiries list with pagination
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

        $filters = array_filter([
            'status' => $status,
            'source' => $source,
            'date' => $date,
            'search' => $search
        ]);

        $totalCount = $this->enquiryBLL->countFilteredEnquiries($filters);
        $totalPages = max(1, (int)ceil($totalCount / $limit));
        $enquiries = $this->enquiryBLL->getFilteredEnquiries($filters, $limit, $offset);

        $pageTitle = "Bookings & Enquiries | Admin Panel";

        require BASE_PATH . '/views/admin/enquiries/index.php';
    }

    /**
     * View single enquiry details
     * 
     * @param int $id
     */
    public function view(int $id): void
    {
        $enquiry = $this->enquiryBLL->getEnquiryById($id);
        if (!$enquiry) {
            setFlash('error', 'Enquiry record not found.');
            redirect('admin_enquiries.php');
        }

        $whatsAppUrl = $this->enquiryBLL->buildCustomerWhatsAppUrl($enquiry);
        $pageTitle = "Enquiry #" . $enquiry['id'] . " Details | Admin Panel";

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
            redirect('admin_enquiries.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_enquiry_view.php?id=' . $id);
        }

        $status = post('status', '');
        $res = $this->enquiryBLL->updateEnquiryStatus($id, $status);

        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }

        redirect('admin_enquiry_view.php?id=' . $id);
    }

    /**
     * Delete enquiry
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (!isPost()) {
            redirect('admin_enquiries.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_enquiries.php');
        }

        $res = $this->enquiryBLL->deleteEnquiry($id);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }

        redirect('admin_enquiries.php');
    }
}
