<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// ===== AUTHENTICATION =====
$routes->get('/login', 'AuthController::showLogin');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::showRegister');
$routes->post('/register', 'AuthController::register');
$routes->get('/register-agent', 'AuthController::showRegisterAgent');
$routes->post('/register-agent', 'AuthController::registerAgent');
$routes->get('/logout', 'AuthController::logout');

// ===== USER / JAMAAH DASHBOARD (Protected) =====
$routes->group('user', ['filter' => 'role:jamaah'], function($routes) {
    $routes->get('dashboard', 'User\DashboardController::index');
    $routes->get('bookings', 'User\DashboardController::bookings');
    $routes->get('bookings/(:num)', 'User\DashboardController::bookingDetail/$1');
    $routes->post('bookings/pay/(:num)', 'User\DashboardController::pay/$1');
});

// ===== FINANCE DASHBOARD (Protected) =====
$routes->group('finance', ['filter' => 'role:finance'], function($routes) {
    $routes->get('dashboard', 'Finance\DashboardController::index');
    $routes->get('disbursements', 'Finance\DisbursementController::index');
    $routes->post('disbursements/process/(:num)', 'Finance\DisbursementController::process/$1');
});

// ===== SUPER ADMIN ROUTES =====
$routes->group('superadmin', ['filter' => 'role:superadmin'], function($routes) {
    $routes->get('dashboard', 'SuperAdmin\DashboardController::index');
    
    // Agents Management
    $routes->get('agents', 'SuperAdmin\AgentController::index');
    $routes->get('agents/edit/(:num)', 'SuperAdmin\AgentController::edit/$1');
    $routes->post('agents/update/(:num)', 'SuperAdmin\AgentController::update/$1');
    $routes->get('agents/delete/(:num)', 'SuperAdmin\AgentController::delete/$1');
    $routes->get('agents/verify/(:num)', 'SuperAdmin\AgentController::verify/$1');
    
    // User & Jamaah Management
    $routes->get('users', 'SuperAdmin\UserController::index');
    $routes->get('users/edit/(:num)', 'SuperAdmin\UserController::edit/$1');
    $routes->post('users/update/(:num)', 'SuperAdmin\UserController::update/$1');
    $routes->get('users/delete/(:num)', 'SuperAdmin\UserController::delete/$1');
    
    $routes->get('transactions', 'SuperAdmin\DashboardController::transactions');
    
    // Packages CRUD
    $routes->get('packages', 'SuperAdmin\PackageController::index');
    $routes->get('packages/create', 'SuperAdmin\PackageController::create');
    $routes->post('packages/store', 'SuperAdmin\PackageController::store');
    $routes->get('packages/edit/(:num)', 'SuperAdmin\PackageController::edit/$1');
    $routes->post('packages/update/(:num)', 'SuperAdmin\PackageController::update/$1');
    $routes->get('packages/delete/(:num)', 'SuperAdmin\PackageController::delete/$1');
    
    $routes->get('ai-config', 'SuperAdmin\DashboardController::aiConfig');
    $routes->post('ai-config/save', 'SuperAdmin\DashboardController::saveAiConfig');
});

// ===== AGENT DASHBOARD (Protected) =====
$routes->group('agent', ['filter' => 'role:agent'], function($routes) {
    $routes->get('dashboard', 'Agent\DashboardController::index');
    
    // Packages Management
    $routes->get('packages', 'Agent\PackageController::index');
    $routes->get('packages/create', 'Agent\PackageController::create');
    $routes->post('packages/store', 'Agent\PackageController::store');
    $routes->get('packages/edit/(:num)', 'Agent\PackageController::edit/$1');
    $routes->post('packages/update/(:num)', 'Agent\PackageController::update/$1');
    $routes->get('packages/delete/(:num)', 'Agent\PackageController::delete/$1');
    
    // Jamaah Management
    $routes->get('jamaah', 'Agent\JamaahController::index');
    $routes->get('jamaah/edit/(:num)', 'Agent\JamaahController::edit/$1');
    $routes->post('jamaah/update/(:num)', 'Agent\JamaahController::update/$1');
    
    // Booking Management
    $routes->get('bookings', 'Agent\BookingController::index');
    $routes->get('bookings/create', 'Agent\BookingController::create');
    $routes->post('bookings/store', 'Agent\BookingController::store');
    $routes->get('bookings/edit/(:num)', 'Agent\BookingController::edit/$1');
    $routes->post('bookings/update/(:num)', 'Agent\BookingController::update/$1');
    $routes->get('bookings/delete/(:num)', 'Agent\BookingController::delete/$1');
    
    $routes->get('disbursements', 'Agent\DashboardController::disbursements');
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

// Katalog
$routes->get('/katalog', 'KatalogController::index');
$routes->get('/katalog/(:num)', 'KatalogController::detail/$1');