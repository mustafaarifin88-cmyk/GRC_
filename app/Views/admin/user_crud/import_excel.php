<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-success text-white rounded-top-4 py-3 text-center">
                <h4 class="card-title text-white m-0"><i class="fas fa-file-excel me-2"></i>Import Data User</h4>
            </div>
            <div class="card-body p-5 text-center">
                <i class="fas fa-cloud-upload-alt text-success mb-3" style="font-size: 4rem;"></i>
                <p class="text-muted mb-4">Pilih file Excel (.xlsx) yang berisi data user. Pastikan format kolom sesuai: <br><b>Kolom A: Username, Kolom B: Password, Kolom C: Nama Lengkap, Kolom D: Level</b>.</p>
                
                <form action="<?= base_url('admin/users/import') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group mb-4">
                        <input type="file" class="form-control form-control-lg border-success" name="file_excel" accept=".xlsx, .xls" required>
                    </div>
                    
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="<?= base_url('admin/users') ?>" class="btn btn-light rounded-pill px-4 shadow-sm">Batal</a>
                        <button type="submit" class="btn btn-success rounded-pill px-5 shadow-sm"><i class="fas fa-upload me-2"></i>Import Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>