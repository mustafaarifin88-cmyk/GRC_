<?php
$level = session()->get('level');
$bgClass = '';
$baseRoute = '';

if ($level == 'ADMIN') {
    $bgClass = 'bg-sidebar-admin animated-gradient';
    $baseRoute = 'admin';
} elseif ($level == 'PIMPINAN TINGGI') {
    $bgClass = 'bg-sidebar-pimpinan animated-gradient';
    $baseRoute = 'pimpinan';
} elseif ($level == 'MANAGERIAL') {
    $bgClass = 'bg-sidebar-managerial animated-gradient';
    $baseRoute = 'managerial';
} elseif ($level == 'SUPERVISOR') {
    $bgClass = 'bg-sidebar-supervisor animated-gradient';
    $baseRoute = 'supervisor';
} elseif ($level == 'KEPALA UNIT') {
    $bgClass = 'bg-sidebar-kepalaunit animated-gradient';
    $baseRoute = 'kepalaunit';
} elseif ($level == 'STAFF') {
    $bgClass = 'bg-sidebar-staff animated-gradient';
    $baseRoute = 'staff';
}

$companyModel = new \App\Models\CompanyModel();
$company = $companyModel->first();
$companyName = $company['nama_perusahaan'] ?? 'GRC System';
$companyLogo = $company['logo'] ?? 'default-logo.png';

$fotoUser = session()->get('foto') ?? 'default-profile.png';
$namaUser = session()->get('nama_lengkap') ?? 'User';
?>

<style>
    /* Tambahan CSS khusus agar sub-menu di sidebar ikut berwarna putih */
    .sidebar-wrapper .menu .submenu .submenu-item a {
        color: rgba(255, 255, 255, 0.7) !important;
        transition: all 0.3s ease;
    }
    .sidebar-wrapper .menu .submenu .submenu-item.active a,
    .sidebar-wrapper .menu .submenu .submenu-item a:hover {
        color: #ffffff !important;
        font-weight: 600;
        transform: translateX(5px);
    }
