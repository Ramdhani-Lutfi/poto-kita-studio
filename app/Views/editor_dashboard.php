<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Dashboard - POTO KITA</title>
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
        }
        .input-dark {
            background-color: #27272a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }
        .input-dark:focus {
            background-color: #27272a;
            border-color: #ef4444;
            color: white;
            box-shadow: none;
        }
    </style>
</head>
<body>

    <?php 
    if (!isset($orders)) { $orders = []; } 

    // Filter Kerja Antrian Komparasi Link Drive
    $antrian_aktif = [];
    $antrian_selesai = [];

    foreach ($orders as $order) {
        $link = trim($order['link_drive'] ?? '');
        if ($link === '') {
            $antrian_aktif[] = $order;
        } else {
            $antrian_selesai[] = $order;
        }
    }
    ?>

    <!-- SIDEBAR MULTI-TAB EDITOR -->
    <div class="sidebar">
        <div>
            <h3 class="mb-4"><a href="#" class="brand-title">POTO KITA</a></h3>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-menu-link active" id="tab-aktif" data-bs-toggle="pill" data-bs-target="#konten-aktif" type="button" role="tab">
                    <i class="fa-solid fa-hourglass-half me-2"></i> Antrian Aktif 
                    <?php if(count($antrian_aktif) > 0): ?>
                        <span class="badge bg-danger ms-2" style="font-size: 10px;"><?= count($antrian_aktif) ?></span>
                    <?php endif; ?>
                </button>
                <button class="nav-menu-link" id="tab-selesai" data-bs-toggle="pill" data-bs-target="#konten-selesai" type="button" role="tab">
                    <i class="fa-solid fa-circle-check me-2"></i> Sudah Selesai
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
        <h2 class="fw-bold mb-1">Production & Editor Workspace 🖼️</h2>
        <p class="text-secondary mb-4">Upload dan kelola tautan Google Drive hasil editing foto pelanggan yang sudah lunas</p>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success bg-success text-white border-0 mb-4"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger bg-danger text-white border-0 mb-4"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="tab-content" id="v-pills-tabContent">
            
            <!-- ================= TAB 1: ANTRIAN AKTIF (BELUM UPLOAD LINK) ================= -->
            <div class="tab-pane fade show active" id="konten-aktif" role="tabpanel">
                <h4 class="fw-bold mb-3 text-warning"><i class="fa-solid fa-clock me-2"></i> ANTRIAN UPLOAD HASIL FOTO</h4>
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Nama Pelanggan</th>
                                <th>Studio</th>
                                <th>Link Google Drive Hasil Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($antrian_aktif)) : foreach ($antrian_aktif as $order) : ?>
                                <tr>
                                    <td class="text-danger fw-bold"><?= esc($order['invoice_number']) ?></td>
                                    <td class="fw-bold text-white"><?= esc($order['nama_customer'] ?? 'Guest') ?></td>
                                    <td><span class="badge bg-secondary"><?= esc($order['tipe_studio'] ?? 'Regular Studio') ?></span></td>
                                    
                                    <form action="<?= base_url('editor/upload-link') ?>" method="POST">
                                        <td>
                                            <input type="hidden" name="id_booking" value="<?= $order['id_booking'] ?? $order['id'] ?>">
                                            <input type="url" name="link_foto" class="form-control form-control-sm input-dark" 
                                                   value="" placeholder="https://drive.google.com/drive/folders/..." required>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-success fw-bold">
                                                <i class="fa-solid fa-cloud-arrow-up me-1"></i> Submit Link
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; else : ?>
                                <tr>
                                    <td colspan="5" class="text-center text-success py-5">
                                        <i class="fa-solid fa-face-smile d-block fs-2 mb-3"></i>
                                        Mantap! Semua antrian editing foto sudah selesai dikerjakan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= TAB 2: SUDAH SELESAI (BISA DIEDIT KEMBALI) ================= -->
            <div class="tab-pane fade" id="konten-selesai" role="tabpanel">
                <h4 class="fw-bold mb-3 text-success"><i class="fa-solid fa-circle-check me-2"></i> RIWAYAT UPLOAD HASIL FOTO</h4>
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Nama Pelanggan</th>
                                <th>Studio</th>
                                <th>Link Google Drive</th>
                                <th>Aksi Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($antrian_selesai)) : foreach ($antrian_selesai as $order) : ?>
                                <tr>
                                    <td class="text-muted fw-bold"><?= esc($order['invoice_number']) ?></td>
                                    <td class="fw-bold text-white"><?= esc($order['nama_customer'] ?? 'Guest') ?></td>
                                    <td><span class="badge bg-dark text-secondary"><?= esc($order['tipe_studio'] ?? 'Regular Studio') ?></span></td>
                                    
                                    <form action="<?= base_url('editor/upload-link') ?>" method="POST">
                                        <td>
                                            <input type="hidden" name="id_booking" value="<?= $order['id_booking'] ?? $order['id'] ?>">
                                            <input type="url" name="link_foto" class="form-control form-control-sm input-dark text-info" 
                                                   value="<?= esc($order['link_drive']) ?>" required>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-outline-warning fw-bold">
                                                <i class="fa-solid fa-pen-to-square me-1"></i> Update Link
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; else : ?>
                                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada hasil foto yang di-upload.</td></tr>
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