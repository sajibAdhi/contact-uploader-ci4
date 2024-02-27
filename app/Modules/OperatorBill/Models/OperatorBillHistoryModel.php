<?php

namespace App\Modules\OperatorBill\Models;

use App\Modules\OperatorBill\Constants\DBConstant;
use CodeIgniter\Model;

class OperatorBillHistoryModel extends Model
{
    protected $table            = DBConstant::OPERATOR_BILL_HISTORY_TABLE;
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'previous_id',
        'action',
        'added_by',
        'added_at',
        'sbu',
        'year',
        'month',
        'operator_id',
        'successful_calls',
        'effective_duration',
        'voice_amount',
        'voice_amount_with_vat',
        'sms_count',
        'sms_amount',
        'sms_amount_with_vat',
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
