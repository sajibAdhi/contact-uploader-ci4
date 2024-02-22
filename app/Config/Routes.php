<?php

use App\Controllers\ImportCsvController;
use CodeIgniter\Router\RouteCollection;

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

$routes->get('/', static fn() => redirect()->to('operator_bills'), ['filter' => ['session']]);

$routes->group('sms_service', ['filter' => ['session']], static function ($routes) {

    $routes->get('/', static fn() => redirect()->to('sms_service/categories'));

    $routes->group('aggregators', static function ($routes) {
        $routes->get('/', [AggregatorController::class, 'index'], ['as' => 'sms_service.aggregator']);
        $routes->post('/', [AggregatorController::class, 'store'], ['as' => 'sms_service.aggregator.store']);
        $routes->get('(:num)', [AggregatorController::class, 'edit/$1'], ['as' => 'sms_service.aggregator.edit']);
        $routes->put('(:num)', [AggregatorController::class, 'update/$1']);
        $routes->delete('(:num)', [AggregatorController::class, 'delete/$1'], ['as' => 'sms_service.aggregator.delete']);
    });

    $routes->group('categories', static function ($routes) {
        $routes->get('/', [CategoryController::class, 'index'], ['as' => 'sms_service.category']);
        $routes->post('/', [CategoryController::class, 'store'], ['as' => 'sms_service.category.store']);
        $routes->get('(:num)', [CategoryController::class, 'edit/$1'], ['as' => 'sms_service.category.edit']);
        $routes->put('(:num)', [CategoryController::class, 'update/$1']);
        $routes->delete('(:num)', [CategoryController::class, 'delete/$1'], ['as' => 'sms_service.category.delete']);
    });

    $routes->group('import_csv', static function ($routes) {
        $routes->get('/', [ImportCsvController::class, 'index'], ['as' => 'sms_service.import_csv']);

        $routes->get('upload', [ImportCsvController::class, 'create'], ['as' => 'sms_service.import_csv.upload']);
        $routes->post('upload', [ImportCsvController::class, 'store']);

        $routes->get('progress', [ImportCsvController::class, 'progress'], ['as' => 'sms_service.import_csv.progress']);
    });

    $routes->group('settings', static function ($routes) {
        $routes->get('/', [SettingController::class, 'index'], ['as' => 'settings']);
        $routes->post('/', [SettingController::class, 'store']);
    });
});
