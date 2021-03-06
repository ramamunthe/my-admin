<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'AdminController::index');
$routes->get('/armada-create', 'AdminController::create');
$routes->post('/armada-store', 'AdminController::store');
$routes->post('/armada-update/(:segment)', 'AdminController::update/$1');
$routes->get('/armada-edit/(:segment)', 'AdminController::edit/$1');
$routes->get('/armada-delete/(:segment)', 'AdminController::delete/$1');

$routes->get('/admin-category', 'CategoryController::index');
$routes->post('/admin-category-store', 'CategoryController::store');
$routes->post('/admin-category-update/(:segment)', 'CategoryController::update/$1');
$routes->get('/admin-category-delete/(:segment)', 'CategoryController::delete/$1');

$routes->get('/admin-paket', 'PaketController::index');
$routes->get('/admin-paket-create', 'PaketController::create');
$routes->post('/admin-paket-store', 'PaketController::store');
$routes->post('/admin-paket-update', 'PaketController::update');
$routes->get('/admin-paket-delete/(:segment)', 'PaketController::delete/$1');
$routes->get('/admin-paket-edit/(:segment)', 'PaketController::edit/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
