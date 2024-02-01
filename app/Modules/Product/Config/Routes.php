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
    $routes->get('/', [ProductController::class,'index']);
    $routes->get('create', [ProductController::class,'create']);
    $routes->post('store', [ProductController::class,'store']);
    $routes->get('edit/(:num)', [ProductController::class,'edit']);
    $routes->post('update/(:num)', [ProductController::class,'update']);
    $routes->get('delete/(:num)', [ProductController::class,'delete']);


});