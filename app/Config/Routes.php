<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::index');
$routes->post('auth/process', 'AuthController::process');
$routes->get('logout', 'AuthController::logout');
$routes->get('generate-hash', 'HashGenerator::index');

$routes->group('admin', ['filter' => 'admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    $routes->get('profil-perusahaan', 'Admin\ProfilPerusahaan::index');
    $routes->post('profil-perusahaan/update', 'Admin\ProfilPerusahaan::update');
    
    $routes->get('users', 'Admin\UserCrud::index');
    $routes->get('users/create', 'Admin\UserCrud::create');
    $routes->post('users/store', 'Admin\UserCrud::store');
    $routes->get('users/edit/(:num)', 'Admin\UserCrud::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\UserCrud::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\UserCrud::delete/$1');
    $routes->post('users/import', 'Admin\UserCrud::import_excel');
    $routes->get('users/import_excel', static function() {
        return view('admin/user_crud/import_excel', ['title' => 'Import Data User']);
    });
    
    $routes->get('hierarchy', 'Admin\UserHierarchy::index');
    $routes->post('hierarchy/get_bawahan', 'Admin\UserHierarchy::get_bawahan');
    $routes->post('hierarchy/save', 'Admin\UserHierarchy::save');
    
    $routes->get('profil', 'Admin\ProfilUser::index');
    $routes->post('profil/update', 'Admin\ProfilUser::update');
    
    $routes->get('pantau-laporan', 'Admin\PantauLaporan::index');
    $routes->post('pantau-laporan/get-hierarchy', 'Admin\PantauLaporan::get_hierarchy_down');
    
    $routes->get('notifikasi', 'Admin\Notifikasi::index');
    $routes->post('notifikasi/send', 'Admin\Notifikasi::send');
});

$routes->group('staff', ['filter' => 'staff'], static function ($routes) {
    $routes->get('dashboard', 'Staff\Dashboard::index');
    
    $routes->get('profil', 'Staff\ProfilUser::index');
    $routes->post('profil/update', 'Staff\ProfilUser::update');
    
    $routes->get('pantau-progres', 'Staff\PantauProgres::index');
    $routes->get('pantau-progres/detail-alasan/(:segment)/(:num)', 'Staff\PantauProgres::detail_alasan/$1/$2');

    $routes->get('input-data-audit/audit-bond', 'Staff\InputDataAudit\AuditBond::index');
    $routes->post('input-data-audit/audit-bond/store', 'Staff\InputDataAudit\AuditBond::store');
    
    $routes->get('input-data-audit/compliance-bond', 'Staff\InputDataAudit\ComplianceBond::index');
    $routes->post('input-data-audit/compliance-bond/store', 'Staff\InputDataAudit\ComplianceBond::store');
    
    $routes->get('input-data-audit/risk-bond', 'Staff\InputDataAudit\RiskBond::index');
    $routes->post('input-data-audit/risk-bond/store', 'Staff\InputDataAudit\RiskBond::store');
    
    $routes->get('input-data-audit/formulir-insiden', 'Staff\InputDataAudit\FormulirInsiden::index');
    $routes->post('input-data-audit/formulir-insiden/store', 'Staff\InputDataAudit\FormulirInsiden::store');

    $routes->get('internal-grc/audit-bond', 'Staff\InputAuditInternal\AuditBond::index');
    $routes->post('internal-grc/audit-bond/store', 'Staff\InputAuditInternal\AuditBond::store');
    
    $routes->get('internal-grc/compliance-bond', 'Staff\InputAuditInternal\ComplianceBond::index');
    $routes->post('internal-grc/compliance-bond/store', 'Staff\InputAuditInternal\ComplianceBond::store');
    
    $routes->get('internal-grc/risk-bond', 'Staff\InputAuditInternal\RiskBond::index');
    $routes->post('internal-grc/risk-bond/store', 'Staff\InputAuditInternal\RiskBond::store');
    
    $routes->get('internal-grc/fraud-bond', 'Staff\InputAuditInternal\FraudBond::index');
    $routes->post('internal-grc/fraud-bond/store', 'Staff\InputAuditInternal\FraudBond::store');
    
    $routes->get('internal-grc/incident-bond', 'Staff\InputAuditInternal\IncidentBond::index');
    $routes->post('internal-grc/incident-bond/store', 'Staff\InputAuditInternal\IncidentBond::store');
    
    $routes->get('internal-grc/cyber-bond', 'Staff\InputAuditInternal\CyberBond::index');
    $routes->post('internal-grc/cyber-bond/store', 'Staff\InputAuditInternal\CyberBond::store');
    
    $routes->get('internal-grc/third-party-bond', 'Staff\InputAuditInternal\ThirdPartyBond::index');
    $routes->post('internal-grc/third-party-bond/store', 'Staff\InputAuditInternal\ThirdPartyBond::store');
    
    $routes->get('internal-grc/continuity-bond', 'Staff\InputAuditInternal\ContinuityBond::index');
    $routes->post('internal-grc/continuity-bond/store', 'Staff\InputAuditInternal\ContinuityBond::store');
    
    $routes->get('internal-grc/control-bond', 'Staff\InputAuditInternal\ControlBond::index');
    $routes->post('internal-grc/control-bond/store', 'Staff\InputAuditInternal\ControlBond::store');
});

