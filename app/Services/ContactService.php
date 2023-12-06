<?php

namespace App\Services;

use App\Libraries\CsvFileReader;
use App\Models\Contact;
use CodeIgniter\HTTP\Files\UploadedFile;
use ReflectionException;

class ContactService
{
    private Contact $contact;
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->contact = new Contact();
    }

    /**
     * @throws ReflectionException
     */
    public function findOrInsert(string $contact, int $category_id, ?string $remarks)
    {
        $contactData = $this->contact->where('contact', $contact)->first();

        if (is_null($contactData)) {
            $this->contact->insert([
                'contact' => $contact,
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
    public function storeUploadedCategories(UploadedFile $file): bool
    {
        $csvData = CsvFileReader::readCsvFile($file, ['contact', 'category']);

        if (!$csvData) {
            return false;
        }

        $this->contact->db->transStart();

        foreach ($csvData as $datum) {
            $category = $this->categoryService->findOrCreate($datum['category']);

            $this->findOrInsert($datum['contact'], $category->id, $datum['remarks'] ?? null);
        }

        $this->contact->db->transComplete();

        return $this->contact->db->transStatus();
    }
}
