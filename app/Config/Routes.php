<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');

$routes->get('/users', 'User::index');
$routes->get('/users/new', 'User::new');
$routes->post('/users/create', 'User::create');
$routes->get('/users/edit/(:num)', 'User::edit/$1');
$routes->post('/users/update/(:num)', 'User::update/$1');

$routes->get('/customers', 'Customer::index');
$routes->get('/customers/new', 'Customer::new');
$routes->post('/customers/create', 'Customer::create');
$routes->get('/customers/edit/(:num)', 'Customer::edit/$1');
$routes->post('/customers/update/(:num)', 'Customer::update/$1');