<?php

namespace Tests\App\Features;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;

/**
 * @internal
 */
final class BaseFeatureTestCase extends CIUnitTestCase
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

    public function testBaseFeatureTestCaseClassIsWorking()
    {
        $this->assertTrue(true);
    }
}
