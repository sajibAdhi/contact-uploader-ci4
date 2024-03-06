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

if (!function_exists('set_select')) {
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
     * @return SettingService
     */
    function settingService(): SettingService
    {
        return new SettingService();
    }
}


if (!function_exists('active_link')) {

    /**
     * Active link
     * If $uri is equal to current_uri return $class
     */
    function active_link(...$uris): string
    {
        $current_uri = current_url(true)->getPath();

        if (in_array($current_uri, $uris, true)) {
            return 'active';
        }

        return '';
    }
}

if (!function_exists('menu_open')) {

    /**
     * Active menu
     * @param mixed ...$uris
     * @return string
     */
    function menu_open(...$uris): string
    {
        $current_uri = current_url(true)->getPath();

        if (in_array($current_uri, $uris, true)) {
            return 'menu-open';
        }

        return 'menu-close';
    }
}


// DataTable helper functions
if (!function_exists('load_datatable_styles')) {
    /**
     * Load DataTable styles
     *
     * @return string
     */
    function load_datatable_styles(): string
    {
        $styles = [
            'adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            'adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'
        ];

        $result = '<!-- load_datatable_styles -->' . PHP_EOL;
        foreach ($styles as $style) {
            $result .= '<link rel="stylesheet" href="' . base_url($style) . '">' . PHP_EOL;
        }

        return $result;
    }
}

if (!function_exists('load_datatable_scripts')) {
    /**
     * Load DataTable scripts
     *
     * @return string
     */
    function load_datatable_scripts(): string
    {
        $scripts = [
            'adminlte/plugins/datatables/jquery.dataTables.min.js',
            'adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
            'adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js',
            'adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
            'adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js',
            'adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
            'adminlte/plugins/jszip/jszip.min.js',
            'adminlte/plugins/pdfmake/pdfmake.min.js',
            'adminlte/plugins/pdfmake/vfs_fonts.js',
            'adminlte/plugins/datatables-buttons/js/buttons.html5.min.js',
            'adminlte/plugins/datatables-buttons/js/buttons.print.min.js',
            'adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js'
        ];

        $result = '<!-- load_datatable_scripts -->' . PHP_EOL;
        foreach ($scripts as $script) {
            $result .= '<script src="' . base_url($script) . '"></script>' . PHP_EOL;
        }
        return $result;
    }
}

if (!function_exists('initialize_datatable')) {
    /**
     * Initialize DataTable
     *
     * @param string $tableId
     * @param array $options
     * @return string
     */
    function initialize_datatable(string $tableId, array $options = []): string
    {
        // Default options
        $defaultOptions = [
            "responsive" => true,
            "lengthChange" => false,
            "autoWidth" => false,
            "order" => [],
            "buttons" => ["copy", "csv", "excel", "pdf", "print", "colvis"]
        ];

        // Merge default options with user-provided options
        $finalOptions = array_merge($defaultOptions, $options);
        $finalOptions = json_encode($finalOptions);

        // Initialize DataTable
        return <<<EOT
                <script>
                $(function () {
                    $("#$tableId").DataTable($finalOptions).buttons().container().appendTo('#$tableId' + '_wrapper .col-md-6:eq(0)');
                });
                </script>
                EOT;
    }
}

// DatePicker helper functions
if (!function_exists('load_datepicker_styles')) {
    /**
     * Load DatePicker styles
     *
     * @return string
     */
    function load_datepicker_styles(): string
    {
        $styles = [
            'adminlte/plugins/daterangepicker/daterangepicker.css',
            'adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'
        ];

        $result = '<!-- load_datepicker_styles -->' . PHP_EOL;
        foreach ($styles as $style) {
            $result .= '<link rel="stylesheet" href="' . base_url($style) . '">' . PHP_EOL;
        }

        return $result;
    }
}

if (!function_exists('load_datepicker_scripts')) {
    /**
     * Load DatePicker scripts
     *
     * @return string
     */
    function load_datepicker_scripts(): string
    {
        $scripts = [
            'adminlte/plugins/moment/moment.min.js',
            'adminlte/plugins/daterangepicker/daterangepicker.js',
            'adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'
        ];

        $result = '<!-- load_datepicker_scripts -->' . PHP_EOL;
        foreach ($scripts as $script) {
            $result .= '<script src="' . base_url($script) . '"></script>' . PHP_EOL;
        }
        return $result;
    }
}

