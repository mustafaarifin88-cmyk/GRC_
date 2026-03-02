<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .welcome-card-spv {
        background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        border-radius: 20px;
        color: white;
        overflow: hidden;
        position: relative;
    }
    .welcome-card-spv::after {
        content: '\f085';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 10rem;
        position: absolute;
        right: -10px;
        bottom: -30px;
        opacity: 0.1;
        transform: rotate(15deg);
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
        <div class="card welcome-card-spv shadow-lg border-0 p-4">
            <div class="card-body position-relative z-1">
                <h2 class="text-white fw-bold mb-3">Halo, <?= explode(' ', session()->get('nama_lengkap'))[0] ?>! 👋</h2>
                <p class="lead mb-4 opacity-75">Selamat datang di portal GRC tingkat Supervisor. Filter dan lakukan approval laporan dari Kepala Unit yang ada di bawah naungan Anda.</p>
                <a href="<?= base_url('supervisor/approval') ?>" class="btn btn-warning text-dark fw-bold rounded-pill px-4 shadow-sm">Buka Halaman Approval</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <a href="<?= base_url('supervisor/approval') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100 border-start border-warning border-5">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-warning text-dark mx-3 shadow-sm"><i class="fas fa-filter"></i></div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Approval & Filter Laporan</h5>
                        <p class="text-muted small mb-0">Setujui laporan dan cetak dokumen (PDF/Excel)</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 mb-4">
        <a href="<?= base_url('supervisor/pantau-progres') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100 border-start border-secondary border-5">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-secondary mx-3 shadow-sm"><i class="fas fa-tasks"></i></div>
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