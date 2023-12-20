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
        $this->label = $this->label ?? '';
        $this->id = $this->id ?? '';
        $this->name = $this->name ?? '';
        $this->defaultValue = $this->defaultValue ?? '';
        $this->type = $this->type ?? 'text';
        $this->placeholder = $this->placeholder ?? ' ';
        $this->required = $this->required ?? false;
    }
}
