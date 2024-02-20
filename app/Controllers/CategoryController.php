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
            'categories' => $categories,
        ]);
    }

    public function store(): RedirectResponse
    {
        try {
            if (!$this->validateCategoryRequest()) {
                return redirect()->route('sms_service.category')
                    ->withInput()->with('error', 'Invalid Form Data');
            }

            $data = ['name' => $this->request->getPost('category')];

            if ($this->categoryService->category->insert($data)) {
                return redirect()->route('sms_service.category')
                    ->with('success', 'Category created successfully');
            }

            return redirect()->route('sms_service.category')
                ->withInput()->with('error', 'Category creation failed');
        } catch (ReflectionException $exception) {
            return redirect()->route('sms_service.category')
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
        try {
            if (!$this->validateCategoryRequest($id)) {
                return redirect()->route('sms_service.category')
                    ->withInput()->with('error', 'Invalid Form Data');
            }

            $data = ['name' => $this->request->getPost('category')];

            if ($this->categoryService->category->update($id, $data)) {
                return redirect()->route('sms_service.category')
                    ->with('success', 'Category updated successfully');
            }

            return redirect()->route('sms_service.category')
                ->withInput()->with('error', 'Category update failed');
        } catch (ReflectionException $exception) {
            return redirect()->route('sms_service.category')
                ->withInput()->with('error', $exception->getMessage());
        }
    }

    public function delete(int $id): RedirectResponse
    {
        if ($this->categoryService->category->delete($id)) {
            return redirect()->route('category.index')
                ->with('success', 'Category deleted successfully');
        }

        return redirect()->route('category.index')
            ->with('error', 'Category deletion failed');
    }

    private function validateCategoryRequest(int $categoryId = null): bool
    {
        return $this->validate([
            'category' => [
                'label' => 'Category',
                'rules' => [
                    'required',
                    'trim',
                    'string',
                    'min_length[3]',
                    'max_length[255]',
                    'is_unique[categories.name,id,' . $categoryId . ']', // Ignore the current category id
                ],
            ],
        ]);
    }
}
