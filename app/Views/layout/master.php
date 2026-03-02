<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'GRC System' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes gradientX {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradientX 12s ease infinite;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased overflow-hidden" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 animate-gradient">
        <?= $this->include('layout/sidebar') ?>

        <div class="flex-1 flex flex-col overflow-hidden">
            <?= $this->include('layout/header') ?>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent p-4 md:p-6">
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 border border-green-200 text-green-700 shadow-sm flex items-center gap-3 animate-bounce">
                        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="mb-4 px-4 py-3 rounded-lg bg-red-100 border border-red-200 text-red-700 shadow-sm flex items-center gap-3">
                        <i class="fas fa-exclamation-triangle"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="glass-panel rounded-2xl p-6 shadow-xl">
                    <?= $this->renderSection('content') ?>
                </div>
            </main>

            <?= $this->include('layout/footer') ?>
        </div>
    </div>
</body>
</html>