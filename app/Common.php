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

if (!function_exists('get_set_select')) {
    /**
     * Set Select
     *
     * Let's you set the selected value of a <select> menu via data in the POST array.
     */
    function set_select(string $field, string $value = '', bool $default = false): string
    {
        $request = Services::request();

        // Try any old input data we may have first
        $input = $request->getOldInput($field);

        if ($input === null) {
            $input = $request->getPost($field);
        }

        if ($input === null) {
            $input = $request->getGet($field);
        }

        if ($input === null) {
            return ($default === true) ? ' selected="selected"' : '';
        }

        if (is_array($input)) {
            // Note: in_array('', array(0)) returns TRUE, do not use it
            foreach ($input as &$v) {
                if ($value === $v) {
                    return ' selected="selected"';
                }
            }

            return '';
        }

        return ($input === $value) ? ' selected="selected"' : '';
    }
}

if (!function_exists('set_value')) {
    /**
     * Form Value
     *
     * Grabs a value from the POST array for the specified field so you can
     * re-populate an input field or textarea
     *
     * @param string $field Field name
     * @param string|string[] $default Default value
     * @param bool $htmlEscape Whether to escape HTML special characters or not
     *
     * @return string|string[]
     */
    function set_value(string $field, $default = '', bool $htmlEscape = true)
    {
        $request = Services::request();

        // Try any old input data we may have first
        $value = $request->getOldInput($field);

        if ($value === null) {
            $value = $request->getPost($field);
        }

        if ($value === null) {
            $value = $request->getGet($field) ?? $default;
        }

        return ($htmlEscape) ? esc($value) : $value;
    }
}

if (!function_exists('settingService')) {

    /**
     * @param string|null $filed
     * @return SettingService|string
     */
    function settingService(string $filed = null)
    {
        $settingService = new SettingService();

        return $filed ? $settingService->getSetting($filed) : $settingService;
    }
}
