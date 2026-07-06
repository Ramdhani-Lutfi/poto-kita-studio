<?php

namespace App\Controllers;

use App\Models\BookingModel;

class Owner extends BaseController
{
    public function index()
    {
        // 1. Proteksi keamanan: Jika belum login atau role bukan pemilik/owner, tendang balik ke login
        $role = strtolower(trim(session()->get('role') ?? ''));
        if (!session()->get('isLoggedIn') || ($role !== 'pemilik' && $role !== 'owner')) {
            return redirect()->to('/login')->with('error', 'Akses khusus Pemilik/Owner ditolak!');
        }

        $bookingModel = new BookingModel();

        // 2. Ambil seluruh data booking untuk kebutuhan rekap laporan keuangan
        $data['all_orders'] = $bookingModel->orderBy($bookingModel->primaryKey, 'DESC')->findAll();

        // 3. Hitung ringkasan data finansial secara otomatis & real-time
        $data['total_sesi'] = count($data['all_orders']);
        
        $sesiLunas = 0;
        $totalOmzet = 0; // Tambahan variabel untuk menampung total uang riil masuk

        foreach ($data['all_orders'] as $order) {
            // KUNCI UTAMA: Mengubah pencarian status agar murni membaca kolom database asli 'status_booking'
            $status = strtolower(trim($order['status_booking'] ?? ''));
            
            if ($status === 'confirmed' || $status === 'lunas' || $status === 'selesai') {
                $sesiLunas++;
                // Menambahkan harga booking data lunas ke dalam kas omzet owner
                $totalOmzet += intval($order['total_harga'] ?? 150000); 
            }
        }
        
        $data['sesi_lunas'] = $sesiLunas;
        $data['total_omzet'] = $totalOmzet; // Kirim data omzet bersih ke view dashboard owner

        // Tampilkan halaman laporan khusus owner
        return view('owner_dashboard', $data);
    }
}