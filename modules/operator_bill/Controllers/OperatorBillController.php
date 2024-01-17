<?php

namespace OperatorBill\Controllers;

use App\Controllers\BaseController;
use OperatorBill\Models\OperatorModel;
use OperatorBill\Services\OperatorBillService;

class OperatorBillController extends BaseController
{
    private OperatorModel $operatorBillModel;
    private OperatorBillService $operatorBillService;

    public function __construct()
    {
        $this->operatorBillModel = new OperatorModel();
        $this->operatorBillService = new OperatorBillService();
    }

    public function index(): string
    {
        return operator_bill_view('index');
    }

    public function create(): string
    {
        return operator_bill_view('create', [
            'title' => 'Add Operator Bill',
            'operators' => $this->operatorBillModel->findAll(),
        ]);
    }

    /**
     * @throws \ReflectionException
     */
    public function store()
    {
        dd($this->request->getPost(), $this->request->getFiles());

        /** Validate The Data */
        $this->storeValidation();

        // If the validation passes then get the posted data
        $postData = $this->request->getPost();

        // Insert the posted data into the database
        $this->operatorBillService->store($postData);

        // Redirect to a success page
        return redirect()->to('/success');

    }

    public function storeValidation()
    {
        // Define validation rules
        $rules = [
            'operator' => 'required',
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
            'file_upload' => 'uploaded[file_upload]|max_size[file_upload,1024]|ext_in[file_upload,pdf,jpg,png]'
        ];

        // Validate the posted data
        if (!$this->validate($rules)) {
            // Redirect back to the form with the validation errors
            redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }
}