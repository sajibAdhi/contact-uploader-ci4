<?php

namespace Tests\Support\Features;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;

class BaseFeatureTestCase extends CIUnitTestCase
{
    use FeatureTestTrait;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        // run migrations
        $migration = Services::migrations();
        $migration->setNamespace('CodeIgniter\Shield')->latest();
        $migration->setNamespace('CodeIgniter\Settings')->latest();
        $migration->setNamespace('App')->latest();

        // run seeds
        dd(Services::seed());
        $seeder = DB:seeder();
        $seeder->setNamespace('App')->call('UserSeeder');

        // insert data using factories
        $seeder->setNamespace('App')->call('CategorySeeder');
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
