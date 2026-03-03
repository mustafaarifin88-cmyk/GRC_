<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/extensions/simple-datatables/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/compiled/css/table-datatable.css') ?>">

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card shadow border-0 rounded-4 h-100">
            <div class="card-header bg-primary text-white border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
                <h5 class="card-title text-white m-0"><i class="fas fa-map me-2"></i>Master Data Area Audit</h5>
            </div>
            <div class="card-body p-4 pt-4">
                <form action="<?= base_url('admin/master-data/store-area') ?>" method="POST" class="mb-4">
                    <?= csrf_field() ?>
                    <div class="input-group">
                        <input type="text" class="form-control border-primary" name="nama_area" placeholder="Masukkan nama area baru..." required>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-plus me-1"></i> Tambah</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover dt-table">
                        <thead class="bg-light">
                            <tr>
                                <th width="10%" class="text-center">No</th>
                                <th>Nama Area</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($areas as $area): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="fw-bold"><?= esc($area['nama_area']) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/master-data/delete-area/'.$area['id']) ?>" class="btn btn-danger btn-sm rounded-circle shadow-sm" onclick="return confirm('Yakin ingin menghapus area ini?')" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card shadow border-0 rounded-4 h-100">
            <div class="card-header bg-success text-white border-bottom-0 py-3 rounded-top-4" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <h5 class="card-title text-white m-0"><i class="fas fa-map-marker-alt me-2"></i>Master Data Lokasi</h5>
            </div>
            <div class="card-body p-4 pt-4">
                <form action="<?= base_url('admin/master-data/store-lokasi') ?>" method="POST" class="mb-4">
                    <?= csrf_field() ?>
                    <div class="input-group">
                        <input type="text" class="form-control border-success" name="nama_lokasi" placeholder="Masukkan nama lokasi baru..." required>
                        <button class="btn btn-success" type="submit"><i class="fas fa-plus me-1"></i> Tambah</button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped table-hover dt-table">
                        <thead class="bg-light">
                            <tr>
                                <th width="10%" class="text-center">No</th>
                                <th>Nama Lokasi</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($lokasis as $lokasi): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="fw-bold"><?= esc($lokasi['nama_lokasi']) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/master-data/delete-lokasi/'.$lokasi['id']) ?>" class="btn btn-danger btn-sm rounded-circle shadow-sm" onclick="return confirm('Yakin ingin menghapus lokasi ini?')" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
        new simpleDatatables.DataTable(table, {
            perPage: 5,
            perPageSelect: [5, 10, 20]
        });
    });
</script>
<?= $this->endSection() ?>