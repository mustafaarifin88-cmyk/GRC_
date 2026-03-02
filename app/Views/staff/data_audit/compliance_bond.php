<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-success text-white border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                <h4 class="card-title text-white m-0"><i class="fas fa-check-double me-2"></i>Formulir Compliance Bond (Penilaian Kepatuhan)</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/input-data-audit/compliance-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-success border-bottom pb-2 mb-4">Informasi Penilaian</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 form-group">
                            <label class="fw-bold text-muted mb-2">Judul Penilaian <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="fw-bold text-muted mb-2">Informasi Penilaian</label>
                            <input type="text" class="form-control" name="informasi_penilaian">
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Area Penilaian <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_area" required>
                                <option value="">-- Pilih Area --</option>
                                <?php foreach($areas as $area): ?>
                                    <option value="<?= $area['id'] ?>"><?= esc($area['nama_area']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Periode <span class="text-danger">*</span></label>
                            <select class="form-select" name="periode_penilaian" required>
                                <option value="">-- Pilih Periode --</option>
                                <option value="Bulanan">Bulanan</option>
                                <option value="Kuartalan">Kuartalan</option>
                                <option value="Tahunan">Tahunan</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Penilaian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_penilaian" required>
                        </div>
                    </div>

                    <h5 class="fw-bold text-success border-bottom pb-2 mb-4 mt-5">Daftar Persyaratan Kepatuhan</h5>
                    <div class="alert alert-info border-0 shadow-sm"><i class="fas fa-info-circle me-2"></i><strong>Auto-Check:</strong> Ceklis akan otomatis terisi "Tidak Memenuhi" (0 File), "Sebagian" (1 File), atau "Memenuhi" (>= 2 File) berdasarkan jumlah upload bukti.</div>
                    
                    <!-- Persyaratan 1 -->
                    <div class="p-4 bg-light rounded-4 mb-4 shadow-sm border">
                        <p class="fw-bold mb-3">1. Memiliki izin usaha yang sah</p>
                        <div class="d-flex gap-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_1_ceklis" value="Memenuhi" id="c1_m" required>
                                <label class="form-check-label text-success fw-bold" for="c1_m">Memenuhi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_1_ceklis" value="Sebagian" id="c1_s" required>
                                <label class="form-check-label text-warning fw-bold" for="c1_s">Sebagian</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_1_ceklis" value="Tidak Memenuhi" id="c1_t" required>
                                <label class="form-check-label text-danger fw-bold" for="c1_t">Tidak Memenuhi</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Upload Bukti (Max 3 File)</label>
                                <input type="file" class="form-control form-control-sm file-auto-level" data-target="item_1_ceklis" name="item_1_file[]" multiple accept=".pdf,.jpg,.png,.jpeg">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea class="form-control form-control-sm" name="item_1_catatan" rows="1"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Persyaratan 2 -->
                    <div class="p-4 bg-light rounded-4 mb-4 shadow-sm border">
                        <p class="fw-bold mb-3">2. Memenuhi standar keselamatan kerja</p>
                        <div class="d-flex gap-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_2_ceklis" value="Memenuhi" id="c2_m" required>
                                <label class="form-check-label text-success fw-bold" for="c2_m">Memenuhi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_2_ceklis" value="Sebagian" id="c2_s" required>
                                <label class="form-check-label text-warning fw-bold" for="c2_s">Sebagian</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_2_ceklis" value="Tidak Memenuhi" id="c2_t" required>
                                <label class="form-check-label text-danger fw-bold" for="c2_t">Tidak Memenuhi</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Upload Bukti (Max 3 File)</label>
                                <input type="file" class="form-control form-control-sm file-auto-level" data-target="item_2_ceklis" name="item_2_file[]" multiple accept=".pdf,.jpg,.png,.jpeg">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea class="form-control form-control-sm" name="item_2_catatan" rows="1"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Persyaratan 3 -->
                    <div class="p-4 bg-light rounded-4 mb-4 shadow-sm border">
                        <p class="fw-bold mb-3">3. Melaporkan pajak tepat waktu</p>
                        <div class="d-flex gap-4 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_3_ceklis" value="Memenuhi" id="c3_m" required>
                                <label class="form-check-label text-success fw-bold" for="c3_m">Memenuhi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_3_ceklis" value="Sebagian" id="c3_s" required>
                                <label class="form-check-label text-warning fw-bold" for="c3_s">Sebagian</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="item_3_ceklis" value="Tidak Memenuhi" id="c3_t" required>
                                <label class="form-check-label text-danger fw-bold" for="c3_t">Tidak Memenuhi</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Upload Bukti (Max 3 File)</label>
                                <input type="file" class="form-control form-control-sm file-auto-level" data-target="item_3_ceklis" name="item_3_file[]" multiple accept=".pdf,.jpg,.png,.jpeg">
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-muted small mb-1">Catatan Tambahan (Opsional)</label>
                                <textarea class="form-control form-control-sm" name="item_3_catatan" rows="1"></textarea>
                            </div>
                        </div>
                    </div>

                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4 mt-5"><i class="fas fa-exclamation-triangle me-2"></i>Celah Kepatuhan</h5>
                    <div class="row bg-warning bg-opacity-10 p-4 rounded-4 border border-warning border-opacity-50">
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Deskripsi Celah Kepatuhan</label>
                            <textarea class="form-control" name="celah_deskripsi" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Dampak</label>
                            <select class="form-select w-50" name="celah_dampak">
                                <option value="">-- Pilih Dampak --</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="fw-bold mb-2">Rekomendasi</label>
                            <textarea class="form-control" name="celah_rekomendasi" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm border-0" style="background: linear-gradient(135deg, #11998e, #38ef7d);"><i class="fas fa-paper-plane me-2"></i>Kirim Laporan Compliance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.querySelectorAll('.file-auto-level').forEach(input => {
        input.addEventListener('change', function() {
            let targetName = this.getAttribute('data-target');
            let count = this.files.length;
            
            if(count > 3) {
                alert("Maksimal upload adalah 3 file untuk form ini!");
                this.value = ""; // Reset
                count = 0;
            }

            if (count >= 2) {
                document.querySelector(`input[name="${targetName}"][value="Memenuhi"]`).checked = true;
            } else if (count == 1) {
                document.querySelector(`input[name="${targetName}"][value="Sebagian"]`).checked = true;
            } else {
                document.querySelector(`input[name="${targetName}"][value="Tidak Memenuhi"]`).checked = true;
            }
        });
    });
</script>
<?= $this->endSection() ?>