<?php

namespace Tests\App\Features;

use CodeIgniter\HTTP\Exceptions\RedirectException;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use Exception;

class CategoryFeatureTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function setUp(): void
    {
        parent::setUp();
        // Additional setup code here
    }

    public function tearDown(): void
    {
        // Cleanup code here
        parent::tearDown();
    }

    /**
     * @throws RedirectException
     * @throws Exception
     */
    public function testIndex()
    {
        $result = $this->get('/category/index');
        $result->assertStatus(200);
        $result->assertSee('Categories');
    }

    /**
     * @throws RedirectException
     * @throws Exception
     */
    public function testStore()
    {
        $params = [
            'category' => 'Test Category'
        ];
        $result = $this->post('/category/store', $params);

        $result->assertRedirect();
    }

    /**
     * @throws RedirectException
     * @throws Exception
     */
    public function testEdit()
    {
        $result = $this->get('/category/edit/1');
        $result->assertStatus(200);
        $result->assertSee('Edit Category');
    }

    /**
     * @throws RedirectException
     * @throws Exception
     */
    public function testUpdate()
    {
        $params = [
            'category' => 'Updated Category'
        ];
        $result = $this->post('/category/update/1', $params);
        $result->assertRedirect();
    }

    /**
     * @throws RedirectException
     * @throws Exception
     */
    public function testDelete()
    {
        $result = $this->post('/category/delete/1');
        $result->assertRedirect();
    }
}