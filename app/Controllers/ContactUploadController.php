<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Contact;
use App\Services\CategoryService;
use App\Services\ContactService;
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
        return view('contact\upload');
    }

    /**
     * @throws ReflectionException
     */
    public function store()
    {
        $file = $this->request->getFile('csv_file');

        dd($this->contactService->storeUploadedCategories($file));
    }
}
