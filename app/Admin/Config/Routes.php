<?php

namespace Admin\Config;

use Config\Services;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('admin', ['namespace' => 'Admin\Controllers'], function ($routes) {
  $routes->presenter('users', ['controller' => 'User']);

  $routes->group('api', ['namespace' => 'Admin\Controllers\Api'], function ($routes) {
    $routes->resource('users', ['controller' => 'User']);
  });
});

$routes->group('admin', ['namespace' => 'Admin\Controllers\Auth'], function ($routes) {
  $routes->get('login', 'Login::login');
});
