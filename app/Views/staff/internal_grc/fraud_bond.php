<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #8E2DE2, #4A00E0);">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-user-secret me-2"></i>Internal GRC: Fraud Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/fraud-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4">Laporan Dugaan Kecurangan</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Judul Pelaporan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Pelaporan</label>
                            <input type="date" class="form-control" name="tgl_pelaporan">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Identitas Pelapor</label>
                            <select class="form-select border-danger" name="pelapor">
                                <option value="Anonim">Anonim (Rahasiakan Identitas)</option>
                                <option value="Identitas Terungkap">Identitas Terungkap</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Pihak yang Diduga</label>
                            <input type="text" class="form-control" name="pihak_diduga">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Deskripsi Kejadian Secara Rinci <span class="text-danger">*</span></label>
                            <textarea class="form-control border-danger border-opacity-25" name="deskripsi" rows="4" required></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Estimasi Nilai Kerugian (Rp)</label>
                            <input type="number" class="form-control" name="nilai_kerugian">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Bukti Awal Kecurangan (Foto/PDF)</label>
                            <input type="file" class="form-control border-primary" name="bukti[]" multiple>
                        </div>
                    </div>

                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4 mt-5">Tindakan & Penyelidikan (Kesimpulan)</h5>
                    <div class="row bg-danger bg-opacity-10 p-4 rounded-4 mb-4 border border-danger border-opacity-25">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Korektif</label>
                            <textarea class="form-control" name="tindakan_korektif" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Disiplin</label>
                            <textarea class="form-control" name="tindakan_disiplin" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Tuntutan Hukum</label>
                            <input type="text" class="form-control" name="tuntutan_hukum">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Perbaikan Sistem</label>
                            <input type="text" class="form-control" name="perbaikan_sistem">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Peningkatan Kontrol</label>
                            <input type="text" class="form-control" name="peningkatan_kontrol">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Darurat Dilakukan</label>
                            <input type="text" class="form-control" name="tindakan_darurat">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Lampiran Tambahan Penyelidikan</label>
                            <input type="file" class="form-control" name="lampiran[]" multiple>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm border-0 fw-bold text-white" style="background: linear-gradient(135deg, #8E2DE2, #4A00E0);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Fraud Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>