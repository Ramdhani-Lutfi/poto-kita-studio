<?php

namespace App\Controllers;

use App\Models\BookingModel;

class Booking extends BaseController
{
    public function index()
    {
        // Form sengaja dibuat bersih dan kosong tanpa lemparan session login admin
        return view('booking_page');
    }

    public function simpan()
    {
        $bookingModel = new BookingModel();

        // 1. Ambil data dari form input customer
        $tipe_studio    = $this->request->getPost('tipe_studio');
        $tanggal_foto   = $this->request->getPost('tanggal_foto');
        $jam_foto       = $this->request->getPost('jam_foto');
        $jumlah_orang   = (int)$this->request->getPost('jumlah_orang');
        $bawa_hewan     = $this->request->getPost('bawa_hewan') ?? 'No';
        
        // 2. Validasi Anti Double Booking (Cek duplikasi Tanggal, Jam, DAN Tipe Studio)
$jadwalBentrok = $bookingModel->where('tanggal_foto', $tanggal_foto)
                              ->where('jam_foto', $jam_foto)
                              ->where('tipe_studio', $tipe_studio) // <-- KUNCI TAMBAHAN: Biar studio lain gak ikut kekunci!
                              ->whereIn('status_booking', ['Pending', 'Confirmed', 'Lunas', 'Selesai'])
                              ->first();

// Jika slot waktu di studio tersebut sudah terisi, gagalkan otomatis
if ($jadwalBentrok) {
    return redirect()->back()->withInput()->with('error', 'Maaf, slot jadwal untuk ' . $tipe_studio . ' pada tanggal ' . $tanggal_foto . ' jam ' . $jam_foto . ' WIB sudah di-booking pelanggan lain. Silakan pilih studio atau waktu lain!');
}

        // 3. Tentukan harga dasar dan batas kuota berdasarkan tipe studio
        $harga_dasar = 0;
        $batas_maks_orang = 5;

        if ($tipe_studio == 'Regular Studio') {
            $harga_dasar = 150000;
            $batas_maks_orang = 5;
        } elseif ($tipe_studio == 'Largest Studio') {
            $harga_dasar = 250000;
            $batas_maks_orang = 10;
        } else {
            $harga_dasar = 350000;
            $batas_maks_orang = 5;
        }

        // 4. Logika Hitung Cas Kelebihan Orang (Aritmatika Bersyarat)
        $biaya_tambahan_orang = 0;
        if ($jumlah_orang > $batas_maks_orang) {
            $kelebihan_orang = $jumlah_orang - $batas_maks_orang;
            $biaya_tambahan_orang = $kelebihan_orang * 25000;
        }

        // 5. Logika Tambahan Biaya Hewan Peliharaan
        $biaya_hewan = ($bawa_hewan == 'Yes') ? 20000 : 0;

        // 6. Total Akhir Tagihan
        $total_harga = $harga_dasar + $biaya_tambahan_orang + $biaya_hewan;

        // 7. Generate Nomor Invoice Unik Otomatis (INV-TANGGAL-KODEACAK)
        $invoice_number = 'INV-' . date('Ymd') . '-' . strtoupper(substr(md5(time()), 0, 4));

        // 8. Siapkan susunan array data untuk disimpan ke MySQL
        $data_simpan = [
            'invoice_number'    => $invoice_number,
            'nama_customer'     => $this->request->getPost('nama_customer'),
            'email_customer'    => session()->get('username') ? session()->get('username') . '@mail.com' : 'customer@mail.com',
            'whatsapp_customer' => $this->request->getPost('whatsapp_customer'),
            'tipe_studio'       => $tipe_studio,
            'tanggal_foto'      => $tanggal_foto,
            'jam_foto'          => $jam_foto,
            'jumlah_orang'      => $jumlah_orang,
            'bawa_hewan'        => $bawa_hewan,
            'total_harga'       => $total_harga,
            'status_booking'    => 'Pending'
        ];

        // 9. Eksekusi simpan ke database dengan metode proteksi murni CodeIgniter 4
        if ($bookingModel->insert($data_simpan)) {
            // Mengirimkan variabel invoice dan total harga ke halaman view sukses
            return view('booking_sukses', [
                'invoice_number' => $invoice_number,
                'total_harga'    => $total_harga
            ]);
        } else {
            return "<h3>Eror Gagal Menyimpan:</h3> <p style='color:red; font-weight:bold;'>Data form gagal dimasukkan. Pastikan MySQL XAMPP dalam posisi aktif.</p>";
        }
    }

    // 1. Menampilkan halaman form pencarian status invoice
    public function cekStatus()
    {
        return view('booking_cek');
    }

    // 2. Memproses pencarian nomor invoice ke database
    public function cariStatus()
    {
        $input_pencarian = $this->request->getPost('invoice_number');
        $bookingModel = new \App\Models\BookingModel();

        $data_booking = $bookingModel->where('invoice_number', $input_pencarian)
                                    ->orWhere('whatsapp_customer', $input_pencarian)
                                    ->first();

        return view('booking_cek', [
            'hasil'   => $data_booking,
            'keyword' => $input_pencarian
        ]);
    }

    // 1. Menampilkan halaman form upload bukti bayar
    public function uploadBayar()
    {
        return view('booking_upload');
    }

    // 2. Memproses file gambar bukti transfer ke folder public/uploads
    public function prosesUpload()
    {
        $invoice = $this->request->getPost('invoice_number');
        $fileBukti = $this->request->getFile('bukti_transfer');

        $bookingModel = new \App\Models\BookingModel();
        $cekData = $bookingModel->where('invoice_number', $invoice)
                                ->orWhere('whatsapp_customer', $invoice)
                                ->first();

        if (!$cekData) {
            return redirect()->back()->with('error', 'Nomor Invoice atau WhatsApp tidak terdaftar di sistem POTO KITA STUDIO.');
        }

        if ($fileBukti->isValid() && !$fileBukti->hasMoved()) {
            $namaFileBaru = $fileBukti->getRandomName();
            $fileBukti->move(ROOTPATH . 'public/uploads', $namaFileBaru);

            $primaryKey = $bookingModel->primaryKey;
            $bookingModel->update($cekData[$primaryKey], [
                'bukti_transfer' => $namaFileBaru
            ]);

            return redirect()->back()->with('success', 'Bukti transfer berhasil diunggah! Admin POTO KITA STUDIO akan segera memvalidasi sesi Anda.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah file. Pastikan format file berupa gambar.');
    }

    // 1. Menampilkan halaman form pencarian unduhan foto
    public function downloadFoto()
    {
        return view('booking_download');
    }

    // 2. Memproses pencarian link Google Drive hasil foto di database
    public function cariFoto()
    {
        $input_pencarian = $this->request->getPost('invoice_number');
        $bookingModel = new \App\Models\BookingModel();

        $data_booking = $bookingModel->where('invoice_number', $input_pencarian)
                                    ->orWhere('whatsapp_customer', $input_pencarian)
                                    ->first();

        return view('booking_download', [
            'hasil'   => $data_booking,
            'keyword' => $input_pencarian
        ]);
    }

    public function aturan()
    {
        return view('booking_aturan');
    }
}   