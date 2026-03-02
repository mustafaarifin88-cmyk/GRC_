<?= $this->extend('layout/master') ?>

<?= $this->section('content') ?>
<div class="max-w-5xl mx-auto">
    <div class="mb-4 flex items-center justify-between">
        <a href="<?= base_url('admin/pantau-laporan') ?>" class="px-4 py-2 bg-white border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition-colors flex items-center gap-2 shadow-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        
        <?php 
            $statusClass = 'bg-gray-100 text-gray-700';
            if($laporan['status'] == 'PROSES') $statusClass = 'bg-blue-100 text-blue-700';
            elseif($laporan['status'] == 'DITOLAK') $statusClass = 'bg-red-100 text-red-700';
            elseif($laporan['status'] == 'APPROVE_PT') $statusClass = 'bg-emerald-100 text-emerald-700';
            else $statusClass = 'bg-amber-100 text-amber-700';
        ?>
        <div class="px-4 py-2 rounded-xl font-extrabold text-sm uppercase tracking-wider border <?= $statusClass ?>">
            Status: <?= str_replace('_', ' ', $laporan['status']) ?>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 px-8 py-6 text-white relative overflow-hidden">
            <i class="fas fa-shield-alt absolute -right-4 -bottom-4 text-9xl text-white/5 opacity-20 transform -rotate-12"></i>
            <h2 class="text-3xl font-extrabold mb-2 relative z-10"><?= $laporan['judul'] ?></h2>
            <div class="flex flex-wrap gap-4 text-sm font-medium text-slate-300 relative z-10">
                <span class="flex items-center gap-1"><i class="fas fa-calendar-alt text-emerald-400"></i> <?= date('d F Y', strtotime($laporan['tanggal_audit'])) ?></span>
                <span class="flex items-center gap-1"><i class="fas fa-map-marker-alt text-emerald-400"></i> Area: <?= $laporan['nama_area'] ?></span>
                <span class="flex items-center gap-1"><i class="fas fa-user-edit text-emerald-400"></i> Auditor: <?= $laporan['nama_staff'] ?></span>
            </div>
        </div>

        <div class="p-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <h4 class="text-xs font-extrabold text-slate-500 uppercase tracking-widest mb-3 flex items-center gap-2"><i class="fas fa-file-contract text-indigo-500"></i> Catatan Kebijakan</h4>
                    <p class="text-gray-800 font-medium text-sm leading-relaxed"><?= nl2br($laporan['catatan_kebijakan'] ?? 'Tidak ada catatan.') ?></p>
                </div>
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <h4 class="text-xs font-extrabold text-slate-500 uppercase tracking-widest mb-3 flex items-center gap-2"><i class="fas fa-door-open text-orange-500"></i> Catatan Akses Fisik</h4>
                    <p class="text-gray-800 font-medium text-sm leading-relaxed"><?= nl2br($laporan['catatan_akses_fisik'] ?? 'Tidak ada catatan.') ?></p>
                </div>
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <h4 class="text-xs font-extrabold text-slate-500 uppercase tracking-widest mb-3 flex items-center gap-2"><i class="fas fa-video text-blue-500"></i> Catatan CCTV</h4>
                    <p class="text-gray-800 font-medium text-sm leading-relaxed"><?= nl2br($laporan['catatan_cctv'] ?? 'Tidak ada catatan.') ?></p>
                </div>
            </div>

            <div class="bg-rose-50 border border-rose-100 rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-rose-500"></div>
                <h3 class="text-lg font-bold text-rose-800 mb-4 flex items-center gap-2"><i class="fas fa-exclamation-triangle"></i> Detail Temuan Audit</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <span class="text-xs font-bold text-rose-400 uppercase tracking-wider block mb-1">Kategori Temuan</span>
                        <span class="inline-block px-3 py-1 bg-white border border-rose-200 text-rose-700 font-bold rounded-lg text-sm"><?= $laporan['temuan_kategori'] ?></span>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-rose-400 uppercase tracking-wider block mb-1">Dampak Risiko</span>
                        <span class="inline-block px-3 py-1 bg-white border border-rose-200 text-rose-700 font-bold rounded-lg text-sm"><?= $laporan['temuan_dampak'] ?></span>
                    </div>
                </div>
                
                <div class="bg-white p-4 rounded-xl border border-rose-100 text-gray-800 text-sm font-medium leading-relaxed">
                    <?= nl2br($laporan['temuan_deskripsi']) ?>
                </div>
            </div>

            <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-emerald-500"></div>
                <h3 class="text-lg font-bold text-emerald-800 mb-3 flex items-center gap-2"><i class="fas fa-lightbulb text-emerald-500"></i> Rekomendasi Tindakan</h3>
                <div class="bg-white p-4 rounded-xl border border-emerald-100 text-gray-800 text-sm font-medium leading-relaxed">
                    <?= nl2br($laporan['rekomendasi']) ?>
                </div>
            </div>

            <?php if($laporan['status'] == 'DITOLAK' && !empty($laporan['alasan_tolak'])): ?>
                <div class="bg-red-600 text-white rounded-2xl p-6 shadow-lg flex gap-4 items-start">
                    <i class="fas fa-ban text-3xl mt-1 opacity-80"></i>
                    <div>
                        <h4 class="font-bold text-lg mb-1">Laporan Ditolak</h4>
                        <p class="text-red-100 font-medium text-sm leading-relaxed">Alasan: <?= $laporan['alasan_tolak'] ?></p>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?= $this->endSection() ?>