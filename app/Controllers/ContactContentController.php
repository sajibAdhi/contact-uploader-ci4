<?php

namespace App\Controllers;

use App\Services\ContactService;

class ContactContentController extends BaseController
{
    private ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function index(): string
    {
        return view('contact_content\index', [
            'title' => 'Contact Content',
            'contacts' => $this->contactService->contactsContent(),
        ]);
    }
}