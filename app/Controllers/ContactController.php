<?php

namespace App\Controllers;

use App\Services\ContactContentService;

class ContactController extends BaseController
{
    private ContactContentService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactContentService();
    }

    public function index(): string
    {
        return view('contact/index', [
            'contacts' => $this->contactService->contacts(),
        ]);
    }
}