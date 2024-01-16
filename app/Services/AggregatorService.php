<?php

namespace App\Services;

use App\Constants\ApplicationConstant;
use App\Libraries\SpreadSheetFileReader;
use App\Models\AggregatorModel;
use App\Models\ContactContentModel;
use App\Models\ContactModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Exception;
use ReflectionException;

class AggregatorService
{
    public AggregatorModel $aggregator;

    public function __construct()
    {
        $this->aggregator = new AggregatorModel();
    }

}
