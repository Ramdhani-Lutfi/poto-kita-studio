<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - POTO KITA</title>
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
        .stat-card {
            background-color: #1c1c1e;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 24px;
            height: 100%;
        }
        .table-custom {
            background-color: #1c1c1e;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .table-custom th {
            background-color: #27272a;
            color: #a1a1aa;
            border: none;
            padding: 16px;
        }
        .table-custom td {
            background-color: #1c1c1e;
            color: #ffffff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 16px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <?php 
    if (!isset($my_orders)) { $my_orders = []; } 

    // Hitung ringkasan widget di atas tabel
    $totalSesi = count($my_orders);
    $outputReady = 0;
    foreach ($my_orders as $order) {
        if (!empty($order['link_drive'])) {
            $outputReady++;
        }
    }
    ?>

    <!-- SIDEBAR CUSTOMER (MURNI LINK NAVIGASI ROUTE) -->
    <div class="sidebar">
        <div>
            <h3 class="mb-4"><a href="#" class="brand-title">POTO KITA</a></h3>
            <nav>
                <!-- Menu 1: Riwayat Foto (Halaman Ini Aktif) -->
                <a href="<?= base_url('customer/dashboard') ?>" class="nav-menu-link active">
                    <i class="fa-solid fa-folder-open me-2"></i> Riwayat Foto
                </a>
                <!-- Menu 2: Output Berkas Foto (Link Baru Hasil Request) -->
                <a href="<?= base_url('customer/output-foto') ?>" class="nav-menu-link">
                    <i class="fa-solid fa-images me-2"></i> Output Berkas Foto
                    <?php if($outputReady > 0): ?>
                        <span class="badge bg-success ms-2" style="font-size: 10px;"><?= $outputReady ?></span>
                    <?php endif; ?>
                </a>
                <!-- Menu 3: Sesi Booking Baru -->
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

    <!-- MAIN PANEL CONTENT -->
    <div class="main-content">
        <h2 class="fw-bold mb-1">Halo, <?= esc(session()->get('nama_user') ?? 'Customer') ?>! 👋</h2>
        <p class="text-secondary mb-4">Berikut adalah daftar riwayat booking studio dan berkas unduhan hasil foto kamu</p>

        <!-- WIDGET INDIKATOR RINGKASAN ATAS -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="stat-card" style="border-left: 4px solid #ef4444;">
                    <span class="text-secondary small fw-bold text-uppercase d-block">Total Riwayat Sesi Foto</span>
                    <h3 class="fw-bold mt-2 mb-0"><?= $totalSesi ?> <span class="fs-6 text-secondary fw-normal">Sesi Terdaftar</span></h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card" style="border-left: 4px solid #10b981;">
                    <span class="text-secondary small fw-bold text-uppercase d-block">Berkas Hasil Foto Siap Unduh</span>
                    <h3 class="fw-bold mt-2 mb-0 text-success"><?= $outputReady ?> <span class="fs-6 text-secondary fw-normal">Folder Drive</span></h3>
                </div>
            </div>
        </div>

        <!-- TABEL UTAMA HISTORI (SUDAH DI-FIX PERGESERAN KOLOMNYA) -->
        <h4 class="fw-bold mb-3"><i class="fa-solid fa-history text-danger me-2"></i> HISTORI SESI PHOTO KAMU</h4>
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Studio</th>
                        <th>Tanggal Sesi</th>
                        <th>Jam Sesi</th>
                        <th>Status Invoice</th>
                        <th>Aksi / Kontak</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($my_orders)) : $no = 1; foreach ($my_orders as $order) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="fw-bold text-danger"><?= esc($order['invoice_number'] ?? '-') ?></td>
                            <td><span class="badge bg-secondary"><?= esc($order['tipe_studio'] ?? $order['studio'] ?? 'Regular Studio') ?></span></td>
                            
                            <!-- FIX PRESISI KOLOM: Sesuai Gambar image_45ded1.png tidak terbalik lagi -->
                            <td class="text-white fw-bold">
                                <i class="fa-regular fa-calendar text-info me-2"></i><?= esc($order['tanggal_foto'] ?? $order['tanggal_sesi'] ?? '-') ?>
                            </td>
                            <td>
                                <span class="badge bg-dark border border-secondary"><?= esc($order['jam_foto'] ?? $order['jam_sesi'] ?? '-') ?> WIB</span>
                            </td>
                            
                            <td>
                                <?php 
                                $status = strtolower(trim($order['status_booking'] ?? ''));
                                if ($status === 'confirmed' || $status === 'lunas' || $status === 'selesai') : 
                                ?>
                                    <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> VERIFIED / PAID</span>
                                <?php elseif ($status === 'batal' || $status === 'ditolak') : ?>
                                    <span class="badge bg-danger"><i class="fa-solid fa-circle-xmark me-1"></i> BATAL</span>
                                <?php else : ?>
                                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> Menunggu Validasi</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- FITUR UPLOAD: Muncul hanya jika status masih pending/belum bayar -->
                                    <?php if ($status !== 'confirmed' && $status !== 'lunas' && $status !== 'selesai' && $status !== 'batal' && $status !== 'ditolak') : ?>
                                        <a href="<?= base_url('customer/upload-pembayaran/' . ($order['id_booking'] ?? $order['id'])) ?>" class="btn btn-sm btn-warning fw-bold text-dark">
                                            <i class="fa-solid fa-upload me-1"></i> Upload Bukti
                                        </a>
                                    <?php else: ?>
                                        <span class="text-secondary small italic align-self-center">No Action Required</span>
                                    <?php endif; ?>
                                    
                                    <!-- FITUR CHAT ADMIN -->
                                    <a href="https://api.whatsapp.com/send?phone=62895709055155&text=Halo%20Admin%20POTO%20KITA,%20saya%20mau%20konfirmasi%20mengenai%20Invoice%20<?= esc($order['invoice_number']) ?>" target="_blank" class="btn btn-sm btn-outline-success">
                                        <i class="fa-brands fa-whatsapp me-1"></i> Chat Admin
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; else : ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Kamu belum memiliki riwayat transaksi booking.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>