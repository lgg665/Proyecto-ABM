<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/users', 'UserController::index');

$routes->get('/users/create', 'UserController::create');

$routes->get('/users/edit/(:num)', 'UserController::edit/$1');

$routes->post('/users/store', 'UserController::store');

$routes->post('/users/update/(:num)', 'UserController::update/$1');

$routes->post('/users/delete/(:num)', 'UserController::delete/$1');