if (!function_exists('initialize_datepicker')) {
    /**
     * Initialize DatePicker
     *
     * @param string $selector
     * @param array $options
     * @return string
     */
    function initialize_datepicker(string $selector, array $options = []): string
    {
        // Default options
        $defaultOptions = [
            "singleDatePicker" => true,
            "showDropdowns" => true,
            "autoApply" => true,
            "locale" => [
                "format" => "YYYY-MM-DD",
                "separator" => " to ",
                "applyLabel" => "Apply",
                "cancelLabel" => "Cancel",
                "fromLabel" => "From",
                "toLabel" => "To",
                "customRangeLabel" => "Custom",
                "daysOfWeek" => ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                "monthNames" => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                "firstDay" => 1
            ]
        ];

        // Merge default options with user-provided options
        $finalOptions = array_merge($defaultOptions, $options);
        $finalOptions = json_encode($finalOptions);

        // Initialize DatePicker
        return <<<EOT
                <!-- initialize_datepicker -->
                <script>
                $(function () {
                    $('$selector').daterangepicker($finalOptions)
                });
                </script>
                EOT;
    }
}

// initialize date_range picker
if (!function_exists('initialize_date_range_picker')) {
    /**
     * Initialize DateRangePicker
     *
     * @param string $selector
     * @param array $options
     * @return string
     */
    function initialize_date_range_picker(string $selector, array $options = []): string
    {
        // date range field must be empty
        $defaultOptions = [
            "autoUpdateInput" => false,
            "locale" => [
                "cancelLabel" => "Clear",
            ]
        ];

        // Merge default options with user-provided options
        $finalOptions = array_merge($defaultOptions, $options);
        $finalOptions = json_encode($finalOptions);

        // Initialize DateRangePicker
        return <<<EOT
                <!-- initialize_daterange_picker -->
                <script>
                    $(function () {
                        const daterangepicker = $(`$selector`);
                       
                        daterangepicker.daterangepicker($finalOptions);
                       
                        daterangepicker.on('apply.daterangepicker', function(ev, picker) {
                            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                        });
                        
                        daterangepicker.on('cancel.daterangepicker', function() {
                            $(this).val('');
                        });
                    });
                </script>
                EOT;
    }
}

// Select2 helper functions
if (!function_exists('load_select2_styles')) {
    /**
     * Load Select2 styles
     *
     * @return string
     */
    function load_select2_styles(): string
    {
        $styles = [
            'adminlte/plugins/select2/css/select2.min.css',
            'adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'
        ];

        $result = '<!-- load_select2_styles -->' . PHP_EOL;
        foreach ($styles as $style) {
            $result .= '<link rel="stylesheet" href="' . base_url($style) . '">' . PHP_EOL;
        }

        return $result;
    }
}

if (!function_exists('load_select2_scripts')) {
    /**
     * Load Select2 scripts
     *
     * @return string
     */
    function load_select2_scripts(): string
    {
        $scripts = [
            'adminlte/plugins/select2/js/select2.full.min.js'
        ];

        $result = '<!-- load_select2_scripts -->' . PHP_EOL;
        foreach ($scripts as $script) {
            $result .= '<script src="' . base_url($script) . '"></script>' . PHP_EOL;
        }
        return $result;
    }
}

if (!function_exists('initialize_select2')) {
    /**
     * Initialize Select2
     *
     * @param string $selector
     * @param array $options
     * @return string
     */
    function initialize_select2(string $selector = '.selectTwo', array $options = []): string
    {
        // Default options
        $defaultOptions = [
            "theme" => "bootstrap4"
        ];

        // Merge default options with user-provided options
        $finalOptions = array_merge($defaultOptions, $options);
        $finalOptions = json_encode($finalOptions);

        // Initialize Select2
        return <<<EOT
                <!-- initialize_select2 -->
                <script>
                $(document).ready(function () {
                    $('$selector').select2($finalOptions)                    
                });
                </script>
                EOT;
    }
}

