<?= $this->extend('layout_dashboard') ?>

<?= $this->section('content') ?>
<div class="container-fluid p-0">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0 text-white text-uppercase tracking-wide" style="font-size: 24px;">Registrasi Sesi Photo</h2>
            <p class="text-secondary m-0 small">Silakan lengkapi reservasi jadwal untuk mengunci slot sesi studio POTO KITA STUDIO</p>
        </div>
        <div>
            <span class="badge bg-danger text-white px-3 py-2 fw-bold" style="background-color: #dc2626 !important; font-size: 12px;">
                <i class="fa-solid fa-circle text-white me-2 animate-pulse" style="font-size: 8px;"></i>PORTAL UTAMA
            </span>
        </div>
    </div>

    <!-- Grid -->
    <div class="row g-4">
        <!-- FORM INPUT -->
        <div class="col-lg-7">
            <div class="card card-premium p-4 h-100">
                <h5 class="text-white fw-bold mb-4 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-pen-to-square text-strong-red me-2"></i>Form Pemesanan Sesi
                </h5>
                
                <!-- Notifikasi Alert Jika Jadwal Bentrok -->
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger d-flex align-items-center border-0 mb-4 py-3" role="alert" style="background-color: rgba(239, 68, 68, 0.15); color: #f87171; border-radius: 8px;">
                        <i class="fa-solid fa-triangle-exclamation fs-5 me-3"></i>
                        <div class="small fw-bold">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form action="<?= base_url('booking/simpan') ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold tracking-wider">NAMA LENGKAP CUSTOMER</label>
                        <div class="input-group">
                            <span class="input-group-text text-strong-red"><i class="fa-solid fa-user"></i></span>
                            <!-- Proteksi readonly dilepas agar inputan nama bisa diedit secara fleksibel -->
                            <input type="text" name="nama_customer" class="form-control" value="<?= esc($session_nama ?? old('nama_customer') ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary small fw-bold tracking-wider">NOMOR WHATSAPP (AKTIF)</label>
                        <div class="input-group">
                            <span class="input-group-text text-strong-red"><i class="fa-brands fa-whatsapp"></i></span>
                            <!-- Proteksi readonly dilepas total agar kotak nomor handphone terbuka bebas -->
                            <input type="number" name="whatsapp_customer" class="form-control" value="<?= esc($session_whatsapp ?? old('whatsapp_customer') ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-secondary small fw-bold tracking-wider">TIPE STUDIO</label>
                            <select name="tipe_studio" class="form-select" required>
                                <option value="Regular Studio" <?= old('tipe_studio') == 'Regular Studio' ? 'selected' : '' ?>>Regular Studio (Max 5 Orang)</option>
                                <option value="Largest Studio" <?= old('tipe_studio') == 'Largest Studio' ? 'selected' : '' ?>>Largest Studio (Max 10 Orang)</option>
                                <option value="VVIP Studio" <?= old('tipe_studio') == 'VVIP Studio' ? 'selected' : '' ?>>VVIP Studio (Premium Box)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-secondary small fw-bold tracking-wider">JUMLAH ORANG</label>
                            <input type="number" name="jumlah_orang" class="form-control" min="1" value="<?= old('jumlah_orang') ?? '1' ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-secondary small fw-bold tracking-wider">TANGGAL SESI FOTO</label>
                            <input type="date" name="tanggal_foto" class="form-control" value="<?= old('tanggal_foto') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-secondary small fw-bold tracking-wider">PILIHAN JAM SESI</label>
                            <select name="jam_foto" class="form-select" required>
                                <option value="09:00" <?= old('jam_foto') == '09:00' ? 'selected' : '' ?>>09:00 WIB</option>
                                <option value="10:00" <?= old('jam_foto') == '10:00' ? 'selected' : '' ?>>10:00 WIB</option>
                                <option value="13:00" <?= old('jam_foto') == '13:00' ? 'selected' : '' ?>>13:00 WIB</option>
                                <option value="15:00" <?= old('jam_foto') == '15:00' ? 'selected' : '' ?>>15:00 WIB</option>
                                <option value="17:00" <?= old('jam_foto') == '17:00' ? 'selected' : '' ?>>17:00 WIB</option>
                                <option value="19:00" <?= old('jam_foto') == '19:00' ? 'selected' : '' ?>>19:00 WIB</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-bold d-block tracking-wider">MEMBAWA HEWAN PELIHARAAN? (+Rp 20.000)</label>
                        <div class="form-check form-check-inline mt-1">
                            <input class="form-check-input" type="radio" name="bawa_hewan" id="hewanYa" value="Yes" <?= old('bawa_hewan') == 'Yes' ? 'checked' : '' ?>>
                            <label class="form-check-label text-white small fw-bold" for="hewanYa">Ya, Membawa</label>
                        </div>
                        <div class="form-check form-check-inline mt-1">
                            <input class="form-check-input" type="radio" name="bawa_hewan" id="hewanToggle" value="No" <?= old('bawa_hewan') == 'No' || !old('bawa_hewan') ? 'checked' : '' ?>>
                            <label class="form-check-label text-white small fw-bold" for="hewanToggle">Tidak Membawa</label>
                        </div>
                    </div>

                    <div class="mb-4 p-3 rounded" style="background-color: #2c2c2e;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkSyarat" required>
                            <label class="form-check-label small text-secondary" for="checkSyarat" style="font-size: 12px; line-height: 1.5; font-weight: 600;">
                                Saya menyetujui seluruh regulasi kehadiran dan operasional studio POTO KITA. Batas keterlambatan adalah 15 menit.
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-strong-red w-100 py-3 text-uppercase fw-bold tracking-wide">
                        <i class="fa-solid fa-lock me-2"></i>Amankan Slot Reservasi Sekarang
                    </button>
                </form>
            </div>
        </div>

        <!-- KOLOM MATRIKS HARGA -->
        <div class="col-lg-5">
            <div class="card card-premium p-4 mb-4">
                <h5 class="text-white fw-bold mb-3 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-receipt text-strong-red me-2"></i>Daftar Harga Sesi
                </h5>
                <div class="table-responsive">
                    <table class="table m-0 text-white small">
                        <thead>
                            <tr class="border-bottom border-secondary text-secondary">
                                <th class="pb-2 bg-transparent text-secondary">KATEGORI STUDIO</th>
                                <th class="text-end pb-2 bg-transparent text-secondary">HARGA DASAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-bottom border-secondary">
                                <td class="py-3 bg-transparent text-white fw-bold">Regular Studio <span class="d-block fw-normal text-secondary" style="font-size: 11px;">Kapasitas standar max 5 orang</span></td>
                                <td class="text-end text-strong-red fw-bold align-middle bg-transparent" style="font-size: 15px;">Rp 150.000</td>
                            </tr>
                            <tr class="border-bottom border-secondary">
                                <td class="py-3 bg-transparent text-white fw-bold">Largest Studio <span class="d-block fw-normal text-secondary" style="font-size: 11px;">Kapasitas grup besar max 10 orang</span></td>
                                <td class="text-end text-strong-red fw-bold align-middle bg-transparent" style="font-size: 15px;">Rp 250.000</td>
                            </tr>
                            <tr>
                                <td class="py-3 bg-transparent text-white fw-bold">VVIP Studio <span class="d-block fw-normal text-secondary" style="font-size: 11px;">Fasilitas eksklusif premium box</span></td>
                                <td class="text-end text-strong-red fw-bold align-middle bg-transparent" style="font-size: 15px;">Rp 350.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-premium p-4">
                <h5 class="text-white fw-bold mb-3 text-uppercase border-bottom border-secondary pb-3">
                    <i class="fa-solid fa-triangle-exclamation text-strong-red me-2"></i>Regulasi Operasional
                </h5>
                <ul class="text-secondary small ps-3 m-0 fw-semibold" style="line-height: 1.7; font-size: 13px;">
                    <li class="mb-2">Apabila jumlah orang melebihi batas kuota tipe studio, dikenakan charge tambahan <span class="text-strong-red fw-bold">Rp 25.000 / orang</span>.</li>
                    <li class="mb-2">Sesi foto bersama hewan peliharaan wajib membayar biaya kebersihan senilai <span class="text-strong-red fw-bold">Rp 20.000</span>.</li>
                    <li>Link unduhan berkas foto mentah (*raw files*) akan dibagikan penuh secara aman melalui tautan privat <span class="text-strong-red fw-bold">Google Drive</span>.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>