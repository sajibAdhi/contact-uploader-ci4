<?php

namespace App\Modules\Product\Entities;

use CodeIgniter\Entity\Entity;

class Product extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [];
}
