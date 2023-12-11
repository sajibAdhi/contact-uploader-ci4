<?php

namespace App\Controllers;

use App\Services\ContactService;
use CodeIgniter\Pager\Pager;
use Config\Services;

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
}