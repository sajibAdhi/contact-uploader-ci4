<?php

namespace Tests\App\Features;

use CodeIgniter\HTTP\Exceptions\RedirectException;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Config\Services;
use Exception;

class CategoryFeatureTest extends CIUnitTestCase
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
     * @throws RedirectException
     * @throws Exception
     */
    public function test_all_category_list_showing_successfully()
    {
        $result = $this->get('/categories');
        $result->assertStatus(200);
        $result->assertSee('Categories');
    }

    /**
     * @throws RedirectException
     * @throws Exception
     */
    public function test_category_name_store_successfully()
    {
        $output = $this->post('/categories', [
            'category' => 'Test Category',
            csrf_token() => csrf_hash()
        ]);

        $this->assertTrue($output->isRedirect());

        // Assert that the session has the success message
        $this->assertEquals('Category created successfully', session('success'));
    }

    /**
     * @throws RedirectException
     * @throws Exception
     */
    public function test_category_edit_view_successfully()
    {
        $result = $this->get('/categories/1');
        $result->assertStatus(200);
        $result->assertSee('Edit Category');
    }

    /**
     * @throws RedirectException
     * @throws Exception
     * @todo test_category_name_update_successfully
     */
    public function test_category_name_update_successfully()
    {
        $output = $this->post('categories', [
            'category' => 'Test Category',
            csrf_token() => csrf_hash()
        ]);

        $this->assertTrue($output->isRedirect());

        // Assert that the session has the success message
        $this->assertEquals('Category created successfully', session('success'));
    }

    /**
     * @throws RedirectException
     * @throws Exception
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