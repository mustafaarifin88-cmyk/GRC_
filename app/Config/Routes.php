<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth\Login::index');
$routes->get('login', 'Auth\Login::index');
$routes->post('login/process', 'Auth\Login::process');
$routes->get('logout', 'Auth\Logout::index');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'admin'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    
    $routes->match(['get', 'post'], 'perusahaan', 'Perusahaan::index');
    
    $routes->get('users', 'Users::index');
    $routes->post('users/create', 'Users::create');
    $routes->post('users/update/(:num)', 'Users::update/$1');
    $routes->post('users/delete/(:num)', 'Users::delete/$1');
    $routes->post('users/import', 'Users::import');
    
    $routes->get('hierarchy', 'Hierarchy::index');
    $routes->post('hierarchy/save', 'Hierarchy::save');
    
    $routes->get('master-data', 'MasterData::index');
    $routes->post('master-data/save', 'MasterData::save');
    $routes->post('master-data/delete/(:num)', 'MasterData::delete/$1');
    
    $routes->get('pantau-laporan', 'PantauLaporan::index');
    $routes->get('pantau-laporan/detail/(:num)', 'PantauLaporan::detail/$1');
    
    $routes->match(['get', 'post'], 'profile', 'Profile::index');
});

$routes->group('staff', ['namespace' => 'App\Controllers\Staff', 'filter' => 'staff'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    
    $routes->get('audit-bond', 'AuditBond::index');
    $routes->get('audit-bond/create', 'AuditBond::create');
    $routes->post('audit-bond/store', 'AuditBond::store');
    
    $routes->get('progres-laporan', 'ProgresLaporan::index');
    
    $routes->match(['get', 'post'], 'profile', 'Profile::index');
});

$routes->group('kepala_unit', ['namespace' => 'App\Controllers\KepalaUnit', 'filter' => 'leader'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('approval', 'Approval::index');
    $routes->get('approval/detail/(:num)', 'Approval::detail/$1');
    $routes->post('approval/approve/(:num)', 'Approval::approve/$1');
    $routes->post('approval/reject/(:num)', 'Approval::reject/$1');
    $routes->match(['get', 'post'], 'profile', 'Profile::index');
});

$routes->group('supervisor', ['namespace' => 'App\Controllers\Supervisor', 'filter' => 'leader'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('approval', 'Approval::index');
    $routes->get('approval/detail/(:num)', 'Approval::detail/$1');
    $routes->post('approval/approve/(:num)', 'Approval::approve/$1');
    $routes->post('approval/reject/(:num)', 'Approval::reject/$1');
    $routes->get('cetak', 'CetakLaporan::index');
    $routes->match(['get', 'post'], 'profile', 'Profile::index');
});

$routes->group('managerial', ['namespace' => 'App\Controllers\Managerial', 'filter' => 'leader'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('approval', 'Approval::index');
    $routes->get('approval/detail/(:num)', 'Approval::detail/$1');
    $routes->post('approval/approve/(:num)', 'Approval::approve/$1');
    $routes->post('approval/reject/(:num)', 'Approval::reject/$1');
    $routes->get('cetak', 'CetakLaporan::index');
    $routes->match(['get', 'post'], 'profile', 'Profile::index');
});

$routes->group('pimpinan_tinggi', ['namespace' => 'App\Controllers\PimpinanTinggi', 'filter' => 'leader'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('approval', 'Approval::index');
    $routes->get('approval/detail/(:num)', 'Approval::detail/$1');
    $routes->post('approval/approve/(:num)', 'Approval::approve/$1');
    $routes->post('approval/reject/(:num)', 'Approval::reject/$1');
    $routes->get('cetak', 'CetakLaporan::index');
    $routes->match(['get', 'post'], 'profile', 'Profile::index');
});