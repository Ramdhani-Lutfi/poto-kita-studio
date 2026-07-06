<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Analytics Dashboard - POTO KITA</title>
    <!-- Bootstrap 5.3, FontAwesome & Chart.js -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
            width: 100%;
            text-align: left;
            border: none;
            background: transparent;
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
        }
        .btn-logout-sidebar:hover {
            background-color: #dc2626;
        }
        .stat-card {
            background-color: #1c1c1e;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 24px;
            height: 100%;
        }
        .chart-card {
            background-color: #1c1c1e;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
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
    if (!isset($all_orders)) { $all_orders = []; } 
    if (!isset($total_sesi)) { $total_sesi = 0; } 
    if (!isset($sesi_lunas)) { $sesi_lunas = 0; } 
    if (!isset($total_omzet)) { $total_omzet = 0; } 

    // Logika Pemisahan Data & Hitung Statistik Grafik
    $orders_lunas = [];
    $orders_ditolak = [];
    $count_pending = 0;
    
    $studio_stats = ['Regular Studio' => 0, 'Largest Studio' => 0, 'VVIP Studio' => 0];

    foreach ($all_orders as $order) {
        $st = strtolower(trim($order['status_booking'] ?? ''));
        $tipe = $order['tipe_studio'] ?? $order['studio'] ?? 'Regular Studio';

        if ($st === 'confirmed' || $st === 'lunas' || $st === 'selesai') {
            $orders_lunas[] = $order;
            if (isset($studio_stats[$tipe])) { $studio_stats[$tipe]++; }
        } elseif ($st === 'batal' || $st === 'ditolak') {
            $orders_ditolak[] = $order;
        } else {
            $count_pending++;
        }
    }
    ?>

    <!-- SIDEBAR MULTI-TAB OWNER -->
    <div class="sidebar">
        <div>
            <h3 class="mb-4"><a href="#" class="brand-title">POTO KITA</a></h3>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-menu-link active" id="tab-ringkasan" data-bs-toggle="pill" data-bs-target="#konten-ringkasan" type="button" role="tab">
                    <i class="fa-solid fa-chart-pie me-2"></i> Ringkasan Finansial
                </button>
                <button class="nav-menu-link" id="tab-lunas" data-bs-toggle="pill" data-bs-target="#konten-lunas" type="button" role="tab">
                    <i class="fa-solid fa-money-bill-wave me-2"></i> Laporan Omzet Bersih
                </button>
                <button class="nav-menu-link" id="tab-ditolak" data-bs-toggle="pill" data-bs-target="#konten-ditolak" type="button" role="tab">
                    <i class="fa-solid fa-ban me-2"></i> Log Sesi Ditolak
                </button>
                <button class="nav-menu-link" id="tab-performa" data-bs-toggle="pill" data-bs-target="#konten-performa" type="button" role="tab">
                    <i class="fa-solid fa-cubes me-2"></i> Performa Tipe Studio
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
        <h2 class="fw-bold mb-1">Manajemen Laporan Keuangan Bisnis 📊</h2>
        <p class="text-secondary mb-4">Panel eksklusif Owner untuk monitoring total omzet operasional studio foto</p>

        <!-- GRID KARTU FINANSIAL REAL-TIME -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card">
                    <span class="text-secondary small fw-bold text-uppercase d-block">Total Seluruh Transaksi</span>
                    <h2 class="fw-bold mt-2 mb-0"><?= $total_sesi ?> <span class="fs-6 text-secondary fw-normal">Sesi Order</span></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="border-left: 4px solid #10b981;">
                    <span class="text-secondary small fw-bold text-uppercase d-block">Sesi Sukses / Lunas</span>
                    <h2 class="fw-bold mt-2 mb-0 text-success"><?= $sesi_lunas ?> <span class="fs-6 text-secondary fw-normal">Paid</span></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card" style="border-left: 4px solid #ef4444;">
                    <span class="text-secondary small fw-bold text-uppercase d-block">Total Pendapatan Bersih (Riil)</span>
                    <h2 class="fw-bold mt-2 mb-0" style="color: #ef4444;">Rp <?= number_format($total_omzet, 0, ',', '.') ?></h2>
                </div>
            </div>
        </div>

        <div class="tab-content" id="v-pills-tabContent">
            
            <!-- ================= TAB 1: RINGKASAN FINANSIAL (GRAFIK ANALISIS PREMIUM) ================= -->
            <div class="tab-pane fade show active" id="konten-ringkasan" role="tabpanel">
                <div class="row">
                    <!-- Grafik Batang Distribusi Pendapatan -->
                    <div class="col-lg-8">
                        <div class="chart-card">
                            <h5 class="fw-bold mb-4 text-uppercase" style="font-size: 14px; color: #ef4444;">
                                <i class="fa-solid fa-chart-column me-2"></i> Grafik Statistik Realisasi Omzet Keuangan
                            </h5>
                            <div style="height: 320px; position: relative;">
                                <canvas id="chartOmzetBar"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Grafik Lingkaran Proporsi Status Transaksi -->
                    <div class="col-lg-4">
                        <div class="chart-card">
                            <h5 class="fw-bold mb-4 text-uppercase" style="font-size: 14px; color: #ef4444;">
                                <i class="fa-solid fa-chart-pie me-2"></i> Proporsi Status Sesi
                            </h5>
                            <div style="height: 320px; position: relative; display: flex; justify-content: center;">
                                <canvas id="chartStatusPie"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= TAB 2: LAPORAN OMZET BERSIH (KHUSUS LUNAS) ================= -->
            <div class="tab-pane fade" id="konten-lunas" role="tabpanel">
                <h4 class="fw-bold mb-3 text-success"><i class="fa-solid fa-circle-check me-2"></i> LOG TRANSAKSI MASUK VALID (LUNAS)</h4>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Kategori / Studio</th>
                                <th>Jadwal Sesi</th>
                                <th>Nominal Bersih</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders_lunas)) : foreach ($orders_lunas as $order) : ?>
                                <tr>
                                    <td class="fw-bold text-white"><?= esc($order['nama_customer']) ?></td>
                                    <td><span class="badge bg-secondary"><?= esc($order['tipe_studio'] ?? 'Regular Studio') ?></span></td>
                                    <td><?= esc($order['tanggal_foto']) ?> <small class="text-secondary">(<?= esc($order['jam_foto']) ?> WIB)</small></td>
                                    <td class="text-success fw-bold">Rp <?= number_format($order['total_harga'] ?? 150000, 0, ',', '.') ?></td>
                                    <td><span class="badge bg-success">PAID</span></td>
                                </tr>
                            <?php endforeach; else : ?>
                                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada dana masuk lunas terkunci.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= TAB 3: LOG SESI DITOLAK (KHUSUS REJECTED) ================= -->
            <div class="tab-pane fade" id="konten-ditolak" role="tabpanel">
                <h4 class="fw-bold mb-3 text-danger"><i class="fa-solid fa-circle-xmark me-2"></i> DAFTAR SESI BOOKING YANG REJECTED / BATAL</h4>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>WhatsApp</th>
                                <th>Kategori / Studio</th>
                                <th>Rencana Jadwal</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders_ditolak)) : foreach ($orders_ditolak as $order) : ?>
                                <tr>
                                    <td class="fw-bold text-white"><?= esc($order['nama_customer']) ?></td>
                                    <td><?= esc($order['no_whatsapp'] ?? $order['whatsapp_customer'] ?? '-') ?></td>
                                    <td><span class="badge bg-secondary"><?= esc($order['tipe_studio'] ?? 'Regular Studio') ?></span></td>
                                    <td><?= esc($order['tanggal_foto']) ?> <small class="text-secondary">(<?= esc($order['jam_foto']) ?> WIB)</small></td>
                                    <td><span class="badge bg-danger">DITOLAK ADMIN</span></td>
                                </tr>
                            <?php endforeach; else : ?>
                                <tr><td colspan="5" class="text-center text-muted py-4">Bersih! Tidak ada log transaksi yang ditolak.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= TAB 4: PERFORMA TIPE STUDIO ================= -->
            <div class="tab-pane fade" id="konten-performa" role="tabpanel">
                <h4 class="fw-bold mb-4 text-info"><i class="fa-solid fa-chart-line me-2"></i> ANALISIS DISTRIBUSI STUDIO PALING LARIS</h4>
                <div class="row g-4">
                    <?php foreach($studio_stats as $nama_studio => $jumlah): ?>
                        <div class="col-md-4">
                            <div class="stat-card p-4 text-center" style="background-color: #27272a;">
                                <h6 class="text-secondary fw-bold text-uppercase"><?= $nama_studio ?></h6>
                                <h1 class="fw-bold text-white my-3"><?= $jumlah ?> <span class="fs-6 text-secondary fw-normal">Sesi</span></h1>
                                <div class="progress" style="height: 6px; background-color: #121214;">
                                    <?php $persen = $sesi_lunas > 0 ? round(($jumlah / $sesi_lunas) * 100) : 0; ?>
                                    <div class="progress-bar bg-info" style="width: <?= $persen ?>%"></div>
                                </div>
                                <span class="small d-block text-info mt-2 fw-bold"><?= $persen ?>% Kontribusi Omzet</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <!-- CONFIGURATION INJEKSI SCRIPT CHART.JS SECARA REAL-TIME -->
    <script>
        // Set tema font agar sinkron ke putih/abu transparan
        Chart.defaults.color = '#a1a1aa';
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";

        // 1. Injeksi Data & Render Grafik Omzet Keuangan (Bar Chart)
        const ctxBar = document.getElementById('chartOmzetBar').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Regular Studio', 'Largest Studio', 'VVIP Studio'],
                datasets: [{
                    label: 'Nominal Omzet Bersih (Rp)',
                    data: [
                        <?= $studio_stats['Regular Studio'] * 150000 ?>,
                        <?= $studio_stats['Largest Studio'] * 250000 ?>,
                        <?= $studio_stats['VVIP Studio'] * 350000 ?>
                    ],
                    backgroundColor: ['rgba(59, 130, 246, 0.65)', 'rgba(16, 185, 129, 0.65)', 'rgba(239, 68, 68, 0.65)'],
                    borderColor: ['#3b82f6', '#10b981', '#ef4444'],
                    borderWidth: 1.5,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, border: { dashed: [5, 5] } },
                    x: { grid: { display: false } }
                }
            }
        });

        // 2. Injeksi Data & Render Proporsi Status Transaksi (Pie Chart)
        const ctxPie = document.getElementById('chartStatusPie').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Lunas', 'Ditolak', 'Pending'],
                datasets: [{
                    data: [<?= $sesi_lunas ?>, <?= count($orders_ditolak) ?>, <?= $count_pending ?>],
                    backgroundColor: ['#10b981', '#ef4444', '#f59e0b'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { padding: 20 } }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>