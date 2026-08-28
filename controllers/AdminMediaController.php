<?php
declare(strict_types=1);

/**
 * Controller for Admin Media Library Management
 */

class AdminMediaController
{
    private MediaBLL $mediaBLL;

    public function __construct()
    {
        requireAdmin();
        $this->mediaBLL = new MediaBLL();
    }

    /**
     * Display Media Library Grid
     */
    public function index(): void
    {
        $mediaList = $this->mediaBLL->getAllMedia();
        $pageTitle = "Media Library | Admin Panel";

        require BASE_PATH . '/views/admin/media/index.php';
    }

    /**
     * Handle Image Upload POST
     */
    public function upload(): void
    {
        if (!isPost()) {
            redirect('admin_media.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_media.php');
        }

        if (!isset($_FILES['media_file']) || empty($_FILES['media_file']['tmp_name'])) {
            setFlash('error', 'Please choose a valid image file to upload.');
            redirect('admin_media.php');
        }

        $altText = post('alt_text');
        $res = $this->mediaBLL->uploadMedia($_FILES['media_file'], $altText);

        if ($res['success']) {
            setFlash('success', 'Media uploaded successfully.');
        } else {
            setFlash('error', $res['error'] ?? ($res['message'] ?? 'Upload failed.'));
        }

        redirect('admin_media.php');
    }

    /**
     * Delete Media File
     * 
     * @param int $id
     */
    public function delete(int $id): void
    {
        if (!isPost()) {
            redirect('admin_media.php');
        }

        $token = post('csrf_token');
        if (!CsrfService::validateToken($token)) {
            setFlash('error', 'Invalid security token.');
            redirect('admin_media.php');
        }

        $res = $this->mediaBLL->deleteMedia($id);
        if ($res['success']) {
            setFlash('success', $res['message']);
        } else {
            setFlash('error', $res['message']);
        }

        redirect('admin_media.php');
    }
}
