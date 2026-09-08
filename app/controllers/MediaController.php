<?php
declare(strict_types=1);

/**
 * Controller for Admin Media Library Management
 */

class MediaController
{
    private Media $mediaModel;
    private UploadService $uploader;

    public function __construct()
    {
        requireAdmin();
        $this->mediaModel = new Media();
        $this->uploader = new UploadService('media');
    }

    /**
     * Display media library gallery
     */
    public function index(): void
    {
        $mediaList = $this->mediaModel->all();
        $pageTitle = "Media Library | Admin Panel";
        $pageCss = 'assets/css/admin/media.css';
        $pageJs = 'assets/js/admin/media.js';

        require BASE_PATH . '/views/admin/media/index.php';
    }

    /**
     * Handle media upload POST request
     */
    public function upload(): void
    {
        if (!isPost()) {
            redirect('admin/media/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/media/index.php');
        }

        if (empty($_FILES['media_file']['tmp_name'])) {
            setFlash('error', 'Please select a file to upload.');
            redirect('admin/media/index.php');
        }

        $uploadRes = $this->uploader->uploadImage($_FILES['media_file']);

        if (!$uploadRes['success']) {
            setFlash('error', $uploadRes['error']);
            redirect('admin/media/index.php');
        }

        $altText = post('alt_text', '');
        $fileData = [
            'filename' => $_FILES['media_file']['name'],
            'stored_name' => $uploadRes['filename'],
            'path' => 'storage/uploads/media/' . $uploadRes['filename'],
            'mime_type' => mime_content_type($uploadRes['path']),
            'file_size' => (int)$_FILES['media_file']['size'],
            'alt_text' => $altText
        ];

        $newId = $this->mediaModel->create($fileData);
        if ($newId > 0) {
            setFlash('success', 'Image uploaded to media library successfully.');
        } else {
            setFlash('error', 'Failed to save media record to database.');
        }

        redirect('admin/media/index.php');
    }

    /**
     * Delete media record and remove file
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (!isPost()) {
            redirect('admin/media/index.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin/media/index.php');
        }

        $media = $this->mediaModel->find($id);
        if (!$media) {
            setFlash('error', 'Media file not found.');
            redirect('admin/media/index.php');
        }

        $fullPath = BASE_PATH . '/' . ltrim($media['path'], '/');
        if (file_exists($fullPath)) {
            @unlink($fullPath);
        }

        if ($this->mediaModel->delete($id)) {
            setFlash('success', 'Media file deleted successfully.');
        } else {
            setFlash('error', 'Failed to delete media record.');
        }

        redirect('admin/media/index.php');
    }
}
