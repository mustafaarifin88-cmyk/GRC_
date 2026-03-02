<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #11998e, #38ef7d);">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-check-double me-2"></i>Internal GRC: Compliance Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/compliance-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-success border-bottom pb-2 mb-4">Informasi Peraturan & Kebijakan Internal</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Nama Peraturan</label>
                            <input type="text" class="form-control" name="nama_peraturan">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">No/Kode Peraturan</label>
                            <input type="text" class="form-control" name="no_peraturan">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Deskripsi Singkat</label>
                            <textarea class="form-control" name="deskripsi" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Kategori</label>
                            <select class="form-select" name="kategori">
                                <option value="Hukum">Hukum</option>
                                <option value="Industri">Industri</option>
                                <option value="Internal">Internal</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Nama Kebijakan Internal</label>
                            <input type="text" class="form-control" name="kebijakan_nama">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">No/Kode Kebijakan</label>
                            <input type="text" class="form-control" name="kebijakan_no">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Penerbitan</label>
                            <input type="date" class="form-control" name="kebijakan_tgl_terbit">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Efektif</label>
                            <input type="date" class="form-control" name="kebijakan_tgl_efektif">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">File Kebijakan (PDF)</label>
                            <input type="file" class="form-control border-success" name="kebijakan_file[]" multiple accept=".pdf">
                        </div>
                    </div>

                    <h5 class="fw-bold text-success border-bottom pb-2 mb-4 mt-5">Penilaian Kepatuhan & Celah</h5>
                    <div class="row p-4 rounded-4 mb-4 shadow-sm border border-success border-opacity-25">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Area Penilaian</label>
                            <select class="form-select" name="id_area" required>
                                <option value="">-- Pilih Area --</option>
                                <?php foreach($areas as $area): ?>
                                    <option value="<?= $area['id'] ?>"><?= esc($area['nama_area']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Periode Penilaian</label>
                            <input type="text" class="form-control" name="periode_penilaian" placeholder="Cth: Semester 1 2024">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Status Kepatuhan</label>
                            <select class="form-select border-warning shadow-sm" name="status_kepatuhan">
                                <option value="Memenuhi">Memenuhi</option>
                                <option value="Sebagian">Sebagian</option>
                                <option value="Tidak Memenuhi">Tidak Memenuhi</option>
                            </select>
                        </div>
                        <div class="col-md-8 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Catatan Kepatuhan</label>
                            <input type="text" class="form-control" name="kepatuhan_catatan">
                        </div>
                        <div class="col-md-12 form-group mb-4">
                            <label class="fw-bold text-muted mb-2">Bukti Kepatuhan Saat Ini (Foto/PDF)</label>
                            <input type="file" class="form-control" name="kepatuhan_bukti[]" multiple>
                        </div>

                        <div class="col-md-12 mb-2"><h6 class="fw-bold text-danger">Rencana Perbaikan Celah</h6></div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Perbaikan</label>
                            <textarea class="form-control" name="celah_tindakan" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jadwal Pelaksanaan</label>
                            <input type="date" class="form-control" name="celah_jadwal">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Status Celah</label>
                            <select class="form-select" name="celah_status">
                                <option value="Belum Dimulai">Belum Dimulai</option>
                                <option value="Dalam Proses">Dalam Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>

                    <h5 class="fw-bold text-info border-bottom pb-2 mb-4 mt-5">Bukti Kepatuhan & Verifikasi Lanjutan</h5>
                    <div class="row bg-info bg-opacity-10 p-4 rounded-4 mb-4 border border-info border-opacity-25">
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Tgl Pelaksanaan Bukti</label>
                            <input type="date" class="form-control" name="bk_tgl">
                        </div>
                        <div class="col-md-8 form-group mb-3">
                            <label class="fw-bold mb-2">Deskripsi Tindakan yang Dilakukan</label>
                            <input type="text" class="form-control" name="bk_deskripsi">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Dokumen Pendukung</label>
                            <input type="file" class="form-control" name="bk_dokumen[]" multiple>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Lampiran Tambahan</label>
                            <input type="file" class="form-control" name="bk_lampiran[]" multiple>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Darurat Dilakukan</label>
                            <textarea class="form-control" name="bk_tindakan_darurat" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm border-0" style="background: linear-gradient(135deg, #11998e, #38ef7d);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Compliance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>