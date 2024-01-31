<?php

/**
 * @var RouteCollection $routes
 */

use CodeIgniter\Router\RouteCollection;
use Modules\Shield\Controllers\LoginController;


$routes->group('', function (RouteCollection $routes) {
    $routes->get('login', [LoginController::class, 'loginView'], ['as' => 'login']);
    $routes->post('login', [LoginController::class, 'loginAction']);

//    $routes->get('register', 'RegisterController::registerView', ['as' => 'register']);
//    $routes->post('register', 'RegisterController::registerAction');
//    $routes->get('forgot-password', 'ForgotPasswordController::forgotPasswordView', ['as' => 'forgot-password']);
//    $routes->post('forgot-password', 'ForgotPasswordController::forgotPasswordAction');
//    $routes->get('reset-password/(:any)', 'ResetPasswordController::resetPasswordView/$1', ['as' => 'reset-password']);
//    $routes->post('reset-password/(:any)', 'ResetPasswordController::resetPasswordAction/$1');
//    $routes->get('activate-account/(:any)', 'ActivateAccountController::activateAccountView/$1', ['as' => 'activate-account']);
//    $routes->post('activate-account/(:any)', 'ActivateAccountController::activateAccountAction/$1');
//    $routes->get('magic-link', 'MagicLinkController::loginView', ['as' => 'magic-link']);
//    $routes->post('magic-link', 'MagicLinkController::loginAction');
//    $routes->get('verify-magic-link', 'MagicLinkController::verify', ['as' => 'verify-magic-link']);

    $routes->group('', ['filter' => 'session'], function (RouteCollection $routes) {
        $routes->get('logout', [LoginController::class, 'logoutAction'], ['as' => 'logout']);

        // admin can manage users
        $routes->group('shield', function (RouteCollection $routes) {
            $routes->get('users', 'Admin\UserController::index', ['as' => 'shield.admin.users']);
            $routes->get('users/create', 'Admin\UserController::create', ['as' => 'users-create']);
            $routes->post('users/create', 'Admin\UserController::store');
            $routes->get('users/edit/(:any)', 'Admin\UserController::edit/$1', ['as' => 'users-edit']);
            $routes->post('users/edit/(:any)', 'Admin\UserController::update/$1');
            $routes->get('users/delete/(:any)', 'Admin\UserController::delete/$1', ['as' => 'users-delete']);
            $routes->post('users/delete/(:any)', 'Admin\UserController::destroy/$1');
        });
    });
});