<?php

namespace Modules\Shield\Controllers\Admin;

use App\Controllers\BaseController;
use Modules\Shield\Traits\Viewable;

class UserController extends BaseController
{
    use Viewable;

    public function index(): string
    {
        return $this->view('Admin\Users\index');
    }

    public function create()
    {
        return view('Modules\Shield\Views\Admin\Users\create');
    }

    public function store()
    {
        return redirect()->route('users');
    }

    public function edit($id)
    {
        return view('Modules\Shield\Views\Admin\Users\edit');
    }

    public function update($id)
    {
        return redirect()->route('users');
    }

    public function delete($id)
    {
        return view('Modules\Shield\Views\Admin\Users\delete');
    }

    public function destroy($id)
    {
        return redirect()->route('users');
    }
}