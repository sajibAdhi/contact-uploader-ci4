<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class InputFieldCell extends Cell
{
    public $label;
    public $id;
    public $name;
    public $defaultValue;
    public $type;
    public $placeholder;
    public $required;

    public function mount()
    {
        $this->label ??= '';
        $this->id ??= '';
        $this->name ??= '';
        $this->defaultValue ??= '';
        $this->type ??= 'text';
        $this->placeholder ??= ' ';
        $this->required ??= false;
    }
}
