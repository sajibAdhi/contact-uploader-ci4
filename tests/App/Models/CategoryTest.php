<?php

namespace Tests\App\Models;

use App\Models\Category;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use ReflectionException;

/**
 * @internal
 */
final class CategoryTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        // Run migrations before each test
        $migrate = \Config\Services::migrations();
        $migrate->setNamespace('App');
        $migrate->latest();

        $this->category = new Category();
    }

    protected function tearDown(): void
    {
        // Rollback migrations after each test
        $migrate = \Config\Services::migrations();
        $migrate->setNamespace('App');
        $migrate->regress();

        parent::tearDown();
    }

    public static function categoryProvider(): iterable
    {
        return [
            ['Test Category1', 'Test Category1 Updated'],
            ['Test Category2', 'Test Category2 Updated'],
            ['Test Category3', 'Test Category3 Updated'],
        ];
    }

    /**
     * @dataProvider categoryProvider
     *
     * @param mixed $name
     *
     * @throws ReflectionException
     */
    public function testCategoryModelInsertSuccessfully($name)
    {
        $lastCategoryId = $this->category->insert(['name' => $name]);

        $category = $this->category->find($lastCategoryId);

        $this->assertSame($name, $category->name);

        $this->seeInDatabase('categories', ['id' => $lastCategoryId, 'name' => $name]);
    }

    /**
     * @dataProvider categoryProvider
     *
     * @param mixed $initialName
     * @param mixed $updatedName
     *
     * @throws ReflectionException
     */
    public function testCategoryModelUpdateSuccessfully($initialName, $updatedName)
    {
        // Insert the  category
        $lastCategoryId = $this->category->insert(['name' => $initialName]);

        $category = $this->category->find($lastCategoryId);

        $this->assertSame($initialName, $category->name);

        // Update the category
        $this->category->update($lastCategoryId, ['name' => $updatedName]);

        // Find the updated category
        $updatedCategory = $this->category->find($lastCategoryId);

        // Assert the updated name
        $this->assertSame($updatedName, $updatedCategory->name);

        // Assert database state
        $this->seeInDatabase('categories', ['id' => $lastCategoryId, 'name' => $updatedName]);
    }

    /**
     * @throws ReflectionException
     */
    public function testCategoryModelDeleteSuccessfully()
    {
        $lastCategoryId = $this->category->insert(['name' => 'Test Category']);

        $this->category->delete($lastCategoryId);

        $category = $this->category->find($lastCategoryId);

        $this->assertNull($category);
    }
}
