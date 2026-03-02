<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-white border-bottom rounded-top-4 py-3">
                <h4 class="card-title text-primary m-0"><i class="fas fa-building me-2"></i>Profil Perusahaan</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('admin/profil-perusahaan/update') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $company['id'] ?? '' ?>">
                    
                    <div class="text-center mb-4">
                        <img src="<?= base_url('uploads/company_logo/' . ($company['logo'] ?? 'default-logo.png')) ?>" alt="Logo Perusahaan" class="rounded-3 shadow-sm" style="max-height: 150px; object-fit: contain;">
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Nama Perusahaan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-industry text-primary"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" name="nama_perusahaan" value="<?= esc($company['nama_perusahaan'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Alamat Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-map-marker-alt text-danger"></i></span>
                            <textarea class="form-control border-start-0 ps-0" name="alamat" rows="3" required><?= esc($company['alamat'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Nama Pimpinan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-user-tie text-success"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" name="nama_pimpinan" value="<?= esc($company['nama_pimpinan'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <label class="fw-bold text-muted mb-2">Ganti Logo Perusahaan</label>
                        <input type="file" class="form-control" name="logo" accept="image/*">
                        <small class="text-muted fst-italic">*Kosongkan jika tidak ingin mengubah logo</small>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>