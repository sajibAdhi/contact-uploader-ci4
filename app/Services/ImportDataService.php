<?php

namespace App\Services;

use App\Constants\ApplicationConstant;
use App\Libraries\SpreadSheetFileReader;
use App\Models\ContactContentModel;
use CodeIgniter\CLI\CLI;
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

    public function contactsContent(int $limit = null): array
    {
        $result = $this->contactContent->paginate($limit ?? ApplicationConstant::PER_PAGE);

        array_walk($result, function ($contactContent) {
            $contactContent->aggregator = $this->aggregatorService->find($contactContent->aggregator_id);
            $contactContent->form = $this->contactService->find($contactContent->from_contact_id);
            $contactContent->to = $this->contactService->contact->find($contactContent->to_contact_id);
        });

        return $result;
    }

    public function getData(int $limit, int $offset): array
    {
        $result = $this->contactContent->orderBy('id', 'DESC')->findAll($limit, $offset);

        array_walk($result, function ($contactContent) {
            $contactContent->aggregator = $this->aggregatorService->find($contactContent->aggregator_id);
            $contactContent->form = $this->contactService->find($contactContent->from_contact_id);
            $contactContent->to = $this->contactService->contact->find($contactContent->to_contact_id);
        });

        return $result;
    }

    public function filter(object $filters): ImportDataService
    {
        if ($filters->categories ?? null) {
            if (!in_array('all', $filters->categories, true)) {
                $this->contactContent->whereIn('contacts.category_id', $filters->categories);
            }
        }

        if ($filters->daterange ?? null) {
            $dateRange = explode(' - ', $filters->daterange);

            $dateRange = array_map(static fn($date) => date('Y-m-d', strtotime($date)), $dateRange);

            $this->contactContent->where('contact_content.date >=', $dateRange[0]);
            $this->contactContent->where('contact_content.date <=', $dateRange[1]);
        }

        return $this;
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
        $chunkSize = 5000; // Define the size of each chunk
        $data = SpreadSheetFileReader::readFile($file, ['aggregator_name', 'from', 'to', 'operator_name', 'content', 'status']);

        $totalRows = count($data);

        // If the file is empty, return false
        if ($totalRows === 0) {
            throw new Exception('The file is empty');
        }

        if ($totalRows > 500000) {
            throw new Exception('The file is too large, please upload a file with less than 500,000 rows');
        }

        $divider = $totalRows / 10; // to set upload progress

        // Initialize caches
        $fromNumbersCache = [];
        $toNumbersCache = [];
        $aggregatorsCache = [];

        $this->contactContent->db->transStart();

        $processedRows = 0;

        // Process the data in chunks
        for ($i = 0; $i < $totalRows; $i += $chunkSize) {
            $dataChunk = array_slice($data, $i, $chunkSize);

            // unique formNumbers
            $fromNumbers = array_unique(array_map(static fn($datum) => trim($datum['from']), $dataChunk));
            foreach ($fromNumbers as $fromNumber) {
                if (!isset($fromNumbersCache[$fromNumber])) {
                    $fromNumbersCache[$fromNumber] = $this->contactService->findOrInsertNumber($fromNumber, $categoryId);
                }
            }

            // unique toNumbers
            $toNumbers = array_unique(array_map(static fn($datum) => trim($datum['to']), $dataChunk));
            foreach ($toNumbers as $toNumber) {
                if (!isset($toNumbersCache[$toNumber])) {
                    $toNumbersCache[$toNumber] = $this->contactService->findOrInsertNumber($toNumber, $categoryId);
                }
            }

            // unique aggregators trim names
            $aggregator_names_in_data = array_unique(array_map(static fn($datum) => trim($datum['aggregator_name']), $dataChunk));
            foreach ($aggregator_names_in_data as $aggregatorName) {
                $aggregatorsCache[$aggregatorName] = $this->aggregatorService->findOrInsert($aggregatorName);
            }

            foreach ($dataChunk as $key => $datum) {

                // replace the from with the form_contact_id
                $dataChunk[$key]['from_contact_id'] = $fromNumbersCache[$datum['from']]->id;

                // replace the to with the to_contact_id
                $dataChunk[$key]['to_contact_id'] = $toNumbersCache[$datum['to']]->id;

                // replace the aggregator_name with the aggregator_id
                $dataChunk[$key]['aggregator_id'] = $aggregatorsCache[trim($datum['aggregator_name'])]->id;

                // date
                $dataChunk[$key]['date'] = date('Y-m-d', strtotime($date));

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

            // Insert the chunk into the database
            $this->contactContent->insertBatch($dataChunk);

            // Free up memory
            unset($dataChunk);
        }

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session()->start();
        }
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
