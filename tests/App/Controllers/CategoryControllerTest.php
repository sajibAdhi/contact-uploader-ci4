<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\ControllerTestTrait;

class CategoryControllerTest extends BaseControllerTest
{
    public function testIndexMethod()
    {
        $result = $this->controller('App\Controllers\CategoryController')
            ->execute('index');
        $this->assertTrue($result->isOK());
        $this->assertTrue($result->see('Categories'));
    }

    // Add similar methods to test other actions of the controller
}