<?php

if (!function_exists('load_datatable_styles')) {
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
    function load_datatable_scripts()
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
     * @param $tableId
     * @param array $options
     * @return string
     */
    function initialize_datatable($tableId, array $options = [])
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
