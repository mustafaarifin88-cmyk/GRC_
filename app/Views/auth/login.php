<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GRC System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes gradient-xy {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .animate-gradient-xy {
            background-size: 300% 300%;
            animation: gradient-xy 10s ease infinite;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 animate-gradient-xy h-screen flex items-center justify-center p-4">

    <div class="glass-card rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all hover:scale-105 duration-500">
        <div class="p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 text-white shadow-lg mb-4">
                    <i class="fas fa-shield-alt text-4xl"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">GRC <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">System</span></h1>
                <p class="text-sm text-gray-500 mt-2 font-medium">Governance, Risk, and Compliance</p>
            </div>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="bg-red-100/80 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-3 backdrop-blur-sm">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/process') ?>" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700" for="username">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-indigo-400"></i>
                        </div>
                        <input type="text" name="username" id="username" required autocomplete="off" class="w-full pl-11 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder-gray-400 text-gray-700 font-medium" placeholder="Masukkan username">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700" for="password">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-indigo-400"></i>
                        </div>
                        <input type="password" name="password" id="password" required class="w-full pl-11 pr-4 py-3 bg-white/60 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all placeholder-gray-400 text-gray-700 font-medium" placeholder="Masukkan password">
                    </div>
                </div>

                <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg transform transition-all hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-indigo-300 flex items-center justify-center gap-2">
                    <span>Masuk Aplikasi</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
        
        <div class="bg-gray-50/50 py-4 text-center border-t border-white/20 backdrop-blur-md">
            <p class="text-xs text-gray-500 font-medium">&copy; <?= date('Y') ?> PT GRC Indonesia</p>
        </div>
    </div>

</body>
</html>