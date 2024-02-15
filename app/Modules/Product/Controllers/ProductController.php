<?php

namespace App\Modules\Product\Controllers;

use App\Controllers\BaseController;
use App\Modules\Product\Models\ProductModel;
use App\Modules\Product\Services\ProductService;
use App\Modules\Product\Traits\Viewable;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class ProductController extends BaseController
{
    use Viewable;

    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index(): string
    {
        $products = $this->productService->findAll();

        return $this->view('product\index', compact('products'));
    }

    public function create(): string
    {
        return $this->view('product\create');
    }

    public function store(): RedirectResponse
    {
        try {
            if (!$this->productValidation()) {
                return redirect()->back()->withInput();
            }

            $data = (object)$this->request->getPost();

            if (!$this->productService->store($data)) {
                return redirect()->back()->withInput()->with('error', 'Product creation failed');
            }

            return redirect()->to(route_to('product'))->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function uploadUi(): string
    {
        return $this->view('product\upload');
    }

    public function upload(): RedirectResponse
    {
        try {
            $file = $this->request->getFiles();

            if (!$this->productService->upload($file['product_file'])) {
                return redirect()->back()->withInput()->with('error', 'Product upload failed');
            }

            return redirect()->to(route_to('product'))->with('success', 'Product uploaded successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    private function productValidation(): bool
    {
        $this->validate([
            'name' => 'required|min_length[3]',
            'description' => 'required|min_length[3]',
        ]);

        return $this->validator->run();
    }
}
