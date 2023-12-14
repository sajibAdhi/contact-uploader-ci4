<?php

namespace App\Controllers;

use App\Models\Category;
use App\Services\ContactService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ContactContentController extends BaseController
{
    private ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function index(): string
    {

        return view('contact_content/index', [
            'title' => 'Contact Content',
            'contacts' => $this->contactService->contactsContent(),
            'pager' => $this->contactService->contactContent->pager,
        ]);
    }

    public function create(): string
    {
        return view('contact_content/upload', [
            'title' => 'Upload Contact Content',
            'categories' => (new Category())->findAll()
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
            $file = $this->request->getFile('contacts_file');
            $category_id = $this->request->getPost('category');
            $category_name = $this->request->getPost('category_name');

            $isUploaded = $this->contactService->storeUploadedContactsContent($file, $category_id, $category_name);

            if ($this->request->isAJAX()) {

                if ($isUploaded) {
                    return $this->response->setStatusCode(200)->setJSON(['status' => 'success', 'message' => 'Contacts content uploaded successfully']);
                } else {
                    return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'Contacts content upload failed']);
                }

            } else {

                if ($isUploaded) {
                    return redirect()->route('contact.content.index')->with('success', 'Contacts content uploaded successfully');
                } else {
                    return redirect()->route('contact.content.upload')->with('error', 'Contacts content upload failed');
                }

            }

        } catch (\Exception $exception) {

            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(500)->setJSON(['status' => 'error', 'message' => $exception->getMessage()]);
            } else {
                return redirect()->route('contact.content.upload')->with('error', $exception->getMessage());
            }
        }
    }

    public function progress(): ResponseInterface
    {
        $progress = $this->contactService->getUploadProgress();
        return $this->response->setJSON(['progress' => $progress]);
    }
}