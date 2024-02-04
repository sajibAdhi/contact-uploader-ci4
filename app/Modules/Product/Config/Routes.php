<?php

use App\Modules\Product\Controllers\ProductController;
use CodeIgniter\Router\RouteCollection;

/**
 * Product Routes
 * product group routes contains all routes related to product module
 *
 * @var RouteCollection $routes
 */
$routes->group('products', static function ($routes) {
    $routes->get('/', [ProductController::class,'index'], ['as' => 'products']);
    $routes->get('create', [ProductController::class,'create'], ['as' => 'products.create']);
    $routes->post('store', [ProductController::class,'store'], ['as' => 'products.store']);
    $routes->get('edit/(:num)', [ProductController::class,'edit'], ['as' => 'products.edit']);
    $routes->post('update/(:num)', [ProductController::class,'update'], ['as' => 'products.update']);
    $routes->get('delete/(:num)', [ProductController::class,'delete'], ['as' => 'products.delete']);


});