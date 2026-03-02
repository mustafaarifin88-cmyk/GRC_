<div x-show="activeTab === 'pimpinan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
    <form action="<?= base_url('admin/hierarchy/save') ?>" method="POST" class="max-w-4xl mx-auto space-y-6">
        
        <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 shadow-inner">
            <label class="block text-sm font-extrabold text-indigo-900 mb-3 uppercase tracking-wider">
                <i class="fas fa-user-tie text-indigo-600 mr-2"></i> Pilih Pimpinan Tinggi (Atasan)
            </label>
            <div class="relative">
                <select name="atasan_id" required class="w-full pl-4 pr-10 py-3 bg-white border border-indigo-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all shadow-sm font-bold text-gray-700 cursor-pointer appearance-none">
                    <option value="">-- Pilih Pimpinan Tinggi --</option>
                    <?php foreach($pimpinan_tinggi as $pt): ?>
                        <option value="<?= $pt['id'] ?>"><?= $pt['nama_lengkap'] ?> (<?= $pt['username'] ?>)</option>
                    <?php endforeach; ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-indigo-500">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-purple-500 to-pink-500"></div>
            <label class="block text-sm font-extrabold text-gray-800 mb-4 uppercase tracking-wider">
                <i class="fas fa-users text-pink-500 mr-2"></i> Pilih Managerial (Bawahan Langsung)
            </label>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-80 overflow-y-auto p-1 custom-scrollbar">
                <?php foreach($managerial as $mgr): ?>
                    <label class="relative flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-pink-50 hover:border-pink-300 transition-all group">
                        <input type="checkbox" name="bawahan_ids[]" value="<?= $mgr['id'] ?>" class="peer w-5 h-5 text-pink-600 border-gray-300 rounded focus:ring-pink-500 cursor-pointer">
                        <div class="ml-3 flex flex-col">
                            <span class="font-bold text-gray-800 group-hover:text-pink-700 transition-colors"><?= $mgr['nama_lengkap'] ?></span>
                            <span class="text-xs text-gray-500"><?= $mgr['username'] ?></span>
                        </div>
                        <div class="absolute inset-0 border-2 border-transparent peer-checked:border-pink-500 rounded-xl pointer-events-none transition-all"></div>
                        <i class="fas fa-check-circle absolute right-4 text-pink-500 opacity-0 peer-checked:opacity-100 transition-opacity text-xl"></i>
                    </label>
                <?php endforeach; ?>
                
                <?php if(empty($managerial)): ?>
                    <div class="col-span-full text-center py-6 text-gray-400 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                        <i class="fas fa-folder-open text-3xl mb-2"></i>
                        <p class="font-semibold text-sm">Tidak ada data Managerial.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-extrabold rounded-xl shadow-lg transform transition-all hover:-translate-y-1 flex items-center gap-2">
                <i class="fas fa-save text-lg"></i> Simpan Relasi Pimpinan
            </button>
        </div>
    </form>
</div>