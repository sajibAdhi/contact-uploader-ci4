<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\CategoryUploadController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('categories/upload', [CategoryUploadController::class,'create'],['as'=>'category.upload']);
$routes->post('categories/upload', [CategoryUploadController::class,'store']);
