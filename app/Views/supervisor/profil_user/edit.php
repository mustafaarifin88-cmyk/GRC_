<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0 rounded-4 overflow-hidden">
            <div class="card-header border-bottom-0 py-4 text-center position-relative" style="background: linear-gradient(135deg, #0f0c29 0%, #24243e 100%);">
                <div class="avatar avatar-2xl bg-white p-1 rounded-circle shadow position-absolute" style="bottom: -50px; left: 50%; transform: translateX(-50%);">
                    <img src="<?= base_url('uploads/profiles/' . $user['foto']) ?>" alt="Foto User" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                </div>
            </div>
            <div class="card-body p-4 pt-5 mt-4">
                <form action="<?= base_url('supervisor/profil/update') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-dark"><?= esc($user['nama_lengkap']) ?></h4>
                        <span class="badge rounded-pill px-3 text-white" style="background-color: #302b63;"><?= esc($user['level']) ?></span>
                    </div>
                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Username</label>
                        <input type="text" class="form-control bg-light" value="<?= esc($user['username']) ?>" readonly>
                    </div>
                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Ganti Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password baru">
                    </div>
                    <div class="form-group mb-5">
                        <label class="fw-bold text-muted mb-2">Ganti Foto Profil</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn text-white btn-lg rounded-pill shadow-sm" style="background: linear-gradient(135deg, #0f0c29, #24243e);"><i class="fas fa-save me-2"></i>Update Profil Saya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>