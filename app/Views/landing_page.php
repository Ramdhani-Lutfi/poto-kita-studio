<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POTO KITA STUDIO - 1st Self Photo Studio Batam</title>
    <!-- Bootstrap 5.3 CSS & FontAwesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts Modern -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #121214;
            color: #ffffff;
            margin: 0;
        }
        /* 1. Hero Section Style */
        .hero-section {
            background: linear-gradient(rgba(18, 18, 20, 0.75), rgba(18, 18, 20, 0.9)), url('https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?q=80&w=1000') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }
        .text-strong-red {
            color: #ef4444;
        }
        .btn-tactical-red {
            background-color: #ef4444;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            text-decoration: none;
        }
        .btn-tactical-red:hover {
            background-color: #dc2626;
            color: #ffffff;
            transform: translateY(-2px);
        }
        /* 2. Why Choose Us Style */
        .section-why {
            background-color: #1c1c1e;
            padding: 90px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        .title-huge {
            font-size: 2.8rem;
            font-weight: 800;
            letter-spacing: 1px;
            line-height: 1.2;
        }
        .lead-text {
            color: #a1a1aa;
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: justify;
        }
        /* 3. Portfolio Gallery Style */
        .section-portfolio {
            padding: 90px 0;
        }
        .portfolio-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            background-color: #1c1c1e;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }
        .portfolio-img-wrapper {
            overflow: hidden;
            position: relative;
            aspect-ratio: 4/5;
        }
        .portfolio-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .portfolio-card:hover .portfolio-img {
            transform: scale(1.08);
        }
        .portfolio-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background-color: rgba(239, 68, 68, 0.9);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
        }
        /* 4. Footer Style */
        footer {
            background-color: #0c0c0e;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 60px 0 30px 0;
        }
        .footer-link {
            color: #a1a1aa;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-link:hover {
            color: #ef4444;
        }
        /* Kustom khusus teks hak cipta agar putih terang benderang */
        .text-copyright-bright {
            color: #ffffff !important;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
    </style>
</head>
<body>

<!-- TOP NAVIGATION BAR -->
<nav class="navbar navbar-expand-lg navbar-dark position-absolute w-100 top-0" style="z-index: 10; padding: 25px 0;">
    <div class="container">
        <a class="navbar-brand fw-extrabold text-strong-red m-0 h4" style="font-weight: 800; text-decoration: none;" href="<?= base_url('/') ?>">POTO KITA</a>
        <a href="<?= base_url('login') ?>" class="btn btn-tactical-red btn-sm px-3 py-2" style="font-size: 13px;">Login</a>
    </div>
</nav>

<!-- 1. HERO SECTION -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 text-start">
                <h1 class="display-3 fw-extrabold m-0 text-white tracking-tight" style="font-weight: 800;">POTO KITA</h1>
                <p class="lead text-white-50 my-4" style="max-width: 600px; font-size: 1.2rem;">
                    1st Self Photo Studio Batam. Ekspresikan dirimu tanpa batas, cetak momen terbaikmu secara instan.
                </p>
                <div class="d-flex gap-3">
                    <a href="<?= base_url('booking') ?>" class="btn btn-tactical-red btn-lg px-4 fs-6">Booking Studio Sekarang</a>
                    <a href="#portfolio" class="btn btn-outline-light btn-lg px-4 fs-6 fw-semibold">Lihat Portofolio</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. WHY CHOOSE US SECTION -->
<section class="section-why">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h2 class="title-huge text-white m-0 text-uppercase">Why Choose<br><span class="text-strong-red">Poto Kita Studio?</span></h2>
            </div>
            <div class="col-lg-7">
                <p class="lead-text mb-3">
                    Menikmati momen seru bersama teman, mengabadikan kehangatan keluarga besar, atau membuat kenangan romantis bersama orang tersayang? Apapun momennya, kami siap mewujudkannya.
                </p>
                <p class="lead-text mb-3">
                    Sebagai salah satu pelopor <i>self-portrait studio</i> modern di Batam, <b>POTO KITA STUDIO</b> hadir memberikan pengalaman foto mandiri yang privat, profesional, dengan hasil cetak instan kualitas premium. Kamu bebas berekspresi tanpa batas di depan kamera tanpa rasa canggung.
                </p>
                <p class="lead-text m-0">
                    Kami memastikan setiap proses penyuntingan dilakukan secara detail oleh tim editor handal tanpa mengurangi kualitas keaslian foto. Cukup datang, ekspresikan dirimu, dan bawa pulang hasil foto terbaikmu hari ini!
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 3. INTERACTIVE PORTFOLIO & PRICE GRID SECTION -->
<section id="portfolio" class="section-portfolio">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold text-uppercase tracking-wide m-0" style="font-weight: 700;">Hasil Sesi & Daftar Harga</h3>
            <p class="text-secondary small mt-2">Inspirasi gaya sekaligus penawaran harga terbaik POTO KITA STUDIO</p>
        </div>

        <div class="row g-4">
            <!-- Slot 1: Foto Bersama Pacar (Regular) -->
            <div class="col-md-4 col-6">
                <div class="portfolio-card mb-2">
                    <span class="portfolio-badge"><i class="fa-solid fa-camera me-1"></i> Regular Studio</span>
                    <div class="portfolio-img-wrapper">
                        <img src="<?= base_url('assets/img/portfolio/foto_regular1.jpeg') ?>" class="portfolio-img" alt="Regular Studio Hasil">
                    </div>
                </div>
                <div class="px-2 text-start">
                    <h6 class="fw-bold m-0 text-white">Regular Studio Room</h6>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <small class="text-secondary">Max 5 Orang</small>
                        <span class="fw-bold text-danger">Rp 150.000</span>
                    </div>
                </div>
            </div>

            <!-- Slot 2: Foto Bersama Pacar (Regular) -->
            <div class="col-md-4 col-6">
                <div class="portfolio-card mb-2">
                    <span class="portfolio-badge"><i class="fa-solid fa-camera me-1"></i> Regular Studio</span>
                    <div class="portfolio-img-wrapper">
                        <img src="<?= base_url('assets/img/portfolio/foto_regular2.jpeg') ?>" class="portfolio-img" alt="Regular Studio Hasil">
                    </div>
                </div>
                <div class="px-2 text-start">
                    <h6 class="fw-bold m-0 text-white">Regular Studio Room</h6>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <small class="text-secondary">Max 5 Orang</small>
                        <span class="fw-bold text-danger">Rp 150.000</span>
                    </div>
                </div>
            </div>

            <!-- Slot 3: Foto Bersama Keluarga (Largest) -->
            <div class="col-md-4 col-6">
                <div class="portfolio-card mb-2">
                    <span class="portfolio-badge"><i class="fa-solid fa-users me-1"></i> Largest Studio</span>
                    <div class="portfolio-img-wrapper">
                        <img src="<?= base_url('assets/img/portfolio/foto_largest1.jpg') ?>" class="portfolio-img" alt="Largest Studio Hasil">
                    </div>
                </div>
                <div class="px-2 text-start">
                    <h6 class="fw-bold m-0 text-white">Largest Studio Room</h6>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <small class="text-secondary">Max 10 Orang</small>
                        <span class="fw-bold text-danger">Rp 250.000</span>
                    </div>
                </div>
            </div>

            <!-- Slot 4: Foto Bersama Keluarga (Largest) -->
            <div class="col-md-4 col-6">
                <div class="portfolio-card mb-2">
                    <span class="portfolio-badge"><i class="fa-solid fa-users me-1"></i> Largest Studio</span>
                    <div class="portfolio-img-wrapper">
                        <img src="<?= base_url('assets/img/portfolio/foto_largest2.jpg') ?>" class="portfolio-img" alt="Largest Studio Hasil">
                    </div>
                </div>
                <div class="px-2 text-start">
                    <h6 class="fw-bold m-0 text-white">Largest Studio Room</h6>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <small class="text-secondary">Max 10 Orang</small>
                        <span class="fw-bold text-danger">Rp 250.000</span>
                    </div>
                </div>
            </div>

            <!-- Slot 5: Foto Solo/Teman (VVIP) -->
            <div class="col-md-4 col-6">
                <div class="portfolio-card mb-2">
                    <span class="portfolio-badge"><i class="fa-solid fa-crown me-1"></i> VVIP Studio</span>
                    <div class="portfolio-img-wrapper">
                        <img src="<?= base_url('assets/img/portfolio/foto_vvip1.jpeg') ?>" class="portfolio-img" alt="VVIP Studio Hasil">
                    </div>
                </div>
                <div class="px-2 text-start">
                    <h6 class="fw-bold m-0 text-white">VVIP Studio Room</h6>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <small class="text-secondary">Premium Box</small>
                        <span class="fw-bold text-danger">Rp 350.000</span>
                    </div>
                </div>
            </div>

            <!-- Slot 6: Foto Solo/Teman (VVIP) -->
            <div class="col-md-4 col-6">
                <div class="portfolio-card mb-2">
                    <span class="portfolio-badge"><i class="fa-solid fa-crown me-1"></i> VVIP Studio</span>
                    <div class="portfolio-img-wrapper">
                        <img src="<?= base_url('assets/img/portfolio/foto_vvip2.jpeg') ?>" class="portfolio-img" alt="VVIP Studio Hasil">
                    </div>
                </div>
                <div class="px-2 text-start">
                    <h6 class="fw-bold m-0 text-white">VVIP Studio Room</h6>
                    <div class="d-flex justify-content-between align-items-center mt-1">
                        <small class="text-secondary">Premium Box</small>
                        <span class="fw-bold text-danger">Rp 350.000</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="<?= base_url('booking') ?>" class="btn btn-tactical-red btn-lg px-5 fw-bold text-uppercase"><i class="fa-solid fa-calendar-days me-2"></i>Amankan Slot Jadwal Kamu Sekarang</a>
        </div>
    </div>
</section>

<!-- 4. PREMIUM FOOTER -->
<footer>
    <div class="container">
        <div class="row g-4 mb-5 text-start">
            <div class="col-lg-6">
                <h5 class="fw-bold text-strong-red text-uppercase tracking-wider mb-3" style="font-weight: 700;">POTO KITA STUDIO</h5>
                <p class="text-secondary small" style="max-width: 400px; line-height: 1.6;">
                    Menyediakan layanan self-portrait premium pertama di Batam dengan alur pemesanan serba digital dan aman.
                </p>
            </div>
            <div class="col-lg-6">
                <h5 class="fw-bold text-white text-uppercase tracking-wider mb-3" style="font-weight: 700;"><i class="fa-solid fa-circle-info text-strong-red me-2"></i>Contact Info</h5>
                <ul class="list-unstyled text-secondary small m-0">
                    <li class="mb-2"><i class="fa-solid fa-location-dot text-strong-red me-2"></i>Lubuk baja, semogabenerantercapai, Kota Batam</li>
                    <li class="mb-2"><i class="fa-brands fa-whatsapp text-success me-2"></i><a href="https://wa.me/6285668902731" target="_blank" class="footer-link">085668902731</a></li>
                    <li><i class="fa-brands fa-instagram text-danger me-2"></i><a href="https://instagram.com/potokitastudio.id" target="_blank" class="footer-link">@potokitastudio.id</a></li>
                </ul>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,0.08); margin: 0;">
        <div class="row pt-4">
            <div class="col-md-10 text-center text-md-start">
                <p class="text-copyright-bright small m-0">&copy; 2026 POTO KITA STUDIO. All Rights Reserved. Designed by Ramdhani Lutfi.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>