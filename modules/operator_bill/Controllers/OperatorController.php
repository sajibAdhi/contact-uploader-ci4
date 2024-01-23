<?php

namespace OperatorBill\Controllers;

use App\Controllers\BaseController;
use OperatorBill\Models\OperatorModel;
use OperatorBill\Constants\OpetatorTypeConstant;
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
        return operator_bill_view('operator\form', [
            'title' => 'Add Operator',
            'operatorTypes' => OpetatorTypeConstant::all(),
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function store()
    {
        try {
            // Get the validated data
            $data = $this->postData();

            if ($this->operatorModel->insert($data)) {
                // Redirect the user back to the form with a success message
                return redirect()->route('operator_bill.operator.index')->with('success', 'Operator created successfully');
            } else {
                return redirect()->back()->withInput()->with('_ci_validation_errors', $this->operatorModel->errors());
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(int $id): string
    {
        $operator = $this->operatorModel->find($id);

        return operator_bill_view('operator\form', [
            'title' => 'Edit Operator',
            'action' => 'edit',
            'operator' => $operator,
        ]);
    }

    /**
     * @throws ReflectionException
     */
    public function update(int $id)
    {
        try {
            // Get the validated data
            $data = $this->postData();

            if ($this->operatorModel->update($id, $data)) {
                return redirect()->route('operator_bill.operator.index')->with('success', 'Operator updated successfully');
            } else {
                return redirect()->back()->withInput()->with('_ci_validation_errors', $this->operatorModel->errors());
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try{
            if ($this->operatorModel->delete($id)) {
                return redirect()->route('operator_bill.operator.index')->with('success', 'Operator deleted successfully');
            } else {
                return redirect()->back()->with('_ci_validation_errors', $this->operatorModel->errors());
            }
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /** ----------------------------------------------------------------------------------------------- */

    private function postData()
    {
        return [
            'name' => $this->request->getPost('operator_name'),
            'address' => $this->request->getPost('operator_address'),
            'phone' => $this->request->getPost('operator_phone'),
            'email' => $this->request->getPost('operator_email'),
        ];
    }
}
