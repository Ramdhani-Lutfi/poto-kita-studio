<?= $this->extend('layout_dashboard') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-white text-uppercase tracking-wide" style="font-size: 24px;">Konfirmasi Pembayaran Sesi</h2>
            <p class="text-secondary m-0 small">Unggah tanda bukti transfer Bank Anda untuk mempercepat verifikasi jadwal</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-6">
            <div class="card card-premium p-4">
                <h5 class="text-white fw-bold mb-4 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-file-arrow-up text-strong-red me-2"></i>Upload Struk Pembayaran
                </h5>

                <!-- Tombol Kembali ke Dashboard Customer -->
<div class="mb-4">
    <a href="<?= base_url('customer/dashboard') ?>" class="btn btn-outline-secondary btn-sm fw-bold px-3 py-2" style="border-radius: 8px; border-color: rgba(255,255,255,0.15); color: #a1a1aa;">
        <i class="fa-solid fa-arrow-left me-2"></i> BATAL / KEMBALI
    </a>
</div>

                <!-- Notifikasi Pesan Sukses / Gagal -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success bg-success text-white border-0 mb-3 small fw-bold" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i><?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger bg-danger text-white border-0 mb-3 small fw-bold" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i><?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <!-- Form dengan atribut enctype wajib untuk upload file -->
                <form action="<?= base_url('booking/proses_upload') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold tracking-wider">NOMOR INVOICE / NOMOR WHATSAPP</label>
                        <input type="text" name="invoice_number" class="form-control" placeholder="Masukkan kode nota atau No. WA Anda" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-bold tracking-wider">PILIH FILE STRUK (JPG / PNG — MAX 2MB)</label>
                        <input type="file" name="bukti_transfer" class="form-control" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-strong-red w-100 py-2.5 fw-bold text-uppercase">
                        <i class="fa-solid fa-cloud-arrow-up me-2"></i>Kirim Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>