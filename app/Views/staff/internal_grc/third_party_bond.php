<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #3a1c71, #d76d77); color: white;">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-handshake me-2"></i>Internal GRC: Third Party Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/third-party-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4">Informasi Pihak Ketiga (Vendor)</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Nama Perusahaan Pihak Ketiga <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_perusahaan" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jenis Layanan</label>
                            <input type="text" class="form-control" name="jenis_layanan">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Kontak Utama</label>
                            <input type="text" class="form-control" name="kontak">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Mulai Kontrak</label>
                            <input type="date" class="form-control" name="tgl_mulai">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Berakhir Kontrak</label>
                            <input type="date" class="form-control" name="tgl_akhir">
                        </div>
                    </div>

                    <h5 class="fw-bold text-warning border-bottom pb-2 mb-4 mt-5">Penilaian Risiko & Klausul Kontrak</h5>
                    <div class="row p-4 rounded-4 mb-4 shadow-sm border border-warning border-opacity-25">
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jenis Risiko</label>
                            <select class="form-select border-warning" name="risiko_jenis">
                                <option value="Operasional">Operasional</option>
                                <option value="Keuangan">Keuangan</option>
                                <option value="Reputasi">Reputasi</option>
                                <option value="Kepatuhan">Kepatuhan</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tingkat Risiko</label>
                            <input type="text" class="form-control" name="risiko_tingkat">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Hasil Due Diligence</label>
                            <input type="text" class="form-control" name="due_diligence">
                        </div>

                        <div class="col-md-12 mt-3 mb-2"><h6 class="fw-bold text-dark">Klausul dalam Kontrak</h6></div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Klausul Keamanan</label>
                            <textarea class="form-control" name="klausul_keamanan" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Klausul Kepatuhan</label>
                            <textarea class="form-control" name="klausul_kepatuhan" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Klausul Hak Audit</label>
                            <textarea class="form-control" name="klausul_audit" rows="2"></textarea>
                        </div>
                    </div>

                    <h5 class="fw-bold text-success border-bottom pb-2 mb-4 mt-5">Pemantauan Kinerja & Tindakan</h5>
                    <div class="row bg-success bg-opacity-10 p-4 rounded-4 mb-4 border border-success border-opacity-25">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">KPI (Key Performance Indicator)</label>
                            <textarea class="form-control" name="pantau_kpi" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Laporan Kinerja Terakhir</label>
                            <textarea class="form-control" name="pantau_laporan" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Hasil Audit Pihak Ketiga</label>
                            <input type="text" class="form-control" name="pantau_audit">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Review Berkala</label>
                            <input type="text" class="form-control" name="pantau_review">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2 text-danger">Tindakan Darurat Terkait Pihak Ketiga</label>
                            <textarea class="form-control border-danger" name="tindakan_darurat" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Lampiran (Kontrak/Review - PDF)</label>
                            <input type="file" class="form-control border-success" name="lampiran[]" multiple>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm border-0 fw-bold text-white" style="background: linear-gradient(135deg, #3a1c71, #d76d77);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Third Party Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>