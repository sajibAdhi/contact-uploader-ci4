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
     * @throws ReflectionException
     */
    public function findOrCreate($category)
    {
        $categoryData = $this->category->where('category', $category)->first();

        if (is_null($categoryData)) {
            $this->category->insert(['category' => $category]);
            $categoryData = $this->category->find($this->category->getInsertID());
        }

        return $categoryData;
    }
}
