<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Contact;
use App\Services\CategoryService;
use App\Services\ContactService;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class ContactContentUploadController extends BaseController
{
    private ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function create(): string
    {
        return view('contact_content\upload', [
            'title' => 'Upload Contact Content',
            'categories' => (new Category())->findAll()
        ]);
    }

    public function store(): RedirectResponse
    {
        set_time_limit(120);
        try {
            $file = $this->request->getFile('contacts_file');
            $category_id = $this->request->getPost('category');
            $category_name = $this->request->getPost('category_name');

            if ($this->contactService->storeUploadedContactsContent($file, $category_id, $category_name)) {
                return redirect()->route('contact.content.upload')->with('success', 'Contact content uploaded successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Contacts upload failed');
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withInput()->with('error', $exception->getMessage());
        }
    }
}
