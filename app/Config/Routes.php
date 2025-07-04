<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingController::index');
$routes->get('produk', 'Home::index');

// Tampilkan form register
$routes->get('register', 'AuthController::register');

// Proses form register (POST)
$routes->post('register', 'AuthController::processRegister');

// Tampilkan form login
$routes->get('login', 'AuthController::login');

// Proses form login (POST bisa langsung ke method login)
$routes->post('login', 'AuthController::login');

// Logout
$routes->get('logout', 'AuthController::logout');


$routes->group('kelolaproduk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->post('kelolaproduk', 'ProdukController::create', ['filter' => 'auth']);
    $routes->post('kelolaproduk', 'ProdukController::create', ['filter' => 'auth']);
    $routes->post('kelolaproduk/edit/(:any)', 'ProdukController::edit/$1', ['filter' => 'auth']);
    $routes->get('kelolaproduk/delete/(:any)', 'ProdukController::delete/$1', ['filter' => 'auth']);
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);
$routes->post('dashboardtoko/update-status', 'DashboardToko::updateStatus');
$routes->post('transaksi/updateStatus', 'TransaksiController::updateStatus');

$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->resource('api', ['controller' => 'apiController']);
$routes->get('dashboardtoko', 'Dashboard::index');
$routes->get('DashboardToko/cetak', 'Dashboard::cetak');
