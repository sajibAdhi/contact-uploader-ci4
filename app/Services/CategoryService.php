<?php

namespace App\Services;

use App\Libraries\SpreadSheetFileReader;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use ReflectionException;

class CategoryService
{
    public CategoryModel $category;

    public function __construct()
    {
        $this->category = new CategoryModel();
    }

    /**
     * @throws ReflectionException
     */
    public function storeUploadedCategories(UploadedFile $file): bool
    {
        $csvData = SpreadSheetFileReader::readCsvFile($file, ['category']);

        if (! $csvData) {
            return false;
        }

        $this->category->db->transStart();

        foreach ($csvData as $datum) {
            $this->findOrCreate($datum['category']);
        }

        $this->category->db->transComplete();

        return $this->category->db->transStart();
    }

    /**
     * @param mixed $categoryId
     *
     * @return array|object|null
     *
     * @throws ReflectionException
     */
    public function findOrCreate($categoryId, ?string $categoryName = null)
    {
        $categoryData = $this->category->find($categoryId);

        if (null === $categoryData) {
            $categoryId = $this->category->insert(['name' => $categoryName]);

            $categoryData = $this->category->find($categoryId);
        }

        return $categoryData;
    }
}
