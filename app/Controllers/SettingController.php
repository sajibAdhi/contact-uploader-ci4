<?php

namespace App\Controllers;

use App\Services\SettingService;
use CodeIgniter\HTTP\RedirectResponse;

class SettingController extends BaseController
{
    private SettingService $settingsService;

    public function __construct()
    {
        $this->settingsService = new SettingService();
    }

    public function index(): string
    {
        return view('setting/index', [
            'settings' => $this->settingsService->getUserSettings(),
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        if ($this->settingsService->setUserSettings($this->request->getPost())) {
            return redirect()->route('settings')->with('success', 'Settings updated successfully');
        } else {
            return redirect()->route('settings')->with('error', 'Settings update failed');
        }
    }
}
