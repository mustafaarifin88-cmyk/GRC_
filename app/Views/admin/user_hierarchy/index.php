<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .nav-tabs .nav-link { border-radius: 10px 10px 0 0; font-weight: bold; padding: 12px 20px; transition: 0.3s; color: #6c757d; border: none; }
    .nav-tabs .nav-link.active { background: linear-gradient(135deg, #0052D4, #4364F7); color: white; box-shadow: 0 -4px 10px rgba(0,0,0,0.1); }
    .hierarchy-card { border: none; border-radius: 0 0 15px 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .bawahan-list { max-height: 300px; overflow-y: auto; }
</style>

<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pt-tab" data-bs-toggle="tab" data-bs-target="#pt" type="button" role="tab" data-level="PIMPINAN TINGGI">PIMPINAN TINGGI</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="mgr-tab" data-bs-toggle="tab" data-bs-target="#mgr" type="button" role="tab" data-level="MANAGERIAL">MANAGERIAL</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="spv-tab" data-bs-toggle="tab" data-bs-target="#spv" type="button" role="tab" data-level="SUPERVISOR">SUPERVISOR</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ku-tab" data-bs-toggle="tab" data-bs-target="#ku" type="button" role="tab" data-level="KEPALA UNIT">KEPALA UNIT</button>
            </li>
        </ul>
        
        <div class="card hierarchy-card">
            <div class="card-body p-4">
                <form id="hierarchyForm">
                    <?= csrf_field() ?>
                    <input type="hidden" id="active_level" name="atasan_level" value="PIMPINAN TINGGI">
                    
                    <div class="form-group mb-4">
                        <label class="fw-bold text-primary mb-2">Pilih Nama Atasan</label>
                        <select class="form-select form-select-lg border-primary shadow-sm" id="atasan_id" name="atasan_id" required>
                            <option value="">-- Pilih Atasan --</option>
                            <?php foreach($pimpinanTinggi as $pt): ?>
                                <option value="<?= $pt['id'] ?>" class="opt-pt"><?= $pt['nama_lengkap'] ?></option>
                            <?php endforeach; ?>
                            <?php foreach($managerial as $mgr): ?>
                                <option value="<?= $mgr['id'] ?>" class="opt-mgr d-none"><?= $mgr['nama_lengkap'] ?></option>
                            <?php endforeach; ?>
                            <?php foreach($supervisor as $spv): ?>
                                <option value="<?= $spv['id'] ?>" class="opt-spv d-none"><?= $spv['nama_lengkap'] ?></option>
                            <?php endforeach; ?>
                            <?php foreach($kepalaUnit as $ku): ?>
                                <option value="<?= $ku['id'] ?>" class="opt-ku d-none"><?= $ku['nama_lengkap'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-4 d-none" id="bawahanContainer">
                        <label class="fw-bold text-info mb-3">Pilih Bawahan <small class="text-muted">(1 Level di bawahnya)</small></label>
                        <div class="row bawahan-list p-3 bg-light rounded-3 shadow-inner" id="bawahanList">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm px-5 mt-3 d-none" id="btnSaveHierarchy"><i class="fas fa-save me-2"></i>Simpan Hirarki</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/jquery/jquery.min.js') ?>"></script>
<script>
$(document).ready(function() {
    $('.nav-link').on('click', function() {
        var level = $(this).data('level');
        $('#active_level').val(level);
        $('#atasan_id').val('');
        $('#bawahanContainer').addClass('d-none');
        $('#btnSaveHierarchy').addClass('d-none');
        
        $('#atasan_id option').addClass('d-none');
        $('#atasan_id option[value=""]').removeClass('d-none');
        
        if(level === 'PIMPINAN TINGGI') $('.opt-pt').removeClass('d-none');
        if(level === 'MANAGERIAL') $('.opt-mgr').removeClass('d-none');
        if(level === 'SUPERVISOR') $('.opt-spv').removeClass('d-none');
        if(level === 'KEPALA UNIT') $('.opt-ku').removeClass('d-none');
    });

    $('#atasan_id').on('change', function() {
        var atasan_id = $(this).val();
        var atasan_level = $('#active_level').val();
        
        if(atasan_id === '') {
            $('#bawahanContainer').addClass('d-none');
            $('#btnSaveHierarchy').addClass('d-none');
            return;
        }

        $.ajax({
            url: '<?= base_url('admin/hierarchy/get_bawahan') ?>',
            type: 'POST',
            data: {
                atasan_id: atasan_id,
                atasan_level: atasan_level,
                csrf_test_name: $('input[name="csrf_test_name"]').val()
            },
            success: function(response) {
                var html = '';
                if(response.length > 0) {
                    $.each(response, function(index, user) {
                        var checked = user.is_checked ? 'checked' : '';
                        html += `
                        <div class="col-md-4 mb-3">
                            <div class="form-check form-switch fs-5">
                                <input class="form-check-input" type="checkbox" name="bawahan_ids[]" value="${user.id}" id="user_${user.id}" ${checked}>
                                <label class="form-check-label" for="user_${user.id}">${user.nama_lengkap}</label>
                            </div>
                        </div>`;
                    });
                    $('#bawahanList').html(html);
                    $('#bawahanContainer').removeClass('d-none');
                    $('#btnSaveHierarchy').removeClass('d-none');
                } else {
                    $('#bawahanList').html('<div class="col-12"><p class="text-danger">Tidak ada bawahan yang tersedia atau semua sudah terikat dengan atasan lain.</p></div>');
                    $('#bawahanContainer').removeClass('d-none');
                    $('#btnSaveHierarchy').addClass('d-none');
                }
            }
        });
    });

    $('#hierarchyForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url('admin/hierarchy/save') ?>',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
});
</script>
<?= $this->endSection() ?>