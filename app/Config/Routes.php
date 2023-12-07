<?php

use App\Controllers\CategoryUploadController;
use App\Controllers\ContactController;
use App\Controllers\ContactUploadController;
use App\Filters\ContactUploadFilter;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', [ContactUploadController::class, 'create']);

$routes->group('categories', function ($routes) {
    $routes->get('upload', [CategoryUploadController::class, 'create'], ['as' => 'category.upload']);
    $routes->post('upload', [CategoryUploadController::class, 'store']);
});

$routes->group('contacts', function ($routes) {
    $routes->get('/', [ContactController::class, 'index'], ['as' => 'contact.index']);

    $routes->get('upload', [ContactUploadController::class, 'create'], ['as' => 'contact.upload']);
    $routes->post('upload', [ContactUploadController::class, 'store'], ['filter' => ContactUploadFilter::class]);
});
