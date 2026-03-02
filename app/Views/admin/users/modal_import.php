<div x-show="showImport" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div x-show="showImport" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showImport = false"></div>

        <div x-show="showImport" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full">
            <div class="bg-gradient-to-r from-teal-500 to-emerald-600 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white"><i class="fas fa-file-excel mr-2"></i>Import Data User</h3>
                <button @click="showImport = false" class="text-white/80 hover:text-white"><i class="fas fa-times text-xl"></i></button>
            </div>
            
            <form action="<?= base_url('admin/users/import') ?>" method="POST" enctype="multipart/form-data" class="p-6 text-left">
                <div class="mb-4 text-sm text-gray-600 bg-teal-50 p-4 rounded-xl border border-teal-100">
                    <p class="font-bold text-teal-800 mb-1">Format Excel (.xlsx / .xls)</p>
                    <p>Kolom A: Username</p>
                    <p>Kolom B: Password (Teks)</p>
                    <p>Kolom C: Nama Lengkap</p>
                    <p>Kolom D: Level (ADMIN, STAFF, dll)</p>
                    <p class="text-xs mt-2 italic text-teal-600">*Baris pertama akan diabaikan (header).</p>
                </div>

                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition-colors relative group">
                    <input type="file" name="file_excel" accept=".xlsx, .xls" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 group-hover:text-emerald-500 mb-2 transition-colors"></i>
                    <p class="text-sm font-semibold text-gray-700">Klik atau drag file Excel ke sini</p>
                </div>
                
                <div class="pt-6 flex justify-end gap-2 mt-2">
                    <button type="button" @click="showImport = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white font-bold rounded-lg hover:bg-emerald-700 shadow-md transition-colors flex items-center gap-2">
                        <i class="fas fa-upload"></i> Proses Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>