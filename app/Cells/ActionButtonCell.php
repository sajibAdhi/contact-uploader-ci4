<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class ActionButtonCell extends Cell
{
    public $title;
    public $href;
    public $class;

    public function show(): string
    {
        return $this->view('action_button', [
            'title' => $this->title ?? '',
            'icon' => 'fa fa-eye',
            'href' => $this->href,
            'class' => $this->class ?? 'btn-primary',
        ]);
    }

    public function edit(): string
    {
        return $this->view('action_button', [
            'title' => $this->title ?? '',
            'icon' => 'fa fa-edit',
            'href' => $this->href,
            'class' => $this->class ?? 'btn-warning',
        ]);
    }

    public function delete(): string
    {
        return $this->view('action_button', [
            'title' => $this->title ?? '',
            'icon' => 'fa fa-trash',
            'onclick' => 'return confirm(\'Are you sure you want to delete this item?\')',
            'href' => $this->href,
            'class' => $this->class ?? 'btn-danger',
        ]);
    }
}
