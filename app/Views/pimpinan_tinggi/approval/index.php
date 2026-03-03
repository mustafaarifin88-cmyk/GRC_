<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<style>
    .nav-pills .nav-link { border-radius: 10px; margin-bottom: 5px; color: #6c757d; font-weight: bold; text-align: left; }
    .nav-pills .nav-link.active { background: linear-gradient(135deg, #141E30, #243B55); color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
</style>

<div class="card shadow border-0 rounded-4 mb-4">
    <div class="card-body p-4">
        <form action="" method="GET">
            <div class="row align-items-end">
                <div class="col-md-3 form-group mb-0">
                    <label class="fw-bold text-muted mb-2">Pilih Managerial</label>
                    <select class="form-select shadow-sm" style="border-color: #243B55;" name="managerial_id" required onchange="this.form.submit()">
                        <option value="">-- Managerial --</option>
                        <?php foreach($list_mgr as $mgr): ?>
                            <option value="<?= $mgr['id'] ?>" <?= ($selectedMgr == $mgr['id']) ? 'selected' : '' ?>><?= esc($mgr['nama_lengkap']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 form-group mb-0">
                    <label class="fw-bold text-muted mb-2">Pilih Supervisor</label>
                    <select class="form-select shadow-sm" style="border-color: #243B55;" name="supervisor_id" <?= empty($list_spv) ? 'disabled' : '' ?> onchange="this.form.submit()">
                        <option value="">-- Supervisor --</option>
                        <?php foreach($list_spv as $spv): ?>
                            <option value="<?= $spv['id'] ?>" <?= ($selectedSpv == $spv['id']) ? 'selected' : '' ?>><?= esc($spv['nama_lengkap']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 form-group mb-0">
                    <label class="fw-bold text-muted mb-2">Pilih Kepala Unit</label>
                    <select class="form-select shadow-sm" style="border-color: #243B55;" name="kepala_unit_id" <?= empty($list_ku) ? 'disabled' : '' ?>>
                        <option value="">-- Kepala Unit --</option>
                        <?php foreach($list_ku as $ku): ?>
                            <option value="<?= $ku['id'] ?>" <?= ($selectedKu == $ku['id']) ? 'selected' : '' ?>><?= esc($ku['nama_lengkap']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn text-white w-100 rounded-pill shadow-sm" style="background: linear-gradient(135deg, #141E30, #243B55); border: none;"><i class="fas fa-filter me-2"></i>Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if($selectedKu): ?>
<div class="row">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-3">
                <h6 class="fw-bold text-muted mb-3 ps-2">Kategori Laporan</h6>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php 
                    $labels = [
                        'audit' => 'Audit Bond', 'compliance' => 'Compliance Bond', 'risk' => 'Risk Bond', 'insiden' => 'Formulir Insiden',
                        'int_audit' => 'Int. Audit Bond', 'int_compliance' => 'Int. Compliance', 'int_risk' => 'Int. Risk Bond', 'int_fraud' => 'Int. Fraud Bond',
                        'int_incident' => 'Int. Incident Bond', 'int_cyber' => 'Int. Cyber Bond', 'int_third_party' => 'Int. Third Party', 'int_continuity' => 'Int. Continuity', 'int_control' => 'Int. Control Bond'
                    ];
                    $first = true;
                    foreach($labels as $key => $label): ?>
                        <button class="nav-link <?= $first ? 'active' : '' ?>" id="v-<?= $key ?>-tab" data-bs-toggle="pill" data-bs-target="#v-<?= $key ?>" type="button" role="tab">
                            <?= $label ?> <span class="badge bg-light text-dark float-end"><?= count($laporan[$key] ?? []) ?></span>
                        </button>
                    <?php $first = false; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-9">
        <div class="card shadow border-0 rounded-4">
            <div class="card-body p-4">
                <div class="tab-content" id="v-pills-tabContent">
                    <?php 
                    $first = true;
                    foreach($labels as $key => $label): ?>
                        <div class="tab-pane fade <?= $first ? 'show active' : '' ?>" id="v-<?= $key ?>" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                                <h5 class="fw-bold text-dark m-0">Menunggu Approval Akhir: <?= $label ?></h5>
                                <a href="<?= base_url('pimpinan/approval/export-excel/'.$key) ?>" class="btn btn-sm btn-success rounded-pill shadow-sm"><i class="fas fa-file-excel me-2"></i>Rekap Excel</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped dt-table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Staff</th>
                                            <th>Judul Laporan</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(empty($laporan[$key])): ?>
                                            <tr><td colspan="5" class="text-center text-muted">Tidak ada laporan yang perlu di-approve.</td></tr>
                                        <?php else: ?>
                                            <?php $no=1; foreach($laporan[$key] as $row): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="fw-bold"><?= esc($row['nama_lengkap']) ?></td>
                                                <td><?= esc($row['judul'] ?? $row['nama_peraturan'] ?? $row['aset'] ?? $row['bia_proses'] ?? 'Tanpa Judul') ?></td>
                                                <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                                                <td class="text-center" style="white-space: nowrap;">
                                                    <a href="<?= base_url('pimpinan/approval/export-pdf/'.$key.'/'.$row['id']) ?>" class="btn btn-sm btn-info text-white rounded-circle shadow-sm me-1" title="Cetak PDF"><i class="fas fa-file-pdf"></i></a>
                                                    <a href="<?= base_url('pimpinan/approval/approve/'.$key.'/'.$row['id']) ?>" class="btn btn-sm btn-success rounded-circle shadow-sm me-1" title="Sahkan / Approve" onclick="return confirm('Yakin ingin mengesahkan laporan ini secara final?')"><i class="fas fa-stamp"></i></a>
                                                    <button type="button" class="btn btn-sm btn-danger rounded-circle shadow-sm" title="Tolak" onclick="openRejectModal('<?= $key ?>', <?= $row['id'] ?>)"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php $first = false; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title text-white"><i class="fas fa-exclamation-triangle me-2"></i>Tolak Laporan (Pimpinan Tinggi)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('pimpinan/approval/reject') ?>" method="POST">
                <div class="modal-body p-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="type" id="reject_type">
                    <input type="hidden" name="id" id="reject_id">
                    <div class="form-group">
                        <label class="fw-bold mb-2">Alasan Penolakan / Arahan Revisi <span class="text-danger">*</span></label>
                        <textarea class="form-control border-danger border-opacity-25" name="alasan_tolak" rows="4" required placeholder="Jelaskan alasan laporan ditolak / butuh revisi..."></textarea>
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

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    document.querySelectorAll('.dt-table').forEach(table => {
        if(table.querySelector('tbody tr td').getAttribute('colspan') !== '5'){
            new simpleDatatables.DataTable(table);
        }
    });
    function openRejectModal(type, id) {
        document.getElementById('reject_type').value = type;
        document.getElementById('reject_id').value = id;
        new bootstrap.Modal(document.getElementById('rejectModal')).show();
    }
</script>
<?= $this->endSection() ?>