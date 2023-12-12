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
        $categories = $this->categoryService->category->findAll();

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

    public function update($id): RedirectResponse
    {
        $data = ['name' => $this->request->getPost('category')];

        try {
            if ($this->categoryService->category->update($id, $data)) {
                return redirect()->route('category.index')
                    ->with('success', 'Category updated successfully');
            } else {
                return redirect()->route('category.index')
                    ->withInput()->with('error', 'Category update failed');
            }
        } catch (\ReflectionException $exception) {
            return redirect()->route('category.index')
                ->withInput()->with('error', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        if ($this->categoryService->category->delete($id)) {
            return redirect()->route('category.index')
                ->with('success', 'Category deleted successfully');
        } else {
            return redirect()->route('category.index')
                ->withInput()->with('error', 'Category deletion failed');
        }
    }
}