<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-warning border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #F2994A, #F2C94C);">
                <h4 class="card-title text-dark m-0 fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Formulir Risk Bond (Penilaian Risiko)</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/input-data-audit/risk-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">Informasi Risiko</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 form-group">
                            <label class="fw-bold text-muted mb-2">Judul Risiko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="fw-bold text-muted mb-2">Informasi Pendek Risiko</label>
                            <input type="text" class="form-control" name="informasi_risiko">
                        </div>
                        <div class="col-md-12 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Deskripsi Detail Risiko <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="deskripsi_risiko" rows="3" required></textarea>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Kategori Risiko <span class="text-danger">*</span></label>
                            <select class="form-select" name="kategori_risiko" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Operasional">Operasional</option>
                                <option value="Keuangan">Keuangan</option>
                                <option value="Reputasi">Reputasi</option>
                                <option value="Kepatuhan">Kepatuhan</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Penilaian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_penilaian" required>
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-4 mt-5">Analisis & Penilaian</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Penyebab</label>
                            <textarea class="form-control" name="penyebab" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Dampak yang Ditimbulkan</label>
                            <textarea class="form-control" name="dampak" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Kemungkinan Terjadi</label>
                            <select class="form-select" name="kemungkinan_terjadi">
                                <option value="Sangat Rendah">Sangat Rendah</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                                <option value="Sangat Tinggi">Sangat Tinggi</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Metode Penilaian</label>
                            <select class="form-select" name="metode_penilaian">
                                <option value="Kualitatif">Kualitatif</option>
                                <option value="Kuantitatif">Kuantitatif</option>
                            </select>
                        </div>
                        <div class="col-md-2 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Skala</label>
                            <select class="form-select" name="skala_penilaian" id="skalaVal">
                                <option value="1-5">1-5</option>
                                <option value="1-10">1-10</option>
                            </select>
                        </div>
                        <div class="col-md-2 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Nilai Risiko</label>
                            <input type="number" class="form-control border-warning bg-white fw-bold text-center" name="nilai_risiko" min="1" max="10" step="0.1" required>
                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">Tingkat Risiko Otomatis</small>
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-4 mt-5">Mitigasi Risiko</h5>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Mitigasi yang Sudah Dilakukan</label>
                            <textarea class="form-control" name="mitigasi_sudah" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Rekomendasi Tindakan Tambahan</label>
                            <textarea class="form-control" name="mitigasi_rekomendasi" rows="3"></textarea>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="fw-bold text-muted mb-2"><i class="fas fa-paperclip me-2"></i>Bukti/Dokumen Pendukung (Foto/PDF)</label>
                            <input type="file" class="form-control" name="mitigasi_bukti[]" multiple accept=".pdf,.jpg,.png,.jpeg">
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-warning text-dark fw-bold btn-lg rounded-pill shadow-sm border-0" style="background: linear-gradient(135deg, #F2994A, #F2C94C);"><i class="fas fa-paper-plane me-2"></i>Kirim Laporan Risiko</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.querySelector('input[name="nilai_risiko"]').addEventListener('input', function() {
        let maxVal = document.getElementById('skalaVal').value === '1-5' ? 5 : 10;
        if(parseFloat(this.value) > maxVal) {
            this.value = maxVal;
            alert('Nilai tidak boleh melebihi skala maksimal (' + maxVal + ')');
        }
    });

    document.getElementById('skalaVal').addEventListener('change', function() {
        document.querySelector('input[name="nilai_risiko"]').value = '';
    });
</script>
<?= $this->endSection() ?>