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
$routes->group('admin', function ($routes) {

    $routes->get('detail/(:num)', 'Loker\LokerController::detail/$1', ['as' => 'loker.detail']);
    $routes->get('kategori/(:num)', 'Loker\LokerController::kategori/$1', ['as' => 'loker.kategori']);
    $routes->post('save-loker/(:num)', 'Loker\LokerController::saveLoker/$1', ['as' => 'save.loker']);
    $routes->post('apply-loker/(:num)', 'Loker\LokerController::applyLoker/$1', ['as' => 'apply.loker']);
    $routes->post('cari-loker', 'Loker\LokerController::cariLoker', ['as' => 'cari.loker']);
});
$routes->group('users', function ($routes) {
    $routes->get('diagnosis', 'Users\UsersController::diagnosis', ['as' => 'users.public.profile']);
    // $routes->get('public-profile', 'Users\UsersController::publicProfile', ['as' => 'users.public.profile']);
    // $routes->get('update-profile', 'Users\UsersController::updateProfile', ['as' => 'users.update.profile']);
    // $routes->post('update-profile', 'Users\UsersController::submitUpdateProfile', ['as' => 'submit.update.profile']);
    // $routes->get('update-cv', 'Users\UsersController::updateCV', ['as' => 'users.update.cv']);
    // $routes->post('update-cv', 'Users\UsersController::submitUpdateCV', ['as' => 'users.submit.cv']);
    // $routes->get('save-loker', 'Users\UsersController::usersSaveloker', ['as' => 'users.save.loker']);
    // $routes->get('aplly-loker', 'Users\UsersController::usersApllyloker', ['as' => 'users.apply.loker']);
});

$routes->get('admin/login', 'Admin\AdminController::login', ['as' => 'admin.login', 'filter' => 'loginfilter']);
$routes->get('admin/register', 'Admin\AdminController::register', ['as' => 'admin.register', 'filter' => 'loginfilter']);
$routes->post('admin/check-login', 'Admin\AdminController::checkLogin', ['as' => 'admin.cek.login']);

$routes->group('admin', ['filter' => 'authfilter'], function ($routes) {
    $routes->get('dashboard', 'Admin\AdminController::index', ['as' => 'admin.index']);
    $routes->get('logout', 'Admin\AdminController::logout', ['as' => 'admin.logout']);


    // admin super
    $routes->get('all-admin', 'Admin\AdminController::displayAdmin', ['as' => 'admins.index']);
    $routes->get('tambah-admin', 'Admin\AdminController::tambahAdmin', ['as' => 'admins.tambah']);
    $routes->post('tambah-admin', 'Admin\AdminController::storeAdmin', ['as' => 'admins.store']);

    $routes->get('all-gejala', 'Admin\AdminController::displayGejala', ['as' => 'gejala.index']);
    $routes->get('tambah-gejala', 'Admin\AdminController::tambahGejala', ['as' => 'gejala.tambah']);
    $routes->post('tambah-gejala', 'Admin\AdminController::storeGejala', ['as' => 'gejala.store']);
    $routes->get('edit-gejala/(:any)', 'Admin\AdminController::editGejala/$1', ['as' => 'gejala.edit']);
    $routes->post('edit-gejala/(:any)', 'Admin\AdminController::updateGejala/$1', ['as' => 'gejala.update']);
    $routes->get('hapus-gejala/(:any)', 'Admin\AdminController::hapusGejala/$1', ['as' => 'gejala.hapus']);

    $routes->get('all-diagnosis', 'Admin\DiagnosisController::displayDiagnosis', ['as' => 'diagnosis.index']);
    $routes->get('diagnosis', 'Admin\DiagnosisController::Diagnosis', ['as' => 'admin.diagnosis']);

    $routes->get('tambah-diagnosis', 'Admin\DiagnosisController::tambahDiagnosis', ['as' => 'diagnosis.tambah']);
    $routes->post('tambah-diagnosis', 'Admin\DiagnosisController::storeDiagnosis', ['as' => 'diagnosis.store']);
    $routes->get('edit-diagnosis/(:any)', 'Admin\DiagnosisController::editDiagnosis/$1', ['as' => 'diagnosis.edit']);
    $routes->post('edit-diagnosis/(:any)', 'Admin\DiagnosisController::updateDiagnosis/$1', ['as' => 'diagnosis.update']);
    $routes->get('hapus-diagnosis/(:any)', 'Admin\DiagnosisController::hapusDiagnosis/$1', ['as' => 'diagnosis.hapus']);


    // New AJAX routes
    $routes->get('getSymptomsData', 'Admin\DiagnosisController::getSymptomsData', ['as' => 'diagnosis.symptoms']);
    $routes->get('getDiseasesData', 'Admin\DiagnosisController::getDiseasesData', ['as' => 'diagnosis.diseases']);
    $routes->post('processDiagnosis', 'Admin\DiagnosisController::processDiagnosis', ['as' => 'diagnosis.process']);
    $routes->post('saveDiagnosisResult', 'Admin\DiagnosisController::saveDiagnosisResult', ['as' => 'diagnosis.save']);
    $routes->get('searchDiagnosis', 'Admin\DiagnosisController::searchDiagnosis', ['as' => 'diagnosis.search']);
    $routes->get('diagnosisDetail/(:any)', 'Admin\DiagnosisController::getDiagnosisDetail/$1', ['as' => 'diagnosis.detail']);
});