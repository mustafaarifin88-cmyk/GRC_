<?= $this->extend('layout/master') ?>

<?= $this->section('content') ?>
<div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col h-full">
    
    <div class="bg-gradient-to-r from-slate-700 to-slate-900 px-6 py-5 flex justify-between items-center">
        <h3 class="text-xl font-bold text-white flex items-center gap-3">
            <i class="fas fa-chart-line text-emerald-400"></i> Pantau Seluruh Laporan Audit
        </h3>
    </div>

    <div class="p-6 border-b border-gray-100 bg-slate-50">
        <form action="" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="w-full md:w-1/3">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1 tracking-wider">Pilih Staff Auditor</label>
                <select name="staff_id" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-slate-500 outline-none font-semibold text-gray-700 bg-white">
                    <option value="">Semua Staff</option>
                    <?php foreach($staffs as $s): ?>
                        <option value="<?= $s['id'] ?>" <?= (isset($_GET['staff_id']) && $_GET['staff_id'] == $s['id']) ? 'selected' : '' ?>><?= $s['nama_lengkap'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="w-full md:w-1/4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1 tracking-wider">Tgl Mulai</label>
                <input type="date" name="start_date" value="<?= $_GET['start_date'] ?? '' ?>" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-slate-500 outline-none font-semibold text-gray-700 bg-white">
            </div>
            <div class="w-full md:w-1/4">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1 tracking-wider">Tgl Akhir</label>
                <input type="date" name="end_date" value="<?= $_GET['end_date'] ?? '' ?>" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-slate-500 outline-none font-semibold text-gray-700 bg-white">
            </div>
            <div class="w-full md:w-auto flex gap-2">
                <button type="submit" class="px-6 py-2 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl shadow-md transition-all flex items-center gap-2">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="<?= base_url('admin/pantau-laporan') ?>" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="p-6 overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-slate-100 text-slate-600 uppercase text-xs font-extrabold tracking-wider border-b-2 border-slate-200">
                    <th class="p-4 rounded-tl-xl">Tanggal</th>
                    <th class="p-4">Staff Auditor</th>
                    <th class="p-4">Area Audit</th>
                    <th class="p-4">Judul Audit</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 rounded-tr-xl text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach($laporan as $lap): ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-4 font-bold text-slate-700"><?= date('d M Y', strtotime($lap['tanggal_audit'])) ?></td>
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-user-circle text-slate-400 text-xl"></i>
                            <span class="font-semibold text-gray-800"><?= $lap['nama_staff'] ?></span>
                        </div>
                    </td>
                    <td class="p-4 font-medium text-emerald-600">
                        <i class="fas fa-map-marker-alt mr-1"></i> <?= $lap['nama_area'] ?>
                    </td>
                    <td class="p-4 font-bold text-gray-800 max-w-xs truncate" title="<?= $lap['judul'] ?>">
                        <?= $lap['judul'] ?>
                    </td>
                    <td class="p-4">
                        <?php 
                            $statusClass = 'bg-gray-100 text-gray-600 border-gray-200';
                            if($lap['status'] == 'PROSES') $statusClass = 'bg-blue-50 text-blue-600 border-blue-200';
                            elseif($lap['status'] == 'DITOLAK') $statusClass = 'bg-red-50 text-red-600 border-red-200';
                            elseif($lap['status'] == 'APPROVE_PT') $statusClass = 'bg-emerald-50 text-emerald-600 border-emerald-200';
                            else $statusClass = 'bg-amber-50 text-amber-600 border-amber-200';
                        ?>
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold border uppercase tracking-wider <?= $statusClass ?>">
                            <?= str_replace('_', ' ', $lap['status']) ?>
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <a href="<?= base_url('admin/pantau-laporan/detail/' . $lap['id']) ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-800 hover:text-white transition-all shadow-sm transform hover:scale-110">
                            <i class="fas fa-eye text-xs"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(empty($laporan)): ?>
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400">
                            <i class="fas fa-folder-open text-4xl mb-3 block"></i>
                            <span class="font-semibold">Tidak ada data laporan ditemukan.</span>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>