</style>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper <?= $bgClass ?>">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="brand-logo d-flex flex-column align-items-center w-100">
                    <a href="<?= base_url($baseRoute . '/dashboard') ?>">
                        <img src="<?= base_url('uploads/company_logo/' . $companyLogo) ?>" alt="Logo" style="height: 60px; width: auto;">
                    </a>
                    <h6 class="mt-3 text-white text-center fw-bold" style="letter-spacing: 1px;"><?= strtoupper($companyName) ?></h6>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2 d-none">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block text-white"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column align-items-center mt-3 pb-3 border-bottom border-light border-opacity-25">
            <div class="avatar avatar-xl bg-white p-1 rounded-circle shadow">
                <img src="<?= base_url('uploads/profiles/' . $fotoUser) ?>" alt="User" class="user-profile-img rounded-circle" style="width: 70px; height: 70px;">
            </div>
            <h6 class="mt-3 mb-0 text-white fw-bold"><?= $namaUser ?></h6>
            <small class="text-white-50 fw-semibold px-3 py-1 mt-2 rounded-pill bg-dark bg-opacity-25"><?= $level ?></small>
        </div>

        <div class="sidebar-menu mt-3">
            <ul class="menu">
                <li class="sidebar-title text-white-50">Menu Utama</li>

                <li class="sidebar-item <?= uri_string() == $baseRoute.'/dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url($baseRoute.'/dashboard') ?>" class='sidebar-link'>
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <?php if($level == 'ADMIN'): ?>
                    <li class="sidebar-item <?= uri_string() == 'admin/profil-perusahaan' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/profil-perusahaan') ?>" class='sidebar-link'>
                            <i class="fas fa-building"></i>
                            <span>Profil Perusahaan</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= strpos(uri_string(), 'admin/users') !== false ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/users') ?>" class='sidebar-link'>
                            <i class="fas fa-users"></i>
                            <span>Manajemen User</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= uri_string() == 'admin/hierarchy' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/hierarchy') ?>" class='sidebar-link'>
                            <i class="fas fa-sitemap"></i>
                            <span>Setting Hirarki</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= strpos(uri_string(), 'admin/master-data') !== false ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/master-data') ?>" class='sidebar-link'>
                            <i class="fas fa-database"></i>
                            <span>Master Data</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= uri_string() == 'admin/pantau-laporan' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/pantau-laporan') ?>" class='sidebar-link'>
                            <i class="fas fa-chart-line"></i>
                            <span>Pantau Laporan</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= uri_string() == 'admin/notifikasi' ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/notifikasi') ?>" class='sidebar-link'>
                            <i class="fas fa-bell"></i>
                            <span>Notifikasi</span>
                        </a>
                    </li>

                <?php elseif($level == 'STAFF'): ?>
                    <li class="sidebar-item has-sub <?= strpos(uri_string(), 'input-data-audit') !== false ? 'active' : '' ?>">
                        <a href="#" class='sidebar-link'>
                            <i class="fas fa-file-alt"></i>
                            <span>Input Data Audit</span>
                        </a>
                        <ul class="submenu <?= strpos(uri_string(), 'input-data-audit') !== false ? 'active' : '' ?>">
                            <li class="submenu-item <?= uri_string() == 'staff/input-data-audit/audit-bond' ? 'active' : '' ?>">
                                <a href="<?= base_url('staff/input-data-audit/audit-bond') ?>" class="submenu-link text-white">Audit Bond</a>
                            </li>
                            <li class="submenu-item <?= uri_string() == 'staff/input-data-audit/compliance-bond' ? 'active' : '' ?>">
                                <a href="<?= base_url('staff/input-data-audit/compliance-bond') ?>" class="submenu-link text-white">Compliance Bond</a>
                            </li>
                            <li class="submenu-item <?= uri_string() == 'staff/input-data-audit/risk-bond' ? 'active' : '' ?>">
                                <a href="<?= base_url('staff/input-data-audit/risk-bond') ?>" class="submenu-link text-white">Risk Bond</a>
                            </li>
                            <li class="submenu-item <?= uri_string() == 'staff/input-data-audit/formulir-insiden' ? 'active' : '' ?>">
                                <a href="<?= base_url('staff/input-data-audit/formulir-insiden') ?>" class="submenu-link text-white">Formulir Insiden</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item has-sub <?= strpos(uri_string(), 'internal-grc') !== false ? 'active' : '' ?>">
                        <a href="#" class='sidebar-link'>
                            <i class="fas fa-shield-alt"></i>
                            <span>Internal GRC</span>
                        </a>
                        <ul class="submenu <?= strpos(uri_string(), 'internal-grc') !== false ? 'active' : '' ?>">
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/audit-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/audit-bond') ?>" class="submenu-link text-white">Audit Bond</a></li>
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/compliance-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/compliance-bond') ?>" class="submenu-link text-white">Compliance Bond</a></li>
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/risk-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/risk-bond') ?>" class="submenu-link text-white">Risk Bond</a></li>
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/fraud-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/fraud-bond') ?>" class="submenu-link text-white">Fraud Bond</a></li>
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/incident-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/incident-bond') ?>" class="submenu-link text-white">Incident Bond</a></li>
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/cyber-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/cyber-bond') ?>" class="submenu-link text-white">Cyber Bond</a></li>
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/third-party-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/third-party-bond') ?>" class="submenu-link text-white">Third Party Bond</a></li>
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/continuity-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/continuity-bond') ?>" class="submenu-link text-white">Continuity Bond</a></li>
                            <li class="submenu-item <?= uri_string() == 'staff/internal-grc/control-bond' ? 'active' : '' ?>"><a href="<?= base_url('staff/internal-grc/control-bond') ?>" class="submenu-link text-white">Control Bond</a></li>
                        </ul>
                    </li>

                <?php else: ?>
                    <li class="sidebar-item <?= uri_string() == $baseRoute.'/approval' ? 'active' : '' ?>">
                        <a href="<?= base_url($baseRoute.'/approval') ?>" class='sidebar-link'>
                            <i class="fas fa-check-double"></i>
                            <span>Approval Laporan</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($level != 'ADMIN'): ?>
                    <li class="sidebar-item <?= uri_string() == $baseRoute.'/pantau-progres' ? 'active' : '' ?>">
                        <a href="<?= base_url($baseRoute.'/pantau-progres') ?>" class='sidebar-link'>
                            <i class="fas fa-tasks"></i>
                            <span>Pantau Progres</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="sidebar-title text-white-50">Pengaturan</li>
                <li class="sidebar-item <?= uri_string() == $baseRoute.'/profil' ? 'active' : '' ?>">
                    <a href="<?= base_url($baseRoute.'/profil') ?>" class='sidebar-link'>
                        <i class="fas fa-user-cog"></i>
                        <span>Profil Saya</span>
                    </a>
                </li>
                
                <li class="sidebar-item mt-4">
                    <a href="<?= base_url('logout') ?>" class='sidebar-link bg-danger bg-opacity-25 text-white'>
                        <i class="fas fa-sign-out-alt text-white"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>