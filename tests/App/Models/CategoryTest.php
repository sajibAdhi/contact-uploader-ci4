<?php

namespace Tests\App\Models;

use App\Models\Category;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;
use ReflectionException;

class CategoryTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected Category $category;

    public function setUp(): void
    {
        parent::setUp();

        // Run migrations before each test
        $migrate = \Config\Services::migrations();
        $migrate->setNamespace('App');
        $migrate->latest();

        $this->category = new Category();
    }

    public function tearDown(): void
    {
        // Rollback migrations after each test
        $migrate = \Config\Services::migrations();
        $migrate->setNamespace('App');
        $migrate->regress();

        parent::tearDown();
    }

    public function categoryProvider(): array
    {
        return [
            ['Test Category1', 'Test Category1 Updated'],
            ['Test Category2', 'Test Category2 Updated'],
            ['Test Category3', 'Test Category3 Updated'],
        ];
    }

    /**
     * @dataProvider categoryProvider
     * @throws ReflectionException
     */
    public function testCreateCategory($name)
    {
        $lastCategoryId = $this->category->insert(['name' => $name]);

        $category = $this->category->find($lastCategoryId);

        $this->assertEquals($name, $category->name);

        $this->seeInDatabase('categories', ['id' => $lastCategoryId, 'name' => $name]);
    }

    /**
     * @dataProvider categoryProvider
     * @throws ReflectionException
     */
    public function testUpdateCategory($initialName, $updatedName)
    {
        // Insert the  category
        $lastCategoryId = $this->category->insert(['name' => $initialName]);

        $category = $this->category->find($lastCategoryId);

        $this->assertEquals($initialName, $category->name);

        // Update the category
        $this->category->update($lastCategoryId, ['name' => $updatedName]);

        // Find the updated category
        $updatedCategory = $this->category->find($lastCategoryId);

        // Assert the updated name
        $this->assertEquals($updatedName, $updatedCategory->name);

        // Assert database state
        $this->seeInDatabase('categories', ['id' => $lastCategoryId, 'name' => $updatedName]);
    }

    /**
     * @throws ReflectionException
     */
    public function testDeleteCategory()
    {
        $lastCategoryId = $this->category->insert(['name' => 'Test Category',]);

        $this->category->delete($lastCategoryId);

        $category = $this->category->find($lastCategoryId);

        $this->assertNull($category);
    }
}