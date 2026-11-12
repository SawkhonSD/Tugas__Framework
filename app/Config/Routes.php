<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('buku', static function ($routes) {
    $routes->get('/', 'Buku::index');
    $routes->get('tambah', 'Buku::create');
    $routes->post('simpan', 'Buku::store');
    $routes->get('ubah/(:num)', 'Buku::edit/$1');
    $routes->post('perbarui/(:num)', 'Buku::update/$1');
    $routes->post('hapus/(:num)', 'Buku::delete/$1');
});
