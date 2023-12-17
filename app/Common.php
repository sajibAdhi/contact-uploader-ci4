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

use CodeIgniter\Config\Services;

if (!function_exists('route_to')) {
    /**
     * Given a route name or controller/method string and any params,
     * will attempt to build the relative URL to the
     * matching route.
     *
     * NOTE: This requires the controller/method to
     * have a route defined in the routes Config file.
     *
     * @param string $method Route name or Controller::method
     * @param int|string ...$params One or more parameters to be passed to the route.
     *                              The last parameter allows you to set the locale.
     *
     * @return false|string The route (URI path relative to baseURL) or false if not found.
     */
    function route_to(string $method, ...$params)
    {
        return base_url(Services::routes()->reverseRoute($method, ...$params));
    }
}

if (!function_exists('get_set_select')) {
    /**
     * Set Select
     *
     * Let's you set the selected value of a <select> menu via data in the POST array.
     */
    function get_set_select(string $field, string $value = '', bool $default = false): string
    {
        $request = Services::request();

        // Try any old input data we may have first
        $input = $request->getOldInput($field);

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


