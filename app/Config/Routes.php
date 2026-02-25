<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->post('login', 'AuthController::login');

$routes->group('mahasiswa', ['filter' => 'jwt'], function($routes) {
    $routes->get('/', 'MahasiswaController::index');
    $routes->get('(:num)', 'MahasiswaController::show/$1');
    $routes->post('/', 'MahasiswaController::create');
    $routes->put('(:num)', 'MahasiswaController::update/$1');
    $routes->delete('(:num)', 'MahasiswaController::delete/$1');
});