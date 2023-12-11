<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class ContactUploadFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null $arguments
     *
     * @return RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $max_file_size = 2 * 1024; // 2MB
        ini_set('memory_limit', '512M'); // Sets the memory limit to 512MB
        set_time_limit(300); // Sets the maximum execution time to 300 seconds (5 minutes)
        ini_set('mysql.connect_timeout', '300');
        ini_set('default_socket_timeout', '300');


        $validation = \Config\Services::validation();

        $validation->setRules([
            'category' => [
                'label' => 'Category',
                'rules' => [
                    'permit_empty',
                    'numeric',
                    'is_not_unique[categories.id]'
                ],
            ],
            'category_name' => [
                'label' => 'Category Name',
                'rules' => [
                    'required_without[category]',
                    'string',
                    'is_unique[categories.name]'
                ]
            ],
            'contacts_file' => [
                'label' => 'Contacts File',
                'rules' => [
                    'uploaded[contacts_file]', // checks if the file was uploaded
                    'mime_in[contacts_file,text/csv,application/vnd.ms-excel,application/vnd.ms-excel.sheet.macroEnabled.12,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]', // checks if the file is of type CSV, Excel, or Excel with Macros
                    'ext_in[contacts_file,csv,xls,xlsx,xlsm]', // checks if file extension is CSV, XLS, XLSX, or XLSM
                    "max_size[contacts_file,$max_file_size]", // checks if the file size is less than or equal to 1024KB (1MB)
                ],
            ]
        ]);

        if (!$validation->withRequest($request)->run()) {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array|null $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
