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
     * Get all active packages
     * 
     * @return array
     */
    public function getActivePackages(): array
    {
        return $this->packageDAL->getAllActive();
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
}
