<?php

namespace App\Modules\OperatorBill\Constants;

class DBConstant
{
    const OPERATOR_BILL_TABLE = 'operator_bills';
    const OPERATOR_BILL_HISTORY_TABLE = 'operator_bill_histories';

    const ACTION_ENUM = [
        'create',
        'update',
        'delete'
    ];

}