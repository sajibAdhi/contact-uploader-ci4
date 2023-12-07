<?php

namespace App\Services;

use App\Models\Category;
use App\Libraries\CsvFileReader;
use CodeIgniter\HTTP\Files\UploadedFile;
use ReflectionException;

class CategoryService
{
    public Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    /**
     * @throws ReflectionException
     */
    public function storeUploadedCategories(UploadedFile $file): bool
    {
        $csvData = CsvFileReader::readCsvFile($file, ['category']);

        if (!$csvData) return false;

        $this->category->db->transStart();

        foreach ($csvData as $datum){
            $this->findOrCreate($datum['category']);
        }

        $this->category->db->transComplete();

        return $this->category->db->transStart();
    }

    /**
     * @param  $categoryId
     * @param string|null $categoryName
     * @return array|object|null
     * @throws ReflectionException
     */
    public function findOrCreate( $categoryId, ?string $categoryName = null)
    {
        $categoryData = $this->category->find($categoryId);

        if (is_null($categoryData)) {
           $categoryId = $this->category->insert(['name' => $categoryName]);

            $categoryData = $this->category->find($categoryId);
        }

        return $categoryData;
    }
}
