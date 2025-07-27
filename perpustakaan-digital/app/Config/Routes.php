<?php

/**
 * Routes Configuration - Perpustakaan Digital
 * Mengatur semua routing untuk aplikasi perpustakaan
 */

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama
$routes->get('/', 'HomeController::index');
$routes->get('/about', 'HomeController::about');
$routes->get('/statistics', 'HomeController::statistics');

// Authentication Routes
$routes->group('auth', [], function($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::processLogin');
    $routes->get('logout', 'AuthController::logout');
});

// Book Management Routes
$routes->group('books', [], function($routes) {
    $routes->get('/', 'BookController::index');
    $routes->get('create', 'BookController::create');
    $routes->post('store', 'BookController::store');
    $routes->get('show/(:num)', 'BookController::show/$1');
    $routes->get('edit/(:num)', 'BookController::edit/$1');
    $routes->post('update/(:num)', 'BookController::update/$1');
    $routes->get('delete/(:num)', 'BookController::delete/$1');
});

// Dashboard Admin Routes
$routes->group('dashboard', [], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->get('books', 'DashboardController::books');
    $routes->get('chart-data', 'DashboardController::chartData');
});

// Default Controller jika tidak ada yang cocok
$routes->setDefaultController('HomeController');
$routes->set404Override();
