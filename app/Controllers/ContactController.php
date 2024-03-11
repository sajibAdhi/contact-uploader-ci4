<?php

namespace App\Controllers;

use App\Services\ContactService;
use Hermawan\DataTables\DataTable;

class ContactController extends BaseController
{
    private ContactService $contactService;

    public function __construct()
    {
        $this->contactService = new ContactService();
    }

    public function index(): string
    {
        return view('contact/index', [
            'categories' => $this->contactService->categoryService->getCategoriesOfContacts()
        ]);
    }

    public function indexDatatable()
    {

        $filter = new \stdClass();
        $filter->categories = explode(',', $this->request->getGet('categories'));

        $builder = $this->contactService->filter($filter)->contactBuilder();

        return DataTable::of($builder)
            ->addNumbering('no')
            ->toJson(true);
    }

}