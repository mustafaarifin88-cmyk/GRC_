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
                    <input type="date" class="form-control" name="start_date" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="fw-bold text-muted mb-2">Sampai Tanggal <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="end_date" required>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 rounded-pill shadow-sm"><i class="fas fa-search me-2"></i>Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if(isset($_GET['staff_id'])): ?>
<div class="card shadow border-0 rounded-4">
    <div class="card-header bg-white border-bottom rounded-top-4 py-3">
        <h4 class="card-title text-success m-0"><i class="fas fa-list me-2"></i>Hasil Pemantauan Laporan</h4>
    </div>
    <div class="card-body p-4">
        <table class="table table-striped" id="tableLaporan">
            <thead class="bg-light">
                <tr>
                    <th>No</th>
                    <th>Judul Laporan</th>
                    <th>Tanggal</th>
                    <th>Jenis Form</th>
                    <th>Status Akhir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4"><i>Belum ada data laporan pada rentang tanggal tersebut.</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    if(document.getElementById("tableLaporan")){
        new simpleDatatables.DataTable("#tableLaporan");
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