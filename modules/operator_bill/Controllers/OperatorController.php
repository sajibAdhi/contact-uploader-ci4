<?php

namespace OperatorBill\Controllers;

use App\Controllers\BaseController;
use OperatorBill\Models\OperatorModel;
use ReflectionException;

class OperatorController extends BaseController
{
    private OperatorModel $operatorModel;

    public function __construct()
    {
        $this->operatorModel = new OperatorModel();
    }

    public function index(): string
    {
        $operators = $this->operatorModel->findAll();

        return operator_bill_view('operator\index', [
            'title' => 'Operator List',
            'operators' => $operators,
        ]);
    }

    public function create(): string
    {
        return operator_bill_view('operator\create', [
            'title' => 'Add Operator',
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function store()
    {
        $rules = [
            'operator_name' => 'required',
            'operator_address' => 'required',
            'operator_phone' => 'required',
            'operator_email' => 'required|valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get the validated data
        $data = [
            'name' => $this->request->getPost('operator_name'),
            'address' => $this->request->getPost('operator_address'),
            'phone' => $this->request->getPost('operator_phone'),
            'email' => $this->request->getPost('operator_email'),
        ];

        $this->operatorModel->save($data);

        // Redirect the user back to the form with a success message
        return redirect()->route('operator_bill.operator.index')->with('success', 'Operator created successfully');
    }

    public function edit(int $id)
    {
        $operator = $this->operatorModel->find($id);

        return operator_bill_view('operator\edit', [
            'title' => 'Edit Operator',
            'operator' => $operator,
        ]);
    }
}