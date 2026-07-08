<?php

namespace App\Controllers;

use App\Models\BookingModel;

class Customer extends BaseController
{
    public function index()
    {
        // 1. Ambil data session
        $isLoggedIn = session()->get('isLoggedIn');
        $sessionRole = strtolower(trim(session()->get('role') ?? ''));

        // 2. Proteksi Fleksibel: Jika belum login, tendang ke login
        if (!$isLoggedIn) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 3. Jika yang masuk adalah staff internal (admin/pemilik), oper ke dashboard mereka yang benar
        if ($sessionRole === 'admin') {
            return redirect()->to('/admin/dashboard');
        } elseif ($sessionRole === 'pemilik' || $sessionRole === 'owner') {
            return redirect()->to('/owner/dashboard');
        }

        // 4. Selain role di atas, LOLOSKAN sebagai member biasa
        $bookingModel = new BookingModel();
        $namaUser = session()->get('nama_user');

        // Ambil riwayat transaksi yang sesuai dengan nama user yang sedang login
        $data['my_orders'] = $bookingModel->where('nama_customer', $namaUser)
                                          ->orderBy($bookingModel->primaryKey, 'DESC')
                                          ->findAll();

        return view('customer_dashboard', $data);
    }

    // FITUR UTAMA: Menampilkan Halaman Upload Bukti Pembayaran (GET)
    public function upload_pembayaran(int $id_booking)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $bookingModel = new BookingModel();
        $data['order'] = $bookingModel->find($id_booking);

        if (!$data['order']) {
            return redirect()->to('customer/dashboard')->with('error', 'Data transaksi tidak ditemukan!');
        }

        return view('customer_upload_pembayaran', $data);
    }

    // FITUR UTAMA: Memproses File Gambar Bukti Transfer Customer (POST)
    public function proses_upload_pembayaran()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $bookingModel = new BookingModel();
        $id_booking = $this->request->getPost('id_booking');
        $fileBukti = $this->request->getFile('bukti_transfer');

        if ($fileBukti && $fileBukti->isValid() && !$fileBukti->hasMoved()) {
            // Berikan nama acak enkripsi yang aman
            $namaBaru = $fileBukti->getRandomName();
            
            // Pindahkan file fisik gambar ke folder public/uploads/
            $fileBukti->move(ROOTPATH . 'public/uploads/', $namaBaru);

            // Update nama file ke kolom database 'bukti_transfer'
            $bookingModel->update($id_booking, [
                'bukti_transfer' => $namaBaru,
                'status_booking' => 'Pending' // Kembalikan/kunci status ke antrian validasi admin
            ]);

            return redirect()->to('customer/dashboard')->with('success', 'Bukti pembayaran berhasil di-upload! Menunggu verifikasi admin.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah berkas gambar. Silakan coba lagi.');
    }

    // FITUR SEPARATE SIDEBAR: Halaman Khusus Output Download Foto
    public function output_foto()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $bookingModel = new BookingModel();
        $namaUser = session()->get('nama_user');

        // Mengambil data yang khusus sudah di-upload link drive-nya saja oleh editor
        $data['my_orders'] = $bookingModel->where('nama_customer', $namaUser)
                                          ->orderBy($bookingModel->primaryKey, 'DESC')
                                          ->findAll();

        return view('customer_output_foto', $data);
    }
}