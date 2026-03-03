<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .stat-card {
        border: none;
        border-radius: 20px;
        color: white;
        transition: transform 0.3s;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .bg-gradient-1 { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .bg-gradient-2 { background: linear-gradient(135deg, #FF416C 0%, #FF4B2B 100%); }
    .bg-gradient-3 { background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%); }
    .bg-gradient-4 { background: linear-gradient(135deg, #f12711 0%, #f5af19 100%); }
    .stat-icon {
        font-size: 3rem;
        opacity: 0.5;
        position: absolute;
        right: 20px;
        bottom: 20px;
    }
</style>

<div class="row">
    <div class="col-12 col-lg-3 col-md-6 mb-4">
        <div class="card stat-card bg-gradient-1 shadow-lg">
            <div class="card-body px-4 py-4 position-relative">
                <h5 class="text-white mb-1">Total Users</h5>
                <h2 class="text-white fw-bold mb-0"><?= esc($total_users) ?></h2>
                <i class="fas fa-users stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 col-md-6 mb-4">
        <div class="card stat-card bg-gradient-2 shadow-lg">
            <div class="card-body px-4 py-4 position-relative">
                <h5 class="text-white mb-1">Total Laporan</h5>
                <h2 class="text-white fw-bold mb-0"><?= esc($total_laporan) ?></h2>
                <i class="fas fa-file-contract stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 col-md-6 mb-4">
        <div class="card stat-card bg-gradient-3 shadow-lg">
            <div class="card-body px-4 py-4 position-relative">
                <h5 class="text-white mb-1">Menunggu Approval</h5>
                <h2 class="text-white fw-bold mb-0"><?= esc($menunggu_approval) ?></h2>
                <i class="fas fa-clock stat-icon"></i>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 col-md-6 mb-4">
        <div class="card stat-card bg-gradient-4 shadow-lg">
            <div class="card-body px-4 py-4 position-relative">
                <h5 class="text-white mb-1">Risiko Tinggi</h5>
                <h2 class="text-white fw-bold mb-0"><?= esc($risiko_tinggi) ?></h2>
                <i class="fas fa-exclamation-triangle stat-icon"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 rounded-top-4">
                <h4 class="card-title text-primary"><i class="fas fa-bullhorn me-2"></i>Selamat Datang di GRC System</h4>
            </div>
            <div class="card-body mt-3">
                <p class="text-muted">Gunakan menu di sebelah kiri untuk mengelola perusahaan, mengatur hirarki pengguna, dan memantau laporan kepatuhan secara menyeluruh.</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>