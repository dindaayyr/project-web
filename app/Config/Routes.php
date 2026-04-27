<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Tambahkan ini di dalam file Routes.php
$routes->get('/', 'Admin\Travel::index'); 

// Atau jika ingin menggunakan prefix /admin
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin\Travel::index'); // Mengarahkan localhost:8080/admin/dashboard
});