<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class CategoryStoreFilter implements FilterInterface
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
     * @return RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! $request instanceof IncomingRequest) {
            return;
        }

        $validation = Services::validation();

        $categoryId = $request->getUri()->getSegment(2); // Get the category id from the URI

        $validation->setRules([
            'category' => [
                'label' => 'Category',
                'rules' => [
                    'required',
                    'trim',
                    'string',
                    'min_length[3]',
                    'max_length[255]',
                    'is_unique[categories.name,id,' . $categoryId . ']', // Ignore the current category id
                ],
            ],
        ]);

        if (! $validation->withRequest($request)->run()) {
            return redirect()->back()->withInput()->with('error', 'Invalid Form Data');
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
