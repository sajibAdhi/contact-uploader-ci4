<?php

namespace App\Modules\Product\Services;

use App\Modules\Product\Models\ProductModel;
use chillerlan\QRCode\QRCode;
use ReflectionException;

class ProductService
{
    private ProductModel $productModel;
    private QRCode $QRCode;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->QRCode = new QRCode();
    }

    public function findAll(): array
    {
        return $this->productModel->findAll();
    }

    /**
     * This method stores a product
     *
     * This method stores a product data and generates a unique id for the product
     * using the UuidModel and generates a qrcode for the product
     *
     * @param object $data
     * @return bool
     * @throws ReflectionException
     */
    public function store(object $data): bool
    {
        $this->productModel->db->transStart();

        $productId = $this->productModel->insert($data);
        // Generate qrcode for the product
        $this->productModel->update($productId, ['qrcode' => $this->QRCode->render($productId),]);

        $this->productModel->db->transComplete();
        return $this->productModel->db->transStatus();
    }

    public function find(string $uuid)
    {
        return $this->productModel->find($uuid);
    }


}