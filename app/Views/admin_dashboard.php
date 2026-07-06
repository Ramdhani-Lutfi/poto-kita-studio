<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - POTO KITA</title>
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
            cursor: pointer;
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
    if (!isset($orders)) { $orders = []; } 
    
    // MENGUNCI TANGGAL HARI INI SECARA REAL-TIME SINKRON
    $hari_ini = date('Y-m-d'); 
    
    $totalSesi = count($orders);
    $omzetReal = 0;
    $menungguVerifikasi = 0;

    $orders_hari_ini = [];
    $orders_pending = [];

    foreach ($orders as $order) {
        $st = strtolower($order['status_booking'] ?? $order['status_konfirmasi'] ?? '');
        $tanggal_booking = trim($order['tanggal_foto'] ?? $order['tanggal_sesi'] ?? '');

        // 1. Hitung Ringkasan Keuangan Omzet Real Lunas
        if ($st === 'confirmed' || $st === 'lunas' || $st === 'selesai') {
            $omzetReal += intval($order['total_harga'] ?? 150000);
        } elseif ($st === 'pending' || $st === 'menunggu validasi' || $st === '') {
            $menungguVerifikasi++;
            $orders_pending[] = $order;
        }

        // 2. FILTER KETAT: Hanya masukkan jika tanggal booking SAMA PERSIS dengan hari ini (Hari-H)
        if ($tanggal_booking === $hari_ini) {
            $orders_hari_ini[] = $order;
        }
    }
    ?>

    <!-- SIDEBAR KIRI (MULTI-TAB) -->
    <div class="sidebar">
        <div>
            <h3 class="mb-4"><a href="#" class="brand-title">POTO KITA</a></h3>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-menu-link active border-0 text-start w-100" id="tab-utama" data-bs-toggle="pill" data-bs-target="#konten-utama" type="button" role="tab">
                    <i class="fa-solid fa-calendar-check me-2"></i> Dashboard Utama
                </button>
                <button class="nav-menu-link border-0 text-start w-100" id="tab-booking" data-bs-toggle="pill" data-bs-target="#konten-booking" type="button" role="tab">
                    <i class="fa-solid fa-database me-2"></i> Data Booking Real
                </button>
                <button class="nav-menu-link border-0 text-start w-100" id="tab-verifikasi" data-bs-toggle="pill" data-bs-target="#konten-verifikasi" type="button" role="tab">
                    <i class="fa-solid fa-circle-check me-2"></i> Antrian Verifikasi 
                    <?php if($menungguVerifikasi > 0): ?>
                        <span class="badge bg-danger ms-2" style="font-size: 10px;"><?= $menungguVerifikasi ?></span>
                    <?php endif; ?>
                </button>
            </div>
        </div>
        
        <div>
            <a href="<?= base_url('auth/logout') ?>" class="btn-logout-sidebar text-center">
                <i class="fa-solid fa-right-from-bracket me-2"></i> KELUAR PORTAL
            </a>
        </div>
    </div>

    <!-- MAIN PANEL WRAPPER -->
    <div class="main-content">
        <h2 class="fw-bold mb-1">Selamat Datang, <?= session()->get('nama_user') ?></h2>
        <p class="text-secondary mb-4">Ringkasan operasional dan monitoring jadwal studio hari ini secara real-time</p>

        <!-- Flash Message Notification -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success bg-success text-white border-0 mb-4"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <!-- KOTAK RINGKASAN DATA MODERN -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card" style="border-top: 4px solid #3b82f6;">
                    <span class="text-secondary small fw-bold text-uppercase d-block">Total Sesi Masuk</span>
                    <h2 class="fw-bold mt-2 mb-0"><?= $totalSesi ?> <span class="fs-6 text-secondary fw-normal">Sesi Order</span></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="border-top: 4px solid #10b981;">
                    <span class="text-secondary small fw-bold text-uppercase d-block">Total Pendapatan Riil</span>
                    <h2 class="fw-bold mt-2 mb-0 text-success">Rp <?= number_format($omzetReal, 0, ',', '.') ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="border-top: 4px solid #f59e0b;">
                    <span class="text-secondary small fw-bold text-uppercase d-block">Menunggu Verifikasi</span>
                    <h2 class="fw-bold mt-2 mb-0 text-warning"><?= $menungguVerifikasi ?> <span class="fs-6 text-secondary fw-normal">Antrian Pending</span></h2>
                </div>
            </div>
        </div>

        <!-- ISI KONTEN PER TAB NAVIGATION -->
        <div class="tab-content" id="v-pills-tabContent">
            
            <!-- ================= TAB 1: DASHBOARD UTAMA (JADWAL SESI HARI H SAJA) ================= -->
            <div class="tab-pane fade show active" id="konten-utama" role="tabpanel">
                <h4 class="fw-bold mb-3 text-uppercase" style="color: #3b82f6;"><i class="fa-solid fa-calendar-days me-2"></i> Jadwal Sesi foto hari ini</h4>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Nama Customer</th>
                                <th>WhatsApp</th>
                                <th>Tanggal Booking</th>
                                <th>Jam Sesi</th>
                                <th>Status Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders_hari_ini)) : $n1=1; foreach ($orders_hari_ini as $order) : ?>
                                <tr>
                                    <td><?= $n1++ ?></td>
                                    <td class="fw-bold text-white"><?= esc($order['invoice_number']) ?></td>
                                    <td class="text-white fw-bold"><?= esc($order['nama_customer']) ?></td>
                                    <td><?= esc($order['no_whatsapp'] ?? $order['whatsapp_customer'] ?? '-') ?></td>
                                    <td class="text-white fw-bold"><i class="fa-regular fa-calendar me-2 text-info"></i><?= esc($order['tanggal_foto'] ?? '-') ?></td>
                                    <td><span class="badge bg-primary"><?= esc($order['jam_foto'] ?? '-') ?> WIB</span></td>
                                    <td>
                                        <?php 
                                        $sv = strtolower($order['status_booking'] ?? $order['status_konfirmasi'] ?? '');
                                        if ($sv==='confirmed'||$sv==='lunas'||$sv==='selesai') echo '<span class="badge bg-success">CONFIRMED</span>';
                                        elseif ($sv==='batal'||$sv==='ditolak') echo '<span class="badge bg-danger">BATAL</span>';
                                        else echo '<span class="badge bg-warning text-dark">PENDING</span>';
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; else : ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-calendar-xmark d-block fs-2 mb-3 text-secondary"></i>
                                        Tidak ada jadwal sesi proses foto untuk hari ini (<?= date('d/m/Y') ?>).
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= TAB 2: DATA BOOKING REAL (SELURUH DATA LOG) ================= -->
            <div class="tab-pane fade" id="konten-booking" role="tabpanel">
                <h4 class="fw-bold mb-3 text-uppercase text-white"><i class="fa-solid fa-database me-2"></i> Seluruh Log Data Transaksi & Bukti Transfer</h4>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Nama Customer</th>
                                <th>WhatsApp</th>
                                <th>Jadwal Sesi</th>
                                <th>Bukti Bayar</th>
                                <th>Status Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)) : $n2=1; foreach ($orders as $order) : ?>
                                <tr>
                                    <td><?= $n2++ ?></td>
                                    <td class="fw-bold text-white"><?= esc($order['invoice_number']) ?></td>
                                    <td class="text-white fw-bold"><?= esc($order['nama_customer']) ?></td>
                                    <td><?= esc($order['no_whatsapp'] ?? $order['whatsapp_customer'] ?? '-') ?></td>
                                    <td><?= esc($order['tanggal_foto']) ?> <small class="text-secondary">(<?= esc($order['jam_foto']) ?> WIB)</small></td>
                                    <td>
    <?php if (!empty($order['bukti_transfer'])) : ?>
        <a href="<?= base_url('uploads/' . $order['bukti_transfer']) ?>" target="_blank" class="btn btn-sm btn-outline-info fw-bold">
            <i class="fa-solid fa-image"></i> Lihat Bukti
        </a>
    <?php else : ?>
        <span class="text-muted small italic">Belum Upload</span>
    <?php endif; ?>
