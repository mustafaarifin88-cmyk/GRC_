<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .welcome-card-mgr {
        background: linear-gradient(135deg, #870000 0%, #190A05 100%);
        border-radius: 20px;
        color: white;
        overflow: hidden;
        position: relative;
    }
    .welcome-card-mgr::after {
        content: '\f201';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 10rem;
        position: absolute;
        right: -10px;
        bottom: -30px;
        opacity: 0.1;
        transform: rotate(10deg);
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
        <div class="card welcome-card-mgr shadow-lg border-0 p-4">
            <div class="card-body position-relative z-1">
                <h2 class="text-white fw-bold mb-3">Halo, <?= explode(' ', session()->get('nama_lengkap'))[0] ?>! 👋</h2>
                <p class="lead mb-4 opacity-75">Selamat datang di portal GRC tingkat Managerial. Evaluasi dan setujui laporan dari tingkat Supervisor secara komprehensif di sini.</p>
                <a href="<?= base_url('managerial/approval') ?>" class="btn btn-light text-danger fw-bold rounded-pill px-4 shadow-sm">Buka Halaman Approval</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <a href="<?= base_url('managerial/approval') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100 border-start border-danger border-5">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-danger text-white mx-3 shadow-sm"><i class="fas fa-check-square"></i></div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Approval & Rekapitulasi</h5>
                        <p class="text-muted small mb-0">Setujui laporan dan cetak dokumen (PDF/Excel)</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 mb-4">
        <a href="<?= base_url('managerial/pantau-progres') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100 border-start border-dark border-5">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-dark mx-3 shadow-sm"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Pantau Progres Laporan Saya</h5>
                        <p class="text-muted small mb-0">Pantau status laporan yang Anda buat secara mandiri</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection() ?>