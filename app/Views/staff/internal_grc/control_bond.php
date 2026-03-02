<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #4568dc, #b06ab3);">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-sliders-h me-2"></i>Internal GRC: Control Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/control-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4">Informasi & Penilaian Efektivitas Kontrol</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border border-primary border-opacity-25">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Nama Kontrol <span class="text-danger">*</span></label>
                            <input type="text" class="form-control border-primary" name="nama_kontrol" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Area yang Dicakup <span class="text-danger">*</span></label>
                            <select class="form-select border-primary" name="id_area" required>
                                <option value="">-- Pilih Area --</option>
                                <?php foreach($areas as $area): ?>
                                    <option value="<?= $area['id'] ?>"><?= esc($area['nama_area']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-8 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tujuan Kontrol</label>
                            <textarea class="form-control" name="tujuan_kontrol" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jenis Kontrol</label>
                            <select class="form-select" name="jenis_kontrol">
                                <option value="Preventif">Preventif</option>
                                <option value="Detektif">Detektif</option>
                                <option value="Korektif">Korektif</option>
                            </select>
                        </div>
                        
                        <div class="col-md-12 mt-3 mb-2"><h6 class="fw-bold text-info border-bottom pb-2">Penilaian Efektivitas</h6></div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Metode Penilaian</label>
                            <input type="text" class="form-control" name="nilai_metode">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Frekuensi Penilaian</label>
                            <input type="text" class="form-control" name="nilai_frekuensi">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Hasil Penilaian</label>
                            <input type="text" class="form-control border-info" name="nilai_hasil">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Bukti Penilaian Efektivitas (Upload)</label>
                            <input type="file" class="form-control border-info" name="nilai_bukti[]" multiple>
                        </div>
                    </div>

                    <h5 class="fw-bold text-warning border-bottom pb-2 mb-4 mt-5">Perbaikan & Pemantauan Kontrol</h5>
                    <div class="row p-4 rounded-4 mb-4 shadow-sm border border-warning border-opacity-50">
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Perbaikan Kontrol</label>
                            <textarea class="form-control" name="perbaikan_tindakan" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Penanggung Jawab Perbaikan</label>
                            <input type="text" class="form-control" name="perbaikan_pj">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jadwal Pelaksanaan Perbaikan</label>
                            <input type="date" class="form-control" name="perbaikan_jadwal">
                        </div>

                        <div class="col-md-12 mt-3 mb-2"><h6 class="fw-bold text-success border-bottom pb-2">Pemantauan Berkelanjutan (KCI)</h6></div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Indikator (KCI)</label>
                            <input type="text" class="form-control" name="pantau_kci">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Ambang Batas</label>
                            <input type="text" class="form-control" name="pantau_ambang">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Frekuensi Pemantauan</label>
                            <input type="text" class="form-control" name="pantau_frekuensi">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Hasil Pemantauan Terakhir</label>
                            <textarea class="form-control" name="pantau_hasil" rows="2"></textarea>
                        </div>
                        
                        <div class="col-md-6 form-group mb-3 mt-3">
                            <label class="fw-bold text-danger mb-2">Tindakan Darurat Dilakukan</label>
                            <textarea class="form-control border-danger" name="tindakan_darurat" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3 mt-3">
                            <label class="fw-bold text-muted mb-2">Lampiran Tambahan (File)</label>
                            <input type="file" class="form-control" name="lampiran[]" multiple>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm border-0 fw-bold text-white" style="background: linear-gradient(135deg, #4568dc, #b06ab3);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Control Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>