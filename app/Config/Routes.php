<?php

use App\Controllers\CategoryUploadController;
use App\Controllers\ContactContentController;
use App\Controllers\ContactContentUploadController;
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

$routes->group('contacts/content', function ($routes) {
    $routes->get('/', [ContactContentController::class, 'index'], ['as' => 'contact.content.index']);

    $routes->get('upload', [ContactContentUploadController::class, 'create'], ['as' => 'contact.content.upload']);
    $routes->post('upload', [ContactContentUploadController::class, 'store'], ['filter' => ContactUploadFilter::class]);
});