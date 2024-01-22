<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class FormDeleteButtonCell extends Cell
{
    public $buttonTitle;
    public $icon;
    public $action;

    public function mount()
    {
        $this->buttonTitle ??= '';
        $this->icon ??= 'fa fa-trash';
    }
}
