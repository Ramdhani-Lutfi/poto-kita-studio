<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POTO KITA STUDIO - Premium Portal</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts Modern -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Latar belakang disesuaikan agar gambar kamera terlihat jelas seperti gambar 2 */
            background: linear-gradient(rgba(26, 26, 26, 0.75), rgba(26, 26, 26, 0.75)), 
                        url('https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1964&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            overflow-x: hidden;
        }
        
        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #141414;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 100;
        }
        .sidebar .brand {
            padding: 24px;
            font-size: 20px;
            font-weight: 800;
            color: #dc2626;
            letter-spacing: 1.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar .menu-list {
            padding: 15px;
        }
        .sidebar .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #a3a3a3;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 6px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s;
        }
        .sidebar .menu-item:hover {
            background-color: rgba(220, 38, 38, 0.08);
            color: #dc2626;
        }
        .sidebar .menu-item.active {
            background-color: rgba(220, 38, 38, 0.15);
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }
        .sidebar .menu-item i {
            margin-right: 12px;
            font-size: 15px;
            width: 22px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 35px;
            min-height: 100vh;
        }
        
        /* Card Solid Padat Anti Tembus Belakang */
        .card-premium {
            background-color: #1c1c1e;
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            color: #ffffff;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.4);
        }
        
        .text-strong-red {
            color: #ef4444 !important;
        }
        
        .btn-strong-red {
            background: #dc2626;
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-strong-red:hover {
            background: #b91c1c;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
        }
        
        /* Form Input */
        .form-control, .form-select {
            background-color: #2c2c2e !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            border-radius: 8px;
            font-weight: 600;
        }
        .form-control::placeholder {
            color: #7c7c80;
        }
        .form-control:focus, .form-select:focus {
            border-color: #dc2626 !important;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2) !important;
        }
        .input-group-text {
            background-color: #2c2c2e !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR LEFT NAVIGATION -->
    <div class="sidebar">
        <div class="brand text-uppercase">
            <i class="fa-solid fa-camera me-2"></i>POTO KITA
        </div>
        <div class="menu-list d-flex flex-column justify-content-between" style="height: calc(100vh - 80px);">
            <!-- DAFTAR MENU UTAMA PORTAL -->
            <div>
                <a href="<?= base_url('booking') ?>" class="menu-item <?= uri_string() == 'booking' ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-check"></i> Form Booking
                </a>
                
                <a href="<?= base_url('booking/cek_status') ?>" class="menu-item <?= (uri_string() == 'booking/cek_status' || uri_string() == 'booking/cari_status') ? 'active' : '' ?>">
                    <i class="fa-solid fa-magnifying-glass"></i> Cek Status Sesi
                </a>
                
                <a href="<?= base_url('booking/upload_bayar') ?>" class="menu-item <?= (uri_string() == 'booking/upload_bayar' || uri_string() == 'booking/proses_upload') ? 'active' : '' ?>">
                    <i class="fa-solid fa-receipt"></i> Upload Bukti Bayar
                </a>
                
                <a href="<?= base_url('booking/download_foto') ?>" class="menu-item <?= (uri_string() == 'booking/download_foto' || uri_string() == 'booking/cari_foto') ? 'active' : '' ?>">
                    <i class="fa-solid fa-cloud-arrow-down"></i> Download Hasil Foto
                </a>
                
                <a href="<?= base_url('booking/aturan') ?>" class="menu-item <?= uri_string() == 'booking/aturan' ? 'active' : '' ?>">
                    <i class="fa-solid fa-circle-info"></i> Aturan Studio
                </a>
            </div>

           <div class="mb-3">
                <hr style="border-color: rgba(255,255,255,0.08);">
                <!-- Menghapus bg-danger dan border merah, diganti warna abu-abu redup bawaan menu -->
                <a href="<?= base_url('/') ?>" class="menu-item" style="color: #a3a3a3 !important;" 
                   onmouseover="this.style.color='#dc2626'" 
                   onmouseout="this.style.color='#a3a3a3'">
                    <i class="fa-solid fa-house"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
            <a href="<?= base_url('booking/aturan') ?>" class="menu-item">
                <i class="fa-solid fa-circle-info"></i> Aturan Studio
            </a>
        </div>
    </div>

    <div class="main-content">
        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>