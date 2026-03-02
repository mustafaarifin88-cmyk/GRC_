<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #1e3c72, #2a5298);">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-search me-2"></i>Internal GRC: Audit Bond</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/internal-grc/audit-bond/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4">Informasi Umum Audit</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">No. Identifikasi/Lisensi</label>
                            <input type="text" class="form-control" name="no_lisensi">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Organisasi</label>
                            <input type="text" class="form-control" name="organisasi">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Penugasan</label>
                            <input type="date" class="form-control" name="tgl_penugasan">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jadwal Audit Tahunan</label>
                            <input type="text" class="form-control" name="jadwal_audit_tahunan" placeholder="Cth: Q1 2024">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Area Diaudit</label>
                            <select class="form-select" name="id_area" required>
                                <option value="">-- Pilih Area --</option>
                                <?php foreach($areas as $area): ?>
                                    <option value="<?= $area['id'] ?>"><?= esc($area['nama_area']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Periode Mulai</label>
                            <input type="date" class="form-control" name="periode_mulai">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Periode Selesai</label>
                            <input type="date" class="form-control" name="periode_selesai">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Lokasi Pemeriksaan</label>
                            <select class="form-select" name="id_lokasi">
                                <option value="">-- Pilih Lokasi --</option>
                                <?php foreach($lokasi as $lok): ?>
                                    <option value="<?= $lok['id'] ?>"><?= esc($lok['nama_lokasi']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tujuan Audit</label>
                            <textarea class="form-control" name="tujuan_audit" rows="2"></textarea>
                        </div>
                        <div class="col-md-8 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Hasil Audit Lapangan (Singkat)</label>
                            <input type="text" class="form-control" name="hasil_audit_lapangan">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tanggal Pemeriksaan</label>
                            <input type="date" class="form-control" name="tgl_pemeriksaan">
                        </div>
                    </div>

                    <h5 class="fw-bold text-primary border-bottom pb-2 mb-4 mt-5">Daftar Periksa (Checklist)</h5>
                    <div class="p-3 bg-white rounded-4 border shadow-sm mb-3">
                        <p class="fw-bold">1. Kebijakan dan prosedur terdokumentasi dan terkini</p>
                        <div class="d-flex gap-4 mb-2">
                            <div class="form-check"><input class="form-check-input" type="radio" name="item_1_ceklis" value="Sesuai" required><label class="text-success fw-bold">Sesuai</label></div>
                            <div class="form-check"><input class="form-check-input" type="radio" name="item_1_ceklis" value="Tidak Sesuai" required><label class="text-danger fw-bold">Tidak Sesuai</label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><input type="file" class="form-control form-control-sm" name="item_1_file[]" multiple></div>
                            <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="item_1_catatan" placeholder="Catatan"></div>
                        </div>
                    </div>
                    <div class="p-3 bg-white rounded-4 border shadow-sm mb-3">
                        <p class="fw-bold">2. Akses fisik ke area terbatas hanya untuk personel yang berwenang</p>
                        <div class="d-flex gap-4 mb-2">
                            <div class="form-check"><input class="form-check-input" type="radio" name="item_2_ceklis" value="Sesuai" required><label class="text-success fw-bold">Sesuai</label></div>
                            <div class="form-check"><input class="form-check-input" type="radio" name="item_2_ceklis" value="Tidak Sesuai" required><label class="text-danger fw-bold">Tidak Sesuai</label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><input type="file" class="form-control form-control-sm" name="item_2_file[]" multiple></div>
                            <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="item_2_catatan" placeholder="Catatan"></div>
                        </div>
                    </div>
                    <div class="p-3 bg-white rounded-4 border shadow-sm mb-4">
                        <p class="fw-bold">3. Sistem pengawasan (CCTV) berfungsi dengan baik</p>
                        <div class="d-flex gap-4 mb-2">
                            <div class="form-check"><input class="form-check-input" type="radio" name="item_3_ceklis" value="Sesuai" required><label class="text-success fw-bold">Sesuai</label></div>
                            <div class="form-check"><input class="form-check-input" type="radio" name="item_3_ceklis" value="Tidak Sesuai" required><label class="text-danger fw-bold">Tidak Sesuai</label></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><input type="file" class="form-control form-control-sm" name="item_3_file[]" multiple></div>
                            <div class="col-md-6"><input type="text" class="form-control form-control-sm" name="item_3_catatan" placeholder="Catatan"></div>
                        </div>
                    </div>

                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4 mt-5">Temuan</h5>
                    <div class="row bg-danger bg-opacity-10 p-4 rounded-4 mb-4 border border-danger border-opacity-25">
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Deskripsi Temuan</label>
                            <textarea class="form-control" name="temuan_deskripsi" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Kategori Temuan</label>
                            <input type="text" class="form-control" name="temuan_kategori">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Dampak</label>
                            <input type="text" class="form-control" name="temuan_dampak">
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Bukti Temuan (Foto/Dokumen)</label>
                            <input type="file" class="form-control border-danger" name="temuan_bukti[]" multiple>
                        </div>
                    </div>

                    <h5 class="fw-bold text-info border-bottom pb-2 mb-4 mt-5">Rencana & Bukti Tindak Lanjut</h5>
                    <div class="row bg-info bg-opacity-10 p-4 rounded-4 mb-4 border border-info border-opacity-25">
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Akar Masalah (Root Cause)</label>
                            <textarea class="form-control" name="rtl_akar_masalah" rows="2"></textarea>
                        </div>
                        <div class="col-md-12 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Perbaikan</label>
                            <textarea class="form-control" name="rtl_tindakan" rows="2"></textarea>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Penanggung Jawab</label>
                            <input type="text" class="form-control" name="rtl_pj">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Jadwal Pelaksanaan</label>
                            <input type="date" class="form-control" name="rtl_jadwal">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Status</label>
                            <select class="form-select" name="rtl_status">
                                <option value="Belum Dimulai">Belum Dimulai</option>
                                <option value="Dalam Proses">Dalam Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="fw-bold mb-2">Tgl Pelaksanaan Bukti</label>
                            <input type="date" class="form-control" name="rtl_tgl_pelaksanaan">
                        </div>
                        <div class="col-md-8 form-group mb-3">
                            <label class="fw-bold mb-2">Deskripsi Tindakan (Bukti)</label>
                            <input type="text" class="form-control" name="rtl_deskripsi">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Dokumen Pendukung Tindak Lanjut</label>
                            <input type="file" class="form-control" name="rtl_dokumen[]" multiple>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold mb-2">Tindakan Darurat Dilakukan</label>
                            <input type="text" class="form-control" name="tindakan_darurat">
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm border-0" style="background: linear-gradient(135deg, #1e3c72, #2a5298);"><i class="fas fa-paper-plane me-2"></i>Kirim Internal Audit Bond</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>