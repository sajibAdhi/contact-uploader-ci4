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

    public function filter(object $filters): ImportDataService
    {
//        dd(!in_array('all', $filters->to_contact_categories, true));
        if (is_array($filters->to_contact_categories) && !in_array('all', $filters->to_contact_categories, true)) {
            $this->contactContent->whereIn('to_contacts.category_id', $filters->to_contact_categories);
        }

        if ($filters->daterange ?? null) {
            $dateRange = explode(' - ', $filters->daterange);

            $dateRange = array_map(static fn($date) => date('Y-m-d', strtotime($date)), $dateRange);

            $this->contactContent->where('contact_content.date >=', $dateRange[0]);
            $this->contactContent->where('contact_content.date <=', $dateRange[1]);
        }

        return $this;
    }

    public function prepareSelectQuery(array $fields = []): ContactContentModel
    {
        // If no fields are passed, use a default set
        if (empty($fields)) {
            $fields = [
                'contact_content.id',
                'contact_content.date',
                'contact_content.operator_name',
                'contact_content.status',
                'contact_content.content',
                'from_contacts.number as from_number',
                'to_contacts.number as to_number',
                'to_contact_category.name as to_number_category',
                'aggregators.name as aggregator_name'
            ];
        }

        $this->contactContent->select($fields)
            ->join('contacts from_contacts', 'from_contacts.id = contact_content.from_contact_id', 'LEFT')
            ->join('contacts to_contacts', 'to_contacts.id = contact_content.to_contact_id', 'LEFT')
            ->join('categories to_contact_category', 'to_contact_category.id = to_contacts.category_id', 'LEFT')
            ->join('aggregators', 'aggregators.id = contact_content.aggregator_id', 'LEFT');

        return $this->contactContent;
    }

    public function contactsContent(int $limit = null): array
    {
        return $this->prepareSelectQuery()->paginate($limit ?? ApplicationConstant::PER_PAGE);
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

    public function getUploadProgress(string $batch): object
    {
        $batchData = cache()->get($batch);
        $stored = $batchData['stored'] ?? false;

        if ($stored) {
            cache()->delete($batch);
        }

        $count = $batchData['count'] ?? 0;
        $inserted = $this->contactContent->where('batch', $batch)->countAllResults();

        if ($count === 0) {
            $progress = 0;
        } else {
            $progress = ($inserted / $count) * 100;
        }


        return (object)[
            'progress' => $progress,
            'inserted' => $inserted,
            'count' => $count,
            'stored' => $stored,
        ];
    }
}
