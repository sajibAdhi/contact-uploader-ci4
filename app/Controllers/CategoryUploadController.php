<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\CategoryService;

class CategoryUploadController extends BaseController
{
    public CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function create()
    {
        return view('category\upload');
    }

    public function store()
    {
        $file = $this->request->getFile('category_file');

        dd($this->categoryService->storeUploadedCategories($file));            
    }
}
