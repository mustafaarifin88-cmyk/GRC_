<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <a href="<?= base_url('kepalaunit/approval') ?>" class="btn btn-light rounded-pill shadow-sm mb-3 fw-bold"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Approval</a>
        
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header text-white py-3 border-bottom-0" style="background: linear-gradient(135deg, #4b6cb7, #182848);">
                <h4 class="card-title text-white m-0"><i class="fas fa-file-alt me-2"></i>Review Detail Laporan</h4>
            </div>
            
            <div class="card-body p-4">
                <div class="alert alert-light border shadow-sm mb-4 d-flex align-items-center">
                    <div class="avatar avatar-lg me-3 border border-2 border-primary shadow-sm"><img src="<?= base_url('uploads/profiles/default-profile.png') ?>"></div>
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">Dibuat oleh: <?= esc($laporan['nama_lengkap']) ?></h6>
                        <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> Tanggal Submit: <?= date('d F Y, H:i', strtotime($laporan['created_at'])) ?></small>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <?php 
                            $fileKeywords = ['_file', '_bukti', '_dokumen', 'lampiran'];
                            $excludeFields = ['id', 'user_id', 'status', 'alasan_tolak', 'penolak_id', 'created_at', 'updated_at', 'nama_lengkap'];
                            
                            foreach($laporan as $field => $value): 
                                if(in_array($field, $excludeFields) || empty($value)) continue;
                                
                                $is_file_field = false;
                                foreach($fileKeywords as $kw) { if(strpos($field, $kw) !== false) $is_file_field = true; }

                                $label = ucwords(str_replace('_', ' ', $field));
                            ?>
                            <tr>
                                <th width="30%" class="bg-light align-middle text-muted"><?= $label ?></th>
                                <td class="align-middle">
                                    <?php if($is_file_field): ?>
                                        <?php 
                                            $files = json_decode($value, true); 
                                            if(is_array($files) && count($files) > 0):
                                        ?>
                                            <div class="d-flex flex-wrap gap-2">
                                                <?php foreach($files as $file): ?>
                                                    <?php 
                                                        $path = base_url('uploads/audit_evidences/'.$file);
                                                        // Fallback untuk policy files
                                                        if (!file_exists(FCPATH . 'uploads/audit_evidences/' . $file) && file_exists(FCPATH . 'uploads/policy_files/' . $file)) {
                                                            $path = base_url('uploads/policy_files/'.$file);
                                                        }
                                                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                                                        $icon = ($ext == 'pdf') ? 'fa-file-pdf text-danger' : 'fa-file-image text-primary';
                                                    ?>
                                                    <a href="<?= $path ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-pill shadow-sm"><i class="fas <?= $icon ?> me-1"></i> Buka File</a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted fst-italic">Tidak ada lampiran.</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="fw-bold text-dark"><?= esc($value) ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-white p-4 border-top">
                <div class="alert alert-warning border-0 shadow-sm"><i class="fas fa-info-circle me-2"></i>Pastikan Anda telah mereview seluruh dokumen sebelum memberikan persetujuan.</div>
                
                <div class="d-flex gap-3 justify-content-end mt-3">
                    <button type="button" class="btn btn-danger btn-lg rounded-pill px-5 shadow-sm fw-bold" data-bs-toggle="modal" data-bs-target="#rejectModal"><i class="fas fa-times me-2"></i>Tolak Laporan</button>
                    <a href="<?= base_url('kepalaunit/approval/approve/'.$type.'/'.$laporan['id']) ?>" class="btn btn-success btn-lg rounded-pill px-5 shadow-sm fw-bold" onclick="return confirm('Apakah Anda yakin ingin menyetujui laporan ini?')"><i class="fas fa-check-double me-2"></i>Setujui Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title text-white"><i class="fas fa-exclamation-triangle me-2"></i>Tolak Laporan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('kepalaunit/approval/reject') ?>" method="POST">
                <div class="modal-body p-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="type" value="<?= $type ?>">
                    <input type="hidden" name="id" value="<?= $laporan['id'] ?>">
                    <div class="form-group">
                        <label class="fw-bold mb-2">Berikan Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea class="form-control border-danger border-opacity-25" name="alasan_tolak" rows="4" required placeholder="Catatan untuk staff agar dapat diperbaiki..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 rounded-bottom-4">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm"><i class="fas fa-paper-plane me-2"></i>Kirim Penolakan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>