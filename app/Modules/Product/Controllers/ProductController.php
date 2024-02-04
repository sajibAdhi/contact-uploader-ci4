<?php

namespace App\Modules\Product\Controllers;

use App\Controllers\BaseController;
use App\Modules\Product\Models\ProductModel;
use App\Modules\Product\Traits\Viewable;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class ProductController extends BaseController
{
    use Viewable;

    private ProductModel $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        die('Comming Soon');
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

            if (!$this->productModel->save($this->request->getPost())) {
                return redirect()->back()->withInput()->with('error', 'Product creation failed');
            }

            return redirect()->to(route_to('products'))->with('success', 'Product created successfully');
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
