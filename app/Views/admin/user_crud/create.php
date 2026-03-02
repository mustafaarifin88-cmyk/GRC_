<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-white border-bottom rounded-top-4 py-3">
                <h4 class="card-title text-primary m-0"><i class="fas fa-user-plus me-2"></i>Tambah User Baru</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('admin/users/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Username</label>
                        <input type="text" class="form-control" name="username" required autocomplete="off">
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Level Akses</label>
                        <select class="form-select" name="level" required>
                            <option value="">-- Pilih Level --</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="PIMPINAN TINGGI">PIMPINAN TINGGI</option>
                            <option value="MANAGERIAL">MANAGERIAL</option>
                            <option value="SUPERVISOR">SUPERVISOR</option>
                            <option value="KEPALA UNIT">KEPALA UNIT</option>
                            <option value="STAFF">STAFF</option>
                        </select>
                    </div>

                    <div class="form-group mb-5">
                        <label class="fw-bold text-muted mb-2">Foto Profil</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-light rounded-pill px-4 shadow-sm"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm"><i class="fas fa-save me-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>