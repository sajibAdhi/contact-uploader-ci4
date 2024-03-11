<?php

namespace App\Controllers;

use App\Services\DashboardService;


class DashboardController extends BaseController
{
    private DashboardService $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    public function index(): string
    {
        return view('dashboard/index', [
            'title' => 'Dashboard',
            'dashboardData' => $this->dashboardService->dashboardData(),
        ]);
    }
}