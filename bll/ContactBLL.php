<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Contact & Booking Enquiries
 */

class ContactBLL
{
    private EnquiryDAL $enquiryDAL;
    private WhatsAppService $whatsAppService;
    private EmailService $emailService;

    public function __construct()
    {
        $this->enquiryDAL = new EnquiryDAL();
        $this->whatsAppService = new WhatsAppService();
        $this->emailService = new EmailService();
    }

    /**
     * Process WhatsApp booking enquiry, store record, and generate redirect URL
     * 
     * @param array $input
     * @return array ['success' => bool, 'redirect_url' => string, 'message' => string]
     */
    public function processBookingEnquiry(array $input): array
    {
        if (!validateRequired($input['customer_name'] ?? null)) {
            return ['success' => false, 'redirect_url' => '', 'message' => 'Your name is required.'];
        }

        // Store enquiry record in database for business record keeping
        $enquiryId = $this->enquiryDAL->create($input);

        // Generate encoded WhatsApp booking URL
        $whatsAppUrl = $this->whatsAppService->buildBookingUrl($input);

        return [
            'success' => true,
            'enquiry_id' => $enquiryId,
            'redirect_url' => $whatsAppUrl,
            'message' => 'Booking enquiry recorded. Redirecting to WhatsApp...'
        ];
    }

    /**
     * Process standard email contact form message
     * 
     * @param array $input
     * @return array
     */
    public function processEmailContact(array $input): array
    {
        if (!validateRequired($input['name'] ?? null) || !validateRequired($input['email'] ?? null) || !validateRequired($input['message'] ?? null)) {
            return ['success' => false, 'message' => 'Please fill in all required fields.'];
        }

        if (!validateEmail($input['email'])) {
            return ['success' => false, 'message' => 'Invalid email address.'];
        }

        $subject = "New Contact Enquiry from " . $input['name'];
        $body = "Name: {$input['name']}\nEmail: {$input['email']}\nPhone: " . ($input['phone'] ?? 'N/A') . "\nMessage:\n{$input['message']}";

        $adminEmail = defined('DEFAULT_BUSINESS_EMAIL') ? DEFAULT_BUSINESS_EMAIL : 'info@ceylontherapist.lk';
        $sent = $this->emailService->send($adminEmail, $subject, $body, false);

        return [
            'success' => $sent,
            'message' => $sent ? 'Your message has been sent successfully!' : 'Failed to send message. Please try WhatsApp contact.'
        ];
    }
}
