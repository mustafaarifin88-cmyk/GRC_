<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-white border-bottom rounded-top-4 py-3">
                <h4 class="card-title text-primary m-0"><i class="fas fa-paper-plane me-2"></i>Kirim Notifikasi Baru</h4>
            </div>
            <div class="card-body p-4">
                <p class="text-muted mb-4">Buat dan kirimkan notifikasi langsung ke dashboard pengguna. Anda dapat mengirim ke semua user sekaligus atau memilih user tertentu secara spesifik.</p>
                
                <form action="<?= base_url('admin/notifikasi/send') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Tujuan Notifikasi <span class="text-danger">*</span></label>
                        <select class="form-select border-primary shadow-sm" name="user_id[]" multiple required style="height: 180px;">
                            <option value="all" class="fw-bold text-primary mb-2">🚀 -- KIRIM KE SEMUA USER --</option>
                            <?php foreach($users as $user): ?>
                                <option value="<?= $user['id'] ?>"><?= esc($user['nama_lengkap']) ?> - [<?= $user['level'] ?>]</option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted fst-italic mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Tahan tombol <b>Ctrl</b> (Windows) atau <b>Cmd</b> (Mac) untuk memilih lebih dari satu user secara bersamaan.</small>
                    </div>

                    <div class="form-group mb-4">
                        <label class="fw-bold text-muted mb-2">Judul Notifikasi <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-heading text-primary"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" name="judul" required placeholder="Contoh: Info Update Kebijakan">
                        </div>
                    </div>

                    <div class="form-group mb-5">
                        <label class="fw-bold text-muted mb-2">Pesan Notifikasi <span class="text-danger">*</span></label>
                        <textarea class="form-control shadow-sm" name="pesan" rows="5" required placeholder="Ketikkan pesan detail notifikasi di sini..."></textarea>
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm bg-gradient-primary border-0" style="background: linear-gradient(135deg, #0052D4, #4364F7);">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>