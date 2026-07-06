<?= $this->extend('layout_dashboard') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card card-premium p-5 text-center shadow-lg" style="max-width: 600px; width: 100%;">
        <!-- Icon Sukses -->
        <div class="mb-4">
            <i class="fa-solid fa-circle-check text-strong-red" style="font-size: 64px;"></i>
        </div>
        
        <h2 class="fw-bold text-white text-uppercase tracking-wide mb-2">Booking Berhasil!</h2>
        <p class="text-secondary small mb-4">Slot sesi foto Anda telah berhasil diamankan di sistem POTO KITA STUDIO</p>
        
        <!-- Detail Invoice Card -->
       <!-- Detail Invoice Card -->
        <div class="p-4 rounded mb-4 text-start" style="background-color: #2c2c2e; border: 1px solid rgba(255, 255, 255, 0.05);">
            <div class="d-flex justify-content-between border-bottom border-secondary pb-2 mb-2">
                <span class="text-secondary small fw-bold">NOMOR INVOICE</span>
                <span class="text-white fw-bold tracking-wider text-strong-red"><?= $invoice_number ?? 'INV-00000000-XXXX' ?></span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-secondary small fw-bold">TOTAL TAGIHAN</span>
                <span class="text-white fw-bold" style="font-size: 18px;">Rp <?= isset($total_harga) ? number_format($total_harga, 0, ',', '.') : '0' ?></span>
            </div>
        </div>

        <!-- Instruksi Pembayaran Taktis -->
        <!-- Instruksi Pembayaran Taktis -->
        <h6 class="text-white fw-bold text-uppercase text-start mb-2 small tracking-wider"><i class="fa-solid fa-credit-card me-2 text-strong-red"></i>Metode Pembayaran Transfer</h6>
        <div class="p-3 rounded text-start mb-4 bg-dark border border-secondary" style="font-size: 13px; color: #a3a3a3;">
            <p class="m-0 mb-1">Silakan lakukan transfer manual ke rekening resmi studio:</p>
            <!-- Rekening sudah diperbarui sesuai request -->
            <strong class="text-white d-block mb-1">Bank BCA — 3400179203 (a/n Ramdhani Lutfi)</strong>
            <span class="text-muted small">Harap simpan struk transaksi Anda untuk diunggah pada tab <b>Upload Bukti Bayar</b>.</span>
        </div>

        <!-- Tombol Aksi Kembali -->
        <a href="<?= base_url('booking') ?>" class="btn btn-strong-red w-100 py-2.5 fw-bold text-uppercase">
            <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Form
        </a>
    </div>
</div>
<?= $this->endSection() ?>