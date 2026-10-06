<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Inicio de la aplicación
$routes->get('/', static function () {
    return redirect()->to('/users');
});

// Listado de usuarios
$routes->get('/users', 'UserController::index');

// Formulario de alta
$routes->get('/users/create', 'UserController::create');

// Formulario de edición
$routes->get('/users/edit/(:num)', 'UserController::edit/$1');

// Crear usuario
$routes->post('/users/store', 'UserController::store');

// Actualizar usuario
$routes->post('/users/update/(:num)', 'UserController::update/$1');

// Eliminar usuario
$routes->post('/users/delete/(:num)', 'UserController::delete/$1');