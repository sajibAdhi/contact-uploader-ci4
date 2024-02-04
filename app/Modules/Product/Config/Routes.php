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
    $routes->get('/', [ProductController::class, 'index'], ['as' => 'products']);
    $routes->get('create', [ProductController::class, 'create'], ['as' => 'products.create']);
    $routes->post('create', [ProductController::class, 'store']);
    $routes->get('(:num)/edit', [ProductController::class, 'edit'], ['as' => 'products.edit']);
    $routes->post('(:num)/edit', [ProductController::class, 'update']);
    $routes->get('(:num)/delete', [ProductController::class, 'delete'], ['as' => 'products.delete']);


});