<?php

namespace App\Services;

use App\Libraries\SpreadSheetFileReader;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\Model;
use CodeIgniter\Settings\Settings;
use ReflectionException;

class SettingService
{
    private array $settingFields = [
        'php_date_format',

        'js_date_format',
    ];
    private \CodeIgniter\Database\BaseConnection $db;
    private string $settingFiledPrefix;

    public function __construct()
    {
        $this->db = (new Model())->db;
        $this->settingFiledPrefix = "user_id_" . auth()->id();
    }

    public function getUserSettings(): array
    {
        $settings = [];
        foreach ($this->settingFields as $field) {
            $settings[$field] = setting("$this->settingFiledPrefix.$field");
        }

        return $settings;
    }

    public function setUserSettings($settings): bool
    {
        $this->db->transStart();
        foreach ($this->settingFields as $field) {
            setting("$this->settingFiledPrefix.$field", $settings[$field]);
        }
        $this->db->transComplete();

        return $this->db->transStatus();
    }

    /**
     * @param string $field
     * @return array|bool|float|int|object|string|null
     */
    public function getUserSetting(string $field)
    {
        return setting("$this->settingFiledPrefix.$field");
    }
}
