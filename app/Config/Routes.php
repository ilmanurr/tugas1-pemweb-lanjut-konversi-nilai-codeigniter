<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->add('/konversinilai', 'KonversiNilai::index');
$routes->post('/konversi-nilai/hitung', 'KonversiNilai::hitung');
$routes->get('/konversi-nilai/hasil', 'KonversiNilai::hasil');