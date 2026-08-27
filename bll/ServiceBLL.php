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
     * Create new service (for admin CRUD)
     * 
     * @param array $input
     * @return array ['success' => bool, 'id' => int, 'message' => string]
     */
    public function createService(array $input): array
    {
        if (!validateRequired($input['name'] ?? null)) {
            return ['success' => false, 'id' => 0, 'message' => 'Service name is required.'];
        }

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $input['name']), '-'));
        $input['slug'] = $slug;

        $id = $this->serviceDAL->create($input);
        return ['success' => true, 'id' => $id, 'message' => 'Service created successfully.'];
    }
}
