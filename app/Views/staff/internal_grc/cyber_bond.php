<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #0f2027, #2c5364);">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-shield-virus me-2"></i>Internal GRC: Cyber Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/cyber-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">Penilaian Risiko Keamanan Siber</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border border-secondary border-opacity-25">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Aset yang Dinilai <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="aset" required placeholder="Cth: Server Database Utama">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Ancaman</label>
                            <input type="text" class="form-control" name="ancaman">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Kerentanan (Vulnerability)</label>
                            <textarea class="form-control" name="kerentanan" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Dampak</label>
                            <input type="text" class="form-control" name="dampak">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tingkat Risiko</label>
                            <input type="text" class="form-control" name="tingkat">
                        </div>
                    </div>

                    <h5 class="fw-bold text-info border-bottom pb-2 mb-4 mt-5">Kontrol & Pemantauan Keamanan</h5>
                    <div class="row p-4 rounded-4 mb-4 shadow-sm border border-info border-opacity-25">
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jenis Kontrol</label>
                            <select class="form-select border-info" name="kontrol_jenis">
                                <option value="Teknis">Teknis (IT)</option>
                                <option value="Administratif">Administratif</option>
                                <option value="Fisik">Fisik</option>
                            </select>
                        </div>
                        <div class="col-md-8 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Deskripsi Kontrol</label>
                            <input type="text" class="form-control" name="kontrol_deskripsi">
                        </div>
                        
                        <div class="col-md-12 mt-3 mb-2"><h6 class="fw-bold text-primary">Status Pemantauan</h6></div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Log Sistem (Monitoring)</label>
                            <input type="text" class="form-control" name="pantau_log">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Deteksi Intrusi (IDS/IPS)</label>
                            <input type="text" class="form-control" name="pantau_deteksi">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Analisis Kerentanan</label>
                            <input type="text" class="form-control" name="pantau_analisis">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Uji Penetrasi (Pentest)</label>
                            <input type="text" class="form-control" name="pantau_uji">
                        </div>
                    </div>

                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4 mt-5">Insiden Keamanan Siber & Tindakan</h5>
                    <div class="row bg-danger bg-opacity-10 p-4 rounded-4 mb-4 border border-danger border-opacity-25">
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Jenis Serangan</label>
                            <input type="text" class="form-control" name="insiden_jenis">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Target Serangan</label>
                            <input type="text" class="form-control" name="insiden_target">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Dampak Serangan</label>
                            <input type="text" class="form-control" name="insiden_dampak">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Penanganan</label>
                            <textarea class="form-control" name="insiden_penanganan" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Darurat yang Dilakukan</label>
                            <textarea class="form-control border-danger" name="tindakan_darurat" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Lampiran Log/Screenshot (Zip/PDF)</label>
                            <input type="file" class="form-control border-danger" name="lampiran[]" multiple>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-dark btn-lg rounded-pill shadow-sm border-0 fw-bold text-white" style="background: linear-gradient(135deg, #0f2027, #2c5364);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Cyber Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>