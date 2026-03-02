<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-danger text-white border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #cb2d3e, #ef473a);">
                <h4 class="card-title text-white m-0 fw-bold"><i class="fas fa-fire-extinguisher me-2"></i>Formulir Pelaporan Insiden</h4>
            </div>
            <div class="card-body p-4 pt-5">
                <form action="<?= base_url('staff/input-data-audit/formulir-insiden/store') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4">Informasi Pelaporan</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 form-group">
                            <label class="fw-bold text-muted mb-2">Judul Laporan Insiden <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="judul" required placeholder="Cth: Kebocoran Pipa di Area Produksi">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="fw-bold text-muted mb-2">Informasi/Label Pelaporan</label>
                            <input type="text" class="form-control" name="informasi_pelaporan" placeholder="Cth: Laporan Insiden K3">
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Waktu & Tanggal Kejadian <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="tanggal_waktu_kejadian" required>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <label class="fw-bold text-muted mb-2">Lokasi Kejadian <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_lokasi" required>
                                <option value="">-- Pilih Lokasi --</option>
                                <?php foreach($lokasi as $lok): ?>
                                    <option value="<?= $lok['id'] ?>"><?= esc($lok['nama_lokasi']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4 mt-5">Detail Insiden</h5>
                    <div class="row bg-light p-4 rounded-4 mb-4 shadow-sm border">
                        <div class="col-md-12 form-group mb-4">
                            <label class="fw-bold text-muted mb-2">Deskripsi Kronologi Kejadian <span class="text-danger">*</span></label>
                            <textarea class="form-control border-danger border-opacity-25" name="deskripsi_kejadian" rows="4" required placeholder="Ceritakan secara detail bagaimana insiden ini bisa terjadi..."></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Jenis Insiden <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenis_insiden" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Keamanan">Keamanan (Security)</option>
                                <option value="Operasional">Operasional / Kerusakan Mesin</option>
                                <option value="Lingkungan">Lingkungan (K3)</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Dampak Insiden <span class="text-danger">*</span></label>
                            <select class="form-select" name="dampak" required>
                                <option value="">-- Pilih Dampak --</option>
                                <option value="Rendah">Rendah (Low)</option>
                                <option value="Sedang">Sedang (Medium)</option>
                                <option value="Tinggi">Tinggi (High/Fatal)</option>
                            </select>
                        </div>
                    </div>

                    <h5 class="fw-bold text-danger border-bottom pb-2 mb-4 mt-5">Penanganan & Bukti</h5>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Pihak/Orang yang Terlibat</label>
                            <textarea class="form-control" name="pihak_terlibat" rows="2" placeholder="Sebutkan nama atau bagian yang terlibat..."></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="fw-bold text-muted mb-2">Tindakan Darurat yang Telah Dilakukan</label>
                            <textarea class="form-control" name="tindakan_darurat" rows="2" placeholder="Cth: Menghentikan mesin, memanggil P3K, dll."></textarea>
                        </div>
                        <div class="col-md-12 form-group mt-3">
                            <label class="fw-bold text-muted mb-2"><i class="fas fa-camera me-2"></i>Lampiran Bukti (Foto/Video/PDF)</label>
                            <input type="file" class="form-control border-danger" name="lampiran_bukti[]" multiple accept=".pdf,.jpg,.png,.jpeg,.mp4" required>
                            <small class="text-danger mt-1 d-block fst-italic">*Wajib melampirkan minimal 1 bukti visual/dokumen atas insiden yang terjadi.</small>
                        </div>
                    </div>

                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-danger btn-lg rounded-pill shadow-sm border-0" style="background: linear-gradient(135deg, #cb2d3e, #ef473a);"><i class="fas fa-paper-plane me-2"></i>Kirim Laporan Insiden Darurat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>