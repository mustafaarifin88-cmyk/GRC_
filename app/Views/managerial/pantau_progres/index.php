<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<style>
    .nav-tabs .nav-link { font-weight: bold; color: #6c757d; border: none; padding: 10px 20px;}
    .nav-tabs .nav-link.active { background: linear-gradient(135deg, #870000, #190A05); color: white; border-radius: 10px 10px 0 0; }
    .main-tab { border-bottom: 2px solid #870000; margin-bottom: 20px; }
    .main-tab .nav-link.active { background: #870000; color: white; border-radius: 5px; }
    .main-tab .nav-link { border-radius: 5px; margin-right: 5px; }
</style>

<div class="card shadow border-0 rounded-4 p-4">
    <div class="alert alert-info border-0 shadow-sm mb-4" style="background-color: #fff3f3; color: #870000;"><i class="fas fa-info-circle me-2"></i>Daftar di bawah ini menampilkan laporan yang <b>Anda buat sendiri</b> maupun laporan dari staff yang <b>telah Anda Approve</b> sehingga Anda dapat memantau progres akhirnya.</div>
    <ul class="nav nav-pills main-tab" id="mainTab" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#data-audit-tab">1. Data Audit</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#internal-grc-tab">2. Internal GRC</button></li>
    </ul>

    <div class="tab-content" id="mainTabContent">
        <div class="tab-pane fade show active" id="data-audit-tab">
            <ul class="nav nav-tabs border-0 mb-3" style="overflow-x: auto; flex-wrap: nowrap; white-space: nowrap;">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#da-audit">Audit Bond</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#da-compliance">Compliance Bond</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#da-risk">Risk Bond</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#da-insiden">Insiden</button></li>
            </ul>
            <div class="tab-content">
                <?php 
                $da_tabs = ['da-audit'=>$da_audit, 'da-compliance'=>$da_compliance, 'da-risk'=>$da_risk, 'da-insiden'=>$da_insiden];
                $first = true;
                foreach($da_tabs as $id => $data): ?>
                    <div class="tab-pane fade <?= $first ? 'show active' : '' ?>" id="<?= $id ?>">
                        <table class="table table-striped dt-table">
                            <thead class="bg-light"><tr><th>Judul & Pembuat</th><th>Tanggal Submit</th><th>Status Terkini</th></tr></thead>
                            <tbody>
                                <?php foreach($data as $d): ?>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block text-dark"><?= esc($d['judul'] ?? 'Tanpa Judul') ?></span>
                                        <small class="text-danger"><i class="fas fa-user-edit me-1"></i> <?= esc($d['nama_pembuat'] ?? 'Saya') ?></small>
                                    </td>
                                    <td><?= date('d M Y, H:i', strtotime($d['created_at'])) ?></td>
                                    <td><?= status_chain(str_replace('-', '_', $id), $d['id'], $d['status']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php $first = false; endforeach; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="internal-grc-tab">
            <ul class="nav nav-tabs border-0 mb-3" style="overflow-x: auto; flex-wrap: nowrap; white-space: nowrap;">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#igrc-audit">Audit</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#igrc-comp">Compliance</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#igrc-risk">Risk</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#igrc-fraud">Fraud</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#igrc-inc">Incident</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#igrc-cyb">Cyber</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#igrc-tp">3rd Party</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#igrc-cont">Continuity</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#igrc-ctrl">Control</button></li>
            </ul>
            <div class="tab-content">
                <?php 
                $igrc_tabs = [
                    'igrc-audit'=>$igrc_audit, 'igrc-comp'=>$igrc_compliance, 'igrc-risk'=>$igrc_risk, 
                    'igrc-fraud'=>$igrc_fraud, 'igrc-inc'=>$igrc_incident, 'igrc-cyb'=>$igrc_cyber,
                    'igrc-tp'=>$igrc_third_party, 'igrc-cont'=>$igrc_continuity, 'igrc-ctrl'=>$igrc_control
                ];
                $first = true;
                foreach($igrc_tabs as $id => $data): ?>
                    <div class="tab-pane fade <?= $first ? 'show active' : '' ?>" id="<?= $id ?>">
                        <table class="table table-striped dt-table">
                            <thead class="bg-light"><tr><th>Judul/Objek & Pembuat</th><th>Tanggal Submit</th><th>Status Terkini</th></tr></thead>
                            <tbody>
                                <?php foreach($data as $d): ?>
                                <tr>
                                    <td>
                                        <span class="fw-bold d-block text-dark"><?= esc($d['judul'] ?? $d['no_lisensi'] ?? $d['nama_peraturan'] ?? $d['aset'] ?? $d['nama_perusahaan'] ?? $d['bia_proses'] ?? $d['nama_kontrol'] ?? 'Tanpa Judul') ?></span>
                                        <small class="text-danger"><i class="fas fa-user-edit me-1"></i> <?= esc($d['nama_pembuat'] ?? 'Saya') ?></small>
                                    </td>
                                    <td><?= date('d M Y, H:i', strtotime($d['created_at'])) ?></td>
                                    <td><?= status_chain(str_replace('-', '_', $id), $d['id'], $d['status']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php $first = false; endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php 
function status_chain($type, $id, $status) {
    if ($status == 'proses') return '<span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> Menunggu Kepala Unit</span>';
    if ($status == 'approve_ku') return '<span class="badge bg-info text-dark"><i class="fas fa-check me-1"></i> Disetujui KU <i class="fas fa-arrow-right mx-1"></i> Menunggu SPV</span>';
    if ($status == 'approve_spv') return '<span class="badge bg-primary"><i class="fas fa-check-double me-1"></i> Disetujui SPV <i class="fas fa-arrow-right mx-1"></i> Menunggu MGR</span>';
    if ($status == 'approve_mgr') return '<span class="badge bg-warning text-dark"><i class="fas fa-check-double me-1"></i> Disetujui MGR <i class="fas fa-arrow-right mx-1"></i> Menunggu Pimpinan</span>';
    if ($status == 'approve_pt') return '<span class="badge bg-success"><i class="fas fa-stamp me-1"></i> Selesai (Final)</span>';
    if ($status == 'ditolak') return '<span class="badge bg-danger shadow-sm" onclick="cekAlasan(\''.$type.'\', '.$id.')" style="cursor:pointer" title="Klik untuk lihat alasan"><i class="fas fa-times-circle me-1"></i> Ditolak (Klik Detail)</span>';
    return '<span class="badge bg-dark">Tidak Diketahui</span>';
}
?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    document.querySelectorAll('.dt-table').forEach(table => {
        new simpleDatatables.DataTable(table);
    });
    function cekAlasan(type, id) {
        $.ajax({
            url: "<?= base_url('managerial/pantau-progres/detail-alasan/') ?>" + type + "/" + id,
            success: function(res) { 
                Swal.fire({ icon: 'error', title: 'Laporan Ditolak', html: `<p>Alasan Penolakan:</p><div class='bg-light p-3 rounded text-start text-danger fw-bold'>${res.alasan_tolak}</div>` }); 
            }
        });
    }
</script>
<?= $this->endSection() ?>