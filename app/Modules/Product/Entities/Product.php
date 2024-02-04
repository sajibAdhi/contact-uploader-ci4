<?php

namespace App\Modules\Product\Entities;

use Michalsn\Uuid\UuidEntity;

class Product extends UuidEntity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    protected $attributes = [
        'id' => null,
        'name' => null,
        'description' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];
}
