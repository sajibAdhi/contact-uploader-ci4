<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Contact;
use App\Services\CategoryService;
use App\Services\ContactService;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class ContactUploadController extends BaseController
{
    private ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function create(): string
    {
        return view('contact\upload', [
            'title' => 'Upload Contacts',
            'categories' => (new Category())->findAll()
        ]);
    }

    public function store(): RedirectResponse
    {
        try {
            $file = $this->request->getFile('contacts_file');
            $category_id = $this->request->getPost('category');
            $category_name = $this->request->getPost('category_name');

            if ($this->contactService->storeUploadedCategories($file, $category_id, $category_name)) {
                return redirect()->route('contact.upload')->with('success', 'Contacts uploaded successfully');
            } else {
                return redirect()->back()->with('error', 'Contacts upload failed');
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
