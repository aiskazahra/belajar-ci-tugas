<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('diskon', ['filter' => 'adminonly'], function ($routes) {
    $routes->get('', 'DiskonController::index');
    $routes->post('', 'DiskonController::create');
    $routes->post('edit/(:any)', 'DiskonController::edit/$1');
    $routes->get('delete/(:any)', 'DiskonController::delete/$1');
});

$routes->group('pembelian', ['filter' => 'adminonly'], function ($routes) {
    $routes->get('', 'PembelianController::index');
    $routes->post('status/(:any)', 'PembelianController::updateStatus/$1');
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
$routes->get('history', 'TransaksiController::history', ['filter' => 'auth']);

$routes->get('ajax/destinations','TransaksiController::destinations', ['filter' => 'auth']);
$routes->get('ajax/costs','TransaksiController::costs', ['filter' => 'auth']);

$routes->resource('api/products', ['controller' => 'Api\ProdukController']);

$routes->get('api/transactions', 'Api\TransaksiController::index');

$routes->resource('api/discounts', ['controller' => 'Api\DiskonController']);

$routes->get('faq', 'Home::faq', ['filter' => 'role']);
