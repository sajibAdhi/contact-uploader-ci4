<?php

namespace Modules\Shield\Config;

use Config\Autoload;

class ShieldAutoload extends Autoload
{
    public function __construct()
    {
        parent::__construct();

        // Append the Shield Common.php file to the files array
        // the file location is ../Common.php
        $this->files[] = ROOTPATH . 'modules/shield/Common.php';
    }
}