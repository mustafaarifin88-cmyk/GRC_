<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #F2994A, #F2C94C);">
                <h4 class="card-title text-dark m-0 fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Internal GRC: Risk Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/risk-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">Informasi & Penilaian Risiko</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Judul Risiko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Kategori Risiko</label>
                            <input type="text" class="form-control" name="kategori">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Deskripsi Risiko</label>
                            <textarea class="form-control" name="deskripsi" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Penyebab</label>
                            <textarea class="form-control" name="penyebab" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Dampak</label>
                            <textarea class="form-control" name="dampak" rows="2"></textarea>
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Kemungkinan</label>
                            <input type="text" class="form-control" name="kemungkinan">
                        </div>
                        <div class="col-md-3 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tingkat Risiko</label>
                            <select class="form-select border-warning" name="tingkat">
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Periode Penilaian</label>
                            <input type="text" class="form-control" name="periode_penilaian">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Metode Penilaian</label>
                            <select class="form-select" name="metode_penilaian">
                                <option value="Kualitatif">Kualitatif</option>
                                <option value="Kuantitatif">Kuantitatif</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Nilai Risiko (Setelah Mitigasi)</label>
                            <input type="number" class="form-control fw-bold text-center border-primary" name="nilai_risiko" step="0.1">
                        </div>
                    </div>

                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-4 mt-5">Rencana & Pemantauan Mitigasi Risiko</h5>
                    <div class="row p-4 rounded-4 mb-4 shadow-sm border border-warning border-opacity-50">
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Mitigasi</label>
                            <textarea class="form-control" name="mitigasi_tindakan" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Penanggung Jawab</label>
                            <input type="text" class="form-control" name="mitigasi_pj">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jadwal Pelaksanaan</label>
                            <input type="date" class="form-control" name="mitigasi_jadwal">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Biaya (Rp)</label>
                            <input type="number" class="form-control" name="mitigasi_biaya">
                        </div>
                        
                        <div class="col-md-12 mt-3 mb-2"><h6 class="fw-bold text-primary border-bottom pb-2">Pemantauan Risiko</h6></div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Indikator Kunci (KRI)</label>
                            <input type="text" class="form-control" name="pantau_kri">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Ambang Batas (Threshold)</label>
                            <input type="text" class="form-control" name="pantau_ambang">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Frekuensi Pemantauan</label>
                            <input type="text" class="form-control" name="pantau_frekuensi">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Hasil Pemantauan</label>
                            <textarea class="form-control" name="pantau_hasil" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Lanjutan</label>
                            <textarea class="form-control" name="pantau_tindakan" rows="2"></textarea>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Darurat Dilakukan</label>
                            <textarea class="form-control border-danger border-opacity-50" name="tindakan_darurat" rows="2"></textarea>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Lampiran (Foto/PDF)</label>
                            <input type="file" class="form-control" name="lampiran[]" multiple>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-warning btn-lg rounded-pill shadow-sm border-0 fw-bold" style="background: linear-gradient(135deg, #F2994A, #F2C94C);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Risk Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>