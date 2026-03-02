<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GRC System</title>
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .auth-bg {
            background: linear-gradient(-45deg, #1e3c72, #2a5298, #0f0c29, #302b63, #4b6cb7);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .card-auth {
            backdrop-filter: blur(15px);
            background-color: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }
        [data-bs-theme="dark"] .card-auth {
            background-color: rgba(30, 30, 30, 0.85);
            border-color: rgba(255,255,255,0.1);
        }
        .auth-logo {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            border: 3px solid #fff;
        }
        .form-control-xl {
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 1rem;
            background: rgba(255,255,255,0.9);
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        .form-control-xl:focus {
            box-shadow: 0 0 15px rgba(67, 100, 247, 0.3);
            border-color: #4364F7;
        }
        .btn-auth {
            background: linear-gradient(135deg, #0052D4 0%, #4364F7 50%, #6FB1FC 100%);
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 82, 212, 0.4);
        }
    </style>
</head>
<body class="auth-bg">
    <div class="card-auth text-center">
        <?php
        $db = \Config\Database::connect();
        $company = $db->table('tb_company_profile')->get()->getRowArray();
        $logo = $company['logo'] ?? 'default-logo.png';
        $nama_perusahaan = $company['nama_perusahaan'] ?? 'GRC System';
        ?>
        <img src="<?= base_url('uploads/company_logo/' . $logo) ?>" alt="Logo" class="auth-logo">
        <h3 class="fw-bold mb-1">Welcome Back!</h3>
        <p class="text-muted mb-4"><?= esc($nama_perusahaan) ?></p>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger rounded-pill shadow-sm py-2">
                <i class="fas fa-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/process') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="text" class="form-control form-control-xl" placeholder="Username" name="username" required autocomplete="off">
                <div class="form-control-icon" style="margin-top: -3px;">
                    <i class="fas fa-user text-primary"></i>
                </div>
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required>
                <div class="form-control-icon" style="margin-top: -3px;">
                    <i class="fas fa-lock text-primary"></i>
                </div>
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3 btn-auth text-white">Log in</button>
        </form>
    </div>
</body>
</html>