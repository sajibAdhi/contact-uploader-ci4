<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ContactContentUploadFilter implements FilterInterface
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
     * @param array|null $arguments
     *
     * @return RedirectResponse|ResponseInterface|void|null
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! $request instanceof IncomingRequest) {
            return;
        }

        $max_file_size = 2 * 1024; // 2MB

        $validation = Services::validation();

        $validation->setRules([
            'category' => [
                'label' => 'Category',
                'rules' => [
                    'required',
                    'numeric',
                    'is_not_unique[categories.id]',
                ],
            ],
            'date' => [
                'label' => 'Date',
                'rules' => [
                    'required',
                    'trim',
                    'string',
                    'valid_date',
                ],
            ],
            'contacts_file' => [
                'label' => 'Contacts File',
                'rules' => [
                    'uploaded[contacts_file]', // checks if the file was uploaded
                    'ext_in[contacts_file,csv]', // checks if file extension is CSV, XLS, XLSX, or XLSM
                    "max_size[contacts_file,{$max_file_size}]", // checks if the file size is less than or equal to $max_file_size
                ],
            ],
        ]);

        if (! $validation->withRequest($request)->run()) {
            if ($request->isAJAX()) {
                return response()->setStatusCode(422)->setJSON(['errors' => $validation->getErrors()]);
            }

            return redirect()->back()->withInput();
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param array|null $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
