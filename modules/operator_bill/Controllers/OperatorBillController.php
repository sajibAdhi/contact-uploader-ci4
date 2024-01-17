<?php

namespace OperatorBill\Controllers;

use App\Controllers\BaseController;

class OperatorBillController extends BaseController
{
    public function index(): string
    {
        return operator_bill_view('index');
    }

    public function create(): string
    {
        return operator_bill_view('create', [
            'title' => 'Add Bill',
        ]);
    }
}