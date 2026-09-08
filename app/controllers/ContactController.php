<?php
declare(strict_types=1);

/**
 * Controller for Contact Page and Booking Submissions
 */

class ContactController
{
    private Enquiry $enquiryModel;
    private Setting $settingModel;
    private Service $serviceModel;
    private WhatsAppService $whatsAppService;
    private EmailService $emailService;

    public function __construct()
    {
        $this->enquiryModel = new Enquiry();
        $this->settingModel = new Setting();
        $this->serviceModel = new Service();
        $this->whatsAppService = new WhatsAppService();
        $this->emailService = new EmailService();
    }

    /**
     * Render Contact & Booking Information Page
     */
    public function index(): void
    {
        $contactInfo = $this->settingModel->getContactSettings();
        $services = $this->serviceModel->getActive();
        
        $pageTitle = "Reserve Privately & Contact | " . APP_NAME;
        $pageCss = 'assets/css/pages/contact.css';
        $pageJs = 'assets/js/pages/contact.js';

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

        $customerName = post('customer_name');
        if (!validateRequired($customerName)) {
            setFlash('error', 'Your name is required.');
            redirect('contact.php');
        }

        $input = [
            'service_name' => post('service_name'),
            'package_name' => post('package_name'),
            'customer_name' => $customerName,
            'phone' => post('phone'),
            'email' => post('email'),
            'preferred_date' => post('preferred_date'),
            'preferred_time' => post('preferred_time'),
            'duration_minutes' => post('duration_minutes'),
            'message' => post('message'),
            'source' => 'WHATSAPP'
        ];

        // Store enquiry record in database
        $this->enquiryModel->create($input);

        // Generate encoded WhatsApp booking URL and redirect
        $whatsAppUrl = $this->whatsAppService->buildBookingUrl($input);
        header("Location: " . $whatsAppUrl);
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

        $name = post('name');
        $email = post('email');
        $message = post('message');

        if (!validateRequired($name) || !validateRequired($email) || !validateRequired($message)) {
            setFlash('error', 'Please fill in all required fields.');
            redirect('contact.php');
        }

        if (!validateEmail((string)$email)) {
            setFlash('error', 'Invalid email address.');
            redirect('contact.php');
        }

        $subject = "New Contact Enquiry from " . $name;
        $body = "Name: {$name}\nEmail: {$email}\nPhone: " . (post('phone') ?? 'N/A') . "\nMessage:\n{$message}";

        $adminEmail = (string)env('DEFAULT_BUSINESS_EMAIL', 'info@ceylontherapist.lk');
        $sent = $this->emailService->send($adminEmail, $subject, $body, false);

        if ($sent) {
            setFlash('success', 'Your message has been sent successfully!');
        } else {
            setFlash('error', 'Failed to send message. Please try WhatsApp contact.');
        }

        redirect('contact.php');
    }
}
