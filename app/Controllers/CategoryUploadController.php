<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\CategoryService;
use ReflectionException;

class CategoryUploadController extends BaseController
{
    public CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function create(): string
    {
        return view('category\upload');
    }

    /**
     * @throws ReflectionException
     */
    public function store()
    {
        $file = $this->request->getFile('csv_file');

        dd($this->categoryService->storeUploadedCategories($file));            
    }
}
