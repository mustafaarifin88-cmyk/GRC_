<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #00b09b, #96c93d);">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-recycle me-2"></i>Internal GRC: Continuity Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/continuity-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-success border-bottom pb-2 mb-4">Analisis Dampak Bisnis (BIA)</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border border-success border-opacity-25">
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Proses Bisnis Kritis <span class="text-danger">*</span></label>
                            <textarea class="form-control border-success" name="bia_proses" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Dampak Keuangan</label>
                            <input type="text" class="form-control" name="bia_dampak_keuangan">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Dampak Operasional</label>
                            <input type="text" class="form-control" name="bia_dampak_operasional">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Target Waktu Pemulihan (RTO)</label>
                            <input type="text" class="form-control" name="bia_rto" placeholder="Cth: 4 Jam">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Target Titik Pemulihan (RPO)</label>
                            <input type="text" class="form-control" name="bia_rpo" placeholder="Cth: Toleransi data loss 1 jam">
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4 mt-5">Pemulihan Bencana (DRP) & Kelangsungan Bisnis (BCP)</h5>
                    <div class="row p-4 rounded-4 mb-4 shadow-sm border border-primary border-opacity-25">
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Lokasi Cadangan (DRP)</label>
                            <input type="text" class="form-control" name="drp_lokasi">
                        </div>
                        <div class="col-md-8 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Prosedur Pemulihan DRP</label>
                            <input type="text" class="form-control" name="drp_prosedur">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tim Pemulihan (DRP)</label>
                            <input type="text" class="form-control" name="drp_tim">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Kontak Darurat</label>
                            <input type="text" class="form-control" name="drp_kontak">
                        </div>

                        <div class="col-md-12 mt-3 mb-2"><h6 class="fw-bold text-info">Strategi Kelangsungan (BCP)</h6></div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Strategi Kelangsungan Bisnis</label>
                            <textarea class="form-control" name="bcp_strategi" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Prosedur Alternatif</label>
                            <input type="text" class="form-control" name="bcp_prosedur">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tim Kelangsungan BCP</label>
                            <input type="text" class="form-control" name="bcp_tim">
                        </div>
                    </div>

                    <h5 class="fw-bold text-warning border-bottom pb-2 mb-4 mt-5">Uji Coba & Lampiran</h5>
                    <div class="row bg-warning bg-opacity-10 p-4 rounded-4 mb-4 border border-warning border-opacity-25">
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Tanggal Uji Coba</label>
                            <input type="date" class="form-control" name="uji_tgl">
                        </div>
                        <div class="col-md-8 form-group mb-3">
                            <label class="fw-bold mb-2">Skenario Uji Coba</label>
                            <input type="text" class="form-control" name="uji_skenario">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Hasil Uji Coba</label>
                            <textarea class="form-control" name="uji_hasil" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Rekomendasi Perbaikan Hasil Uji</label>
                            <textarea class="form-control" name="uji_perbaikan" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2 text-danger">Tindakan Darurat Dilakukan</label>
                            <textarea class="form-control border-danger border-opacity-50" name="tindakan_darurat" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Lampiran Dokumen DRP/BCP (PDF)</label>
                            <input type="file" class="form-control border-warning" name="lampiran[]" multiple>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm border-0 fw-bold text-white" style="background: linear-gradient(135deg, #00b09b, #96c93d);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Continuity Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>