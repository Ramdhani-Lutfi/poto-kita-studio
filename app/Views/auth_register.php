<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member - POTO KITA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
        .register-card {
            background-color: #1c1c1e;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        .brand-title {
            color: #ef4444;
            font-weight: 800;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .form-control-custom {
            background-color: #27272a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 12px 16px;
            border-radius: 8px;
        }
        .form-control-custom:focus {
            background-color: #27272a;
            border-color: #ef4444;
            color: #ffffff;
            box-shadow: none;
        }
        .btn-register {
            background-color: #ef4444;
            border: none;
            padding: 12px;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background-color: #dc2626;
        }
        .input-group-text-custom {
            background-color: #27272a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #a1a1aa;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="text-center mb-4">
            <h2 class="brand-title mb-1">POTO KITA</h2>
            <p class="text-secondary small">Daftar akun member untuk pantau histori foto kamu</p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger border-0 small bg-danger text-white" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/register_process') ?>" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-user-tag"></i></span>
                    <input type="text" name="nama_lengkap" class="form-control form-control-custom" placeholder="Masukkan nama lengkap Anda" required>
                </div>
            </div>
            <!-- INPUT NOMOR WHATSAPP BARU -->
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nomor WhatsApp (Aktif)</label>
                <div class="input-group">
                    <span class="input-group-text input-group-text-custom"><i class="fa-brands fa-whatsapp fw-bold text-success"></i></span>
                    <input type="number" name="no_whatsapp" class="form-control form-control-custom" placeholder="Contoh: 0812xxxxxxxx" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Username Baru</label>
                <div class="input-group">
                    <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-user"></i></span>
                    <input type="text" name="username" class="form-control form-control-custom" placeholder="Buat username Anda" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <div class="input-group">
                    <span class="input-group-text input-group-text-custom"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control form-control-custom" placeholder="Buat password aman Anda" required>
                </div>
            </div>

            <button type="submit" class="btn btn-register w-100 text-white mb-3">DAFTAR JADI MEMBER</button>
            
          

            <div class="text-center">
                <span class="text-secondary small">Sudah punya akun? <a href="<?= base_url('login') ?>" class="text-danger text-decoration-none fw-bold">Login di sini</a></span>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>