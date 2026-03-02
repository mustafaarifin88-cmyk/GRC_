<?php
$level = session()->get('level');
$prefix = strtolower(str_replace(' ', '_', $level));
if ($prefix == 'admin') $prefix = 'admin';
elseif ($prefix == 'staff') $prefix = 'staff';
?>
<header class="glass-panel z-10 sticky top-0 border-b border-gray-200/50 h-20 flex items-center justify-between px-6 shadow-sm">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none md:hidden hover:text-indigo-600 transition-colors">
            <i class="fas fa-bars text-2xl"></i>
        </button>
        <h2 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600 hidden sm:block">
            <?= $title ?? 'Dashboard' ?>
        </h2>
    </div>

    <div class="flex items-center gap-4 relative">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-gray-800"><?= session()->get('nama_lengkap') ?></p>
            <p class="text-xs text-indigo-600 font-semibold bg-indigo-50 px-2 py-0.5 rounded-full inline-block mt-1"><?= session()->get('level') ?></p>
        </div>
        
        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none transition-transform hover:scale-105">
                <img class="w-11 h-11 rounded-full object-cover border-2 border-indigo-200 shadow-md" src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" alt="Avatar">
            </button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100 py-1">
                <div class="px-4 py-3 border-b border-gray-100 sm:hidden">
                    <p class="text-sm font-bold text-gray-800"><?= session()->get('nama_lengkap') ?></p>
                    <p class="text-xs text-gray-500"><?= session()->get('level') ?></p>
                </div>
                <a href="<?= base_url($prefix . '/profile') ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors flex items-center gap-3">
                    <i class="fas fa-user-circle"></i> Edit Profil
                </a>
                <a href="<?= base_url('logout') ?>" class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors flex items-center gap-3">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</header>