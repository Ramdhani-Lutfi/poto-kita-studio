<?php 
// Inisialisasi Fallback untuk mengelabui Intelephense agar tidak error merah
if (!isset($order)) { 
    $order = [
        'id_booking' => 0, 
        'id' => 0, 
        'invoice_number' => '-', 
        'total_harga' => 0
    ]; 
} 
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Pembayaran - POTO KITA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #121214; color: #ffffff; }
        .upload-card { background-color: #1c1c1e; border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 12px; max-width: 500px; margin: 50px auto; padding: 32px; }
        .bank-info-box { background-color: #27272a; border-radius: 8px; padding: 16px; border-left: 4px solid #ef4444; }
        .input-dark { background-color: #27272a; border: 1px solid rgba(255, 255, 255, 0.1); color: white; }
        .input-dark:focus { background-color: #27272a; border-color: #ef4444; color: white; box-shadow: none; }
    </style>
</head>
<body>

    <div class="container">
        <div class="upload-card">
            <h4 class="fw-bold text-center mb-1">UPLOAD BUKTI PEMBAYARAN</h4>
            <p class="text-secondary text-center small mb-4">Invoice: <span class="text-danger fw-bold"><?= esc($order['invoice_number']) ?></span></p>

            <!-- KOMPONEN TAMBAHAN: Detail Rekening Tujuan Studio -->
            <div class="bank-info-box mb-4">
                <span class="text-secondary small fw-bold text-uppercase d-block mb-2"><i class="fa-solid fa-university me-1"></i> Rekening Tujuan Transfer:</span>
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-bold text-white">Bank Central Asia (BCA)</span>
                    <span class="badge bg-dark text-secondary fw-bold">Studio Utama</span>
                </div>
                <h5 class="fw-bold text-danger mb-1">8612-3456-78</h5>
                <small class="text-secondary d-block">Atas Nama: <strong class="text-white">POTO KITA STUDIO</strong></small>
                <hr class="my-2" style="border-top: 1px dashed rgba(255,255,255,0.1);">
                <div class="d-flex justify-content-between text-secondary small">
                    <span>Total Tagihan:</span>
                    <span class="text-success fw-bold">Rp <?= number_format($order['total_harga'] ?? 150000, 0, ',', '.') ?></span>
                </div>
            </div>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger bg-danger text-white border-0 mb-3"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('customer/proses-upload-pembayaran') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_booking" value="<?= $order['id_booking'] ?? $order['id'] ?>">
                
                <div class="mb-4">
                    <label class="form-label text-secondary small fw-bold">PILIH FILE BUKTI TRANSFER (JPG/PNG/JPEG)</label>
                    <input type="file" name="bukti_transfer" class="form-control input-dark" accept="image/*" required>
                    <div class="form-text text-muted" style="font-size: 11px;">Pastikan gambar struk transfer terlihat jelas, utuh, dan tidak terpotong.</div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success fw-bold py-2">
                        <i class="fa-solid fa-cloud-arrow-up me-2"></i> Kirim Bukti Bayar
                    </button>
                    <a href="<?= base_url('customer/dashboard') ?>" class="btn btn-outline-secondary fw-bold py-2">
                        <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>