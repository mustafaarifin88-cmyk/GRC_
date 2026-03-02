<?php
$level = session()->get('level');
$sidebarColor = get_sidebar_color($level);
$prefix = strtolower(str_replace(' ', '_', $level));
if ($prefix == 'admin') $prefix = 'admin';
elseif ($prefix == 'staff') $prefix = 'staff';
?>

<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 transition duration-300 transform md:relative md:translate-x-0 shadow-2xl <?= $sidebarColor ?> animate-gradient text-white flex flex-col">
    <div class="flex items-center justify-center h-20 border-b border-white/20 bg-black/10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-indigo-600 text-xl font-bold shadow-lg">
                <i class="fas fa-shield-alt"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-wider">GRC Pro</span>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="<?= base_url($prefix . '/dashboard') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
            <i class="fas fa-home w-5"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <?php if ($level === 'ADMIN'): ?>
            <a href="<?= base_url('admin/perusahaan') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-building w-5"></i>
                <span class="font-medium">Perusahaan</span>
            </a>
            <a href="<?= base_url('admin/users') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-users w-5"></i>
                <span class="font-medium">Manajemen User</span>
            </a>
            <a href="<?= base_url('admin/hierarchy') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-sitemap w-5"></i>
                <span class="font-medium">Hierarchy</span>
            </a>
            <a href="<?= base_url('admin/master-data') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-database w-5"></i>
                <span class="font-medium">Master Data</span>
            </a>
            <a href="<?= base_url('admin/pantau-laporan') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-chart-line w-5"></i>
                <span class="font-medium">Pantau Laporan</span>
            </a>
        <?php endif; ?>

        <?php if ($level === 'STAFF'): ?>
            <a href="<?= base_url('staff/audit-bond') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-file-signature w-5"></i>
                <span class="font-medium">Input Audit</span>
            </a>
            <a href="<?= base_url('staff/progres-laporan') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-tasks w-5"></i>
                <span class="font-medium">Progres Laporan</span>
            </a>
        <?php endif; ?>

        <?php if (in_array($level, ['KEPALA UNIT', 'SUPERVISOR', 'MANAGERIAL', 'PIMPINAN TINGGI'])): ?>
            <a href="<?= base_url($prefix . '/approval') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/20 transition-all duration-200">
                <i class="fas fa-check-double w-5"></i>
                <span class="font-medium">Approval Audit</span>
            </a>
        <?php endif; ?>
    </nav>
    
    <div class="p-4 border-t border-white/20 bg-black/10">
        <a href="<?= base_url('logout') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-200 text-white/90">
            <i class="fas fa-sign-out-alt w-5"></i>
            <span class="font-medium">Logout</span>
        </a>
    </div>
</div>

<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black/50 backdrop-blur-sm md:hidden" x-transition></div>