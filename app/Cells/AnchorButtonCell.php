<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class AnchorButtonCell extends Cell
{
    public $href;

    public function edit(): string
    {
        return $this->view('anchor_button', [
            'title' => 'Edit',
            'icon' => 'fa fa-edit',
            'href' => $this->href,
        ]);
    }

    public function delete(): string
    {
        return $this->view('anchor_button', [
            'title' => 'Delete',
            'icon' => 'fa fa-trash',
            'onclick' => 'return confirm(\'Are you sure you want to delete this item?\')',
            'href' => $this->href,
        ]);
    }
}
