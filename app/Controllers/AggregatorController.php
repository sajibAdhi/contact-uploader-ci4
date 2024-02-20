<?php

namespace App\Controllers;

use App\Services\AggregatorService;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class AggregatorController extends BaseController
{
    private AggregatorService $aggregatorService;

    public function __construct()
    {
        $this->aggregatorService = new AggregatorService();
    }

    public function index(): string
    {
        return view('aggregator/index', [
            'title' => 'Aggregators',
            'aggregators' => $this->aggregatorService->aggregator->findAll(),
        ]);
    }

    public function store(): RedirectResponse
    {
        if (!$this->validateAggregatorRequest()) {
            return redirect()->route('sms_service.aggregator')
                ->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->getPost();

        try {
            if ($this->aggregatorService->aggregator->insert($data)) {
                return redirect()->route('sms_service.aggregator')
                    ->with('success', 'aggregator created successfully');
            }

            return redirect()->route('sms_service.aggregator')
                ->withInput()->with('error', 'aggregator creation failed');
        } catch (ReflectionException $exception) {
            return redirect()->route('sms_service.aggregator')
                ->withInput()->with('error', $exception->getMessage());
        }
    }

    public function edit($id): string
    {
        return view('aggregator/index', [
            'title' => 'Edit aggregator',
            'action' => 'edit',
            'aggregators' => $this->aggregatorService->aggregator->findAll(),
            'aggregator' => $this->aggregatorService->aggregator->find($id),
        ]);
    }

    public function update($id): RedirectResponse
    {
        $data = $this->getPost();

        try {
            if ($this->aggregatorService->aggregator->update($id, $data)) {
                return redirect()->route('aggregator.index')
                    ->with('success', 'aggregator updated successfully');
            }

            return redirect()->route('aggregator.index')
                ->withInput()->with('error', 'aggregator update failed');
        } catch (ReflectionException $exception) {
            return redirect()->route('aggregator.index')
                ->withInput()->with('error', $exception->getMessage());
        }
    }

    private function getPost(): object
    {
        return (object)[
            'name' => $this->request->getPost('aggregator')
        ];
    }

    private function validateAggregatorRequest(): bool
    {
        return $this->validate([
            'aggregator' => 'required|min_length[3]|max_length[255]|is_unique[aggregators.name]',
        ]);
    }
}
