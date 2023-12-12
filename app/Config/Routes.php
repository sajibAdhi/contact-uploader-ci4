<?php

use App\Controllers\CategoryController;
use App\Controllers\CategoryUploadController;
use App\Controllers\ContactContentController;
use App\Controllers\ContactContentUploadController;
use App\Controllers\ContactController;
use App\Controllers\ContactUploadController;
use App\Filters\CategoryStoreFilter;
use App\Filters\ContactUploadFilter;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return redirect()->route('category.index');
});

$routes->group('categories', function ($routes) {
    $routes->get('/', [CategoryController::class, 'index'], ['as' => 'category.index']);
    $routes->post('/', [CategoryController::class, 'store'], ['as' => 'category.store', 'filter' => CategoryStoreFilter::class]);
    $routes->get('(:num)', [CategoryController::class, 'edit/$1'], ['as' => 'category.edit']);
    $routes->post('(:num)', [CategoryController::class, 'update/$1'], ['filter' => CategoryStoreFilter::class]);
});

$routes->group('contacts', function ($routes) {
    $routes->get('/', [ContactController::class, 'index'], ['as' => 'contact.index']);

    $routes->get('upload', [ContactUploadController::class, 'create'], ['as' => 'contact.upload']);
    $routes->post('upload', [ContactUploadController::class, 'store'], ['filter' => ContactUploadFilter::class]);
});

$routes->group('contacts/content', function ($routes) {
    $routes->get('/', [ContactContentController::class, 'index'], ['as' => 'contact.content.index']);

    $routes->get('upload', [ContactContentUploadController::class, 'create'], ['as' => 'contact.content.upload']);
    $routes->post('upload', [ContactContentUploadController::class, 'store'], ['filter' => ContactUploadFilter::class]);
});