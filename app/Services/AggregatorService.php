<?php

namespace App\Services;

use App\Constants\ApplicationConstant;
use App\Libraries\SpreadSheetFileReader;
use App\Models\ContactContentModel;
use App\Models\ContactModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Exception;
use ReflectionException;

class AggregatorService
{
    public ContactModel $aggregator;

    public function __construct()
    {
        $this->aggregator         = new ContactModel();
    }

    /**
     * @return array|object|null
     *
     * @throws ReflectionException
     */
    public function findOrInsert(string $number, int $category_id, ?string $remarks)
    {
        $contactData = $this->aggregator->where('number', $number)->first();

        if (null === $contactData) {
            $this->aggregator->insert([
                'number'      => $number,
                'category_id' => $category_id,
                'remarks'     => $remarks,
            ]);

            $contactData = $this->aggregator->find($this->aggregator->getInsertID());
        }

        return $contactData;
    }

    public function contacts(): array
    {
        return $this->aggregator
            ->select('contacts.*, categories.name as category_name')
            ->join('categories', 'categories.id = contacts.category_id')
            ->findAll();
    }

    /**
     * @param mixed $date
     *
     * @throws ReflectionException
     */
    private function findOrInsertContactContent(int $contactId, string $content, $date, ?string $remarks): void
    {
        $contactContent = $this->contactContent
            ->select('contact_content.*')
            ->where('contact_id', $contactId)
            ->where('content', $content)
            ->first();

        if (null === $contactContent) {
            $contactContentId = $this->contactContent->insert([
                'contact_id' => $contactId,
                'content'    => $content,
                'date'       => $date,
                'remarks'    => $remarks,
            ]);

            $contactContent = $this->contactContent->find($contactContentId);
        }

    }

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
            if (! in_array('all', $filters['categories'], true)) {
                $result->whereIn('contacts.category_id', $filters['categories']);
            }
        }

        if ($filters['daterange'] ?? null) {
            $dateRange = explode(' - ', $filters['daterange']);

            $dateRange = array_map(static fn ($date) => date('Y-m-d', strtotime($date)), $dateRange);

            $result->where('contact_content.created_at >=', $dateRange[0]);
            $result->where('contact_content.created_at <=', $dateRange[1]);
        }

        if ($filters['limit'] ?? null) {
            return $result->paginate($filters['limit']);
        }

        return $result->paginate(ApplicationConstant::PER_PAGE);
    }

    /**
     * @param mixed $category_id
     * @param mixed $categoryName
     *
     * @throws ReflectionException
     */
    public function storeUploadedContacts(UploadedFile $file, $category_id, $categoryName): bool
    {
        $csvData = SpreadSheetFileReader::readCsvFile($file, ['contact']);

        if (! $csvData) {
            return false;
        }

        $this->aggregator->db->transStart();

        $category = $this->categoryService->findOrCreate($category_id, $categoryName);

        foreach ($csvData as $datum) {
            $this->findOrInsert($datum['contact'], $category->id, $datum['remarks'] ?? null);
        }

        $this->aggregator->db->transComplete();

        return $this->aggregator->db->transStatus();
    }

    /**
     * @param mixed $categoryId
     * @param mixed $categoryName
     * @param mixed $date
     *
     * @throws Exception
     * @throws ReflectionException
     */
    public function storeUploadedContactsContent(UploadedFile $file, $categoryId, $categoryName, $date): bool
    {
        $data = SpreadSheetFileReader::readFile($file, ['AGGREGATED_NAME', 'DATE', 'SENDER_NO', 'DESTINATION_NO', 'OPERATOR_NAME', 'SMS_CONTENT', 'STATUS']);

        $totalRows = count($data);

        // If the file is empty, return false
        if ($totalRows === 0) {
            return false;
        }

        $numbLength = strlen($totalRows);
        $divider    = 10 ** ($numbLength - 1);

        $date = date('Y-m-d', strtotime($date));

        $this->aggregator->db->transStart();

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
            if ($processedRows % $divider === 0) {
                $progress = ($processedRows / $totalRows) * 100;

                // Start the session
                if (session_status() !== PHP_SESSION_ACTIVE) {
                    session()->start();
                }
                // Store the progress in the session
                session()->setFlashdata('upload_progress', $progress);
                // Close the session data to the client
                session()->close();
            }
        }

        session()->setFlashdata('upload_progress', 100);

        $this->aggregator->db->transComplete();

        return $this->aggregator->db->transStatus();
    }

    public function getUploadProgress()
    {
        return session()->getFlashdata('upload_progress');
    }

    public function whereContactsExist(): AggregatorService
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
