<?= $this->extend('layout/master') ?>

<?= $this->section('content') ?>
<div x-data="{ showCreate: false, showEdit: false, showImport: false, editData: {} }" class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
    
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-5 flex flex-col sm:flex-row justify-between items-center gap-4">
        <h3 class="text-xl font-bold text-white flex items-center gap-3">
            <i class="fas fa-users-cog"></i> Manajemen Data User
        </h3>
        <div class="flex gap-2">
            <button @click="showImport = true" class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg font-semibold backdrop-blur-sm transition-all text-sm flex items-center gap-2">
                <i class="fas fa-file-excel"></i> Import
            </button>
            <button @click="showCreate = true" class="px-4 py-2 bg-white text-pink-600 hover:bg-gray-50 rounded-lg font-bold shadow-md transition-all text-sm flex items-center gap-2 transform hover:scale-105">
                <i class="fas fa-plus"></i> Tambah User
            </button>
        </div>
    </div>

    <div class="p-6 overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 text-gray-500 uppercase text-xs font-extrabold tracking-wider border-b-2 border-gray-200">
                    <th class="p-4 rounded-tl-xl">Profil</th>
                    <th class="p-4">Nama Lengkap</th>
                    <th class="p-4">Username</th>
                    <th class="p-4">Level</th>
                    <th class="p-4 rounded-tr-xl text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach($users as $u): ?>
                <tr class="hover:bg-indigo-50/30 transition-colors">
                    <td class="p-4">
                        <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200 shadow-sm">
                    </td>
                    <td class="p-4 font-bold text-gray-800"><?= $u['nama_lengkap'] ?></td>
                    <td class="p-4 text-gray-600"><?= $u['username'] ?></td>
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold border 
                            <?= $u['level'] === 'ADMIN' ? 'bg-red-50 text-red-600 border-red-200' : 
                               ($u['level'] === 'STAFF' ? 'bg-blue-50 text-blue-600 border-blue-200' : 'bg-purple-50 text-purple-600 border-purple-200') ?>">
                            <?= $u['level'] ?>
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button @click="editData = <?= htmlspecialchars(json_encode($u)) ?>; showEdit = true" class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-colors shadow-sm">
                                <i class="fas fa-pen text-xs"></i>
                            </button>
                            <form action="<?= base_url('admin/users/delete/' . $u['id']) ?>" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?');">
                                <button type="submit" class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors shadow-sm">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?= $this->include('admin/users/create') ?>
    <?= $this->include('admin/users/edit') ?>
    <?= $this->include('admin/users/modal_import') ?>

</div>
<?= $this->endSection() ?>