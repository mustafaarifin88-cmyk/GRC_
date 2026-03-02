<?= $this->extend('layout/master') ?>

<?= $this->section('content') ?>
<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6 flex justify-between items-center">
        <h3 class="text-2xl font-bold text-white flex items-center gap-3">
            <i class="fas fa-building"></i> Profil Perusahaan
        </h3>
    </div>

    <div class="p-8">
        <form action="<?= base_url('admin/perusahaan') ?>" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-bold text-gray-700">Nama Perusahaan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-indigo-400">
                            <i class="fas fa-signature"></i>
                        </div>
                        <input type="text" name="nama_perusahaan" value="<?= $perusahaan['nama_perusahaan'] ?? '' ?>" required class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none" placeholder="Masukkan nama perusahaan">
                    </div>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-bold text-gray-700">Nama Pimpinan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-indigo-400">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <input type="text" name="nama_pimpinan" value="<?= $perusahaan['nama_pimpinan'] ?? '' ?>" required class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none" placeholder="Masukkan nama pimpinan">
                    </div>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label class="text-sm font-bold text-gray-700">Alamat Perusahaan</label>
                    <textarea name="alamat" rows="3" required class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none resize-none" placeholder="Alamat lengkap perusahaan"><?= $perusahaan['alamat'] ?? '' ?></textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-gray-700">Logo Perusahaan</label>
                    <input type="file" name="logo" accept="image/*" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all">
                    <p class="text-xs text-gray-500 mt-1">Abaikan jika tidak ingin mengubah logo.</p>
                </div>

                <div class="flex items-center justify-center border-2 border-dashed border-gray-200 rounded-xl p-4 bg-gray-50">
                    <?php if(!empty($perusahaan['logo'])): ?>
                        <img src="<?= base_url('uploads/perusahaan/' . $perusahaan['logo']) ?>" alt="Logo" class="max-h-32 object-contain rounded-lg shadow-sm">
                    <?php else: ?>
                        <span class="text-gray-400 text-sm font-medium"><i class="fas fa-image text-2xl block text-center mb-2"></i> Belum ada logo</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg transform transition-all hover:-translate-y-1 flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Profil
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>