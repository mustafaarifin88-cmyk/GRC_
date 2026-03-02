<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'GRC System' ?></title>
    
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/extensions/perfect-scrollbar/perfect-scrollbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/iconly.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/custom/custom_grc.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .animated-gradient {
            background-size: 300% 300% !important;
            animation: gradientBG 6s ease infinite !important;
            box-shadow: inset 0 0 20px rgba(0,0,0,0.3);
            border-right: none !important;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .sidebar-wrapper {
            transition: all 0.3s ease-out;
        }
        .layout-navbar {
            background-color: #f4f7f8;
        }
        .navbar-top {
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 0 0 15px 15px;
            margin-bottom: 20px;
        }
        .user-profile-img {
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        .brand-logo img {
            max-height: 50px;
            object-fit: contain;
            filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.3));
        }
        .sidebar-menu .sidebar-item .sidebar-link {
            border-radius: 10px;
            margin: 0 10px;
            transition: all 0.2s;
        }
        .sidebar-menu .sidebar-item.active > .sidebar-link {
            transform: translateX(5px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <script src="<?= base_url('assets/static/js/initTheme.js') ?>"></script>
    <div id="app">
        <?= $this->include('layouts/sidebar') ?>
        
        <div id="main" class='layout-navbar'>
            <?= $this->include('layouts/header') ?>
            
            <div id="main-content">
                <div class="page-heading d-flex justify-content-between align-items-center">
                    <h3><?= isset($title) ? $title : 'Dashboard' ?></h3>
                </div>
                
                <div class="page-content">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?= $this->renderSection('content') ?>
                </div>
                
                <?= $this->include('layouts/footer') ?>
            </div>
        </div>
    </div>
    
    <script src="<?= base_url('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/compiled/js/app.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>