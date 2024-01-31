<?php

namespace Modules\OperatorBill\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use Modules\OperatorBill\Constants\OperatorTypeConstant;
use Modules\OperatorBill\Models\OperatorModel;
use Modules\OperatorBill\Traits\Viewable;

class OperatorController extends BaseController
{
    use Viewable;

    private OperatorModel $operatorModel;

    public function __construct()
    {
        $this->operatorModel = new OperatorModel();
    }

    public function index(): string
    {
        $operators = $this->operatorModel->findAll();

        return $this->view('operator\index', [
            'title' => 'Operator List',
            'operators' => $operators,
        ]);
    }

    public function create(): string
    {
        return $this->view('operator\form', [
            'title' => 'Add Operator',
            'operatorTypes' => OperatorTypeConstant::all(),
        ]);
    }

    public function store()
    {
        try {
            // Validate the input
            if (!$this->storeValidation()) {
                return redirect()->back()->withInput();
            }

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

        return $this->view('operator\form', [
            'title' => 'Edit Operator',
            'action' => 'edit',
            'operator' => $operator,
        ]);
    }

    public function update(int $id)
    {
        try {
            // Validate the input
            if (!$this->storeValidation()) {
                return redirect()->back()->withInput();
            }

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

    public function delete(int $id): RedirectResponse
    {
        try {
            if ($this->operatorModel->delete($id)) {
                return redirect()->route('operator_bill.operator.index')->with('success', 'Operator deleted successfully');
            } else {
                return redirect()->back()->with('_ci_validation_errors', $this->operatorModel->errors());
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * -------------------------------------------------------------------
     */

    private function storeValidation(): bool
    {
        $rules = [
            'operator_type' => [
                'label' => 'Operator Type',
                'rules' => [
                    'required',
                    'trim',
                    'in_list[' . implode(',', OperatorTypeConstant::all()) . ']',
                ]
            ],
            'operator_name' => [
                'label' => 'Operator Name',
                'rules' => 'required|trim|string|max_length[255]',
            ],
            'operator_address' => [
                'label' => 'Operator Address',
                'rules' => 'permit_empty|trim|string|max_length[255]',
            ],
            'operator_phone' => [
                'label' => 'Operator Phone',
                'rules' => 'permit_empty|trim|string|max_length[255]',
            ],
            'operator_email' => [
                'label' => 'Operator Email',
                'rules' => 'permit_empty|trim|valid_email|max_length[255]',
            ],
        ];

        return $this->validate($rules);
    }

    private function postData(): array
    {
        return [
            'name' => $this->request->getPost('operator_name'),
            'address' => $this->request->getPost('operator_address'),
            'phone' => $this->request->getPost('operator_phone'),
            'email' => $this->request->getPost('operator_email'),
            'type' => $this->request->getPost('operator_type'),
        ];
    }
}
