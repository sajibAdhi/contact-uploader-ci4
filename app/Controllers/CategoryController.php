<?php

namespace App\Controllers;

use App\Services\CategoryService;
use CodeIgniter\HTTP\RedirectResponse;
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
        $cache = service('cache');

        $key = 'categories';
        $categories = $cache->get($key);

        if ($categories === null) {
            $categories = $this->categoryService->category->findAll();
            $cache->save($key, $categories, 300); // Cache data for 5 minutes (300 seconds)
        }

        return view('category/index', [
            'title' => 'Categories',
            'categories' => $categories
        ]);
    }

    public function store(): RedirectResponse
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

    public function edit($id): string
    {
        return view('category/index', [
            'title' => 'Edit Category',
            'action' => 'edit',
            'categories' => $this->categoryService->category->findAll(),
            'category' => $this->categoryService->category->find($id),
        ]);
    }
}