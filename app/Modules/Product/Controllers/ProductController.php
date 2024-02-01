<?php

namespace App\Modules\Product\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function index()
    {
        dd('ProductController@index');
    }

    public function create()
    {
        // Your existing code for displaying the product creation form
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
