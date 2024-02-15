<?php

namespace App\Modules\Product\Services;

use App\Libraries\SpreadSheetFileReader;
use App\Modules\Product\Models\ProductModel;
use chillerlan\QRCode\QRCode;
use Exception;
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

        $qrcodeString = base_url(route_to('product.validate', $productId));
        // Generate qrcode for the product
        $this->productModel->update($productId, ['qrcode' => $this->QRCode->render($qrcodeString),]);

        $this->productModel->db->transComplete();
        return $this->productModel->db->transStatus();
    }

    /**
     * @param $file
     * @return bool
     * @throws ReflectionException
     * @throws Exception
     */
    public function upload($file): bool
    {
        $bulkData = SpreadSheetFileReader::readCsvFile($file, ['name', 'description']);

        $this->productModel->db->transStart();

        foreach ($bulkData as $data) {
            // Check if product already exists
            $existingProduct = $this->findBy('name', $data['name']);

            if ($existingProduct === null) {
                $productId = $this->productModel->insert($data);

                $qrcodeString = base_url(route_to('product.validate', $productId));
                // Generate qrcode for the product
                $this->productModel->update($productId, ['qrcode' => $this->QRCode->render($qrcodeString),]);
            }
        }

        $this->productModel->db->transComplete();
        return $this->productModel->db->transStatus();
    }

    public function getAutoIncrementValue(string $tableName): int
    {
        $query = $this->productModel->db->query('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "' . getenv('database.default.database') . '" AND TABLE_NAME = "' . $tableName . '"');
        $result = $query->getRow();
        return $result->AUTO_INCREMENT;
    }

    public function find(string $uuid): array|object|null
    {
        return $this->productModel->find($uuid);
    }

    public function findBy(string $field, $value): array|object|null
    {
        return $this->productModel->where($field, $value)->first();
    }

    public function generateUnique16CharHash($uniqueInteger): string
    {
        // Convert the unique integer to a string
        $stringRepresentation = strval($uniqueInteger);

        // Generate the SHA-256 hash
        $hash = hash('sha256', $stringRepresentation);

        // Take the first 16 characters
        return substr($hash, 0, 16);
    }


}