<?php

/**
 * @var RouteCollection $routes
 */

use CodeIgniter\Router\RouteCollection;

$routes->group('', ['namespace' => 'Modules\Shield\Controllers'], function (RouteCollection $routes) {
    $routes->get('login', 'LoginController::loginView', ['as' => 'login']);
    $routes->post('login', 'LoginController::loginAction');
    $routes->get('logout', 'LoginController::logoutAction', ['as' => 'logout']);
    $routes->get('register', 'RegisterController::registerView', ['as' => 'register']);
    $routes->post('register', 'RegisterController::registerAction');
    $routes->get('forgot-password', 'ForgotPasswordController::forgotPasswordView', ['as' => 'forgot-password']);
    $routes->post('forgot-password', 'ForgotPasswordController::forgotPasswordAction');
    $routes->get('reset-password/(:any)', 'ResetPasswordController::resetPasswordView/$1', ['as' => 'reset-password']);
    $routes->post('reset-password/(:any)', 'ResetPasswordController::resetPasswordAction/$1');
    $routes->get('activate-account/(:any)', 'ActivateAccountController::activateAccountView/$1', ['as' => 'activate-account']);
    $routes->post('activate-account/(:any)', 'ActivateAccountController::activateAccountAction/$1');
    $routes->get('magic-link', 'MagicLinkController::loginView', ['as' => 'magic-link']);
    $routes->post('magic-link', 'MagicLinkController::loginAction');
    $routes->get('verify-magic-link', 'MagicLinkController::verify', ['as' => 'verify-magic-link']);
});