<?= $this->extend('layout/master') ?>

<?= $this->section('content') ?>
<div x-data="{ showModal: false, isEdit: false, formData: { id: '', nama_area: '' } }" class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
    
    <div class="bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-5 flex justify-between items-center">
        <h3 class="text-xl font-bold text-white flex items-center gap-3">
            <i class="fas fa-database"></i> Master Data Area Audit
        </h3>
        <button @click="isEdit = false; formData = { id: '', nama_area: '' }; showModal = true" class="px-4 py-2 bg-white text-blue-600 hover:bg-gray-50 rounded-lg font-bold shadow-md transition-all text-sm flex items-center gap-2 transform hover:scale-105">
            <i class="fas fa-plus"></i> Tambah Area
        </button>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            <?php foreach($areas as $area): ?>
                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-xl hover:border-blue-300 transition-all group relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-cyan-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500 ease-out z-0"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-cyan-100 text-cyan-600 flex items-center justify-center font-bold">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h4 class="font-extrabold text-gray-800 text-lg truncate"><?= $area['nama_area'] ?></h4>
                        </div>
                        
                        <div class="flex justify-end gap-2 border-t border-gray-100 pt-3">
                            <button @click="isEdit = true; formData = { id: '<?= $area['id'] ?>', nama_area: '<?= htmlspecialchars($area['nama_area'], ENT_QUOTES) ?>' }; showModal = true" class="px-3 py-1.5 bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white rounded-lg text-xs font-bold transition-colors">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="<?= base_url('admin/master-data/delete/' . $area['id']) ?>" method="POST" class="inline" onsubmit="return confirm('Hapus area ini secara permanen?');">
                                <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-500 hover:text-white rounded-lg text-xs font-bold transition-colors">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if(empty($areas)): ?>
                <div class="col-span-full py-12 text-center text-gray-500 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                    <i class="fas fa-map-signs text-5xl mb-4 text-gray-300"></i>
                    <p class="text-lg font-bold">Data area belum tersedia</p>
                    <p class="text-sm">Silakan tambah area baru untuk keperluan audit.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showModal = false"></div>

            <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
                <div class="bg-gradient-to-r from-blue-600 to-cyan-500 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white" x-text="isEdit ? 'Edit Nama Area' : 'Tambah Area Baru'"></h3>
                    <button @click="showModal = false" class="text-white/80 hover:text-white"><i class="fas fa-times text-xl"></i></button>
                </div>
                
                <form action="<?= base_url('admin/master-data/save') ?>" method="POST" class="p-6 space-y-4 text-left">
                    <input type="hidden" name="id" x-model="formData.id">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Area / Unit Kerja</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-blue-400">
                                <i class="fas fa-building"></i>
                            </div>
                            <input type="text" name="nama_area" x-model="formData.nama_area" required class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all outline-none font-bold text-gray-800" placeholder="Contoh: IT Network, Data Center...">
                        </div>
                    </div>
                    
                    <div class="pt-4 flex justify-end gap-2 border-t border-gray-100 mt-6">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 text-white font-bold rounded-xl shadow-md transition-colors shadow-blue-500/30">Simpan Area</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>