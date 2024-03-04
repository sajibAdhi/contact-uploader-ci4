<?php

namespace App\Services;

use App\Constants\ApplicationConstant;
use App\Libraries\SpreadSheetFileReader;
use App\Models\ContactContentModel;
use CodeIgniter\Files\Exceptions\FileException;
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
     * @param int $categoryId
     * @param string $date
     * @return bool
     * @throws ReflectionException
     * @throws Exception
     */
    public function storeUploadedData(UploadedFile $file, int $categoryId, string $date): bool
    {
        $identifier = $date . auth()->id();
        // Set the status to reading
        session()->setFlashdata("$identifier.upload_status", 'Reading the data...');
        session()->close();

        $data = SpreadSheetFileReader::readFile($file, ['aggregator_name', 'from', 'to', 'operator_name', 'content', 'status']);

        $totalRows = count($data);
        $divider = $totalRows / 10; // to set upload progress
        $processedRows = 0;
        $chunkSize = 5000; // Define the size of each chunk

        // If the file is empty, return false
        if ($totalRows === 0) {
            throw new Exception('The file is empty');
        }
        // If the file is too large, return false
        if ($totalRows > 500000) {
            throw new Exception('The file is too large, please upload a file with less than 500,000 rows');
        }


        // Initialize caches
        $fromNumbersCache = [];
        $toNumbersCache = [];
        $aggregatorsCache = [];

        $this->contactContent->db->transStart();
        // Set the status to writing
        session()->start();
        session()->setFlashdata("$identifier.upload_status", 'Writing the data...');
        session()->close();

        // Process the data in chunks
        for ($i = 0; $i < $totalRows; $i += $chunkSize) {
            $dataChunk = array_slice($data, $i, $chunkSize);

            $fromNumbers = [];
            $toNumbers = [];
            $aggregator_names_in_data = [];

            foreach ($dataChunk as $datum) {
                $fromNumbers[] = trim($datum['from']);
                $toNumbers[] = trim($datum['to']);
                $aggregator_names_in_data[] = trim($datum['aggregator_name']);
            }

            // unique fromNumbers
            foreach (array_unique($fromNumbers) as $fromNumber) {
                if (!isset($fromNumbersCache[$fromNumber])) {
                    $fromNumbersCache[$fromNumber] = $this->contactService->findOrInsertNumber($fromNumber, $categoryId);
                }
            }

            // unique toNumbers
            foreach (array_unique($toNumbers) as $toNumber) {
                if (!isset($toNumbersCache[$toNumber])) {
                    $toNumbersCache[$toNumber] = $this->contactService->findOrInsertNumber($toNumber, $categoryId);
                }
            }

            // unique aggregators trim names
            foreach (array_unique($aggregator_names_in_data) as $aggregatorName) {
                $aggregatorsCache[$aggregatorName] = $this->aggregatorService->findOrInsert($aggregatorName);
            }

            $validData = [];
            foreach ($dataChunk as $key => $datum) {

                $validData[$key]['from_contact_id'] = $fromNumbersCache[$datum['from']]->id;
                $validData[$key]['to_contact_id'] = $toNumbersCache[$datum['to']]->id;
                $validData[$key]['aggregator_id'] = $aggregatorsCache[trim($datum['aggregator_name'])]->id;
                $validData[$key]['date'] = date('Y-m-d', strtotime($date));
                $validData[$key]['operator_name'] = $datum['operator_name'];
                $validData[$key]['content'] = $datum['content'];
                $validData[$key]['status'] = $datum['status'];
                $validData[$key]['remarks'] = $datum['status'] ?? null;


                $processedRows++;
                // Update the progress 10 times
                if ($processedRows % $divider === 0) {
                    $progress = ($processedRows / $totalRows) * 100;

                    session()->start();
                    session()->setFlashdata("$identifier.upload_progress", $progress);
                    session_commit();
                }
            }
            // Insert the chunk into the database
            $this->contactContent->builder()->ignore()->insertBatch($validData);

            // Free up memory
            unset($dataChunk);
        }

        session()->start();
        session()->setFlashdata("$identifier.upload_progress", 100);
        // Set the status to complete
        session()->setFlashdata("$identifier.upload_status", 'Data upload complete.');

        $this->contactContent->db->transComplete();

        return $this->contactContent->db->transStatus();
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

    /**
     * @throws Exception
     */
    public function uploadFile(?UploadedFile $file): string
    {
        if ($file === null) {
            throw new FileException('No file was uploaded');
        }

        if ($file->getError() !== UPLOAD_ERR_OK) {
            throw new FileException($file->getErrorString());
        }

        $data = SpreadSheetFileReader::readFile($file, ['aggregator_name', 'from', 'to', 'operator_name', 'content', 'status']);

        $count = count($data);

        // If the file is empty, return false
        if ($count === 0) {
            throw new Exception('The file is empty');
        }
        // If the file is too large, return false
        if ($count >= 500000) {
            throw new Exception('The file is too large, please upload a file with less than 500,000 rows');
        }

        // change file name in a unique name
        $fileRandomName = $file->getRandomName();
        cache()->save($fileRandomName, ['data' => $data, 'count' => $count], 60 * 60 * 24); // cache the file data for 24 hours (1 day

        return $fileRandomName;
    }

    /**
     * @throws ReflectionException
     */
    public function storeFileData(string $batch, int $categoryId, string $date)
    {
        $batchData = cache()->get($batch);

        $count = $batchData['count'];
        $chunkSize = 5000; // Define the size of each chunk

        // Initialize caches
        $fromNumbersCache = [];
        $toNumbersCache = [];
        $aggregatorsCache = [];

        // Process the data in chunks
        for ($i = 0; $i < $count; $i += $chunkSize) {
            $dataChunk = array_slice($batchData['data'], $i, $chunkSize);

            $fromNumbers = [];
            $toNumbers = [];
            $aggregator_names_in_data = [];

            foreach ($dataChunk as $datum) {
                $fromNumbers[] = trim($datum['from']);
                $toNumbers[] = trim($datum['to']);
                $aggregator_names_in_data[] = trim($datum['aggregator_name']);
            }

            // unique fromNumbers
            foreach (array_unique($fromNumbers) as $fromNumber) {
                if (!isset($fromNumbersCache[$fromNumber])) {
                    $fromNumbersCache[$fromNumber] = $this->contactService->findOrInsertNumber($fromNumber, $categoryId);
                }
            }

            // unique toNumbers
            foreach (array_unique($toNumbers) as $toNumber) {
                if (!isset($toNumbersCache[$toNumber])) {
                    $toNumbersCache[$toNumber] = $this->contactService->findOrInsertNumber($toNumber, $categoryId);
                }
            }

            // unique aggregators trim names
            foreach (array_unique($aggregator_names_in_data) as $aggregatorName) {
                $aggregatorsCache[$aggregatorName] = $this->aggregatorService->findOrInsert($aggregatorName);
            }

            $validData = [];
            foreach ($dataChunk as $key => $datum) {

                $validData[$key]['from_contact_id'] = $fromNumbersCache[$datum['from']]->id;
                $validData[$key]['to_contact_id'] = $toNumbersCache[$datum['to']]->id;
                $validData[$key]['aggregator_id'] = $aggregatorsCache[trim($datum['aggregator_name'])]->id;
                $validData[$key]['date'] = date('Y-m-d', strtotime($date));
                $validData[$key]['operator_name'] = $datum['operator_name'];
                $validData[$key]['content'] = $datum['content'];
                $validData[$key]['status'] = $datum['status'];
                $validData[$key]['remarks'] = $datum['status'] ?? null;
                $validData[$key]['batch'] = $batch;
            }
            // Insert the chunk into the database
            $this->contactContent->builder()->ignore()->insertBatch($validData);

            // Free up memory
            unset($dataChunk);
        }
        $batchData['stored'] = true;
        cache()->save($batch, $batchData, 60 * 60 * 24); // cache the file data for 24 hours (1 day
    }

    public function testGetUploadProgress(string $batch): object
    {
        $batchData = cache()->get($batch);
        $count = $batchData['count'];
        $stored = $batchData['stored'] ?? false;

        if ($stored) {
            cache()->delete($batch);
        }

        $inserted = $this->contactContent->where('batch', $batch)->countAllResults();

        $progress = ($inserted / $count) * 100;


        return (object)[
            'progress' => $progress,
            'inserted' => $inserted,
            'count' => $count,
            'stored' => $stored,
        ];
    }
}
