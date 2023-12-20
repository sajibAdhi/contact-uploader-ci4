<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class DateInputFieldCell extends Cell
{
    public $label;
    public $id;
    public $name;
    public $defaultValue;
    public $placeholder;

    public function mount()
    {
        $this->label ??= '';
        $this->id ??= '';
        $this->name ??= '';
        $this->defaultValue ??= '';
        $this->placeholder ??= 'mm/dd/yyyy';
    }
}
