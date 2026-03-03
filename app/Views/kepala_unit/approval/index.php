<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<style>
    .nav-pills .nav-link { border-radius: 10px; margin-bottom: 5px; color: #6c757d; font-weight: bold; text-align: left; }
    .nav-pills .nav-link.active { background: linear-gradient(135deg, #4b6cb7, #182848); color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
</style>

<div class="row">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-3" style="max-height: 80vh; overflow-y: auto;">
                <h6 class="fw-bold text-muted mb-3 ps-2">Kategori Laporan</h6>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php 
                    $labels = [
                        'audit' => 'Data: Audit Bond', 'compliance' => 'Data: Compliance Bond', 'risk' => 'Data: Risk Bond', 'insiden' => 'Data: Insiden',
                        'int_audit' => 'Int: Audit Bond', 'int_compliance' => 'Int: Compliance', 'int_risk' => 'Int: Risk Bond', 'int_fraud' => 'Int: Fraud Bond',
                        'int_incident' => 'Int: Incident Bond', 'int_cyber' => 'Int: Cyber Bond', 'int_third_party' => 'Int: Third Party', 'int_continuity' => 'Int: Continuity', 'int_control' => 'Int: Control Bond'
                    ];
                    $first = true;
                    foreach($labels as $key => $label): ?>
                        <button class="nav-link <?= $first ? 'active' : '' ?>" id="v-<?= $key ?>-tab" data-bs-toggle="pill" data-bs-target="#v-<?= $key ?>" type="button" role="tab">
                            <?= $label ?> <span class="badge bg-danger float-end"><?= count($laporan[$key] ?? []) ?></span>
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
                            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Menunggu Approval: <?= $label ?></h5>
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
                                            <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada laporan yang perlu di-approve saat ini.</td></tr>
                                        <?php else: ?>
                                            <?php $no=1; foreach($laporan[$key] as $row): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="fw-bold"><?= esc($row['nama_lengkap']) ?></td>
                                                <td><?= esc($row['judul'] ?? $row['no_lisensi'] ?? $row['nama_peraturan'] ?? $row['aset'] ?? $row['nama_perusahaan'] ?? $row['bia_proses'] ?? $row['nama_kontrol'] ?? 'Tanpa Judul') ?></td>
                                                <td><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('kepalaunit/approval/detail/'.$key.'/'.$row['id']) ?>" class="btn btn-sm btn-info text-white rounded-pill shadow-sm px-3">
                                                        <i class="fas fa-eye me-1"></i> Lihat Laporan
                                                    </a>
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    document.querySelectorAll('.dt-table').forEach(table => {
        if(table.querySelector('tbody tr td').getAttribute('colspan') !== '5'){
            new simpleDatatables.DataTable(table);
        }
    });
</script>
<?= $this->endSection() ?>