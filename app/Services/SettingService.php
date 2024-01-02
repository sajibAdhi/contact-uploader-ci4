<?php

namespace App\Services;

use App\Libraries\SpreadSheetFileReader;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Model;
use ReflectionException;

class SettingService
{
    private array $settingFields = [
        'date_format',
    ];
    private \CodeIgniter\Database\BaseConnection $db;
    private string $settingFiledPrefix;

    public function __construct()
    {
        $this->db = (new Model())->db;
        $this->settingFiledPrefix = "user_id_" . auth()->id();
    }

    public function getSettings(): array
    {
        $settings = [];
        foreach ($this->settingFields as $field) {
            $settings[$field] = setting("$this->settingFiledPrefix.$field");
        }

        return $settings;
    }

    public function setSettings($settings): bool
    {
        $this->db->transStart();
        foreach ($this->settingFields as $field) {
            setting("$this->settingFiledPrefix.$field", $settings[$field]);
        }
        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function getSetting($field): string
    {
        return setting("$this->settingFiledPrefix.$field");
    }
}
