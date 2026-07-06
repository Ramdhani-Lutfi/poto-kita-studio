<?php

namespace App\Controllers;

use App\Models\BookingModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Admin extends BaseController
{
    /**
     * Gerbang Pengaman Otomatis
     * Fungsi ini akan berjalan paling pertama setiap kali Controller Admin diakses.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // PENGAMAN SINKRON: Cek session isLoggedIn DAN pastikan role-nya adalah admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            // Jika tidak valid, langsung tendang ke halaman login internal
            header('Location: ' . base_url('login'));
            exit();
        }
    }

    // 1. Menampilkan seluruh daftar pesanan masuk secara real-time
    public function index()
    {
        $bookingModel = new BookingModel();
        
        // Ambil data terbaru di posisi paling atas
        $data['orders'] = $bookingModel->orderBy($bookingModel->primaryKey, 'DESC')->findAll();

        return view('admin_dashboard', $data);
    }

    // 2. Mengubah status validasi pembayaran (Pending -> Confirmed)
    // Disesuaikan agar bisa menerima request post langsung dari tombol validasi kilat Admin
    public function updateStatus(int $id)
    {
        $bookingModel = new BookingModel();
        
        $status = $this->request->getPost('status') ?? 'Confirmed';

        // Ganti status_konfirmasi menjadi status_booking sesuai nama kolom asli di MySQL
        $bookingModel->update($id, [
            'status_booking' => $status
        ]);

        return redirect()->to('admin/dashboard')->with('success', 'Status validasi invoice berhasil diperbarui!');
    }

    // 3. Menginput tautan berkas Google Drive untuk customer
    public function inputLink(int $id)
    {
        $bookingModel = new BookingModel();
        $linkDrive = $this->request->getPost('link_foto');

        $bookingModel->update($id, [
            'link_foto' => $linkDrive
        ]);

        // Dialihkan kembali ke rute admin/dashboard sesuai Routes.php kamu
        return redirect()->to('admin/dashboard')->with('success', 'Tautan Google Drive berhasil dibagikan ke pelanggan!');
    }
}