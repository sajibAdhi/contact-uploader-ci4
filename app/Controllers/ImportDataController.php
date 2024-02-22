<?php

namespace App\Controllers;

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
        $filters = [
            'categories' => $this->request->getGet('categories'),
            'daterange' => $this->request->getGet('daterange'),
            'limit' => $this->request->getGet('limit'),
        ];

        return view('import_data/index', [
            'title' => 'Imported Data',
            'categories' => $this->importDataService->whereContactsExist()->categories(),
            'contacts' => $this->importDataService->contactsContent($filters),
            'pager' => $this->importDataService->contactContent->pager,
        ]);
    }

    public function create(): string
    {
        return view('import_data/upload', [
            'title' => 'Import CSV File',
            'categories' => (new CategoryModel())->findAll(),
        ]);
    }

    /**
     * @return RedirectResponse|ResponseInterface
     */
    public function store()
    {
        ini_set('memory_limit', '3000M'); // Sets the memory limit to 250MB
        set_time_limit(300); // Sets the maximum execution time to 300 seconds (5 minutes)
        ini_set('mysql.connect_timeout', '300');
        ini_set('default_socket_timeout', '300');

        try {
            if (!$this->validateRequest()) {
                if ($this->request->isAJAX()) {
                    return response()->setStatusCode(422)->setJSON(['errors' => $this->validator->getErrors()]);
                }

                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $file = $this->request->getFile('contacts_file');
            $category_id = $this->request->getPost('category');
            $category_name = $this->request->getPost('category_name');
            $date = $this->request->getPost('date');

            $isUploaded = $this->importDataService->storeUploadedData($file, $category_id, $category_name, $date);

            if ($this->request->isAJAX()) {
                if ($isUploaded) {
                    return $this->response->setStatusCode(200)->setJSON(['status' => 'success', 'message' => 'Contacts content uploaded successfully']);
                }

                return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'Contacts content upload failed']);
            }

            if ($isUploaded) {
                return redirect()->route('contact.content.index')->with('success', 'Contacts content uploaded successfully');
            }

            return redirect()->route('contact.content.upload')->with('error', 'Contacts content upload failed');
        } catch (Exception $exception) {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => $exception->getMessage()]);
            }

            return redirect()->route('contact.content.upload')->with('error', $exception->getMessage());
        }
    }

    public function progress(): ResponseInterface
    {
        $progress = $this->importDataService->getUploadProgress();

        return $this->response->setJSON(['progress' => $progress]);
    }

    private function validateRequest(): bool
    {
        $max_file_size = 5 * 1024; // 2MB

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
                    // application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
                    'ext_in[contacts_file,csv,xlsx]', // checks if a file extension is CSV, XLS, XLSX, or XLSM
                    "max_size[contacts_file,{$max_file_size}]", // checks if the file size is less than or equal to $max_file_size
                ],
            ],
        ]);
    }
}
