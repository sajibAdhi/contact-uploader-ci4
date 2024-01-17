<?php

/**
 * @var RouteCollection $routes
 */

use OperatorBill\Controllers\OperatorController;
use OperatorBill\Controllers\OperatorBillController;

$routes->group('operator_bills', static function ($routes) {
    $routes->get('/', [OperatorBillController::class, 'index'], ['as' => 'operator_bill.index']);
    $routes->get('create', [OperatorBillController::class, 'create'], ['as' => 'operator_bill.create']);
    $routes->post('create', [OperatorBillController::class, 'store']);

    $routes->group('operators', static function ($routes) {
        $routes->get('/', [OperatorController::class, 'index'], ['as' => 'operator_bill.operator.index']);
        $routes->get('create', [OperatorController::class, 'create'], ['as' => 'operator_bill.operator.upload']);
        $routes->post('create', [OperatorController::class, 'store']);
        $routes->get('edit/(:num)', [OperatorController::class, 'edit'], ['as' => 'operator_bill.operator.edit']);
        $routes->post('edit/(:num)', [OperatorController::class, 'update']);
    });
});