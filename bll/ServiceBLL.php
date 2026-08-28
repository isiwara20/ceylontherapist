<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Treatments and Services
 */

class ServiceBLL
{
    private ServiceDAL $serviceDAL;

    public function __construct()
    {
        $this->serviceDAL = new ServiceDAL();
    }

    /**
     * Retrieve all active services formatted for public view
     * 
     * @return array
     */
    public function getPublicServices(): array
    {
        return $this->serviceDAL->getAllActive();
    }

    /**
     * Retrieve active services filtered by category code
     * 
     * @param string $categoryCode (GENERAL, FOR_HER, COUPLES)
     * @return array
     */
    public function getServicesByCategory(string $categoryCode): array
    {
        return $this->serviceDAL->getByCategoryCode($categoryCode);
    }

    /**
     * Retrieve all services for Admin management
     * 
     * @param string|null $categoryCode
     * @param string|null $search
     * @return array
     */
    public function getAllAdminServices(?string $categoryCode = null, ?string $search = null): array
    {
        return $this->serviceDAL->getAllAdmin($categoryCode, $search);
    }

    /**
     * Get single service detail by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function getServiceById(int $id): ?array
    {
        if ($id <= 0) {
            return null;
        }
        return $this->serviceDAL->findById($id);
    }

    /**
     * Get single service detail by slug
     * 
     * @param string $slug
     * @return array|null
     */
    public function getServiceBySlug(string $slug): ?array
    {
        if (empty($slug)) {
            return null;
        }
        return $this->serviceDAL->findBySlug($slug);
    }

    /**
     * Create or Update service (Admin)
     * 
     * @param array $input
     * @param int|null $id (if null => create, if int => update)
     * @return array ['success' => bool, 'id' => int, 'message' => string]
     */
    public function saveService(array $input, ?int $id = null): array
    {
        if (!validateRequired($input['name'] ?? null)) {
            return ['success' => false, 'id' => 0, 'message' => 'Service name is required.'];
        }

        if (empty($input['category_id'])) {
            return ['success' => false, 'id' => 0, 'message' => 'Please select a valid category.'];
        }

        // Generate or clean slug
        $rawSlug = !empty($input['slug']) ? (string)$input['slug'] : (string)$input['name'];
        $slug = strtolower(trim((string)preg_replace('/[^A-Za-z0-9-]+/', '-', $rawSlug), '-'));
        
        if (empty($slug)) {
            $slug = 'service-' . time();
        }

        // Ensure unique slug
        if (!$this->serviceDAL->isSlugUnique($slug, $id)) {
            $slug .= '-' . rand(100, 999);
        }
        $input['slug'] = $slug;

        $duration = (int)($input['duration_minutes'] ?? 60);
        if ($duration <= 0) {
            $duration = 60;
        }
        $input['duration_minutes'] = $duration;

        $displayOrder = (int)($input['display_order'] ?? 0);
        $input['display_order'] = $displayOrder;

        $status = in_array($input['status'] ?? 'ACTIVE', ['ACTIVE', 'INACTIVE'], true) ? $input['status'] : 'ACTIVE';
        $input['status'] = $status;

        if ($id !== null && $id > 0) {
            $updated = $this->serviceDAL->update($id, $input);
            return [
                'success' => $updated,
                'id' => $id,
                'message' => $updated ? 'Treatment updated successfully.' : 'Failed to update treatment.'
            ];
        } else {
            $newId = $this->serviceDAL->create($input);
            return [
                'success' => $newId > 0,
                'id' => $newId,
                'message' => $newId > 0 ? 'Treatment created successfully.' : 'Failed to create treatment.'
            ];
        }
    }

    /**
     * Delete service
     * 
     * @param int $id
     * @return array
     */
    public function deleteService(int $id): array
    {
        $existing = $this->serviceDAL->findById($id);
        if (!$existing) {
            return ['success' => false, 'message' => 'Treatment not found.'];
        }

        $deleted = $this->serviceDAL->delete($id);
        return [
            'success' => $deleted,
            'message' => $deleted ? 'Treatment deleted successfully.' : 'Failed to delete treatment.'
        ];
    }

    /**
     * Toggle service active/inactive status
     * 
     * @param int $id
     * @return array
     */
    public function toggleStatus(int $id): array
    {
        $toggled = $this->serviceDAL->toggleStatus($id);
        return [
            'success' => $toggled,
            'message' => $toggled ? 'Treatment status updated.' : 'Failed to update status.'
        ];
    }

    /**
     * Get all categories
     * 
     * @return array
     */
    public function getAllCategories(): array
    {
        return $this->serviceDAL->getAllCategories();
    }
}
