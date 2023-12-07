<?php

use App\Controllers\CategoryUploadController;
use App\Controllers\ContactUploadController;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', [ContactUploadController::class,'create'],['as'=>'contact.upload']);

$routes->group('categories', function ($routes){
    $routes->get('upload', [CategoryUploadController::class,'create'],['as'=>'category.upload']);
    $routes->post('upload', [CategoryUploadController::class,'store']);
});

$routes->group('contacts', function ($routes){
    $routes->get('upload', [ContactUploadController::class,'create'],['as'=>'contact.upload']);
    $routes->post('upload', [ContactUploadController::class,'store']);
});
