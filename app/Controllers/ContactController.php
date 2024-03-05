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
        $filter = [
            'categories' => $this->request->getGet('categories'),
        ];
        return view('contact/index', [
            'categories' => $this->contactService->categoryService->getCategoriesOfContacts(),
            'contacts' => $this->contactService->filter($filter)->paginate(),
            'pager' => $this->contactService->contact->pager,
        ]);
    }

}