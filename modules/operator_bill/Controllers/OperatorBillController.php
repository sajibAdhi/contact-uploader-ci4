<?php

namespace OperatorBill\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use OperatorBill\Constants\OperatorTypeConstant;
use OperatorBill\Constants\SBNConstant;
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
            'sbnList' => SBNConstant::all(),
            'operatorTypes' => OperatorTypeConstant::all(),
            'operators' => $this->operatorBillService->operatorModel->findAll(),
        ]);
    }

    public function store(): RedirectResponse
    {
        try {
            /** Validate The Data */
            $this->storeValidation();

            // If the validation passes, then get the posted data
            $postData = [
                'sbn' => $this->request->getPost('sbn', FILTER_SANITIZE_STRING),
                'operator_id' => $this->request->getPost('operator_id', FILTER_SANITIZE_NUMBER_INT),
                'year' => $this->request->getPost('year', FILTER_SANITIZE_NUMBER_INT),
                'month' => $this->request->getPost('month', FILTER_SANITIZE_NUMBER_INT),
                'successful_calls' => $this->request->getPost('successful_calls', FILTER_SANITIZE_NUMBER_INT),
                'effective_duration' => $this->request->getPost('effective_duration', FILTER_SANITIZE_NUMBER_INT),
                'voice_amount' => $this->request->getPost('voice_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'voice_amount_with_vat' => $this->request->getPost('voice_amount_with_vat', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'sms_count' => $this->request->getPost('sms_count', FILTER_SANITIZE_NUMBER_INT),
                'sms_amount' => $this->request->getPost('sms_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'sms_amount_with_vat' => $this->request->getPost('sms_amount_with_vat', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            ];
            $files = $this->request->getFiles();

            // Insert the posted data into the database
            if ($this->operatorBillService->store($postData, $files['file_upload'])) {
                return redirect()->route('operator_bill.index')->with('success', 'Operator Bill Created Successfully');
            }

            return redirect()->back()->withInput()->with('_ci_validation_errors', $this->operatorBillService->operatorBillModel->errors());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(int $id): string
    {
        return operator_bill_view('create', [
            'title' => 'Edit Operator Bill',
            'action' => 'edit',
            'operatorBill' => $this->operatorBillService->find($id),
            'operators' => $this->operatorBillService->operatorModel->findAll(),
        ]);
    }

    public function ajaxGet()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back()->with('error', 'Invalid Request');
        }

        $operator_type = $this->request->getGet('operator_type') ?? null;

        $operators = $this->operatorBillService->operatorModel->where('type', $operator_type)->findAll();

        // Check if the operators are empty
        if (empty($operators)) {
            // Return a json response so this get ajax error

            return $this->response
                ->setStatusCode(204)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'No operators found for this operator type',
                ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Operators found',
            'data' => $operators,
        ]);
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------
     */

    private function storeValidation()
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