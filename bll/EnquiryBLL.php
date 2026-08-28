<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Admin Booking & Enquiry Management
 */

class EnquiryBLL
{
    private EnquiryDAL $enquiryDAL;
    private WhatsAppService $whatsAppService;

    public function __construct()
    {
        $this->enquiryDAL = new EnquiryDAL();
        $this->whatsAppService = new WhatsAppService();
    }

    /**
     * Get filtered list of enquiries
     * 
     * @param array $filters
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getFilteredEnquiries(array $filters = [], int $limit = 20, int $offset = 0): array
    {
        return $this->enquiryDAL->getFiltered($filters, $limit, $offset);
    }

    /**
     * Count total filtered enquiries
     * 
     * @param array $filters
     * @return int
     */
    public function countFilteredEnquiries(array $filters = []): int
    {
        return $this->enquiryDAL->countFiltered($filters);
    }

    /**
     * Get single enquiry details
     * 
     * @param int $id
     * @return array|null
     */
    public function getEnquiryById(int $id): ?array
    {
        if ($id <= 0) {
            return null;
        }
        return $this->enquiryDAL->findById($id);
    }

    /**
     * Update status
     * 
     * @param int $id
     * @param string $status (NEW, CONTACTED, CONFIRMED, CANCELLED, COMPLETED)
     * @return array
     */
    public function updateEnquiryStatus(int $id, string $status): array
    {
        $enquiry = $this->enquiryDAL->findById($id);
        if (!$enquiry) {
            return ['success' => false, 'message' => 'Enquiry record not found.'];
        }

        $ok = $this->enquiryDAL->updateStatus($id, $status);
        return [
            'success' => $ok,
            'message' => $ok ? 'Enquiry status updated to ' . $status : 'Failed to update status.'
        ];
    }

    /**
     * Delete enquiry
     * 
     * @param int $id
     * @return array
     */
    public function deleteEnquiry(int $id): array
    {
        $enquiry = $this->enquiryDAL->findById($id);
        if (!$enquiry) {
            return ['success' => false, 'message' => 'Enquiry record not found.'];
        }

        $ok = $this->enquiryDAL->delete($id);
        return [
            'success' => $ok,
            'message' => $ok ? 'Enquiry record deleted successfully.' : 'Failed to delete record.'
        ];
    }

    /**
     * Build customer response WhatsApp link
     * 
     * @param array $enquiry
     * @return string
     */
    public function buildCustomerWhatsAppUrl(array $enquiry): string
    {
        $phone = preg_replace('/[^0-9]/', '', $enquiry['phone'] ?? '');
        if (empty($phone)) {
            return '#';
        }

        $serviceName = $enquiry['service_name'] ?? ($enquiry['package_title'] ?? 'your requested session');
        $msg = "Hello " . $enquiry['customer_name'] . ", this is Ceylon Therapist regarding your enquiry for " . $serviceName . ". We would be delighted to assist you with your private booking.";

        return "https://wa.me/" . $phone . "?text=" . urlencode($msg);
    }
}
