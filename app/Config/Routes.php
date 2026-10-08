<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public login routes
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');

// Logout route
$routes->get('logout', 'Auth::logout');

// Protected customer routes
$routes->group(
    'customers',
    ['filter' => 'auth'],
    static function ($routes) {
        $routes->get('/', 'Customer::index');
        $routes->get('new', 'Customer::new');
        $routes->post('create', 'Customer::create');
        $routes->get('edit/(:num)', 'Customer::edit/$1');
        $routes->post('update/(:num)', 'Customer::update/$1');
    }
);

// Protected user routes
$routes->group(
    'users',
    ['filter' => 'auth'],
    static function ($routes) {
        $routes->get('/', 'User::index');
        $routes->get('new', 'User::new');
        $routes->post('create', 'User::create');
        $routes->get('edit/(:num)', 'User::edit/$1');
        $routes->post('update/(:num)', 'User::update/$1');
    }
);