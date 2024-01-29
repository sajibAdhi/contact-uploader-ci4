<?php

namespace Modules\OperatorBill\Models;

use CodeIgniter\Model;

class OperatorModel extends Model
{
    protected $table = 'operators';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'address', 'phone', 'email','type'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules =  [
        'name' =>  ['label' => 'Operator Name', 'rules' => 'required|trim|string|min_length[3]|max_length[255]'],
        'address' => ['label' => 'Operator Address', 'rules' => 'permit_empty|trim|string|min_length[3]|max_length[255]'],
        'phone' => ['label' => 'Operator Phone', 'rules' => 'permit_empty|trim|string|min_length[3]|max_length[255]'],
        'email' => ['label' => 'Operator Email', 'rules' => 'permit_empty|trim|valid_email|min_length[3]|max_length[255]']
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
