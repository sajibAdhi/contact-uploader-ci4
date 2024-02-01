<?php

/**
 * @var RouteCollection $routes
 */



$routes->group('products', static function ($routes) {
    $routes->get('/', function () {
        return 'Products';
    });
});