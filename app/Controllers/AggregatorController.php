<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\AggregatorService;
use CodeIgniter\HTTP\ResponseInterface;

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
}
