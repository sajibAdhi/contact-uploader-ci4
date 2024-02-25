<?php

namespace App\Services;

use App\Constants\ApplicationConstant;
use App\Libraries\SpreadSheetFileReader;
use App\Models\ContactContentModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Exception;
use ReflectionException;

class ImportDataService
{
    public CategoryService $categoryService;
    public ContactContentModel $contactContent;
    private AggregatorService $aggregatorService;
    private ContactService $contactService;

    public function __construct()
    {
        $this->aggregatorService = new AggregatorService();
        $this->categoryService = new CategoryService();
        $this->contactService = new ContactService();
        $this->contactContent = new ContactContentModel();
    }

    public function contacts(): array
    {
        return $this->contactService->contact
            ->select('contacts.*, categories.name as category_name')
            ->join('categories', 'categories.id = contacts.category_id')
            ->findAll();
    }

    public function contactsContent(array $filters = []): array
    {
        $result = $this->contactContent;

        if ($filters['categories'] ?? null) {
            if (!in_array('all', $filters['categories'], true)) {
                $result->whereIn('contacts.category_id', $filters['categories']);
            }
        }

        if ($filters['daterange'] ?? null) {
            $dateRange = explode(' - ', $filters['daterange']);

            $dateRange = array_map(static fn($date) => date('Y-m-d', strtotime($date)), $dateRange);

            $result->where('contact_content.created_at >=', $dateRange[0]);
            $result->where('contact_content.created_at <=', $dateRange[1]);
        }

        if ($filters['limit'] ?? null) {
            return $result->paginate($filters['limit']);
        }

        $result = $result->paginate(ApplicationConstant::PER_PAGE);

        array_walk($result, function ($contactContent) {
            $contactContent->aggregator = $this->aggregatorService->find($contactContent->aggregator_id);
            $contactContent->form = $this->contactService->find($contactContent->from_contact_id);
            $contactContent->to = $this->contactService->contact->find($contactContent->to_contact_id);
        });

        return $result;
    }

    /**
     * @param UploadedFile $file
     * @param mixed $categoryId
     * @param mixed $date
     * @param int|null $aggregatorId
     * @return bool
     * @throws ReflectionException
     * @throws Exception
     */
    public function storeUploadedData(UploadedFile $file, int $categoryId = null, int $aggregatorId = null, string $date = null): bool
    {
        $data = SpreadSheetFileReader::readFile($file, ['aggregator_name', 'from', 'to', 'operator_name', 'content', 'status']);

        $totalRows = count($data);

        // If the file is empty, return false
        if ($totalRows === 0) {
            return false;
        }

        $numbLength = strlen($totalRows);
        $divider = 10 ** ($numbLength - 1);

        $this->contactContent->db->transStart();

        // unique formNumbers
        $fromNumbers = array_unique(array_map(static fn($datum) => trim($datum['from']), $data));
        $fromNumbers = $this->contactService->findAllOrInsertBatchContactNumbers($fromNumbers, $categoryId);

        // unique toNumbers
        $toNumbers = array_unique(array_map(static fn($datum) => trim($datum['to']), $data));
        $toNumbers = $this->contactService->findAllOrInsertBatchContactNumbers($toNumbers, $categoryId);

        // unique aggregators trim names
        $aggregator_names_in_data = array_unique(array_map(static fn($datum) => trim($datum['aggregator_name']), $data));
        $aggregators = $this->aggregatorService->findAllOrInsertBatchByAggregatorName($aggregator_names_in_data);

        $processedRows = 0;
        foreach ($data as $key => $datum) {

            // replace the from with the form_contact_id
            $index = array_search($datum['from'], array_column($fromNumbers, 'number'), true);
            $data[$key]['from_contact_id'] = $fromNumbers[$index]->id;

            // replace the to with the to_contact_id
            $index = array_search($datum['to'], array_column($toNumbers, 'number'), true);
            $data[$key]['to_contact_id'] = $toNumbers[$index]->id;

            // date
            $data[$key]['date'] = date('Y-m-d', strtotime($date));


            // replace the aggregator_name with the aggregator_id
            $index = array_search($datum['aggregator_name'], array_column($aggregators, 'name'), true);
            $data[$key]['aggregator_id'] = $aggregators[$index]->id;

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
                log_message('info', 'Progress: ' . $progress);
                // Close the session data to the client
                session()->close();
            }

            dd($data[$key]);
        }
        $this->contactContent->insertBatch($data);

        session()->setFlashdata('upload_progress', 100);

        $this->contactContent->db->transComplete();

        return $this->contactContent->db->transStatus();
    }

    public function getUploadProgress()
    {
        return session()->getFlashdata('upload_progress');
    }

    public function whereContactsExist(): ImportDataService
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
