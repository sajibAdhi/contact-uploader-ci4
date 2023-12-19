<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\ControllerTestTrait;

class CategoryControllerTest extends BaseControllerTest
{
    public function test_index_method_return_ok_response()
    {
        $response = $this->controller('App\Controllers\CategoryController')
            ->execute('index');

        $this->assertTrue($response->isOK());
        $this->assertTrue($response->see('Categories'));
    }

    // Add similar methods to test other actions of the controller
}