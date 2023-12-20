<?php

namespace Tests\App\Features;

use CodeIgniter\HTTP\Exceptions\RedirectException;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;
use Exception;

/**
 * @internal
 */
final class CategoryFeatureTest extends CIUnitTestCase
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

    /**
     * @throws Exception
     * @throws RedirectException
     */
    public function testAllCategoryListShowingSuccessfully()
    {
        $result = $this->get('/categories');
        $result->assertStatus(200);
        $result->assertSee('Categories');
    }

    /**
     * @throws Exception
     * @throws RedirectException
     */
    public function testCategoryNameStoreSuccessfully()
    {
        $output = $this->post('/categories', [
            'category'   => 'Test Category',
            csrf_token() => csrf_hash(),
        ]);

        $this->assertTrue($output->isRedirect());

        // Assert that the session has the success message
        $this->assertSame('Category created successfully', session('success'));
    }

    /**
     * @throws Exception
     * @throws RedirectException
     */
    public function testCategoryEditViewSuccessfully()
    {
        $result = $this->get('/categories/1');
        $result->assertStatus(200);
        $result->assertSee('Edit Category');
    }

    /**
     * @throws Exception
     * @throws RedirectException
     * @todo test_category_name_update_successfully
     */
    public function testCategoryNameUpdateSuccessfully()
    {
        $output = $this->post('categories', [
            'category'   => 'Test Category',
            csrf_token() => csrf_hash(),
        ]);

        $this->assertTrue($output->isRedirect());

        // Assert that the session has the success message
        $this->assertSame('Category created successfully', session('success'));
    }

    /**
     * @throws Exception
     * @throws RedirectException
     * @todo test_category_is_deleted_successfully
     */
    //    public function test_category_is_deleted_successfully()
    //    {
    //        $output = $this->delete('/categories/1', [
    //            csrf_token() => csrf_hash()
    //        ]);
    //
    //        $this->assertTrue($output->isRedirect());
    //
    //        // Assert that the session has the success message
    //        $this->assertEquals('Category deleted successfully', session('success'));
    //    }
}
