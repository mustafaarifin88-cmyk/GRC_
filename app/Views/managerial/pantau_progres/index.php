<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<style>
    .nav-tabs .nav-link { font-weight: bold; color: #6c757d; border: none; }
    .nav-tabs .nav-link.active { background: linear-gradient(135deg, #870000, #190A05); color: white; border-radius: 10px 10px 0 0; }
</style>

<div class="card shadow border-0 rounded-4 p-3">
    <ul class="nav nav-tabs border-0 mb-3" id="progresTab" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#audit">Audit Bond</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#compliance">Compliance Bond</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#risk">Risk Bond</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#insiden">Insiden</button></li>
    </ul>

    <div class="tab-content" id="progresTabContent">
        <div class="tab-pane fade show active" id="audit">
            <table class="table table-striped" id="tableAudit">
                <thead><tr><th>No</th><th>Judul</th><th>Tanggal</th><th>Status Terkini</th></tr></thead>
                <tbody>
                    <?php $no=1; foreach($audit as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="fw-bold" style="color:#870000;"><?= esc($d['judul']) ?></td>
                        <td><?= date('d M Y', strtotime($d['tanggal_audit'])) ?></td>
                        <td><?= status_badge('audit', $d['id'], $d['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="compliance">
            <table class="table table-striped" id="tableCompliance">
                <thead><tr><th>No</th><th>Judul</th><th>Tanggal</th><th>Status Terkini</th></tr></thead>
                <tbody>
                    <?php $no=1; foreach($compliance as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="fw-bold" style="color:#870000;"><?= esc($d['judul']) ?></td>
                        <td><?= date('d M Y', strtotime($d['tanggal_penilaian'])) ?></td>
                        <td><?= status_badge('compliance', $d['id'], $d['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="risk">
            <table class="table table-striped" id="tableRisk">
                <thead><tr><th>No</th><th>Judul</th><th>Risiko</th><th>Status Terkini</th></tr></thead>
                <tbody>
                    <?php $no=1; foreach($risk as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="fw-bold" style="color:#870000;"><?= esc($d['judul']) ?></td>
                        <td><span class="badge bg-<?= $d['tingkat_risiko'] == 'Tinggi' ? 'danger' : 'success' ?>"><?= esc($d['tingkat_risiko']) ?></span></td>
                        <td><?= status_badge('risk', $d['id'], $d['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="insiden">
            <table class="table table-striped" id="tableInsiden">
                <thead><tr><th>No</th><th>Judul</th><th>Jenis</th><th>Status Terkini</th></tr></thead>
                <tbody>
                    <?php $no=1; foreach($insiden as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="fw-bold" style="color:#870000;"><?= esc($d['judul']) ?></td>
                        <td><?= esc($d['jenis_insiden']) ?></td>
                        <td><?= status_badge('insiden', $d['id'], $d['status']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
function status_badge($type, $id, $status) {
    if ($status == 'proses') return '<span class="badge bg-secondary px-3 py-2 rounded-pill">Proses</span>';
    if ($status == 'ditolak') return '<span class="badge bg-danger px-3 py-2 rounded-pill" onclick="cekAlasan(\''.$type.'\', '.$id.')" style="cursor:pointer">Ditolak</span>';
    return '<span class="badge bg-success px-3 py-2 rounded-pill">Disetujui</span>';
}
?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    new simpleDatatables.DataTable("#tableAudit");
    new simpleDatatables.DataTable("#tableCompliance");
    new simpleDatatables.DataTable("#tableRisk");
    new simpleDatatables.DataTable("#tableInsiden");
    function cekAlasan(type, id) {
        $.ajax({
            url: "<?= base_url('managerial/pantau-progres/detail-alasan/') ?>" + type + "/" + id,
            success: function(res) { Swal.fire({ icon: 'error', title: 'Ditolak', text: res.alasan_tolak }); }
        });
    }
</script>
<?= $this->endSection() ?>