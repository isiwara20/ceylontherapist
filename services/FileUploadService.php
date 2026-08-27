<?php
declare(strict_types=1);

/**
 * File Upload Handling & Validation Service
 */

class FileUploadService
{
    private string $uploadDir;
    private array $allowedMimeTypes;
    private int $maxFileSize; // in bytes

    public function __construct(string $subDirectory = 'services')
    {
        $this->uploadDir = BASE_PATH . '/storage/uploads/' . trim($subDirectory, '/') . '/';
        $this->allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $this->maxFileSize = 5 * 1024 * 1024; // 5 MB max limit

        if (!is_dir($this->uploadDir)) {
            @mkdir($this->uploadDir, 0755, true);
        }
    }

    /**
     * Upload and validate file from $_FILES input array
     * 
     * @param array $fileInput ($_FILES['field'])
     * @return array Array containing ['success' => bool, 'filename' => string, 'error' => string]
     */
    public function uploadImage(array $fileInput): array
    {
        if (!isset($fileInput['error']) || is_array($fileInput['error'])) {
            return ['success' => false, 'filename' => '', 'error' => 'Invalid file parameters.'];
        }

        switch ($fileInput['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return ['success' => false, 'filename' => '', 'error' => 'No file uploaded.'];
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return ['success' => false, 'filename' => '', 'error' => 'Exceeded filesize limit.'];
            default:
                return ['success' => false, 'filename' => '', 'error' => 'Unknown upload error.'];
        }

        if ($fileInput['size'] > $this->maxFileSize) {
            return ['success' => false, 'filename' => '', 'error' => 'File size exceeds 5MB limit.'];
        }

        // Verify MIME type using finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($fileInput['tmp_name']);

        if (!in_array($mimeType, $this->allowedMimeTypes, true)) {
            return ['success' => false, 'filename' => '', 'error' => 'Invalid file format. Allowed: JPG, PNG, WEBP.'];
        }

        // Generate safe unique filename
        $extension = match ($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            default => 'bin'
        };

        $safeFilename = sprintf('%s_%s.%s', bin2hex(random_bytes(8)), time(), $extension);
        $targetPath = $this->uploadDir . $safeFilename;

        if (!move_uploaded_file($fileInput['tmp_name'], $targetPath)) {
            return ['success' => false, 'filename' => '', 'error' => 'Failed to move uploaded file.'];
        }

        return [
            'success' => true,
            'filename' => $safeFilename,
            'path' => $targetPath,
            'error' => ''
        ];
    }
}
