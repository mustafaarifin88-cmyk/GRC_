<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #cb2d3e, #ef473a);">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-car-crash me-2"></i>Internal GRC: Incident Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/incident-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4">Informasi Insiden</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border border-danger border-opacity-25">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Judul Laporan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tanggal & Waktu Kejadian</label>
                            <input type="datetime-local" class="form-control" name="tgl_waktu">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Lokasi Kejadian</label>
                            <input type="text" class="form-control" name="lokasi">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jenis Insiden</label>
                            <input type="text" class="form-control" name="jenis">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Deskripsi Kejadian</label>
                            <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Dampak</label>
                            <input type="text" class="form-control" name="dampak">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Pihak Terlibat</label>
                            <input type="text" class="form-control" name="pihak_terlibat">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Darurat Dilakukan</label>
                            <textarea class="form-control border-danger" name="tindakan_darurat" rows="2"></textarea>
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4 mt-5">Analisis Akar Masalah (RCA) & Tindakan</h5>
                    <div class="row p-4 rounded-4 mb-4 shadow-sm border border-primary border-opacity-25">
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Metode Analisis</label>
                            <input type="text" class="form-control" name="rca_metode">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Faktor Penyebab</label>
                            <input type="text" class="form-control" name="rca_faktor_penyebab">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Faktor Kontributor</label>
                            <input type="text" class="form-control" name="rca_faktor_kontributor">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Jangka Pendek</label>
                            <textarea class="form-control" name="tp_pendek" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Jangka Panjang</label>
                            <textarea class="form-control" name="tp_panjang" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Penanggung Jawab Perbaikan</label>
                            <input type="text" class="form-control" name="tp_pj">
                        </div>
                    </div>

                    <h5 class="fw-bold text-success border-bottom pb-2 mb-4 mt-5">Pemulihan (Recovery)</h5>
                    <div class="row bg-success bg-opacity-10 p-4 rounded-4 mb-4 border border-success border-opacity-25">
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Langkah-Langkah Pemulihan</label>
                            <textarea class="form-control" name="pemulihan_langkah" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Biaya Pemulihan (Rp)</label>
                            <input type="number" class="form-control" name="pemulihan_biaya">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Waktu Pemulihan</label>
                            <input type="text" class="form-control" name="pemulihan_waktu">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Darurat Tambahan</label>
                            <input type="text" class="form-control" name="pemulihan_darurat">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Lampiran Bukti Insiden (Foto/PDF)</label>
                            <input type="file" class="form-control border-success" name="lampiran[]" multiple>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-danger btn-lg rounded-pill shadow-sm border-0 fw-bold text-white" style="background: linear-gradient(135deg, #cb2d3e, #ef473a);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Incident Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>