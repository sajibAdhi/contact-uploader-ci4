<?php

namespace App\Services;

use App\Constants\ApplicationConstant;
use App\Libraries\SpreadSheetFileReader;
use App\Models\Contact;
use App\Models\ContactContent;
use CodeIgniter\HTTP\Files\UploadedFile;
use Exception;
use ReflectionException;

class ContactService
{
    public Contact $contact;
    public CategoryService $categoryService;
    public ContactContent $contactContent;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->contact = new Contact();
        $this->contactContent = new ContactContent();
    }

    /**
     * @param string $number
     * @param int $category_id
     * @param string|null $remarks
     * @return array|object|null
     * @throws ReflectionException
     */
    public function findOrInsert(string $number, int $category_id, ?string $remarks)
    {
        $contactData = $this->contact->where('number', $number)->first();

        if (is_null($contactData)) {
            $this->contact->insert([
                'number' => $number,
                'category_id' => $category_id,
                'remarks' => $remarks,
            ]);

            $contactData = $this->contact->find($this->contact->getInsertID());
        }

        return $contactData;
    }

    public function contacts(): array
    {
        return $this->contact
            ->select('contacts.*, categories.name as category_name')
            ->join('categories', 'categories.id = contacts.category_id')
            ->findAll();
    }

    /**
     * @param int $contactId
     * @param string $content
     * @param string|null $remarks
     * @return object
     * @throws ReflectionException
     */
    private function findOrInsertContactContent(int $contactId, string $content, ?string $remarks): object
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

    public function contactsContent(): array
    {
        return $this->contactContent
            ->select('contact_content.*, contacts.number, categories.name as category_name')
            ->join('contacts', 'contacts.id = contact_content.contact_id')
            ->join('categories', 'categories.id = contacts.category_id')
            ->paginate(ApplicationConstant::PER_PAGE);
    }

    /**
     * @throws ReflectionException
     */
    public function storeUploadedContacts(UploadedFile $file, $category_id, $categoryName): bool
    {
        $csvData = SpreadSheetFileReader::readCsvFile($file, ['contact']);

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
     * @throws Exception
     */
    public function storeUploadedContactsContent(UploadedFile $file, $category_id, $categoryName): bool
    {
        $data = SpreadSheetFileReader::readFile($file, ['MOBILE_NO', 'SMS_CONTENT']);

        $totalRows = count($data);

        // If the file is empty, return false
        if ($totalRows == 0) return false;

        $numbLength = strlen($totalRows);
        $divider = pow(10, $numbLength - 1);

        $this->contact->db->transStart();

        $category = $this->categoryService->findOrCreate($category_id, $categoryName);

        $processedRows = 0;
        foreach ($data as $datum) {

            $number = $datum['MOBILE_NO'];
            if ($number !== null) {
                $contact = $this->findOrInsert($number, $category->id, $datum['remarks'] ?? null);
                $this->findOrInsertContactContent($contact->id, $datum['SMS_CONTENT'], $datum['remarks'] ?? null);
            }

            $processedRows++;

            // Update the progress 10 times
            if ($processedRows % $divider == 0) {
                $progress = ($processedRows / $totalRows) * 100;

                // Start the session
                if (session_status() !== PHP_SESSION_ACTIVE)
                    session()->start();
                // Store the progress in the session
                session()->setFlashdata('upload_progress', $progress);
                // Close the session data to the client
                session()->close();
            }

        }

        session()->setFlashdata('upload_progress', 100);

        $this->contact->db->transComplete();

        return $this->contact->db->transStatus();
    }

    public function getUploadProgress()
    {
        return session()->getFlashdata('upload_progress');
    }

    public function categories(): array
    {
        return $this->categoryService->category->findAll();
    }
}
