<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<div class="card shadow border-0 rounded-4 mb-4">
    <div class="card-header bg-white border-bottom rounded-top-4 py-3">
        <h4 class="card-title text-primary m-0"><i class="fas fa-filter me-2"></i>Filter Laporan</h4>
    </div>
    <div class="card-body p-4">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="fw-bold text-muted mb-2">Pimpinan Tinggi</label>
                    <select class="form-select" id="filter_pt">
                        <option value="">-- Pilih Pimpinan Tinggi --</option>
                        <?php foreach($pimpinanTinggi as $pt): ?>
                            <option value="<?= $pt['id'] ?>"><?= $pt['nama_lengkap'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="fw-bold text-muted mb-2">Managerial</label>
                    <select class="form-select" id="filter_mgr" disabled><option value="">-- Menunggu --</option></select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="fw-bold text-muted mb-2">Supervisor</label>
                    <select class="form-select" id="filter_spv" disabled><option value="">-- Menunggu --</option></select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="fw-bold text-muted mb-2">Kepala Unit</label>
                    <select class="form-select" id="filter_ku" disabled><option value="">-- Menunggu --</option></select>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="fw-bold text-muted mb-2">Pilih Staff <span class="text-danger">*</span></label>
                    <select class="form-select border-primary" name="staff_id" id="filter_staff" required>
                        <option value="">-- Menunggu Kepala Unit --</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="fw-bold text-muted mb-2">Dari Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control border-primary" name="start_date" value="<?= $_GET['start_date'] ?? '' ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="fw-bold text-muted mb-2">Sampai Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control border-primary" name="end_date" value="<?= $_GET['end_date'] ?? '' ?>" required>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm"><i class="fas fa-search me-2"></i>Cari Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if(isset($_GET['staff_id'])): ?>
<div class="card shadow border-0 rounded-4 mb-5">
    <div class="card-header bg-white border-bottom rounded-top-4 py-3">
        <h4 class="card-title text-success m-0"><i class="fas fa-list me-2"></i>Hasil Pemantauan Laporan Staff</h4>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-striped table-hover dt-table" id="tableLaporan">
                <thead class="bg-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul / Objek Laporan</th>
                        <th>Tanggal Submit</th>
                        <th>Jenis Form Laporan</th>
                        <th>Status Terkini</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($laporan)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4"><i>Belum ada data laporan dari staff ini pada rentang tanggal tersebut.</i></td>
                    </tr>
                    <?php else: ?>
                        <?php 
                        function status_chain($status) {
                            if ($status == 'proses') return '<span class="badge bg-secondary"><i class="fas fa-clock me-1"></i> Menunggu Kepala Unit</span>';
                            if ($status == 'approve_ku') return '<span class="badge bg-info text-dark"><i class="fas fa-check me-1"></i> Disetujui KU <i class="fas fa-arrow-right mx-1"></i> Menunggu SPV</span>';
                            if ($status == 'approve_spv') return '<span class="badge bg-primary"><i class="fas fa-check-double me-1"></i> Disetujui SPV <i class="fas fa-arrow-right mx-1"></i> Menunggu MGR</span>';
                            if ($status == 'approve_mgr') return '<span class="badge bg-warning text-dark"><i class="fas fa-check-double me-1"></i> Disetujui MGR <i class="fas fa-arrow-right mx-1"></i> Menunggu Pimpinan</span>';
                            if ($status == 'approve_pt') return '<span class="badge bg-success"><i class="fas fa-stamp me-1"></i> Selesai (Final)</span>';
                            if ($status == 'ditolak') return '<span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Ditolak</span>';
                            return '<span class="badge bg-dark">Tidak Diketahui</span>';
                        }

                        $no = 1; 
                        foreach($laporan as $d): 
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="fw-bold text-dark"><?= esc($d['judul']) ?></td>
                            <td><?= date('d M Y, H:i', strtotime($d['tanggal'])) ?></td>
                            <td><span class="badge bg-primary bg-opacity-75 rounded-pill px-3"><?= esc($d['jenis_form']) ?></span></td>
                            <td><?= status_chain($d['status']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    if(document.getElementById("tableLaporan")){
        let table = document.getElementById("tableLaporan");
        if(table.querySelector('tbody tr td').getAttribute('colspan') !== '5'){
            new simpleDatatables.DataTable("#tableLaporan");
        }
    }

    function loadHierarchy(atasan_id, target_select) {
        if(!atasan_id) {
            $(target_select).html('<option value="">-- Menunggu --</option>').prop('disabled', true);
            return;
        }
        $(target_select).html('<option value="">Loading...</option>').prop('disabled', false);
        $.ajax({
            url: '<?= base_url('admin/pantau-laporan/get-hierarchy') ?>',
            type: 'POST',
            data: { atasan_id: atasan_id, csrf_test_name: $('input[name="csrf_test_name"]').val() },
            success: function(res) {
                var html = '<option value="">-- Pilih --</option>';
                $.each(res, function(i, item) {
                    html += `<option value="${item.id}">${item.nama_lengkap}</option>`;
                });
                $(target_select).html(html);
            }
        });
    }

    $('#filter_pt').change(function() { loadHierarchy($(this).val(), '#filter_mgr'); $('#filter_spv, #filter_ku, #filter_staff').html('<option value="">-- Menunggu --</option>').prop('disabled', true); });
    $('#filter_mgr').change(function() { loadHierarchy($(this).val(), '#filter_spv'); $('#filter_ku, #filter_staff').html('<option value="">-- Menunggu --</option>').prop('disabled', true); });
    $('#filter_spv').change(function() { loadHierarchy($(this).val(), '#filter_ku'); $('#filter_staff').html('<option value="">-- Menunggu --</option>').prop('disabled', true); });
    $('#filter_ku').change(function() { loadHierarchy($(this).val(), '#filter_staff'); });
</script>
<?= $this->endSection() ?>