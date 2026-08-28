<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Wellness Packages
 */

class PackageBLL
{
    private PackageDAL $packageDAL;

    public function __construct()
    {
        $this->packageDAL = new PackageDAL();
    }

    /**
     * Get all active packages for public display
     * 
     * @return array
     */
    public function getActivePackages(): array
    {
        return $this->packageDAL->getAllActive();
    }

    /**
     * Get all packages for admin management
     * 
     * @param string|null $search
     * @return array
     */
    public function getAllAdminPackages(?string $search = null): array
    {
        return $this->packageDAL->getAllAdmin($search);
    }

    /**
     * Get single package by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function getPackageById(int $id): ?array
    {
        if ($id <= 0) {
            return null;
        }
        return $this->packageDAL->findById($id);
    }

    /**
     * Get single package by slug
     * 
     * @param string $slug
     * @return array|null
     */
    public function getPackageBySlug(string $slug): ?array
    {
        if (empty($slug)) {
            return null;
        }
        return $this->packageDAL->findBySlug($slug);
    }

    /**
     * Get included service IDs for package
     * 
     * @param int $packageId
     * @return array
     */
    public function getServiceIdsForPackage(int $packageId): array
    {
        return $this->packageDAL->getServiceIdsForPackage($packageId);
    }

    /**
     * Get included services full details for package
     * 
     * @param int $packageId
     * @return array
     */
    public function getServicesForPackage(int $packageId): array
    {
        return $this->packageDAL->getServicesForPackage($packageId);
    }

    /**
     * Save package with included services (Create or Update)
     * 
     * @param array $input
     * @param array $serviceIds
     * @param int|null $id
     * @return array
     */
    public function savePackage(array $input, array $serviceIds = [], ?int $id = null): array
    {
        if (!validateRequired($input['title'] ?? null)) {
            return ['success' => false, 'message' => 'Package title is required.'];
        }

        $rawSlug = !empty($input['slug']) ? (string)$input['slug'] : (string)$input['title'];
        $slug = strtolower(trim((string)preg_replace('/[^A-Za-z0-9-]+/', '-', $rawSlug), '-'));
        
        if (empty($slug)) {
            $slug = 'package-' . time();
        }

        if (!$this->packageDAL->isSlugUnique($slug, $id)) {
            $slug .= '-' . rand(100, 999);
        }
        $input['slug'] = $slug;

        $duration = (int)($input['duration_minutes'] ?? 90);
        $input['duration_minutes'] = $duration > 0 ? $duration : 90;

        $displayOrder = (int)($input['display_order'] ?? 0);
        $input['display_order'] = $displayOrder;

        $status = in_array($input['status'] ?? 'ACTIVE', ['ACTIVE', 'INACTIVE'], true) ? $input['status'] : 'ACTIVE';
        $input['status'] = $status;

        try {
            if ($id !== null && $id > 0) {
                $ok = $this->packageDAL->updateWithServices($id, $input, $serviceIds);
                return [
                    'success' => $ok,
                    'id' => $id,
                    'message' => $ok ? 'Package updated successfully.' : 'Failed to update package.'
                ];
            } else {
                $newId = $this->packageDAL->createWithServices($input, $serviceIds);
                return [
                    'success' => $newId > 0,
                    'id' => $newId,
                    'message' => $newId > 0 ? 'Package created successfully.' : 'Failed to create package.'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'id' => 0,
                'message' => 'Error saving package: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Delete package
     * 
     * @param int $id
     * @return array
     */
    public function deletePackage(int $id): array
    {
        $pkg = $this->packageDAL->findById($id);
        if (!$pkg) {
            return ['success' => false, 'message' => 'Package not found.'];
        }

        $deleted = $this->packageDAL->delete($id);
        return [
            'success' => $deleted,
            'message' => $deleted ? 'Package deleted successfully.' : 'Failed to delete package.'
        ];
    }

    /**
     * Toggle package status
     * 
     * @param int $id
     * @return array
     */
    public function toggleStatus(int $id): array
    {
        $toggled = $this->packageDAL->toggleStatus($id);
        return [
            'success' => $toggled,
            'message' => $toggled ? 'Package status updated.' : 'Failed to update status.'
        ];
    }
}
