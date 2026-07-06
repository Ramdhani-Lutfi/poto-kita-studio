<?= $this->extend('layout_dashboard') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-white text-uppercase tracking-wide" style="font-size: 24px;">Aturan & Regulasi Studio</h2>
            <p class="text-secondary m-0 small">Harap baca tata tertib operasional demi kenyamanan bersama di POTO KITA STUDIO</p>
        </div>
    </div>

    <!-- Rangka Grid Aturan -->
    <div class="row g-4">
        <!-- SEKTOR 1: TATA TERTIB KEHADIRAN & WAKTU -->
        <div class="col-md-6">
            <div class="card card-premium p-4 h-100">
                <h5 class="text-white fw-bold mb-3 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-clock text-strong-red me-2"></i>Kehadiran & Sesi Waktu
                </h5>
                <ul class="text-secondary small ps-3 m-0" style="line-height: 1.8;">
                    <li class="mb-2">Pelanggan diwajibkan hadir minimal <span class="text-white fw-bold">10 menit sebelum</span> sesi foto dimulai untuk melakukan registrasi ulang.</li>
                    <li class="mb-2">Batas toleransi keterlambatan maksimal adalah <span class="text-strong-red fw-bold">15 menit</span>. Keterlambatan melebihi batas akan memotong durasi sesi foto Anda secara otomatis.</li>
                    <li class="mb-2">Perpanjangan waktu (*extra time*) hanya diperbolehkan apabila slot jam berikutnya masih kosong, dengan biaya tambahan yang berlaku di kasir.</li>
                    <li>Sesi pemotretan sepenuhnya bersifat mandiri (*self photo studio*) menggunakan remote shutter yang disediakan oleh kru studio.</li>
                </ul>
            </div>
        </div>

        <!-- SEKTOR 2: KEBIJAKAN KUOTA & HEWAN PELIHARAAN -->
        <div class="col-md-6">
            <div class="card card-premium p-4 h-100">
                <h5 class="text-white fw-bold mb-3 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-users text-strong-red me-2"></i>Kuota Kapasitas & Pet Policy
                </h5>
                <ul class="text-secondary small ps-3 m-0" style="line-height: 1.8;">
                    <li class="mb-2">Setiap tipe studio memiliki batas maksimal kuota standar (Regular: 5 orang, Largest: 10 orang).</li>
                    <li class="mb-2">Kelebihan jumlah orang di dalam studio akan dikenakan biaya tambahan senilai <span class="text-white fw-bold">Rp 25.000 / kepala</span>.</li>
                    <li class="mb-2">Membawa hewan peliharaan diperbolehkan dengan kewajiban membayar biaya pemeliharaan kebersihan ekstra sebesar <span class="text-strong-red fw-bold">Rp 20.000</span>.</li>
                    <li>Pemilik hewan peliharaan wajib menjaga kebersihan dan bertanggung jawab penuh atas perilaku hewan selama berada di area POTO KITA STUDIO.</li>
                </ul>
            </div>
        </div>

        <!-- SEKTOR 3: PENGUNDUHAN BERKAS & PRIVASI -->
        <div class="col-md-12">
            <div class="card card-premium p-4">
                <h5 class="text-white fw-bold mb-3 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-shield-halved text-strong-red me-2"></i>Pengiriman Berkas & Hak Privasi
                </h5>
                <div class="row g-3">
                    <div class="col-md-6 text-secondary small" style="line-height: 1.8;">
                        <p class="mb-2"><i class="fa-solid fa-cloud text-strong-red me-2"></i>Semua file foto mentah (*raw files*) beserta hasil editing akan diunggah ke cloud storage <span class="text-white fw-bold">Google Drive privat</span>.</p>
                        <p class="m-0"><i class="fa-solid fa-unlock-keyhole text-strong-red me-2"></i>Tautan unduhan dapat diakses melalui tab <b>Download Hasil Foto</b> paling lambat dalam waktu 1x24 jam setelah sesi selesai.</p>
                    </div>
                    <div class="col-md-6 text-secondary small" style="line-height: 1.8;">
                        <p class="mb-2"><i class="fa-solid fa-trash-can text-strong-red me-2"></i>Tautan enkripsi Google Drive aktif selama <span class="text-white fw-bold">30 hari</span>. Mohon segera amankan berkas Anda sebelum sistem menghapusnya secara otomatis demi kapasitas server.</p>
                        <p class="m-0"><i class="fa-solid fa-eye-slash text-strong-red me-2"></i>POTO KITA STUDIO menjamin kerahasiaan berkas Anda dan tidak akan mempublikasikan foto tanpa persetujuan tertulis dari pelanggan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>