<?php

namespace Tests\App\Features;

use CodeIgniter\HTTP\Exceptions\RedirectException;
use Exception;
use Tests\Support\Features\BaseFeatureTestCase;

class CategoryFeatureTest extends BaseFeatureTestCase
{
    /**
     * @throws Exception
     * @throws RedirectException
     */
    public function testCategoryListShowingSuccessfully()
    {
        // request as user
        $result = $this->withUser()->get('/categories');
        dd($result->response()->getBody());
        $result->assertSee('Categories');
    }

    /**
     * @throws Exception
     * @throws RedirectException
     */
    public function testCategoryNameStoreSuccessfullyWithValidData()
    {
        $category = 'Test Category1';
        $result = $this->post('/categories', [
            'category' => $category,
            csrf_token() => csrf_hash(),
        ]);

        $result->assertOK();
        $result->assertRedirect();
        $result->assertSessionHas('success', 'Category created successfully');
        $result->assertSessionMissing('error');
        $result->assertSessionMissing('_ci_validation_errors');
    }

    /**
     * @throws Exception
     * @throws RedirectException
     */
    public function testCategoryNameStoreFailedWithDuplicateData()
    {
        $result = $this->post('/categories', [
            'category' => 'Test Category1',
            csrf_token() => csrf_hash(),
        ]);

        $result->assertOK();
        $result->assertRedirect();
        $result->assertSessionHas('error', 'Invalid Form Data');
        $result->assertSessionHas('_ci_validation_errors');
    }

    /**
     * @throws Exception
     * @throws RedirectException
     */
    public function testCategoryEditViewSuccessfully()
    {
        $result = $this->get('/categories/1');

        $result->assertSee('Edit Category');
        $result->assertSee('Test Category1');
        $result->assertSee('Update');
    }

    /**
     * @throws Exception
     * @throws RedirectException
     * @todo testCategoryNameUpdateSuccessfully
     */
    //    public function testCategoryNameUpdateSuccessfully()
    //    {
    //        $category = 'Updated Test Category1';
    //        $result = $this->put('categories/1', [
    //            'category' => $category,
    //            csrf_token() => csrf_hash(),
    //        ]);
    //
    //        $result->assertOK();
    //        $result->assertRedirect();
    //        $result->assertSessionHas('success', 'Category updated successfully');
    //    }

    /**
     * @throws Exception
     * @throws RedirectException
     * @todo testCategoryIsDeletedSuccessfully
     */
    //    public function testCategoryIsDeletedSuccessfully()
    //    {
    //        $result = $this->delete('/categories/1', [
    //            '_method' => 'DELETE',
    //            csrf_token() => csrf_hash(),
    //        ]);
    //
    //        $result->assertOK();
    //        $result->assertRedirect();
    //        $result->assertSessionHas('error', 'Category deleted successfully');
    //    }
}
