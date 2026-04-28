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

// ===== USER / JAMAAH DASHBOARD (Protected) =====
$routes->group('user', ['filter' => 'role:jamaah'], function($routes) {
    $routes->get('dashboard', 'User\DashboardController::index');
    $routes->get('bookings', 'User\DashboardController::bookings');
    $routes->get('documents', 'User\DashboardController::documents');
    $routes->get('payments', 'User\DashboardController::payments');
});

// ===== AGENT ROUTES =====
$routes->group('agent', ['filter' => 'role:agent'], function($routes) {
    $routes->get('dashboard', 'Agent\DashboardController::index');
    $routes->get('packages', 'Agent\PackageController::index');
    $routes->get('packages/create', 'Agent\PackageController::create');
    $routes->post('packages/store', 'Agent\PackageController::store');
    $routes->get('packages/edit/(:num)', 'Agent\PackageController::edit/$1');
    $routes->post('packages/update/(:num)', 'Agent\PackageController::update/$1');
    $routes->get('packages/delete/(:num)', 'Agent\PackageController::delete/$1');
    $routes->get('bookings', 'Agent\DashboardController::bookings');
    $routes->get('disbursements', 'Agent\DashboardController::disbursements');
});

// ===== FINANCE ROUTES =====
$routes->group('finance', ['filter' => 'role:finance'], function($routes) {
    $routes->get('dashboard', 'Finance\DashboardController::index');
    $routes->get('transactions', 'Finance\DashboardController::transactions');
    $routes->get('disbursements', 'Finance\DisbursementController::index');
    $routes->post('disbursements/process/(:num)', 'Finance\DisbursementController::process/$1');
});

// ===== SUPER ADMIN ROUTES =====
$routes->group('superadmin', ['filter' => 'role:superadmin'], function($routes) {
    $routes->get('dashboard', 'SuperAdmin\DashboardController::index');
    $routes->get('agents', 'SuperAdmin\DashboardController::agents');
    $routes->get('packages', 'SuperAdmin\DashboardController::packages');
    $routes->get('ai-config', 'SuperAdmin\DashboardController::aiConfig');
    $routes->post('ai-config/save', 'SuperAdmin\DashboardController::saveAiConfig');
});

// ===== LEGACY ADMIN REDIRECT =====
$routes->get('admin/dashboard', function() {
    return redirect()->to('/superadmin/dashboard');
});
$routes->get('admin/travel', function() {
    return redirect()->to('/superadmin/agents');
});

// ===== API =====
$routes->post('/api/ai/search', 'Api\AiController::search');
$routes->post('/api/ai/search-nlp', 'Api\AiController::searchNLP');
$routes->post('/api/midtrans/webhook', 'Api\MidtransWebhook::handle');