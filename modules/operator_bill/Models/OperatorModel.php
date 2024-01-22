<?php

namespace OperatorBill\Models;

use CodeIgniter\Model;

class OperatorModel extends Model
{
    protected $table = 'operators';
    protected $primaryKey = 'id';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'address', 'phone', 'email'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules =  [
        'id'    => 'max_length[19]|is_natural_no_zero',
        'name' =>  ['label' => 'Operator Name', 'rules' => 'required|trim|string|min_length[3]|max_length[255]'],
        'address' => ['label' => 'Operator Address', 'rules' => 'permit_empty|trim|string|min_length[3]|max_length[255]'],
        'phone' => ['label' => 'Operator Phone', 'rules' => 'permit_empty|trim|string|min_length[3]|max_length[255]'],
        'email' => ['label' => 'Operator Email', 'rules' => 'permit_empty|trim|valid_email|min_length[3]|max_length[255]']
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
