<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<div class="card shadow border-0 rounded-4">
    <div class="card-header bg-white border-bottom rounded-top-4 py-3 d-flex justify-content-between align-items-center">
        <h4 class="card-title text-primary m-0"><i class="fas fa-users-cog me-2"></i>Manajemen User</h4>
        <div>
            <a href="<?= base_url('admin/users/import_excel') ?>" class="btn btn-success shadow-sm rounded-pill"><i class="fas fa-file-excel me-2"></i>Import Excel</a>
            <a href="<?= base_url('admin/users/create') ?>" class="btn btn-primary shadow-sm rounded-pill ms-2"><i class="fas fa-plus-circle me-2"></i>Tambah User</a>
        </div>
    </div>
    <div class="card-body p-4">
        <table class="table table-striped table-hover" id="table1">
            <thead class="bg-light">
                <tr>
                    <th class="text-center">No</th>
                    <th>Foto</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Level</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($users as $u): ?>
                <tr>
                    <td class="text-center align-middle"><?= $no++ ?></td>
                    <td class="align-middle">
                        <div class="avatar avatar-lg shadow-sm border border-2 border-white">
                            <img src="<?= base_url('uploads/profiles/' . $u['foto']) ?>" alt="Foto" style="object-fit: cover;">
                        </div>
                    </td>
                    <td class="align-middle fw-bold"><?= esc($u['username']) ?></td>
                    <td class="align-middle"><?= esc($u['nama_lengkap']) ?></td>
                    <td class="align-middle">
                        <span class="badge bg-primary px-3 py-2 rounded-pill shadow-sm"><?= esc($u['level']) ?></span>
                    </td>
                    <td class="text-center align-middle">
                        <a href="<?= base_url('admin/users/edit/'.$u['id']) ?>" class="btn btn-warning btn-sm rounded-circle shadow-sm me-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('admin/users/delete/'.$u['id']) ?>" class="btn btn-danger btn-sm rounded-circle shadow-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus user ini?')">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
<script>
    let dataTable = new simpleDatatables.DataTable("#table1");
</script>
<?= $this->endSection() ?>