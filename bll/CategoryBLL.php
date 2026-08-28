<?php
declare(strict_types=1);

/**
 * Business Logic Layer for Service Categories
 */

class CategoryBLL
{
    private CategoryDAL $categoryDAL;

    public function __construct()
    {
        $this->categoryDAL = new CategoryDAL();
    }

    /**
     * Get all categories
     * 
     * @return array
     */
    public function getAllCategories(): array
    {
        return $this->categoryDAL->getAll();
    }

    /**
     * Find category by ID
     * 
     * @param int $id
     * @return array|null
     */
    public function getCategoryById(int $id): ?array
    {
        return $this->categoryDAL->findById($id);
    }

    /**
     * Save category (create or update)
     * 
     * @param array $input
     * @param int|null $id
     * @return array
     */
    public function saveCategory(array $input, ?int $id = null): array
    {
        if (!validateRequired($input['name'] ?? null)) {
            return ['success' => false, 'message' => 'Category name is required.'];
        }

        if (empty($input['code'])) {
            $input['code'] = strtoupper(trim((string)preg_replace('/[^A-Za-z0-9_]+/', '_', $input['name']), '_'));
        }

        if ($id !== null && $id > 0) {
            $ok = $this->categoryDAL->update($id, $input);
            return [
                'success' => $ok,
                'message' => $ok ? 'Category updated successfully.' : 'Failed to update category.'
            ];
        } else {
            $newId = $this->categoryDAL->create($input);
            return [
                'success' => $newId > 0,
                'message' => $newId > 0 ? 'Category created successfully.' : 'Failed to create category.'
            ];
        }
    }

    /**
     * Delete category
     * 
     * @param int $id
     * @return array
     */
    public function deleteCategory(int $id): array
    {
        $cat = $this->categoryDAL->findById($id);
        if (!$cat) {
            return ['success' => false, 'message' => 'Category not found.'];
        }

        $deleted = $this->categoryDAL->delete($id);
        return [
            'success' => $deleted,
            'message' => $deleted ? 'Category deleted successfully.' : 'Failed to delete category.'
        ];
    }
}
