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
    $routes->get('/', [ProductController::class, 'index'], ['as' => 'product']);
    $routes->get('create', [ProductController::class, 'create'], ['as' => 'product.create']);
    $routes->post('create', [ProductController::class, 'store']);
    $routes->get('(:any)/edit', [ProductController::class, 'edit/$1'], ['as' => 'product.edit']);
    $routes->put('(:any)/edit', [ProductController::class, 'update/$1']);
    $routes->delete('(:any)/delete', [ProductController::class, 'delete/$1'], ['as' => 'product.delete']);
});