<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Services\ContactContentService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class ImportCsvController extends BaseController
{
    private ContactContentService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactContentService();
    }

    public function index(): string
    {
        $filters = [
            'categories' => $this->request->getGet('categories'),
            'daterange'  => $this->request->getGet('daterange'),
            'limit'      => $this->request->getGet('limit'),
        ];

        return view('import_csv/index', [
            'title'      => 'Imported Data',
            'categories' => $this->contactService->whereContactsExist()->categories(),
            'contacts'   => $this->contactService->contactsContent($filters),
            'pager'      => $this->contactService->contactContent->pager,
        ]);
    }

    public function create(): string
    {
        return view('import_csv/upload', [
            'title'      => 'Import CSV File',
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
            $file          = $this->request->getFile('contacts_file');
            $category_id   = $this->request->getPost('category');
            $category_name = $this->request->getPost('category_name');
            $date          = $this->request->getPost('date');

            $isUploaded = $this->contactService->storeUploadedContactsContent($file, $category_id, $category_name, $date);

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
        $progress = $this->contactService->getUploadProgress();

        return $this->response->setJSON(['progress' => $progress]);
    }
}
