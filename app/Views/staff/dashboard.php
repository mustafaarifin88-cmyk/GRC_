<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .welcome-card {
        background: linear-gradient(135deg, #0052D4 0%, #4364F7 50%, #6FB1FC 100%);
        border-radius: 20px;
        color: white;
        overflow: hidden;
        position: relative;
    }
    .welcome-card::after {
        content: '\f135';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 10rem;
        position: absolute;
        right: -20px;
        bottom: -40px;
        opacity: 0.1;
        transform: rotate(-15deg);
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
    .bg-gradient-audit { background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%); }
    .bg-gradient-compliance { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .bg-gradient-risk { background: linear-gradient(135deg, #F2994A 0%, #F2C94C 100%); }
    .bg-gradient-incident { background: linear-gradient(135deg, #8E2DE2 0%, #4A00E0 100%); }
</style>

<div class="row mb-4">
    <div class="col-12">
        <div class="card welcome-card shadow-lg border-0 p-4">
            <div class="card-body position-relative z-1">
                <h2 class="text-white fw-bold mb-3">Halo, <?= explode(' ', session()->get('nama_lengkap'))[0] ?>! 👋</h2>
                <p class="lead mb-4 opacity-75">Selamat datang di portal GRC Staff. Mulai buat laporan audit, kepatuhan, atau insiden dengan mudah melalui menu di bawah ini.</p>
                <a href="<?= base_url('staff/pantau-progres') ?>" class="btn btn-light text-primary rounded-pill px-4 fw-bold shadow-sm">Pantau Progres Laporan Saya</a>
            </div>
        </div>
    </div>
</div>

<h5 class="fw-bold text-muted mb-3"><i class="fas fa-bolt text-warning me-2"></i>Akses Cepat Form Audit</h5>
<div class="row">
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <a href="<?= base_url('staff/input-data-audit/audit-bond') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box bg-gradient-audit mx-auto mb-3 shadow"><i class="fas fa-file-signature"></i></div>
                    <h5 class="fw-bold text-dark">Audit Bond</h5>
                    <p class="text-muted small mb-0">Formulir hasil audit lapangan</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <a href="<?= base_url('staff/input-data-audit/compliance-bond') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box bg-gradient-compliance mx-auto mb-3 shadow"><i class="fas fa-check-double"></i></div>
                    <h5 class="fw-bold text-dark">Compliance Bond</h5>
                    <p class="text-muted small mb-0">Formulir penilaian kepatuhan</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <a href="<?= base_url('staff/input-data-audit/risk-bond') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box bg-gradient-risk mx-auto mb-3 shadow"><i class="fas fa-exclamation-triangle"></i></div>
                    <h5 class="fw-bold text-dark">Risk Bond</h5>
                    <p class="text-muted small mb-0">Formulir penilaian risiko</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4">
        <a href="<?= base_url('staff/input-data-audit/formulir-insiden') ?>" class="text-decoration-none">
            <div class="card shortcut-card shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="icon-box bg-gradient-incident mx-auto mb-3 shadow"><i class="fas fa-fire-extinguisher"></i></div>
                    <h5 class="fw-bold text-dark">Formulir Insiden</h5>
                    <p class="text-muted small mb-0">Pelaporan insiden & kejadian</p>
                </div>
            </div>
        </a>
    </div>
</div>

<?= $this->endSection() ?>