<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ===== PUBLIC ROUTES =====
$routes->get('/', 'LandingController::index');
$routes->get('/katalog', 'KatalogController::index');
$routes->get('/katalog/detail/(:num)', 'KatalogController::detail/$1');

// ===== AUTH ROUTES =====
$routes->get('/login', 'AuthController::showLogin');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::showRegister');
$routes->post('/register', 'AuthController::register');
$routes->get('/logout', 'AuthController::logout');

// ===== USER DASHBOARD (Protected) =====
$routes->group('user', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'User\DashboardController::index');
    $routes->get('bookings', 'User\DashboardController::bookings');
    $routes->get('documents', 'User\DashboardController::documents');
    $routes->get('payments', 'User\DashboardController::payments');
});

// ===== API =====
$routes->post('/api/ai/search', 'Api\AiController::search');

// ===== ADMIN ROUTES =====
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin\Travel::index');
    $routes->get('travel', 'Admin\Travel::index');
});