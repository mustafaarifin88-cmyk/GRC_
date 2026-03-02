<?= $this->extend('layout/master') ?>

<?= $this->section('content') ?>
<div x-data="{ activeTab: 'pimpinan' }" class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
    
    <div class="bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 px-8 py-6">
        <h3 class="text-2xl font-extrabold text-white flex items-center gap-3">
            <i class="fas fa-sitemap"></i> Setting Hierarchy Approval
        </h3>
        <p class="text-indigo-100 text-sm mt-1">Tentukan bawahan langsung untuk setiap level jabatan.</p>
    </div>

    <div class="flex overflow-x-auto border-b border-gray-200 bg-gray-50 px-4 pt-2 custom-scrollbar">
        <button @click="activeTab = 'pimpinan'" :class="activeTab === 'pimpinan' ? 'border-indigo-600 text-indigo-700 bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'" class="px-6 py-3 border-b-2 font-bold text-sm whitespace-nowrap rounded-t-lg transition-all flex items-center gap-2">
            <i class="fas fa-chess-king"></i> Pimpinan Tinggi
        </button>
        <button @click="activeTab = 'managerial'" :class="activeTab === 'managerial' ? 'border-indigo-600 text-indigo-700 bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'" class="px-6 py-3 border-b-2 font-bold text-sm whitespace-nowrap rounded-t-lg transition-all flex items-center gap-2">
            <i class="fas fa-chess-queen"></i> Managerial
        </button>
        <button @click="activeTab = 'supervisor'" :class="activeTab === 'supervisor' ? 'border-indigo-600 text-indigo-700 bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'" class="px-6 py-3 border-b-2 font-bold text-sm whitespace-nowrap rounded-t-lg transition-all flex items-center gap-2">
            <i class="fas fa-chess-knight"></i> Supervisor
        </button>
        <button @click="activeTab = 'kepala_unit'" :class="activeTab === 'kepala_unit' ? 'border-indigo-600 text-indigo-700 bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100'" class="px-6 py-3 border-b-2 font-bold text-sm whitespace-nowrap rounded-t-lg transition-all flex items-center gap-2">
            <i class="fas fa-chess-rook"></i> Kepala Unit
        </button>
    </div>

    <div class="p-8 bg-white min-h-[400px]">
        <?= $this->include('admin/hierarchy/tab_pimpinan') ?>
        
        <div x-show="activeTab === 'managerial'" style="display: none;" class="text-center py-20">
            <i class="fas fa-tools text-6xl text-gray-200 mb-4"></i>
            <h4 class="text-xl font-bold text-gray-400">Implementasi Tab Managerial Serupa</h4>
        </div>
        <div x-show="activeTab === 'supervisor'" style="display: none;" class="text-center py-20">
            <i class="fas fa-tools text-6xl text-gray-200 mb-4"></i>
            <h4 class="text-xl font-bold text-gray-400">Implementasi Tab Supervisor Serupa</h4>
        </div>
        <div x-show="activeTab === 'kepala_unit'" style="display: none;" class="text-center py-20">
            <i class="fas fa-tools text-6xl text-gray-200 mb-4"></i>
            <h4 class="text-xl font-bold text-gray-400">Implementasi Tab Kepala Unit Serupa</h4>
        </div>
    </div>
</div>
<?= $this->endSection() ?>