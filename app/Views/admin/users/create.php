<div x-show="showCreate" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div x-show="showCreate" x-transition.opacity class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="showCreate = false"></div>

        <div x-show="showCreate" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold text-white">Tambah User Baru</h3>
                <button @click="showCreate = false" class="text-white/80 hover:text-white"><i class="fas fa-times text-xl"></i></button>
            </div>
            
            <form action="<?= base_url('admin/users/create') ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 text-left">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 focus:bg-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 focus:bg-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 focus:bg-white">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Level Akses</label>
                    <select name="level" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50 focus:bg-white cursor-pointer">
                        <option value="ADMIN">ADMIN</option>
                        <option value="PIMPINAN TINGGI">PIMPINAN TINGGI</option>
                        <option value="MANAGERIAL">MANAGERIAL</option>
                        <option value="SUPERVISOR">SUPERVISOR</option>
                        <option value="KEPALA UNIT">KEPALA UNIT</option>
                        <option value="STAFF">STAFF</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Profil</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>
                
                <div class="pt-4 flex justify-end gap-2 border-t border-gray-100 mt-6">
                    <button type="button" @click="showCreate = false" class="px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 shadow-md transition-colors">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>