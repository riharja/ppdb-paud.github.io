<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Halaman awal -> arahkan ke login
$routes->get('/', static function () {
    return redirect()->to('/login');
});

// ===== AUTH (tidak perlu login) =====
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

// ===== HALAMAN YANG BUTUH LOGIN =====
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');

    // CRUD Pendaftaran PPDB
    $routes->get('/pendaftaran', 'Pendaftaran::index');
    $routes->get('/pendaftaran/tambah', 'Pendaftaran::create');
    $routes->post('/pendaftaran/simpan', 'Pendaftaran::store');
    $routes->get('/pendaftaran/detail/(:num)', 'Pendaftaran::show/$1');
    $routes->get('/pendaftaran/edit/(:num)', 'Pendaftaran::edit/$1');
    $routes->post('/pendaftaran/update/(:num)', 'Pendaftaran::update/$1');
    $routes->get('/pendaftaran/hapus/(:num)', 'Pendaftaran::delete/$1');
});
