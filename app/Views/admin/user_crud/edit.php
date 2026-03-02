<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-white border-bottom rounded-top-4 py-3">
                <h4 class="card-title text-primary m-0"><i class="fas fa-user-edit me-2"></i>Edit User</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('admin/users/update/'.$user['id']) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="text-center mb-4">
                        <div class="avatar avatar-xl bg-light p-1 rounded-circle shadow border border-3 border-white">
                            <img src="<?= base_url('uploads/profiles/' . $user['foto']) ?>" alt="Foto" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= esc($user['username']) ?>" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Password Baru</label>
                        <input type="password" class="form-control" name="password">
                        <small class="text-danger fst-italic">*Kosongkan jika tidak ingin mengubah password</small>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" value="<?= esc($user['nama_lengkap']) ?>" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Level Akses</label>
                        <select class="form-select" name="level" required>
                            <option value="ADMIN" <?= $user['level'] == 'ADMIN' ? 'selected' : '' ?>>ADMIN</option>
                            <option value="PIMPINAN TINGGI" <?= $user['level'] == 'PIMPINAN TINGGI' ? 'selected' : '' ?>>PIMPINAN TINGGI</option>
                            <option value="MANAGERIAL" <?= $user['level'] == 'MANAGERIAL' ? 'selected' : '' ?>>MANAGERIAL</option>
                            <option value="SUPERVISOR" <?= $user['level'] == 'SUPERVISOR' ? 'selected' : '' ?>>SUPERVISOR</option>
                            <option value="KEPALA UNIT" <?= $user['level'] == 'KEPALA UNIT' ? 'selected' : '' ?>>KEPALA UNIT</option>
                            <option value="STAFF" <?= $user['level'] == 'STAFF' ? 'selected' : '' ?>>STAFF</option>
                        </select>
                    </div>

                    <div class="form-group mb-5">
                        <label class="fw-bold text-muted mb-2">Ganti Foto Profil</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-light rounded-pill px-4 shadow-sm"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm"><i class="fas fa-save me-2"></i>Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>