// SweetAlert helper functions
if (!function_exists('load_sweetalert2_styles')) {
    /**
     * Load SweetAlert2 styles
     *
     * @return string
     */
    function load_sweetalert2_styles(): string
    {
        $styles = [
            'adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'
        ];

        $result = '<!-- load_sweetalert2_styles -->' . PHP_EOL;
        foreach ($styles as $style) {
            $result .= '<link rel="stylesheet" href="' . base_url($style) . '">' . PHP_EOL;
        }

        return $result;
    }
}

if (!function_exists('load_sweetalert2_scripts')) {
    /**
     * Load SweetAlert2 scripts
     *
     * @return string
     */
    function load_sweetalert2_scripts(): string
    {
        $scripts = [
            'adminlte/plugins/sweetalert2/sweetalert2.min.js'
        ];

        $result = '<!-- load_sweetalert2_scripts -->' . PHP_EOL;
        foreach ($scripts as $script) {
            $result .= '<script src="' . base_url($script) . '"></script>' . PHP_EOL;
        }
        return $result;
    }
}

if (!function_exists('initialize_sweetalert2')) {
    /**
     * Initialize SweetAlert2
     *
     * @param array $options
     * @return string
     */
    function initialize_sweetalert2(array $options = []): string
    {
        // Default options
        $defaultOptions = [
            "theme" => "bootstrap4"
        ];

        // Merge default options with user-provided options
        $finalOptions = array_merge($defaultOptions, $options);
        $finalOptions = json_encode($finalOptions);

        // Initialize SweetAlert2
        return <<<EOT
                <!-- initialize_sweetalert2 -->
                <script>
                $(function () {
                     Swal.mixin($finalOptions)
                });
                </script>
                EOT;
    }
}

// toasts helper functions
if (!function_exists('load_toasts_styles')) {
    /**
     * Load notify styles
     *
     * @return string
     */
    function load_toasts_styles(): string
    {
        $styles = [
            'adminlte/plugins/toastr/toastr.min.css'
        ];

        $result = '<!-- load_toasts_styles -->' . PHP_EOL;
        foreach ($styles as $style) {
            $result .= '<link rel="stylesheet" href="' . base_url($style) . '">' . PHP_EOL;
        }

        return $result;
    }
}

if (!function_exists('load_toasts_scripts')) {
    /**
     * Load notify scripts
     *
     * @return string
     */
    function load_toasts_scripts(): string
    {
        $scripts = [
            'adminlte/plugins/toastr/toastr.min.js'
        ];

        $result = '<!-- load_toasts_scripts -->' . PHP_EOL;
        foreach ($scripts as $script) {
            $result .= '<script src="' . base_url($script) . '"></script>' . PHP_EOL;
        }
        return $result;
    }
}

if (!function_exists('initialize_toasts')) {
    /**
     * Initialize notify
     *
     * @param array $options
     * @return string
     */
    function initialize_toasts(array $options = []): string
    {
        // Default options
        $defaultOptions = [
            "progressBar" => true,
            "timeOut" => 3000
        ];

        // Merge default options with user-provided options
        $finalOptions = array_merge($defaultOptions, $options);
        $finalOptions = json_encode($finalOptions);

        // Initialize notify
        return <<<EOT
                $(function () {
                    toastr.options = $finalOptions;
                });
                EOT;
    }
}

// notify toasts helper functions for server session
if (!function_exists('notify')) {
    /**
     * Notify
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    function notify(string $type, string $message): void
    {
        session()->setFlashdata('notify', [
            'type' => $type,
            'message' => $message
        ]);
    }
}

// notify toasts
if (!function_exists('notify_toasts')) {
    /**
     * Notify toasts
     *
     * @return string
     */
    function notify_toasts(): string
    {
        $notify = session()->getFlashdata('notify');

        if ($notify === null) {
            return '';
        }

        return <<<EOT
                <script>
                $(function () {
                    toastr.{$notify['type']}('{$notify['message']}');
                });
                </script>
                EOT;
    }
}



