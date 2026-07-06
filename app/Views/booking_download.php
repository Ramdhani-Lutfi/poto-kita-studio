<?= $this->extend('layout_dashboard') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-white text-uppercase tracking-wide" style="font-size: 24px;">Pengambilan Berkas Foto</h2>
            <p class="text-secondary m-0 small">Unduh berkas mentah (raw files) maupun hasil suntingan sesi foto Anda secara aman</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- PANEL KIRI: INPUT PENCARIAN -->
        <div class="col-lg-5">
            <div class="card card-premium p-4">
                <h5 class="text-white fw-bold mb-3 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-cloud-arrow-down text-strong-red me-2"></i>Akses Berkas
                </h5>
                <form action="<?= base_url('booking/cari_foto') ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold tracking-wider">NOMOR INVOICE / NOMOR WHATSAPP</label>
                        <input type="text" name="invoice_number" class="form-control" placeholder="Contoh: INV-XXXX / 0812XXXXXXXX" value="<?= $keyword ?? '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-strong-red w-100 py-2.5 fw-bold text-uppercase">
                        <i class="fa-solid fa-circle-nodes me-2"></i>Ambil Link Foto
                    </button>
                </form>
            </div>
        </div>

        <!-- PANEL KANAN: STATUS LINK DRIVE -->
        <div class="col-lg-7">
            <div class="card card-premium p-4 h-100">
                <h5 class="text-white fw-bold mb-4 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-server text-strong-red me-2"></i>Cloud Storage Link
                </h5>

                <?php if (isset($hasil) && !empty($hasil)): ?>
                    <div class="text-center py-4">
                        <?php if (!empty($hasil['link_foto'])): ?>
                            <!-- JIKA LINK FOTO SUDAH DIINPUT OLEH ADMIN -->
                            <i class="fa-brands fa-google-drive text-success mb-3 animate-pulse" style="font-size: 56px;"></i>
                            <h5 class="text-white fw-bold text-uppercase mb-2">Berkas Foto Anda Sudah Siap!</h5>
                            <p class="text-secondary small mb-4 px-md-4">Seluruh dokumentasi digital sesi <b><?= esc($hasil['tipe_studio']) ?></b> atas nama <b><?= esc($hasil['nama_customer']) ?></b> telah diunggah ke Google Drive cloud enkripsi aman.</p>
                            
                            <a href="<?= esc($hasil['link_foto']) ?>" target="_blank" class="btn btn-success px-5 py-3 fw-bold text-uppercase shadow-lg" style="border-radius: 10px;">
                                <i class="fa-solid fa-download me-2"></i>Download via Google Drive
                            </a>
                        <?php else: ?>
                            <!-- JIKA LINK FOTO MASIH KOSONG (PROSES EDITING) -->
                            <i class="fa-solid fa-hourglass-half text-warning mb-3" style="font-size: 50px;"></i>
                            <h5 class="text-white fw-bold text-uppercase mb-2">Foto Dalam Proses Penyuntingan</h5>
                            <p class="text-secondary small m-0 px-md-4">Data sesi ditemukan. Tim fotografer kami sedang melakukan proses editing terbaik. Mohon periksa kembali tab ini secara berkala dalam waktu 1x24 jam.</p>
                        <?php endif; ?>
                    </div>
                <?php elseif (isset($hasil) && empty($hasil)): ?>
                    <!-- JIKA USER INPUT DATA SALAH -->
                    <div class="text-center py-4">
                        <i class="fa-solid fa-user-slash text-danger mb-2" style="font-size: 32px;"></i>
                        <p class="text-white fw-bold mb-1">Data Sesi Tidak Ditemukan</p>
                        <p class="text-secondary small m-0">Nomor invoice atau kontak WhatsApp tidak terdaftar dalam database kami.</p>
                    </div>
                <?php else: ?>
                    <!-- TAMPILAN AWAL SEBELUM CARI -->
                    <div class="text-center text-secondary py-5">
                        <i class="fa-solid fa-cloud shadow-sm mb-3" style="font-size: 48px; opacity: 0.2;"></i>
                        <p class="small m-0">Masukkan data nota validasi Anda di sisi kiri untuk memunculkan gerbang akses penyimpanan awan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>