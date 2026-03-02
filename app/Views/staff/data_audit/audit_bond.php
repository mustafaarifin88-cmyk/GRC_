<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-primary text-white border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #0052D4, #4364F7);">
                <h4 class="card-title text-white m-0"><i class="fas fa-file-signature me-2"></i>Formulir Audit Bond (Hasil Audit Lapangan)</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/input-data-audit/audit-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4">Informasi Umum</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 form-group">
                            <label class="fw-bold text-muted mb-2">Judul Laporan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="fw-bold text-muted mb-2">Informasi Audit</label>
                            <input type="text" class="form-control" name="informasi_audit">
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Area yang Diaudit <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_area" required>
                                <option value="">-- Pilih Area --</option>
                                <?php foreach($areas as $area): ?>
                                    <option value="<?= $area['id'] ?>"><?= esc($area['nama_area']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Audit <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_audit" required>
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4 mt-5">Item Pemeriksaan</h5>
                    
                    <!-- Item 1 -->
                    <div class="p-4 bg-light rounded-4 mb-4 shadow-sm border">
                        <p class="fw-bold mb-3">1. Kebijakan dan prosedur terdokumentasi dan terkini</p>
                        <div class="d-flex gap-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_1_ceklis" value="Sesuai" id="i1_sesuai" required>
                                <label class="form-check-label text-success fw-bold" for="i1_sesuai">Sesuai</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_1_ceklis" value="Tidak Sesuai" id="i1_tidak" required>
                                <label class="form-check-label text-danger fw-bold" for="i1_tidak">Tidak Sesuai</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Upload Bukti (Otomatis set Sesuai jika ada file)</label>
                                <input type="file" class="form-control form-control-sm file-auto-check" data-target="item_1_ceklis" name="item_1_file[]" multiple accept=".pdf,.jpg,.png,.jpeg">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea class="form-control form-control-sm" name="item_1_catatan" rows="1"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="p-4 bg-light rounded-4 mb-4 shadow-sm border">
                        <p class="fw-bold mb-3">2. Akses fisik ke area terbatas hanya untuk personel yang berwenang</p>
                        <div class="d-flex gap-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_2_ceklis" value="Sesuai" id="i2_sesuai" required>
                                <label class="form-check-label text-success fw-bold" for="i2_sesuai">Sesuai</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_2_ceklis" value="Tidak Sesuai" id="i2_tidak" required>
                                <label class="form-check-label text-danger fw-bold" for="i2_tidak">Tidak Sesuai</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Upload Bukti (Otomatis set Sesuai jika ada file)</label>
                                <input type="file" class="form-control form-control-sm file-auto-check" data-target="item_2_ceklis" name="item_2_file[]" multiple accept=".pdf,.jpg,.png,.jpeg">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea class="form-control form-control-sm" name="item_2_catatan" rows="1"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="p-4 bg-light rounded-4 mb-4 shadow-sm border">
                        <p class="fw-bold mb-3">3. Sistem pengawasan (CCTV) berfungsi dengan baik</p>
                        <div class="d-flex gap-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_3_ceklis" value="Sesuai" id="i3_sesuai" required>
                                <label class="form-check-label text-success fw-bold" for="i3_sesuai">Sesuai</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_3_ceklis" value="Tidak Sesuai" id="i3_tidak" required>
                                <label class="form-check-label text-danger fw-bold" for="i3_tidak">Tidak Sesuai</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Upload Bukti (Otomatis set Sesuai jika ada file)</label>
                                <input type="file" class="form-control form-control-sm file-auto-check" data-target="item_3_ceklis" name="item_3_file[]" multiple accept=".pdf,.jpg,.png,.jpeg">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea class="form-control form-control-sm" name="item_3_catatan" rows="1"></textarea>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4 mt-5"><i class="fas fa-exclamation-circle me-2"></i>Bagian Temuan</h5>
                    <div class="row bg-danger bg-opacity-10 p-4 rounded-4 border border-danger border-opacity-25">
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Deskripsi Temuan</label>
                            <textarea class="form-control" name="temuan_deskripsi" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Kategori Temuan</label>
                            <select class="form-select" name="temuan_kategori">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Pelanggaran Kebijakan">Pelanggaran Kebijakan</option>
                                <option value="Kelemahan Kontrol">Kelemahan Kontrol</option>
                                <option value="Ketidakpatuhan">Ketidakpatuhan</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Dampak</label>
                            <select class="form-select" name="temuan_dampak">
                                <option value="">-- Pilih Dampak --</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Rekomendasi</label>
                            <textarea class="form-control" name="temuan_rekomendasi" rows="2"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="fw-bold mb-2">Bukti Lainnya (Bisa > 1)</label>
                            <input type="file" class="form-control" name="temuan_bukti[]" multiple accept=".pdf,.jpg,.png,.jpeg">
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm bg-gradient-primary border-0"><i class="fas fa-paper-plane me-2"></i>Kirim Laporan Audit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.querySelectorAll('.file-auto-check').forEach(input => {
        input.addEventListener('change', function() {
            let targetName = this.getAttribute('data-target');
            let radioSesuai = document.querySelector(`input[name="${targetName}"][value="Sesuai"]`);
            let radioTidak = document.querySelector(`input[name="${targetName}"][value="Tidak Sesuai"]`);
            
            if (this.files.length > 0) {
                radioSesuai.checked = true;
            } else {
                radioTidak.checked = true;
            }
        });
    });
</script>
<?= $this->endSection() ?>