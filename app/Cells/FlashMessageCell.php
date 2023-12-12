<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
use function PHPUnit\Framework\matches;

class FlashMessageCell extends Cell
{
    public $type;
    public $message;

    public function mount()
    {
        if (session()->getFlashdata('success')) {
            $this->type = 'success';
            $this->message = session()->getFlashdata('success');
        } elseif (session()->getFlashdata('error')) {
            $this->type = 'danger';
            $this->message = session()->getFlashdata('error');
        } elseif (session()->getFlashdata('warning')) {
            $this->type = 'warning';
            $this->message = session()->getFlashdata('warning');
        }
    }
}
