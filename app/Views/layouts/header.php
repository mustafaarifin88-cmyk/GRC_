<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3 text-primary"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0 align-items-center">
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle text-gray-600 position-relative" href="#" data-bs-toggle="dropdown" data-bs-display="static">
                            <i class='bi bi-bell bi-sub fs-4'></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                0
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown shadow-lg border-0" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-header">
                                <h6>Notifikasi</h6>
                            </li>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center" href="#">
                                    <div class="notification-icon bg-primary">
                                        <i class="bi bi-info-circle"></i>
                                    </div>
                                    <div class="notification-text ms-4">
                                        <p class="notification-title font-bold">Tidak ada notifikasi baru</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="d-flex align-items-center text-decoration-none">
                        <div class="user-menu d-flex align-items-center">
                            <div class="user-name text-end me-3 d-none d-md-block">
                                <h6 class="mb-0 text-gray-600 fw-bold"><?= session()->get('nama_lengkap') ?></h6>
                                <p class="mb-0 text-sm text-gray-500"><?= session()->get('level') ?></p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md border border-2 border-primary shadow-sm">
                                    <img src="<?= base_url('uploads/profiles/' . (session()->get('foto') ?? 'default-profile.png')) ?>">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-3" aria-labelledby="dropdownMenuButton" style="min-width: 200px;">
                        <li>
                            <h6 class="dropdown-header">Halo, <?= explode(' ', session()->get('nama_lengkap'))[0] ?>!</h6>
                        </li>
                        <li>
                            <?php 
                            $level = session()->get('level');
                            $profilLink = 'admin/profil';
                            if($level == 'STAFF') $profilLink = 'staff/profil';
                            if($level == 'KEPALA UNIT') $profilLink = 'kepalaunit/profil';
                            if($level == 'SUPERVISOR') $profilLink = 'supervisor/profil';
                            if($level == 'MANAGERIAL') $profilLink = 'managerial/profil';
                            if($level == 'PIMPINAN TINGGI') $profilLink = 'pimpinan/profil';
                            ?>
                            <a class="dropdown-item py-2" href="<?= base_url($profilLink) ?>"><i class="icon-mid bi bi-person me-2 text-primary"></i> Profil Saya</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2 text-danger fw-bold" href="<?= base_url('logout') ?>"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>