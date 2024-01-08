<?php

namespace Tests\App\Features;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;

class BaseFeatureTestCase extends CIUnitTestCase
{
    use FeatureTestTrait;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        // run migrations off all namespaces
        $migration = Services::migrations();
        $migration->setNamespace('CodeIgniter\Shield')->latest();
        $migration->setNamespace('CodeIgniter\Settings')->latest();
        $migration->setNamespace('App')->latest();

    }

    public static function tearDownAfterClass(): void
    {
        // setup migrations
        $migration = Services::migrations();
        $migration->regress();

        parent::tearDownAfterClass();
    }

    public function testBaseFeatureTestCaseClassIsWorking()
    {
        $this->assertTrue(true);
    }
}
