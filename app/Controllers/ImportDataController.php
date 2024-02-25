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
        $limit = $this->request->getGet('limit');

        return view('import_data/index', [
            'title' => 'Imported Data',
            'categories' => $this->importDataService->whereContactsExist()->categories(),
            'contactContents' => $this->importDataService->filter($filters)->contactsContent($limit),
            'pager' => $this->importDataService->contactContent->pager,
        ]);
    }

    // AJAX request handler
    public function fetchData(int $page = 1): ResponseInterface
    {
        $limit = ApplicationConstant::PER_PAGE; // Number of rows per page
        $offset = ($page - 1) * $limit;
        $data = $this->importDataService->getData($limit, $offset);

        return $this->response->setJSON($data);
    }


    // Generate Excel file
    public function generateExcel(): void
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add data to the spreadsheet
        $data = $this->importDataService->getAllData();
        foreach ($data as $index => $row) {
            $sheet->fromArray($row, null, 'A' . ($index + 1));
        }

        // Write the spreadsheet to a file
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('path/to/file.xlsx');
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
        set_time_limit(15 * 60);
        ini_set('mysql.connect_timeout', 5 * 60);
        ini_set('default_socket_timeout', 5 * 60);

        $newCsrfToken = csrf_token();
        $newCsrfHash = csrf_hash();

        try {


            if (!$this->validateRequest()) {
                if ($this->request->isAJAX()) {
                    return response()->setStatusCode(422)->setJSON([
                        'errors' => $this->validator->getErrors(),
                        'csrf_token' => $newCsrfToken,
                        'csrf_hash' => $newCsrfHash
                    ]);
                }

                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $file = $this->request->getFile('contacts_file');
            $category_id = $this->request->getPost('category');
            $aggregator_id = $this->request->getPost('aggregator');
            $date = $this->request->getPost('date');

            $isUploaded = $this->importDataService->storeUploadedData($file, $category_id, $aggregator_id, $date);

            if ($this->request->isAJAX()) {
                if ($isUploaded) {
                    return $this->response->setStatusCode(200)->setJSON([
                        'status' => 'success',
                        'message' => 'Contacts content uploaded successfully',
                        'csrf_token' => $newCsrfToken,
                        'csrf_hash' => $newCsrfHash
                    ]);
                }

                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => 'Contacts content upload failed',
                    'csrf_token' => $newCsrfToken,
                    'csrf_hash' => $newCsrfHash
                ]);
            }

            if ($isUploaded) {
                return redirect()->route('sms_service.import_data')->with('success', 'Contacts content uploaded successfully');
            }

            return redirect()->route('sms_service.import_data.upload')->with('error', 'Contacts content upload failed');
        } catch (Exception $exception) {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(500)->setJSON([
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                    'csrf_token' => $newCsrfToken,
                    'csrf_hash' => $newCsrfHash
                ]);
            }

            return redirect()->route('sms_service.import_data.upload')->with('error', $exception->getMessage());
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
