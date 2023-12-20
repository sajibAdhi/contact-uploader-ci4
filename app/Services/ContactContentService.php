<?php

namespace App\Services;

use App\Constants\ApplicationConstant;
use App\Libraries\SpreadSheetFileReader;
use App\Models\Contact;
use App\Models\ContactContent;
use CodeIgniter\HTTP\Files\UploadedFile;
use Exception;
use ReflectionException;

class ContactContentService
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
    private function findOrInsertContactContent(int $contactId, string $content, $date, ?string $remarks): object
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
                'date' => $date,
                'remarks' => $remarks,
            ]);

            $contactContent = $this->contactContent->find($contactContentId);
        }

        return $contactContent;
    }

    /**
     * @param array $filters
     * @return array
     */
    public function contactsContent(array $filters = []): array
    {
        $result = $this->contactContent
//            ->builder()
            ->select('contact_content.*')
            ->select(' contacts.number')
            ->select(' categories.name as category_name')
            ->join('contacts', 'contacts.id = contact_content.contact_id')
            ->join('categories', 'categories.id = contacts.category_id');

        if ($filters['categories'] ?? null) {
            if (!in_array('all', $filters['categories'])) {
                $result->whereIn('contacts.category_id', $filters['categories']);
            }
        }

        if ($filters['daterange'] ?? null) {
            $dateRange = explode(' - ', $filters['daterange']);

            $dateRange = array_map(function ($date) {
                return date('Y-m-d', strtotime($date));
            }, $dateRange);

            $result->where('contact_content.created_at >=', $dateRange[0]);
            $result->where('contact_content.created_at <=', $dateRange[1]);
        }

        if ($filters['limit'] ?? null) {
            return $result->paginate($filters['limit']);
        }

        return $result->paginate(ApplicationConstant::PER_PAGE);
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
    public function storeUploadedContactsContent(UploadedFile $file, $categoryId, $categoryName, $date): bool
    {
        $data = SpreadSheetFileReader::readFile($file, ['MOBILE_NO', 'SMS_CONTENT']);

        $totalRows = count($data);

        // If the file is empty, return false
        if ($totalRows == 0) return false;

        $numbLength = strlen($totalRows);
        $divider = pow(10, $numbLength - 1);

        $date = date('Y-m-d', strtotime($date));

        $this->contact->db->transStart();

        $categoryId = $this->categoryService->findOrCreate($categoryId, $categoryName)->id;

        $processedRows = 0;
        foreach ($data as $datum) {

            $number = $datum['MOBILE_NO'];
            if ($number !== null) {
                $contactId = $this->findOrInsert($number, $categoryId, $datum['remarks'] ?? null)->id;
                $this->findOrInsertContactContent($contactId, $datum['SMS_CONTENT'], $date, $datum['remarks'] ?? null);
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

    public function whereContactsExist(): ContactContentService
    {
        $this->categoryService->category
            ->select('categories.*')
            ->join('contacts', 'contacts.category_id = categories.id', 'RIGHT')
            ->groupBy('categories.id');
        return $this;
    }

    public function categories(): array
    {
        return $this->categoryService->category->findAll();
    }
}
