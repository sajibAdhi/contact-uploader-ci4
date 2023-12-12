<?php

namespace App\Controllers;

use App\Services\CategoryService;
use ReflectionException;

class CategoryController extends BaseController
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function index(): string
    {
        return view('category/index', [
            'title' => 'Categories',
            'categories' => $this->categoryService->category->findAll(),
            'pager' => $this->categoryService->category->pager,
        ]);
    }

    public function store()
    {
        $data = ['name' => $this->request->getPost('category')];

        try {
            if ($this->categoryService->category->insert($data)) {
                return redirect()->route('category.index')
                    ->with('success', 'Category created successfully');
            } else {
                return redirect()->route('category.index')
                    ->withInput()->with('error', 'Category creation failed');
            }
        } catch (\ReflectionException $exception) {
            return redirect()->route('category.index')
                ->withInput()->with('error', $exception->getMessage());
        }
    }
}