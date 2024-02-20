<?php // Path: adminlte3_helper.php

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

        $result = '';
        foreach ($styles as $style) {
            $result .= '<link rel="stylesheet" href="' . base_url($style) . '">';
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

        $result = '';
        foreach ($scripts as $script) {
            $result .= '<script src="' . base_url($script) . '"></script>';
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
            $result .= '<link rel="stylesheet" href="' . base_url($style) . '">';
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
     * @param string $inputId
     * @param array $options
     * @return string
     */
    function initialize_datepicker(string $inputId, array $options = []): string
    {
        // Default options
        $defaultOptions = [
            "format" => "YYYY-MM-DD",
            "useCurrent" => false
        ];

        // Merge default options with user-provided options
        $finalOptions = array_merge($defaultOptions, $options);
        $finalOptions = json_encode($finalOptions);

        // Initialize DatePicker
        return <<<EOT
                <!-- initialize_datepicker -->
                <script>
                $('#$inputId').datetimepicker($finalOptions);
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
     * @param string $class
     * @param array $options
     * @return string
     */
    function initialize_select2(string $class, array $options = []): string
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
                $('.$class').select2($finalOptions);
                </script>
                EOT;
    }
}