<?php

use App\Controllers\ContactController;
use App\Controllers\ImportDataController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

use App\Controllers\AggregatorController;
use App\Controllers\CategoryController;
use App\Controllers\SettingController;

$routes->get('/', static fn() => redirect('sms_service.import_data'), ['filter' => ['session']]);

$routes->group('sms_service', ['filter' => ['session']], static function ($routes) {


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

    $routes->group('contacts', static function ($routes) {
        $routes->get('/', [ContactController::class, 'index'], ['as' => 'sms_service.contact']);
    });

    // host/sms_service/import_data
    $routes->group('import_data', static function ($routes) {
        // host/sms_service/import_data
        $routes->get('/', [ImportDataController::class, 'index'], ['as' => 'sms_service.import_data']);
        // host/sms_service/import_data/fetch_data/1
        $routes->get('fetch_data/(:num)', [ImportDataController::class, 'fetchData/$1'], ['as' => 'sms_service.import_data.fetch_data']);

        $routes->get('upload', [ImportDataController::class, 'create'], ['as' => 'sms_service.import_data.upload']);
        $routes->post('upload_file', [ImportDataController::class, 'uploadFile'], ['as' => 'sms_service.import_data.upload_file']);
        $routes->post('store_data', [ImportDataController::class, 'storeFileData'], ['as' => 'sms_service.import_data.store_data']);
        $routes->get('progress', [ImportDataController::class, 'progress'], ['as' => 'sms_service.import_data.progress']);


        $routes->get('progress', [ImportDataController::class, 'progress'], ['as' => 'sms_service.import_data.progress']);
        $routes->get('status', [ImportDataController::class, 'uploadStatus'], ['as' => 'sms_service.import_data.status']);
    });

    $routes->group('settings', static function ($routes) {
        $routes->get('/', [SettingController::class, 'index'], ['as' => 'settings']);
        $routes->post('/', [SettingController::class, 'store']);
    });
});
