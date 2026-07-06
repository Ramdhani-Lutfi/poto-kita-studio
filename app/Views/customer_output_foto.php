<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Output Foto - POTO KITA</title>
    <!-- Bootstrap 5.3 & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #121214;
            color: #ffffff;
            margin: 0;
            overflow-x: hidden;
        }
        .sidebar {
            width: 260px;
            background-color: #1c1c1e;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 24px;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 100;
        }
        .main-content {
            margin-left: 260px;
            padding: 40px;
            min-height: 100vh;
            width: calc(100% - 260px);
        }
        .brand-title {
            color: #ef4444;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: 0.5px;
        }
        .nav-menu-link {
            display: block;
            color: #a1a1aa;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        .nav-menu-link:hover, .nav-menu-link.active {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }
        .btn-logout-sidebar {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            padding: 12px 16px;
            border-radius: 8px;
            background-color: #ef4444;
            display: block;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-logout-sidebar:hover {
            background-color: #dc2626;
            color: #ffffff;
        }
        .photo-box-card {
            background-color: #1c1c1e;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
        }
        .photo-box-card:hover {
            transform: translateY(-4px);
            border-color: #10b981;
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.1);
        }
    </style>
</head>
<body>

    <?php 
    if (!isset($my_orders)) { $my_orders = []; } 
    
    // Saring data khusus yang link Google Drive-nya sudah diisi oleh Editor
    $orders_berkas_ready = [];
    foreach ($my_orders as $order) {
        if (!empty($order['link_drive'])) {
            $orders_berkas_ready[] = $order;
        }
    }
    ?>

    <!-- SIDEBAR NAVIGASI PORTAL CUSTOMER -->
    <div class="sidebar">
        <div>
            <h3 class="mb-4"><a href="#" class="brand-title">POTO KITA</a></h3>
            <nav>
                <a href="<?= base_url('customer/dashboard') ?>" class="nav-menu-link">
                    <i class="fa-solid fa-folder-open me-2"></i> Riwayat Foto
                </a>
                <a href="<?= base_url('customer/output-foto') ?>" class="nav-menu-link active">
                    <i class="fa-solid fa-images me-2"></i> Output Berkas Foto
                    <?php if(count($orders_berkas_ready) > 0): ?>
                        <span class="badge bg-success ms-2" style="font-size: 10px;"><?= count($orders_berkas_ready) ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= base_url('booking') ?>" class="nav-menu-link">
                    <i class="fa-solid fa-calendar-plus me-2"></i> Sesi Booking Baru
                </a>
            </nav>
        </div>
        
        <div>
            <a href="<?= base_url('auth/logout') ?>" class="btn-logout-sidebar text-center">
                <i class="fa-solid fa-right-from-bracket me-2"></i> KELUAR PORTAL
            </a>
        </div>
    </div>

    <!-- MAIN PANEL KONTEN -->
    <div class="main-content">
        <h2 class="fw-bold mb-1">Output Berkas Foto 📸</h2>
        <p class="text-secondary mb-5">Unduh seluruh berkas softfile digital hasil sesi studio kamu langsung melalui tautan privat Google Drive</p>

        <?php if (!empty($orders_berkas_ready)) : ?>
            <div class="row g-4">
                <?php foreach ($orders_berkas_ready as $berkas) : ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="photo-box-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-dark border border-success text-success fw-bold px-2 py-1"><?= esc($berkas['tipe_studio'] ?? 'Studio') ?></span>
                                <small class="text-secondary"><i class="fa-regular fa-calendar me-1"></i><?= esc($berkas['tanggal_foto'] ?? $berkas['tanggal_sesi'] ?? '-') ?></small>
                            </div>
                            <h5 class="fw-bold text-white mb-1"><?= esc($berkas['invoice_number']) ?></h5>
                            <p class="text-muted small mb-4">Sesi Jam: <?= esc($berkas['jam_foto'] ?? $berkas['jam_sesi'] ?? '-') ?> WIB</p>
                            
                            <a href="<?= esc($berkas['link_drive']) ?>" target="_blank" class="btn btn-success w-100 fw-bold py-2">
                                <i class="fa-solid fa-cloud-arrow-down me-2"></i> Buka Google Drive
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="text-center text-muted py-5 rounded" style="background-color: #1c1c1e; border: 1px solid rgba(255,255,255,0.05)">
                <i class="fa-solid fa-images d-block fs-1 mb-3 text-secondary" style="opacity: 0.3;"></i>
                <span class="fw-bold d-block text-white mb-1">Belum Ada Berkas Hasil Foto</span>
                <small class="text-secondary">Pastikan sesi foto kamu sudah berstatus Lunas dan selesai diproses oleh tim Editor kami.</small>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>