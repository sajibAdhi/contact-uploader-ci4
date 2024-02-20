<?php

namespace App\Modules\Product\Traits;

trait Viewable
{
    private function view(string $name, array $data = [], array $options = []): string
    {
        return view("App\\Modules\\Product\\Views\\$name", $data, $options);
    }
}