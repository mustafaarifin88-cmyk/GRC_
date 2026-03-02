<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .welcome-card-ku {
        background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
        border-radius: 20px;
        color: white;
        overflow: hidden;
        position: relative;
    }
    .welcome-card-ku::after {
        content: '\f0b1';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 10rem;
        position: absolute;
        right: -10px;
        bottom: -30px;
        opacity: 0.1;
        transform: rotate(-10deg);
    }
    .shortcut-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 15px;
    }
    .shortcut-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .icon-box {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        font-size: 1.5rem;
        color: white;
    }
</style>

<div class="row mb-4">
    <div class="col-12">
        <div class="card welcome-card-ku shadow-lg border-0 p-4">
            <div class="card-body position-relative z-1">
                <h2 class="text-white fw-bold mb-3">Halo, <?= explode(' ', session()->get('nama_lengkap'))[0] ?>! 👋</h2>
                <p class="lead mb-4 opacity-75">Selamat datang di portal GRC tingkat Kepala Unit. Segera periksa dan verifikasi laporan yang diajukan oleh Staff di bawah unit Anda.</p>
                <a href="<?= base_url('kepalaunit/approval') ?>" class="btn btn-light text-dark fw-bold rounded-pill px-4 shadow-sm">Buka Halaman Approval</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <a href="<?= base_url('kepalaunit/approval') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100 border-start border-primary border-5">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-primary mx-3 shadow-sm"><i class="fas fa-check-double"></i></div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Approval Laporan Staff</h5>
                        <p class="text-muted small mb-0">Setujui atau tolak laporan dari tim Anda</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 mb-4">
        <a href="<?= base_url('kepalaunit/pantau-progres') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100 border-start border-info border-5">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-info mx-3 shadow-sm"><i class="fas fa-tasks"></i></div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Pantau Progres Saya</h5>
                        <p class="text-muted small mb-0">Pantau laporan yang Anda buat sendiri</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection() ?>