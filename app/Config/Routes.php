<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/contact', 'Home::contact', ['as' => 'contact']);
$routes->get('/about', 'Home::about', ['as' => 'about']);

service('auth')->routes($routes);

$routes->group('loker', function ($routes) {

    $routes->get('detail/(:num)', 'Loker\LokerController::detail/$1', ['as' => 'loker.detail']);
    $routes->get('kategori/(:num)', 'Loker\LokerController::kategori/$1', ['as' => 'loker.kategori']);
    $routes->post('save-loker/(:num)', 'Loker\LokerController::saveLoker/$1', ['as' => 'save.loker']);
    $routes->post('apply-loker/(:num)', 'Loker\LokerController::applyLoker/$1', ['as' => 'apply.loker']);
    $routes->post('cari-loker', 'Loker\LokerController::cariLoker', ['as' => 'cari.loker']);
});
$routes->group('users', function ($routes) {
    $routes->get('public-profile', 'Users\UsersController::publicProfile', ['as' => 'users.public.profile']);
    $routes->get('update-profile', 'Users\UsersController::updateProfile', ['as' => 'users.update.profile']);
    $routes->post('update-profile', 'Users\UsersController::submitUpdateProfile', ['as' => 'submit.update.profile']);
    $routes->get('update-cv', 'Users\UsersController::updateCV', ['as' => 'users.update.cv']);
    $routes->post('update-cv', 'Users\UsersController::submitUpdateCV', ['as' => 'users.submit.cv']);
    $routes->get('save-loker', 'Users\UsersController::usersSaveloker', ['as' => 'users.save.loker']);
    $routes->get('aplly-loker', 'Users\UsersController::usersApllyloker', ['as' => 'users.apply.loker']);
});


$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\AdminController::index', ['as' => 'admin.index']);
});