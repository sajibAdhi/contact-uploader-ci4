<?php

namespace App\Modules\Product\Controllers;

use App\Controllers\BaseController;
use App\Modules\Product\Traits\Viewable;

class ProductController extends BaseController
{
    use Viewable;

    public function index()
    {
        die('Comming Soon');
    }

    public function create(): string
    {
        return $this->view('product\create');
    }

    public function store()
    {
        // Your existing code for storing the product

        // Generate a unique barcode for the new product
        $generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode($product->id, $generator::TYPE_CODE_128);

        // Store the barcode in the product model
        $product->barcode = $barcode;
        $product->save();

        // Your existing code for redirecting after storing the product
    }
}
