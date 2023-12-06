<?php

namespace App\Services;

use App\Models\Category;
use App\Libraries\CsvFileReader;
use CodeIgniter\HTTP\Files\UploadedFile;

class CategoryService
{
    public Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function storeUploadedCategories(UploadedFile $file)
    {
        if (!$file->isValid() || $file->getClientMimeType() !== 'text/csv') {
            return false;
        }

        $csvData = CsvFileReader::readCsvFile($file, ['contact', 'category']);

        if ($csvData == false){
            return  false;
        } 
        
        if(!$this->category->insertBatch($csvData)){
            return false;
        }

        return true;
    }
}
