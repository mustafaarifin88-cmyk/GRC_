<?= $this->extend('layout/master') ?>

<?= $this->section('content') ?>
<div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white shadow-lg transform hover:scale-[1.01] transition-transform duration-300">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
            <h2 class="text-3xl font-extrabold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-200">Selamat Datang, <?= session()->get('nama_lengkap') ?>!</h2>
            <p class="text-indigo-100 font-medium">Sistem Informasi Governance, Risk, and Compliance.</p>
        </div>
        <div class="mt-4 md:mt-0 bg-white/20 p-4 rounded-full backdrop-blur-sm border border-white/30 shadow-inner">
            <i class="fas fa-chart-pie text-5xl text-white"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-xl shadow-indigo-100/50 flex items-center gap-4 group hover:-translate-y-2 transition-transform duration-300">
        <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Total User</p>
            <h3 class="text-2xl font-bold text-gray-800">Manajemen</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-xl shadow-purple-100/50 flex items-center gap-4 group hover:-translate-y-2 transition-transform duration-300">
        <div class="w-14 h-14 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center text-2xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
            <i class="fas fa-building"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Perusahaan</p>
            <h3 class="text-2xl font-bold text-gray-800">Profil</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-xl shadow-pink-100/50 flex items-center gap-4 group hover:-translate-y-2 transition-transform duration-300">
        <div class="w-14 h-14 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center text-2xl group-hover:bg-pink-600 group-hover:text-white transition-colors">
            <i class="fas fa-sitemap"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Hierarchy</p>
            <h3 class="text-2xl font-bold text-gray-800">Struktur</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-xl shadow-green-100/50 flex items-center gap-4 group hover:-translate-y-2 transition-transform duration-300">
        <div class="w-14 h-14 rounded-full bg-green-50 text-green-600 flex items-center justify-center text-2xl group-hover:bg-green-600 group-hover:text-white transition-colors">
            <i class="fas fa-file-alt"></i>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Laporan</p>
            <h3 class="text-2xl font-bold text-gray-800">Pantau</h3>
        </div>
    </div>
</div>
<?= $this->endSection() ?>