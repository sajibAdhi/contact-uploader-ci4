<?php

namespace App\Controllers;

use App\Constants\ApplicationConstant;
use App\Models\CategoryModel;
use App\Services\ImportDataService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class ImportDataController extends BaseController
{
    private ImportDataService $importDataService;

    public function __construct()
    {
        $this->importDataService = new ImportDataService();
    }

    public function index(): string
    {
        $filters = (object)[
            'categories' => $this->request->getGet('categories'),
            'daterange' => $this->request->getGet('daterange'),
        ];

        $limit = $this->request->getGet('limit') ?? null;
        //if empty, set to null
        $limit = empty($limit) ? null : $limit;

        return view('import_data/index', [
            'title' => 'Imported Data',
            'categories' => $this->importDataService->whereContactsExist()->categories(),
            'contactContents' => $this->importDataService->filter($filters)->contactsContent($limit),
            'pager' => $this->importDataService->contactContent->pager,
        ]);
    }

    public function create(): string
    {
        return view('import_data/upload', [
            'title' => 'Import Data',
            'categories' => (new CategoryModel())->findAll(),
        ]);
    }

    /**
     * @return RedirectResponse|ResponseInterface
     */
    public function uploadFile()
    {
        // Sets the memory limit
        ini_set('memory_limit', '512M'); // 100MB

        if (!$this->request->isAJAX()) {
            return redirect()->route('sms_service.import_data.upload')->with('error', 'Invalid request');
        }

        $newCsrfToken = csrf_token();
        $newCsrfHash = csrf_hash();

        try {
            if (!$this->validateRequest()) {
                return response()->setStatusCode(422)->setJSON([
                    'status' => 'errors',
                    'errors' => $this->validator->getErrors(),
                    'csrf_token' => $newCsrfToken,
                    'csrf_hash' => $newCsrfHash
                ]);
            }


            $file = $this->request->getFile('contacts_file');

            if ($batch = $this->importDataService->uploadFile($file)) {
                return $this->response->setStatusCode(200)->setJSON([
                    'status' => 'success',
                    'success' => 'File uploaded successfully',
                    'csrf_token' => $newCsrfToken,
                    'csrf_hash' => $newCsrfHash,
                    'batch' => $batch,
                ]);
            } else {
                return $this->response->setStatusCode(500)->setJSON([
                    'status' => 'error',
                    'error' => 'File upload failed',
                    'csrf_token' => $newCsrfToken,
                    'csrf_hash' => $newCsrfHash
                ]);
            }
        } catch (Exception $exception) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'error' => $exception->getMessage(),
                'csrf_token' => $newCsrfToken,
                'csrf_hash' => $newCsrfHash
            ]);
        }
    }

    /**
     * @return RedirectResponse|ResponseInterface
     */
    public function storeFileData()
    {
        ini_set('memory_limit', '256M'); // 100MB
//        set_time_limit(15 * 60);
//        // Sets the maximum time in seconds that the script is allowed to connect to the database
//        ini_set('mysql.connect_timeout', 5 * 60); // 5 minutes

        if (!$this->request->isAJAX()) {
            return redirect()->route('sms_service.import_data.upload')->with('error', 'Invalid request');
        }

        $newCsrfToken = csrf_token();
        $newCsrfHash = csrf_hash();

        try {
            if (!$this->validateRequest()) {
                return response()->setStatusCode(422)->setJSON([
                    'status' => 'errors',
                    'errors' => $this->validator->getErrors(),
                    'csrf_token' => $newCsrfToken,
                    'csrf_hash' => $newCsrfHash
                ]);
            }

            $batch = $this->request->getPost('batch', FILTER_SANITIZE_STRING);
            $category_id = $this->request->getPost('category', FILTER_SANITIZE_NUMBER_INT);
            $date = $this->request->getPost('date', FILTER_SANITIZE_STRING);

            $this->importDataService->storeFileData($batch, $category_id, $date);

            return $this->response->setStatusCode(200)->setJSON([
                'status' => 'success',
                'success' => 'Data processed successfully',
                'csrf_token' => $newCsrfToken,
                'csrf_hash' => $newCsrfHash
            ]);
        } catch (Exception $exception) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'error' => $exception->getMessage(),
                'csrf_token' => $newCsrfToken,
                'csrf_hash' => $newCsrfHash
            ]);
        }
    }

    public function progress(): ResponseInterface
    {
        $batch = $this->request->getGet('batch');
        $progressData = $this->importDataService->getUploadProgress($batch);

        return $this->response->setJSON([
            'status' => 'success',
            'success' => 'Progress fetched successfully',
            'progress' => $progressData->progress,
            'inserted' => $progressData->inserted,
            'count' => $progressData->count,
            'stored' => $progressData->stored
        ]);
    }

    private function validateRequest(): bool
    {
        $max_file_size = 20 * 1024; // 20MB

        return $this->validate([
            'category' => [
                'label' => 'Category',
                'rules' => [
                    'required',
                    'numeric',
                    'is_not_unique[categories.id]',
                ],
            ],
            'date' => [
                'label' => 'Date',
                'rules' => [
                    'required',
                    'trim',
                    'string',
                    'valid_date',
                ],
            ],
            'contacts_file' => [
                'label' => 'Contacts File',
                'rules' => [
                    'uploaded[contacts_file]', // checks if the file was uploaded
                    'ext_in[contacts_file,csv,xlsx]', // checks if a file extension is CSV, XLS, XLSX, or XLSM
                    "max_size[contacts_file,$max_file_size]", // checks if the file size is less than or equal to $max_file_size
                ],
            ],
        ]);
    }
}
