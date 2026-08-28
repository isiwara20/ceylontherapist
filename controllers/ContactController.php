<?php
declare(strict_types=1);

/**
 * Controller for Contact Page and Booking Submissions
 */

class ContactController
{
    private ContactBLL $contactBLL;
    private SettingsBLL $settingsBLL;

    public function __construct()
    {
        $this->contactBLL = new ContactBLL();
        $this->settingsBLL = new SettingsBLL();
    }

    /**
     * Render Contact & Booking Information Page
     */
    public function index(): void
    {
        $contactInfo = $this->settingsBLL->getContactSettings();
        $serviceBLL = new ServiceBLL();
        $services = $serviceBLL->getPublicServices();
        $pageTitle = "Reserve Privately & Contact | " . APP_NAME;

        require BASE_PATH . '/views/public/contact.php';
    }


    /**
     * Handle WhatsApp Booking Submission
     */
    public function handleBooking(): void
    {
        if (!isPost()) {
            redirect('contact.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token. Please try submitting the form again.');
            redirect('contact.php');
        }

        $input = [
            'service_name' => post('service_name'),
            'package_name' => post('package_name'),
            'customer_name' => post('customer_name'),
            'phone' => post('phone'),
            'email' => post('email'),
            'preferred_date' => post('preferred_date'),
            'preferred_time' => post('preferred_time'),
            'duration_minutes' => post('duration_minutes'),
            'message' => post('message'),
            'source' => 'WHATSAPP'
        ];

        $result = $this->contactBLL->processBookingEnquiry($input);

        if (!$result['success']) {
            setFlash('error', $result['message']);
            redirect('contact.php');
        }

        // Redirect directly to WhatsApp wa.me URL
        header("Location: " . $result['redirect_url']);
        exit;
    }

    /**
     * Handle Standard Contact Email Form Submission
     */
    public function handleEmailContact(): void
    {
        if (!isPost()) {
            redirect('contact.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('contact.php');
        }

        $input = [
            'name' => post('name'),
            'email' => post('email'),
            'phone' => post('phone'),
            'message' => post('message')
        ];

        $result = $this->contactBLL->processEmailContact($input);

        if ($result['success']) {
            setFlash('success', $result['message']);
        } else {
            setFlash('error', $result['message']);
        }

        redirect('contact.php');
    }
}