$routes->group('kepalaunit', ['filter' => 'kepalaunit'], static function ($routes) {
    $routes->get('dashboard', 'KepalaUnit\Dashboard::index');
    $routes->get('profil', 'KepalaUnit\ProfilUser::index');
    $routes->post('profil/update', 'KepalaUnit\ProfilUser::update');
    $routes->get('pantau-progres', 'KepalaUnit\PantauProgres::index');
    $routes->get('pantau-progres/detail-alasan/(:segment)/(:num)', 'KepalaUnit\PantauProgres::detail_alasan/$1/$2');
    $routes->get('approval', 'KepalaUnit\ApprovalLaporan::index');
    $routes->get('approval/detail/(:segment)/(:num)', 'KepalaUnit\ApprovalLaporan::detail/$1/$2');
    $routes->get('approval/approve/(:segment)/(:num)', 'KepalaUnit\ApprovalLaporan::approve/$1/$2');
    $routes->post('approval/reject', 'KepalaUnit\ApprovalLaporan::reject');
});

$routes->group('supervisor', ['filter' => 'supervisor'], static function ($routes) {
    $routes->get('dashboard', 'Supervisor\Dashboard::index');
    $routes->get('profil', 'Supervisor\ProfilUser::index');
    $routes->post('profil/update', 'Supervisor\ProfilUser::update');
    $routes->get('pantau-progres', 'Supervisor\PantauProgres::index');
    $routes->get('pantau-progres/detail-alasan/(:segment)/(:num)', 'Supervisor\PantauProgres::detail_alasan/$1/$2');
    $routes->get('approval', 'Supervisor\ApprovalLaporan::index');
    $routes->get('approval/detail/(:segment)/(:num)', 'Supervisor\ApprovalLaporan::detail/$1/$2');
    $routes->get('approval/approve/(:segment)/(:num)', 'Supervisor\ApprovalLaporan::approve/$1/$2');
    $routes->post('approval/reject', 'Supervisor\ApprovalLaporan::reject');
    $routes->get('approval/export-excel/(:segment)', 'Supervisor\ApprovalLaporan::export_excel/$1');
    $routes->get('approval/export-pdf/(:segment)/(:num)', 'Supervisor\ApprovalLaporan::export_pdf/$1/$2');
});

$routes->group('managerial', ['filter' => 'managerial'], static function ($routes) {
    $routes->get('dashboard', 'Managerial\Dashboard::index');
    $routes->get('profil', 'Managerial\ProfilUser::index');
    $routes->post('profil/update', 'Managerial\ProfilUser::update');
    $routes->get('pantau-progres', 'Managerial\PantauProgres::index');
    $routes->get('pantau-progres/detail-alasan/(:segment)/(:num)', 'Managerial\PantauProgres::detail_alasan/$1/$2');
    $routes->get('approval', 'Managerial\ApprovalLaporan::index');
    $routes->get('approval/detail/(:segment)/(:num)', 'Managerial\ApprovalLaporan::detail/$1/$2');
    $routes->get('approval/approve/(:segment)/(:num)', 'Managerial\ApprovalLaporan::approve/$1/$2');
    $routes->post('approval/reject', 'Managerial\ApprovalLaporan::reject');
    $routes->get('approval/export-excel/(:segment)', 'Managerial\ApprovalLaporan::export_excel/$1');
    $routes->get('approval/export-pdf/(:segment)/(:num)', 'Managerial\ApprovalLaporan::export_pdf/$1/$2');
});

$routes->group('pimpinan', ['filter' => 'pimpinan'], static function ($routes) {
    $routes->get('dashboard', 'PimpinanTinggi\Dashboard::index');
    $routes->get('profil', 'PimpinanTinggi\ProfilUser::index');
    $routes->post('profil/update', 'PimpinanTinggi\ProfilUser::update');
    $routes->get('pantau-progres', 'PimpinanTinggi\PantauProgres::index');
    $routes->get('pantau-progres/detail-alasan/(:segment)/(:num)', 'PimpinanTinggi\PantauProgres::detail_alasan/$1/$2');
    $routes->get('approval', 'PimpinanTinggi\ApprovalLaporan::index');
    $routes->get('approval/detail/(:segment)/(:num)', 'PimpinanTinggi\ApprovalLaporan::detail/$1/$2');
    $routes->get('approval/approve/(:segment)/(:num)', 'PimpinanTinggi\ApprovalLaporan::approve/$1/$2');
    $routes->post('approval/reject', 'PimpinanTinggi\ApprovalLaporan::reject');
    $routes->get('approval/export-excel/(:segment)', 'PimpinanTinggi\ApprovalLaporan::export_excel/$1');
    $routes->get('approval/export-pdf/(:segment)/(:num)', 'PimpinanTinggi\ApprovalLaporan::export_pdf/$1/$2');
});