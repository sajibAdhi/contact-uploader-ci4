<?php

namespace App\Services;

use App\Libraries\CsvFileReader;
use App\Models\Contact;
use CodeIgniter\HTTP\Files\UploadedFile;
use ReflectionException;

class ContactService
{
    private Contact $contact;
    public CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->contact = new Contact();
    }

    /**
     * @param string $contact
     * @param int $category_id
     * @param string|null $remarks
     * @return array|object|null
     * @throws ReflectionException
     */
    public function findOrInsert(string $contact, int $category_id, ?string $remarks)
    {
        $contactData = $this->contact->where('number', $contact)->first();

        if (is_null($contactData)) {
            $this->contact->insert([
                'number' => $contact,
                'category_id' => $category_id,
                'remarks' => $remarks,
            ]);

            $contactData = $this->contact->find($this->contact->getInsertID());
        }

        return $contactData;
    }

    /**
     * @throws ReflectionException
     */
    public function storeUploadedCategories(UploadedFile $file, $category_id, $categoryName): bool
    {
        $csvData = CsvFileReader::readCsvFile($file, ['contact']);

        if (!$csvData) {
            return false;
        }

        $this->contact->db->transStart();

        $category = $this->categoryService->findOrCreate($category_id, $categoryName);


        foreach ($csvData as $datum) {
            $this->findOrInsert($datum['contact'], $category->id, $datum['remarks'] ?? null);
        }

        $this->contact->db->transComplete();

        return $this->contact->db->transStatus();
    }
}
