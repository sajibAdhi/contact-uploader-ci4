<?php

namespace App\Modules\OperatorBill\Models;

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

    protected $validationRules =  [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
