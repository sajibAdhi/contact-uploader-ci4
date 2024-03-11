<?php

namespace App\Services;

class DashboardService
{
    private CategoryService $categoryService;
    private ContactService $contactService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->contactService = new ContactService();
    }

    /**
     *
     * @return object
     */
    public function dashboardData(): object
    {
        $categories = $this->categoryService->category
            ->select("categories.*")
            ->select("COUNT(contacts.id) as contacts_count")
            ->join('contacts', 'contacts.category_id = categories.id', 'left')
            ->groupBy('categories.id')
            ->findAll();

        return (object)[
            'totalCategories' => $this->categoryService->category->countAllResults(),
            'totalContacts' => $this->contactService->contact->countAllResults(),
            'categories' => $categories
        ];
    }
}