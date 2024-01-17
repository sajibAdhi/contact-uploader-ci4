<?php

namespace OperatorBill\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use OperatorBill\Services\OperatorBillService;
use ReflectionException;

class OperatorBillController extends BaseController
{
    private OperatorBillService $operatorBillService;

    public function __construct()
    {
        $this->operatorBillService = new OperatorBillService();
    }

    public function index(): string
    {
        return operator_bill_view('index', [
            'title' => 'Operator Bills',
            'operatorBills' => $this->operatorBillService->findAll(),
        ]);
    }

    public function create(): string
    {
        return operator_bill_view('create', [
            'title' => 'Add Operator Bill',
            'operators' => $this->operatorBillService->operatorModel->findAll(),
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function store(): RedirectResponse
    {
        /** Validate The Data */
        $this->storeValidation();

        // If the validation passes, then get the posted data
        $postData = $this->request->getPost();
        $files = $this->request->getFiles();
        // Insert the posted data into the database
        if ($this->operatorBillService->store($postData, $files['file_upload'])) {
            return redirect()->route('operator_bill.index')->with('success', 'Operator Bill Created Successfully');
        }

        return redirect()->back()->withInput()->with('error', 'Something went wrong');
    }

    public function storeValidation()
    {
        // Define validation rules
        $rules = [
            'operator' => 'required|integer',
            'year' => 'required|numeric',
            'month' => 'required|numeric',
            'successful_calls' => 'required|numeric',
            'effective_duration' => 'required|numeric',
            'voice_amount' => 'required|numeric',
            'voice_amount_with_vat' => 'required|numeric',
            'sms_count' => 'required|numeric',
            'sms_rate' => 'required|numeric',
            'sms_amount' => 'required|numeric',
            'sms_amount_with_vat' => 'required|numeric',
            'file_upload.*' => 'uploaded[file_upload]|max_size[file_upload,1024]|ext_in[file_upload,pdf,jpg,png]'
        ];

        // Validate the posted data
        if (!$this->validate($rules)) {
            // Redirect back to the form with the validation errors
            redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
}