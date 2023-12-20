<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class FormSubmitCell extends Cell
{
    public $title;

    public function mount()
    {
        $this->title ??= 'Submit';
    }
}
