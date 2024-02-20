<?php

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

    $routes->get('/', static function () {
        return redirect()->to('contacts');
    });

    $routes->group('aggregators', static function ($routes) {
        $routes->get('/', [AggregatorController::class, 'index'], ['as' => 'sms_service.aggregator']);
        $routes->post('/', [AggregatorController::class, 'store'], ['as' => 'sms_service.aggregator.store']);
        $routes->get('(:num)', [AggregatorController::class, 'edit/$1'], ['as' => 'sms_service.aggregator.edit']);
        $routes->put('(:num)', [AggregatorController::class, 'update/$1']);
        $routes->delete('(:num)', [AggregatorController::class, 'delete/$1'], ['as' => 'sms_service.aggregator.delete']);
    });

    $routes->group('categories', static function ($routes) {
        $routes->get('/', [CategoryController::class, 'index'], ['as' => 'sms_service.category']);
        $routes->post('/', [CategoryController::class, 'store'], ['as' => 'sms_service.category.store', 'filter' => CategoryStoreFilter::class]);
        $routes->get('(:num)', [CategoryController::class, 'edit/$1'], ['as' => 'sms_service.category.edit']);
        $routes->put('(:num)', [CategoryController::class, 'update/$1'], ['filter' => CategoryStoreFilter::class]);
        $routes->delete('(:num)', [CategoryController::class, 'delete/$1'], ['as' => 'sms_service.category.delete']);
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

    $routes->group('import_csv', static function ($routes) {
        $routes->get('/', [ContactContentController::class, 'index'], ['as' => 'sms_service.import_csv']);

        $routes->get('upload', [ContactContentController::class, 'create'], ['as' => 'sms_service.import_csv.upload']);
        $routes->post('upload', [ContactContentController::class, 'store'], ['filter' => ContactContentUploadFilter::class]);

        $routes->get('progress', [ContactContentController::class, 'progress'], ['as' => 'sms_service.import_csv.progress']);
    });

    $routes->group('settings', static function ($routes) {
        $routes->get('/', [SettingController::class, 'index'], ['as' => 'settings']);
        $routes->post('/', [SettingController::class, 'store']);
    });
});
