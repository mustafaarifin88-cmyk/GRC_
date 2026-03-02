<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<style>
    .nav-tabs .nav-link { border-radius: 10px 10px 0 0; font-weight: bold; padding: 12px 20px; color: #6c757d; border: none; }
    .nav-tabs .nav-link.active { background: linear-gradient(135deg, #0052D4, #4364F7); color: white; box-shadow: 0 -4px 10px rgba(0,0,0,0.1); }
    .status-badge { cursor: pointer; transition: transform 0.2s; }
    .status-badge:hover { transform: scale(1.05); }
</style>

<div class="row">
    <div class="col-12">
        <div class="card shadow border-0 rounded-4 p-3">
            <ul class="nav nav-tabs border-0 mb-3" id="progresTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#audit">Audit Bond</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#compliance">Compliance Bond</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#risk">Risk Bond</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#insiden">Insiden</button></li>
            </ul>

            <div class="tab-content" id="progresTabContent">
                <!-- Data Audit -->
                <div class="tab-pane fade show active" id="audit">
                    <table class="table table-striped" id="tableAudit">
                        <thead class="bg-light">
                            <tr><th>No</th><th>Judul</th><th>Tanggal Audit</th><th>Status Terkini</th></tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($audit as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-bold text-primary"><?= esc($d['judul']) ?></td>
                                <td><?= date('d M Y', strtotime($d['tanggal_audit'])) ?></td>
                                <td><?= status_badge('audit', $d['id'], $d['status']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Data Compliance -->
                <div class="tab-pane fade" id="compliance">
                    <table class="table table-striped" id="tableCompliance">
                        <thead class="bg-light">
                            <tr><th>No</th><th>Judul</th><th>Periode</th><th>Tanggal Penilaian</th><th>Status Terkini</th></tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($compliance as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-bold text-primary"><?= esc($d['judul']) ?></td>
                                <td><?= esc($d['periode_penilaian']) ?></td>
                                <td><?= date('d M Y', strtotime($d['tanggal_penilaian'])) ?></td>
                                <td><?= status_badge('compliance', $d['id'], $d['status']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Data Risk -->
                <div class="tab-pane fade" id="risk">
                    <table class="table table-striped" id="tableRisk">
                        <thead class="bg-light">
                            <tr><th>No</th><th>Judul</th><th>Kategori</th><th>Tingkat Risiko</th><th>Status Terkini</th></tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($risk as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-bold text-primary"><?= esc($d['judul']) ?></td>
                                <td><?= esc($d['kategori_risiko']) ?></td>
                                <td><span class="badge bg-<?= $d['tingkat_risiko'] == 'Tinggi' ? 'danger' : ($d['tingkat_risiko'] == 'Sedang' ? 'warning' : 'success') ?>"><?= esc($d['tingkat_risiko']) ?></span></td>
                                <td><?= status_badge('risk', $d['id'], $d['status']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Data Insiden -->
                <div class="tab-pane fade" id="insiden">
                    <table class="table table-striped" id="tableInsiden">
                        <thead class="bg-light">
                            <tr><th>No</th><th>Judul</th><th>Waktu Kejadian</th><th>Jenis</th><th>Status Terkini</th></tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($insiden as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-bold text-primary"><?= esc($d['judul']) ?></td>
                                <td><?= date('d M Y H:i', strtotime($d['tanggal_waktu_kejadian'])) ?></td>
                                <td><?= esc($d['jenis_insiden']) ?></td>
                                <td><?= status_badge('insiden', $d['id'], $d['status']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
function status_badge($type, $id, $status) {
    if ($status == 'proses') {
        return '<span class="badge bg-secondary px-3 py-2 rounded-pill">Menunggu Approval (Proses)</span>';
    } elseif ($status == 'ditolak') {
        return '<span class="badge bg-danger px-3 py-2 rounded-pill status-badge" onclick="cekAlasan(\''.$type.'\', '.$id.')" title="Klik untuk melihat alasan"><i class="fas fa-times-circle me-1"></i> Ditolak (Lihat Alasan)</span>';
    } else {
        $levelStr = str_replace('approve_', '', $status);
        $levelFull = ['ku' => 'Kepala Unit', 'spv' => 'Supervisor', 'mgr' => 'Managerial', 'pt' => 'Pimpinan Tinggi'][$levelStr] ?? $levelStr;
        return '<span class="badge bg-success px-3 py-2 rounded-pill"><i class="fas fa-check-circle me-1"></i> Disetujui ('.$levelFull.')</span>';
    }
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
            url: "<?= base_url('staff/pantau-progres/detail-alasan/') ?>" + type + "/" + id,
            type: "GET",
            success: function(res) {
                Swal.fire({
                    icon: 'error',
                    title: 'Laporan Ditolak',
                    html: `<p class="text-danger fw-bold">Alasan Penolakan:</p><div class="p-3 bg-light rounded text-start">${res.alasan_tolak}</div>`,
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#d33'
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>