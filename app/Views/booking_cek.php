<?= $this->extend('layout_dashboard') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-white text-uppercase tracking-wide" style="font-size: 24px;">Pelacakan Status Sesi</h2>
            <p class="text-secondary m-0 small">Masukkan nomor invoice atau nomor WhatsApp untuk memeriksa validasi reservasi</p>
        </div>
    </div>

    <!-- Tombol Kembali ke Dashboard Customer / Depan -->
<div class="mb-3">
    <a href="<?= base_url('customer/dashboard') ?>" class="btn btn-outline-secondary btn-sm fw-bold px-3 py-2" style="border-radius: 8px; border-color: rgba(255,255,255,0.15); color: #a1a1aa;">
        <i class="fa-solid fa-arrow-left me-2"></i> KEMBALI
    </a>
</div>
    <!-- Rangka Grid Utama -->
    <div class="row g-4">
        <!-- FORM PENCARIAN (KOLOM KIRI - col-lg-5) -->
        <div class="col-lg-5">
            <div class="card card-premium p-4">
                <h5 class="text-white fw-bold mb-3 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-magnifying-glass text-strong-red me-2"></i>Lacak Sesi Anda
                </h5>
                <form action="<?= base_url('booking/cari_status') ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold tracking-wider">NOMOR INVOICE / NOMOR WHATSAPP</label>
                        <input type="text" name="invoice_number" class="form-control" placeholder="Contoh: INV-XXXX / 0812XXXXXXXX" value="<?= $keyword ?? '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-strong-red w-100 py-2.5 fw-bold text-uppercase">
                        <i class="fa-solid fa-radar me-2"></i>Lacak Jadwal Sesi
                    </button>
                </form>
            </div>
        </div>

        <!-- PANEL HASIL PENCARIAN (KOLOM KANAN - col-lg-7) -->
        <div class="col-lg-7">
            <div class="card card-premium p-4 h-100">
                <h5 class="text-white fw-bold mb-4 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-folder-open text-strong-red me-2"></i>Keterangan Validasi Data
                </h5>

                <?php if (isset($hasil) && !empty($hasil)): ?>
                    <!-- Tampilan Jika Data Ditemukan -->
                    <div class="table-responsive">
                        <table class="table table-borderless m-0">
                            <tbody>
                                <tr class="border-bottom border-secondary">
                                    <td class="bg-transparent text-secondary py-2.5 fw-bold">Nama Pelanggan</td>
                                    <!-- Diubah ke text-white fw-bold agar tulisan terbaca jelas -->
                                    <td class="bg-transparent text-end text-white fw-bold" style="font-size: 14px;"><?= esc($hasil['nama_customer']) ?></td>
                                </tr>
                                <tr class="border-bottom border-secondary">
                                    <td class="bg-transparent text-secondary py-2.5 fw-bold">Tipe Studio</td>
                                    <td class="bg-transparent text-end fw-bold text-strong-red" style="font-size: 14px;"><?= esc($hasil['tipe_studio']) ?></td>
                                </tr>
                                <tr class="border-bottom border-secondary">
                                    <td class="bg-transparent text-secondary py-2.5 fw-bold">Jadwal Sesi</td>
                                    <!-- Diubah ke text-white fw-bold -->
                                    <td class="bg-transparent text-end text-white fw-bold" style="font-size: 14px;"><?= esc($hasil['tanggal_foto']) ?> | Jam <?= esc($hasil['jam_foto']) ?> WIB</td>
                                </tr>
                                <tr class="border-bottom border-secondary">
                                    <td class="bg-transparent text-secondary py-2.5 fw-bold">Total Tagihan</td>
                                    <!-- Diubah ke text-white fw-bold -->
                                    <td class="bg-transparent text-end text-white fw-bold" style="font-size: 14px;">Rp <?= number_format($hasil['total_harga'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td class="bg-transparent text-secondary py-2.5 fw-bold">Status Konfirmasi</td>
                                    <td class="bg-transparent text-end align-middle">
                                        <span class="badge bg-warning text-dark fw-bold px-2.5 py-1.5 text-uppercase" style="font-size: 11px;">PENDING VERIFIKASI</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php elseif (isset($hasil) && empty($hasil)): ?>
                    <!-- Tampilan Jika Data Kosong -->
                    <div class="text-center py-4">
                        <i class="fa-solid fa-triangle-exclamation text-warning mb-2" style="font-size: 32px;"></i>
                        <p class="text-white fw-bold mb-1">Data Tidak Ditemukan</p>
                        <p class="text-secondary small m-0">Pastikan nomor invoice atau WhatsApp yang Anda ketik sudah benar.</p>
                    </div>
                <?php else: ?>
                    <!-- Tampilan Awal Sebelum Melakukan Pencarian -->
                    <div class="text-center text-secondary py-5">
                        <i class="fa-solid fa-receipt mb-3" style="font-size: 48px; opacity: 0.3;"></i>
                        <p class="small m-0">Silakan masukkan nomor invoice atau nomor WhatsApp Anda di panel kiri untuk memunculkan detail status real-time.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>