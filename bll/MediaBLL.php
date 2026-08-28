<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Media Library Management
 */

class MediaBLL
{
    private MediaDAL $mediaDAL;
    private FileUploadService $uploader;

    public function __construct()
    {
        $this->mediaDAL = new MediaDAL();
        $this->uploader = new FileUploadService('media');
    }

    /**
     * Get all media items (combines database media records with assets/images list)
     * 
     * @return array
     */
    public function getAllMedia(): array
    {
        $dbMedia = $this->mediaDAL->getAll();
        
        // Also scan static assets/images/ folder
        $staticDir = BASE_PATH . '/assets/images/';
        $staticItems = [];
        if (is_dir($staticDir)) {
            $files = scandir($staticDir);
            foreach ($files as $f) {
                if ($f === '.' || $f === '..' || is_dir($staticDir . $f)) continue;
                $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
                    $staticItems[] = [
                        'id' => 'static_' . md5($f),
                        'filename' => $f,
                        'stored_name' => $f,
                        'path' => 'assets/images/' . $f,
                        'url' => baseUrl('assets/images/' . $f),
                        'mime_type' => 'image/' . ($ext === 'jpg' ? 'jpeg' : $ext),
                        'file_size' => filesize($staticDir . $f),
                        'alt_text' => ucwords(str_replace(['_', '-'], ' ', pathinfo($f, PATHINFO_FILENAME))),
                        'is_static' => true,
                        'created_at' => date('Y-m-d H:i:s', filemtime($staticDir . $f))
                    ];
                }
            }
        }

        // Format db media with full URL
        $formattedDb = [];
        foreach ($dbMedia as $m) {
            $m['url'] = baseUrl('storage/uploads/media/' . $m['stored_name']);
            $m['is_static'] = false;
            $formattedDb[] = $m;
        }

        return array_merge($formattedDb, $staticItems);
    }

    /**
     * Upload image to media library
     * 
     * @param array $fileInput
     * @param string|null $altText
     * @return array
     */
    public function uploadMedia(array $fileInput, ?string $altText = null): array
    {
        $res = $this->uploader->uploadImage($fileInput);
        if (!$res['success']) {
            return $res;
        }

        $id = $this->mediaDAL->create([
            'filename' => $fileInput['name'] ?? $res['filename'],
            'stored_name' => $res['filename'],
            'path' => 'storage/uploads/media/' . $res['filename'],
            'mime_type' => mime_content_type($res['path']) ?: 'image/jpeg',
            'file_size' => $fileInput['size'] ?? 0,
            'alt_text' => $altText
        ]);

        return [
            'success' => $id > 0,
            'id' => $id,
            'filename' => $res['filename'],
            'path' => 'storage/uploads/media/' . $res['filename'],
            'url' => baseUrl('storage/uploads/media/' . $res['filename']),
            'message' => 'Media file uploaded successfully.'
        ];
    }

    /**
     * Delete media item
     * 
     * @param int $id
     * @return array
     */
    public function deleteMedia(int $id): array
    {
        $item = $this->mediaDAL->findById($id);
        if (!$item) {
            return ['success' => false, 'message' => 'Media file not found.'];
        }

        $filePath = BASE_PATH . '/' . ltrim($item['path'], '/');
        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $deleted = $this->mediaDAL->delete($id);
        return [
            'success' => $deleted,
            'message' => $deleted ? 'Media file deleted.' : 'Failed to delete record.'
        ];
    }
}
