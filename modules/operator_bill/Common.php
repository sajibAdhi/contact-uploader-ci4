<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

use App\Services\SettingService;
use CodeIgniter\Config\Services;

if (!function_exists('operator_bill_view')) {
    /**
     * @param string $name
     * @param array $data
     * @param array $options
     * @return string
     */
    function operator_bill_view(string $name, array $data = [], array $options = []): string
    {
        return view("Modules\\OperatorBill\\Views\\$name", $data, $options);
    }
}