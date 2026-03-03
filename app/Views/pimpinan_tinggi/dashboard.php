<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .welcome-card-pt {
        background: linear-gradient(135deg, #141E30 0%, #243B55 100%);
        border-radius: 20px;
        color: white;
        overflow: hidden;
        position: relative;
    }
    .welcome-card-pt::after {
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
        <div class="card welcome-card-pt shadow-lg border-0 p-4">
            <div class="card-body position-relative z-1">
                <h2 class="text-white fw-bold mb-3">Halo, <?= explode(' ', session()->get('nama_lengkap'))[0] ?>! 👋</h2>
                <p class="lead mb-4 opacity-75">Selamat datang di portal GRC tingkat Pimpinan Tinggi. Tinjau dan sahkan laporan strategis perusahaan dari hierarki di bawah Anda.</p>
                <a href="<?= base_url('pimpinan/approval') ?>" class="btn btn-light text-dark fw-bold rounded-pill px-4 shadow-sm">Buka Halaman Approval Akhir</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <a href="<?= base_url('pimpinan/approval') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100 border-start border-primary border-5">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box mx-3 shadow-sm" style="background-color: #243B55;"><i class="fas fa-stamp"></i></div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Approval Akhir & Rekap</h5>
                        <p class="text-muted small mb-0">Sahkan laporan & cetak dokumen resmi (PDF/Excel)</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6 mb-4">
        <a href="<?= base_url('pimpinan/pantau-progres') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100 border-start border-secondary border-5">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-secondary mx-3 shadow-sm"><i class="fas fa-list-ol"></i></div>
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Pantau Progres Personal</h5>
                        <p class="text-muted small mb-0">Pantau status form yang Anda ajukan</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection() ?>