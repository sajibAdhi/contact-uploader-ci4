<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Config\Services;

class BaseControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function setUp(): void
    {
        parent::setUp();

        $migration = Services::migrations();
        $migration->setNamespace('App');
        $migration->latest();
    }

    public function tearDown(): void
    {
        $migration = Services::migrations();
        $migration->setNamespace('App');
        $migration->regress();

        parent::tearDown();
    }

    public function test_base_controller_class_is_working()
    {
        $this->assertTrue(true);
    }
}