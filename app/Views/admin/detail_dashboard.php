<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<div class="card shadow border-0 rounded-4 mb-4">
    <div class="card-header bg-primary text-white border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title text-white m-0"><i class="fas fa-list-alt me-2"></i><?= esc($title) ?></h4>
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-light btn-sm rounded-pill fw-bold text-primary shadow-sm"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>
    </div>
    <div class="card-body p-4 pt-4">
        <div class="table-responsive">
            <table class="table table-striped table-hover dt-table">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Staff</th>
                        <th>Judul/Objek Laporan</th>
                        <th>Jenis Form</th>
                        <th>Tanggal Submit</th>
                        <th>Status Terkini</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($dataList)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data yang ditemukan.</td></tr>
                    <?php else: ?>
                        <?php 
                        $no = 1; 
                        foreach($dataList as $d): 
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="fw-bold"><?= esc($d['staff']) ?></td>
                            <td><?= esc($d['judul']) ?></td>
                            <td><span class="badge bg-dark bg-opacity-75 rounded-pill px-3"><?= esc($d['jenis']) ?></span></td>
                            <td><?= date('d M Y, H:i', strtotime($d['tanggal'])) ?></td>
                            <td>
                                <?php 
                                    $st = $d['status'];
                                    if ($st == 'proses') echo '<span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> Menunggu Kepala Unit</span>';
                                    elseif ($st == 'approve_ku') echo '<span class="badge bg-info text-dark"><i class="fas fa-check me-1"></i> Disetujui KU <i class="fas fa-arrow-right mx-1"></i> Menunggu SPV</span>';
                                    elseif ($st == 'approve_spv') echo '<span class="badge bg-primary"><i class="fas fa-check-double me-1"></i> Disetujui SPV <i class="fas fa-arrow-right mx-1"></i> Menunggu MGR</span>';
                                    elseif ($st == 'approve_mgr') echo '<span class="badge bg-warning text-dark"><i class="fas fa-check-double me-1"></i> Disetujui MGR <i class="fas fa-arrow-right mx-1"></i> Menunggu Pimpinan</span>';
                                    elseif ($st == 'approve_pt') echo '<span class="badge bg-success"><i class="fas fa-stamp me-1"></i> Selesai (Final)</span>';
                                    elseif ($st == 'ditolak') echo '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Ditolak</span>';
                                    else echo '<span class="badge bg-dark">Tidak Diketahui</span>';
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    document.querySelectorAll('.dt-table').forEach(table => {
        if(table.querySelector('tbody tr td').getAttribute('colspan') !== '6'){
            new simpleDatatables.DataTable(table);
        }
    });
</script>
<?= $this->endSection() ?>