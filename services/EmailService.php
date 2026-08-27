<?php
declare(strict_types=1);

/**
 * Technical Email Service
 */

class EmailService
{
    private string $fromAddress;
    private string $fromName;
    private string $logFile;

    public function __construct()
    {
        $this->fromAddress = defined('MAIL_FROM_ADDRESS') ? MAIL_FROM_ADDRESS : 'no-reply@ceylontherapist.lk';
        $this->fromName = defined('MAIL_FROM_NAME') ? MAIL_FROM_NAME : 'Ceylon Therapist';
        $this->logFile = defined('MAIL_LOG_FILE') ? MAIL_LOG_FILE : BASE_PATH . '/storage/logs/mail.log';
    }

    /**
     * Send email via native mail() function with logging support
     * 
     * @param string $to
     * @param string $subject
     * @param string $messageBody
     * @param bool $isHtml
     * @return bool
     */
    public function send(string $to, string $subject, string $messageBody, bool $isHtml = true): bool
    {
        $headers = [];
        $headers[] = "From: {$this->fromName} <{$this->fromAddress}>";
        $headers[] = "Reply-To: {$this->fromAddress}";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        if ($isHtml) {
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-Type: text/html; charset=UTF-8";
        } else {
            $headers[] = "Content-Type: text/plain; charset=UTF-8";
        }

        $headerStr = implode("\r\n", $headers);

        // In development mode or local XAMPP without sendmail, log output to mail.log
        if (defined('ENVIRONMENT') && ENVIRONMENT === 'development') {
            return $this->logMail($to, $subject, $messageBody, $headerStr);
        }

        $success = @mail($to, $subject, $messageBody, $headerStr);

        if (!$success) {
            $this->logMail($to, "[FAILED] " . $subject, $messageBody, $headerStr);
        }

        return $success;
    }

    /**
     * Log mail execution details to storage/logs/mail.log
     * 
     * @param string $to
     * @param string $subject
     * @param string $body
     * @param string $headers
     * @return bool
     */
    private function logMail(string $to, string $subject, string $body, string $headers): bool
    {
        $logEntry = sprintf(
            "[%s] TO: %s | SUBJECT: %s\nHEADERS:\n%s\nBODY:\n%s\n%s\n",
            date('Y-m-d H:i:s'),
            $to,
            $subject,
            $headers,
            $body,
            str_repeat('-', 80)
        );

        $logDir = dirname($this->logFile);
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }

        return @file_put_contents($this->logFile, $logEntry, FILE_APPEND) !== false;
    }
}
