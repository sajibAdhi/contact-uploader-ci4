<?php

namespace App\Features;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Database;
use Config\Services;

class BaseFeatureTestCase extends CIUnitTestCase
{
    use FeatureTestTrait;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        // setup migrations
        $migration = Services::migrations();
        $migration->setNamespace('App');
        $migration->latest();
    }

    public static function tearDownAfterClass(): void
    {
        // setup migrations
        $migration = Services::migrations();
        $migration->setNamespace('App');
        $migration->regress();

        parent::tearDownAfterClass();
    }

    public function test_base_feature_test_case_class_is_working()
    {
        $this->assertTrue(true);
    }
}