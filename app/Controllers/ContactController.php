<?php

namespace App\Controllers;

use App\Services\ContactService;

class ContactController extends BaseController
{
    private ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function index(): string
    {
        return view('contact\index', [
            'contacts' => $this->contactService->contacts(),
        ]);
    }
}