<?php

namespace App\Services;

use App\Constants\ApplicationConstant;
use App\Models\ContactContentModel;
use App\Models\ContactModel;
use ReflectionException;

class ContactService
{
    public ContactModel $contact;
    public CategoryService $categoryService;
    public ContactContentModel $contactContent;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
        $this->contact = new ContactModel();
        $this->contactContent = new ContactContentModel();
    }

    public function contacts(): array
    {
        return $this->contact
            ->select('contacts.*, categories.name as category_name')
            ->join('categories', 'categories.id = contacts.category_id')
            ->findAll();
    }

    public function categories(): array
    {
        return $this->categoryService->category->findAll();
    }

    /**
     * @throws ReflectionException
     */
    public function findOrInsertNumber(string $number, int $categoryId): object
    {
        $existingContact = $this->existingContact($number);

        if (empty($existingContact)) {
            $this->contact->insert(['number' => $number, 'category_id' => $categoryId]);
            $existingContact = $this->existingContact($number);
        }

        return $existingContact;
    }

    /**
     * @param string $number
     * @return array|object|null
     */
    private function existingContact(string $number)
    {
        return $this->contact->where('number', $number)->first();
    }

    public function find(int $contactId)
    {
        return $this->contact->find($contactId);
    }

    public function paginate(): array
    {
        return $this->contact
            ->select('contacts.id, contacts.number, categories.name as category_name')
            ->join('categories', 'categories.id = contacts.category_id')
            ->paginate(ApplicationConstant::PER_PAGE);
    }

    public function filter(array $filter): ContactService
    {
        if (!empty($filter['categories']) && !in_array('all', $filter['categories'])) {
            $this->contact->whereIn('contacts.category_id', $filter['categories']);
        }

        return $this;
    }
}
