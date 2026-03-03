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
                            <?php
                                $db = \Config\Database::connect();
                                $notifikasi = $db->table('tb_notifikasi')
                                                 ->where('user_id', session()->get('id'))
                                                 ->where('is_read', 0)
                                                 ->orderBy('created_at', 'DESC')
                                                 ->get()->getResultArray();
                                $notifCount = count($notifikasi);
                            ?>
                            <?php if($notifCount > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                <?= $notifCount ?>
                            </span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown shadow-lg border-0" aria-labelledby="dropdownMenuButton" style="min-width: 320px; max-height: 400px; overflow-y: auto;">
                            <li class="dropdown-header d-flex justify-content-between align-items-center">
                                <h6>Notifikasi (<?= $notifCount ?>)</h6>
                                <?php if($notifCount > 0): ?>
                                    <a href="<?= base_url('notifikasi/read-all') ?>" class="text-primary small text-decoration-none"><i class="fas fa-check-double me-1"></i>Tandai semua dibaca</a>
                                <?php endif; ?>
                            </li>
                            <?php if($notifCount == 0): ?>
                                <li class="dropdown-item notification-item">
                                    <p class="text-center text-muted mb-0 py-2"><i class="fas fa-bell-slash fs-4 d-block mb-2 text-light"></i>Tidak ada notifikasi baru</p>
                                </li>
                            <?php else: ?>
                                <?php foreach($notifikasi as $notif): ?>
                                <li class="dropdown-item notification-item border-bottom px-3 py-2" style="white-space: normal;">
                                    <a class="d-flex align-items-start text-decoration-none" href="<?= base_url('notifikasi/read/'.$notif['id']) ?>">
                                        <div class="notification-icon bg-primary mt-1 text-white rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width:35px;height:35px;">
                                            <i class="fas fa-info-circle fs-6"></i>
                                        </div>
                                        <div class="notification-text ms-3 flex-grow-1">
                                            <p class="notification-title font-bold text-dark mb-1" style="font-size: 0.85rem;"><?= esc($notif['judul']) ?></p>
                                            <p class="notification-subtitle font-thin text-muted mb-1 lh-sm" style="font-size: 0.75rem;"><?= esc($notif['pesan']) ?></p>
                                            <small class="text-muted" style="font-size: 0.65rem;"><i class="fas fa-clock me-1"></i><?= date('d M Y, H:i', strtotime($notif['created_at'])) ?></small>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
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