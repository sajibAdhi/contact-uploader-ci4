<?php

namespace App\Services;

use App\Libraries\CsvFileReader;
use App\Models\Contact;
use App\Models\ContactContent;
use CodeIgniter\HTTP\Files\UploadedFile;
use ReflectionException;

class ContactService
{
    private Contact $contact;
    public CategoryService $categoryService;
    private ContactContent $contactContent;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->contact = new Contact();
        $this->contactContent = new ContactContent();
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
    public function storeUploadedContacts(UploadedFile $file, $category_id, $categoryName): bool
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


    /**
     * @throws ReflectionException
     */
    public function storeUploadedContactsContent(UploadedFile $file, $category_id, $categoryName): bool
    {
        $csvData = CsvFileReader::readCsvFile($file, ['contact', 'content']);
        if (!$csvData) return false;

        $this->contact->db->transStart();

        $category = $this->categoryService->findOrCreate($category_id, $categoryName);

        foreach ($csvData as $datum) {
            $contact = $this->findOrInsert($datum['contact'], $category->id, $datum['remarks'] ?? null);
            $this->findOrInsertContactContent($contact->id, $datum['content'], $datum['remarks'] ?? null);
        }

        $this->contact->db->transComplete();


        return $this->contact->db->transStatus();
    }

    public function contacts(): array
    {
        return $this->contact
            ->select('contacts.*, categories.name as category_name')
            ->join('categories', 'categories.id = contacts.category_id')
            ->findAll();
    }

    /**
     * @throws ReflectionException
     */
    private function findOrInsertContactContent(int $contactId, string $content, ?string $remarks)
    {
        $contactContent = $this->contactContent
            ->select('contact_content.*')
            ->where('contact_id', $contactId)
            ->where('content', $content)
            ->first();

        if (is_null($contactContent)) {
            $contactContentId = $this->contactContent->insert([
                'contact_id' => $contactId,
                'content' => $content,
                'remarks' => $remarks,
            ]);

            $contactContent = $this->contactContent->find($contactContentId);
        }

        return $contactContent;
    }
}
