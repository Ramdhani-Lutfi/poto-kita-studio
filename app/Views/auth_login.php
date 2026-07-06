<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal - POTO KITA STUDIO</title>
    <!-- Bootstrap 5.3 CSS & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts Modern -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #121214;
            color: #ffffff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            background-color: #1c1c1e;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.4);
        }
        .form-control-custom {
            background-color: #27272a !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            padding: 12px 16px;
            border-radius: 8px;
        }
        .form-control-custom:focus {
            border-color: #ef4444 !important;
            box-shadow: none !important;
        }
        .btn-tactical-red {
            background-color: #ef4444;
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            border-radius: 8px;
            border: none;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-tactical-red:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }
        .brand-link {
            text-decoration: none;
            color: #ef4444;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <!-- BRAND HEADER -->
    <h3 class="fw-extrabold mb-2" style="font-weight: 800;">
        <a href="<?= base_url('/') ?>" class="brand-link">POTO KITA</a>
    </h3>
    <p class="text-secondary small mb-4">Silakan masuk untuk mengakses sistem portal Anda</p>

    <!-- NOTIFIKASI ERROR JIKA LOGIN GAGAL -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger py-2 small" style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #ef4444;">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- FORM LOGIN (Sudah diarahkan ke login_process) -->
    <form action="<?= base_url('auth/login_process') ?>" method="POST">
        <?= csrf_field(); ?>
        
<!-- Tombol Kembali ke Halaman Utama (Landing Page) -->
<div class="mb-3 text-start">
    <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary btn-sm fw-bold px-3 py-2" style="border-radius: 8px; border-color: rgba(255,255,255,0.15); color: #a1a1aa;">
        <i class="fa-solid fa-arrow-left me-2"></i> KEMBALI KE BERANDA
    </a>
</div>

        <!-- INPUT USERNAME -->
        <div class="mb-3 text-start">
            <label for="username" class="form-label small text-secondary fw-bold">Username</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0" style="border: 1px solid rgba(255, 255, 255, 0.1); color: #a1a1aa;">
                    <i class="fa-solid fa-user"></i>
                </span>
                <input type="text" name="username" id="username" class="form-control form-control-custom border-start-0 ps-0" placeholder="Masukkan username Anda" required>
            </div>
        </div>

        <!-- INPUT PASSWORD -->
        <div class="mb-4 text-start">
            <label for="password" class="form-label small text-secondary fw-bold">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0" style="border: 1px solid rgba(255, 255, 255, 0.1); color: #a1a1aa;">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" name="password" id="password" class="form-control form-control-custom border-start-0 ps-0" placeholder="Masukkan password Anda" required>
            </div>
        </div>

        <!-- BUTTON SUBMIT -->
        <button type="submit" class="btn btn-tactical-red text-uppercase tracking-wider">Masuk Ke Portal</button>
    </form>

    <!-- FOOTER NAVIGASI -->
    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.05);">
        <p class="small text-muted m-0">Belum punya akun customer? <a href="<?= base_url('register') ?>" class="text-danger text-decoration-none fw-semibold">Daftar di sini</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>