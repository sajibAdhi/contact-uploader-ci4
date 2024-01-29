<?php

/**
 * @var RouteCollection $routes
 */


use Modules\OperatorBill\Controllers\OperatorBillController;
use Modules\OperatorBill\Controllers\OperatorController;

$routes->group('operator_bills', static function ($routes) {
    $routes->get('/', [OperatorBillController::class, 'index'], ['as' => 'operator_bill.index']);
    $routes->get('create', [OperatorBillController::class, 'create'], ['as' => 'operator_bill.create']);
    $routes->post('create', [OperatorBillController::class, 'store']);
    $routes->get('(:num)', [OperatorBillController::class, 'show/$1'], ['as' => 'operator_bill.show']);
    $routes->get('(:num)/edit', [OperatorBillController::class, 'edit'], ['as' => 'operator_bill.edit']);
    $routes->post('(:num)/edit', [OperatorBillController::class, 'update']);

    $routes->group('operators', static function ($routes) {
        $routes->get('/', [OperatorController::class, 'index'], ['as' => 'operator_bill.operator.index']);
        $routes->get('test', [OperatorController::class, 'test']);
        $routes->get('create', [OperatorController::class, 'create'], ['as' => 'operator_bill.operator.create']);
        $routes->post('create', [OperatorController::class, 'store']);
        $routes->get('(:num)/edit', [OperatorController::class, 'edit'], ['as' => 'operator_bill.operator.edit']);
        $routes->post('(:num)/edit', [OperatorController::class, 'update']);
        $routes->get('(:num)/delete', [OperatorController::class, 'delete'], ['as' => 'operator_bill.operator.delete']);

        $routes->get('get_operators', [OperatorBillController::class, 'ajaxGet'], ['as' => 'operator_bill.operator.get_operators']);
    });

});