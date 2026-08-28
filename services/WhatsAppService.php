<?php
declare(strict_types=1);

/**
 * WhatsApp Booking Service
 * Converts booking details into encoded wa.me URLs
 */

class WhatsAppService
{
    private string $phoneNumber;

    public function __construct(?string $phoneNumber = null)
    {
        $this->phoneNumber = $phoneNumber ?? (defined('DEFAULT_WHATSAPP_NUMBER') ? DEFAULT_WHATSAPP_NUMBER : '94762244114');
    }

    /**
     * Clean and format phone number for WhatsApp wa.me link
     * 
     * @param string $number
     * @return string
     */
    private function formatPhoneNumber(string $number): string
    {
        // Strip everything except digits
        $clean = preg_replace('/[^\d]/', '', $number);

        // Convert leading 0 to 94 (Sri Lanka country code)
        if (strpos($clean, '0') === 0) {
            $clean = '94' . substr($clean, 1);
        }

        return $clean;
    }

    /**
     * Generate encoded WhatsApp booking URL
     * 
     * @param array $bookingData
     * @return string
     */
    public function buildBookingUrl(array $bookingData): string
    {
        $phone = $this->formatPhoneNumber($this->phoneNumber);

        $serviceTitle = $bookingData['service_name'] ?? $bookingData['package_name'] ?? 'Therapy Treatment';
        $customerName = $bookingData['customer_name'] ?? 'Valued Guest';
        $preferredDate = $bookingData['preferred_date'] ?? 'As soon as possible';
        $preferredTime = $bookingData['preferred_time'] ?? 'Flexible';
        $duration = $bookingData['duration_minutes'] ?? 'Standard';
        $notes = $bookingData['message'] ?? '';

        $message = "✨ *CEYLON THERAPIST BOOKING ENQUIRY* ✨\n\n";
        $message .= "Hello! I would like to reserve a session:\n\n";
        $message .= "🌿 *Selected Service/Package:* " . $serviceTitle . "\n";
        $message .= "👤 *Guest Name:* " . $customerName . "\n";
        $message .= "📅 *Preferred Date:* " . $preferredDate . "\n";
        $message .= "⏰ *Preferred Time:* " . $preferredTime . "\n";
        if ($duration) {
            $message .= "⏱️ *Duration:* " . $duration . " mins\n";
        }
        if (!empty($notes)) {
            $message .= "📝 *Notes/Requests:* " . $notes . "\n";
        }
        $message .= "\nPlease confirm availability and details. Thank you!";

        $encodedText = rawurlencode($message);

        return "https://wa.me/" . $phone . "?text=" . $encodedText;
    }
}
