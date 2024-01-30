<?php

namespace Modules\OperatorBill\Traits;

trait Viewable
{
    /**
     * @param string $view
     * @param array $data
     * @param array $options
     * @return string
     */
    protected function view(string $view, array $data = [], array $options = []): string
    {
        return view("Modules\\OperatorBill\\Views\\$view", $data, $options);
    }

}