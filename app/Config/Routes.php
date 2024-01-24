<?php

/**
 * @var RouteCollection $routes
 */

use App\Controllers\AggregatorController;
use App\Controllers\CategoryController;
use App\Controllers\ContactContentController;
use App\Controllers\ContactController;
use App\Controllers\ContactUploadController;
use App\Controllers\SettingController;
use App\Filters\CategoryStoreFilter;
use App\Filters\ContactContentUploadFilter;

$routes->get('/', static fn() => redirect()->to('operator_bills'));

$routes->group('aggregators', static function ($routes) {
    $routes->get('/', [AggregatorController::class, 'index'], ['as' => 'aggregator.index']);
    $routes->post('/', [AggregatorController::class, 'store'], ['as' => 'aggregator.store']);
    $routes->get('(:num)', [AggregatorController::class, 'edit/$1'], ['as' => 'aggregator.edit']);
    $routes->put('(:num)', [AggregatorController::class, 'update/$1']);
    $routes->delete('(:num)', [AggregatorController::class, 'delete/$1'], ['as' => 'aggregator.delete']);
});

$routes->group('categories', static function ($routes) {
    $routes->get('/', [CategoryController::class, 'index'], ['as' => 'category.index']);
    $routes->post('/', [CategoryController::class, 'store'], ['as' => 'category.store', 'filter' => CategoryStoreFilter::class]);
    $routes->get('(:num)', [CategoryController::class, 'edit/$1'], ['as' => 'category.edit']);
    $routes->put('(:num)', [CategoryController::class, 'update/$1'], ['filter' => CategoryStoreFilter::class]);
    $routes->delete('(:num)', [CategoryController::class, 'delete/$1'], ['as' => 'category.delete']);
});

$routes->group('contacts', static function ($routes) {
    $routes->get('/', [ContactController::class, 'index'], ['as' => 'contact.index']);

    $routes->get('upload', [ContactUploadController::class, 'create'], ['as' => 'contact.upload']);
    $routes->post('upload', [ContactUploadController::class, 'store'], ['filter' => ContactContentUploadFilter::class]);
});

$routes->group('contacts/content', static function ($routes) {
    $routes->get('/', [ContactContentController::class, 'index'], ['as' => 'contact.content.index']);

    $routes->get('upload', [ContactContentController::class, 'create'], ['as' => 'contact.content.upload']);
    $routes->post('upload', [ContactContentController::class, 'store'], ['filter' => ContactContentUploadFilter::class]);

    $routes->get('progress', [ContactContentController::class, 'progress'], ['as' => 'contact.content.progress']);
});

$routes->group('settings', static function ($routes) {
    $routes->get('/', [SettingController::class, 'index'], ['as' => 'settings']);
    $routes->post('/', [SettingController::class, 'store']);
});

/** text/adminlte3 */
$routes->get('test/adminlte3', static fn() => view('test/adminlte3'), ['as' => 'adminlte3.index']);