</td>
                                    <td>
                                        <?php 
                                        $sv = strtolower($order['status_booking'] ?? $order['status_konfirmasi'] ?? '');
                                        if ($sv==='confirmed'||$sv==='lunas'||$sv==='selesai') echo '<span class="badge bg-success">SELESAI / PAID</span>';
                                        elseif ($sv==='batal'||$sv==='ditolak') echo '<span class="badge bg-danger">DITOLAK / BATAL</span>';
                                        else echo '<span class="badge bg-warning text-dark">PENDING</span>';
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; else : ?>
                                <tr><td colspan="7" class="text-center text-muted py-4">Data kosong.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= TAB 3: ANTRIAN VERIFIKASI (AKSI VALIDASI) ================= -->
            <div class="tab-pane fade" id="konten-verifikasi" role="tabpanel">
                <h4 class="fw-bold mb-3 text-uppercase text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i> Butuh Validasi Pembayaran Customer</h4>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Nama Customer</th>
                                <th>Jadwal Sesi</th>
                                <th>Bukti</th>
                                <th>Aksi Operasional</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders_pending)) : foreach ($orders_pending as $order) : ?>
                                <tr>
                                    <td class="fw-bold text-white"><?= esc($order['invoice_number']) ?></td>
                                    <td class="text-white fw-bold"><?= esc($order['nama_customer']) ?></td>
                                    <td><?= esc($order['tanggal_foto']) ?> <br><small class="badge bg-secondary mt-1"><?= esc($order['jam_foto']) ?> WIB</small></td>
                                    <td>
                                        <?php if (!empty($order['bukti_transfer'])) : ?>
                                            <a href="<?= base_url('uploads/' . $order['bukti_transfer']) ?>" target="_blank" class="btn btn-sm btn-outline-info fw-bold"><i class="fa-solid fa-image"></i> Cek</a>
                                        <?php else : ?>
                                            <span class="text-muted small italic">Kosong</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <form action="<?= base_url('admin/update-status/' . ($order['id_booking'] ?? $order['id'] ?? 0)) ?>" method="POST" class="d-inline">
                                                <input type="hidden" name="status" value="Confirmed">
                                                <button type="submit" class="btn btn-sm btn-success fw-bold"><i class="fa-solid fa-check"></i> Setuju</button>
                                            </form>
                                            <form action="<?= base_url('admin/update-status/' . ($order['id_booking'] ?? $order['id'] ?? 0)) ?>" method="POST" class="d-inline">
                                                <input type="hidden" name="status" value="Batal">
                                                <button type="submit" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Tolak pesanan ini?')"><i class="fa-solid fa-xmark"></i> Tolak</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else : ?>
                                <tr><td colspan="5" class="text-center text-success py-4"><i class="fa-solid fa-circle-check me-2"></i> Bersih! Semua bukti transfer sudah diverifikasi admin.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>