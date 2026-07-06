<?php

namespace App\Controllers;

use App\Models\BookingModel;

class Editor extends BaseController
{
    public function index()
    {
        // 1. Proteksi keamanan: Jika belum login atau role bukan editor, tendang balik
        $role = strtolower(trim(session()->get('role') ?? ''));
        if (!session()->get('isLoggedIn') || $role !== 'editor') {
            return redirect()->to('/login')->with('error', 'Akses khusus Editor ditolak!');
        }

        $bookingModel = new BookingModel();

        // 2. Tarik data yang statusnya Lunas/Confirmed untuk diproses fotonya
        // Menampilkan yang lunas saja agar editor fokus mengerjakan pesanan yang sudah dibayar
        $data['orders'] = $bookingModel->where('status_booking', 'Confirmed')
                                       ->orWhere('status_booking', 'Lunas')
                                       ->orderBy($bookingModel->primaryKey, 'DESC')
                                       ->findAll();

        return view('editor_dashboard', $data);
    }

    public function uploadLink()
    {
        $bookingModel = new BookingModel();
        
        $id = $this->request->getPost('id_booking');
        $linkDrive = $this->request->getPost('link_foto');

        if (empty($linkDrive)) {
            return redirect()->back()->with('error', 'Link Google Drive tidak boleh kosong!');
        }

        // KUNCI: Ubah nama kolom menjadi link_drive sesuai database asli kamu
        $updated = $bookingModel->update($id, [
            'link_drive' => $linkDrive 
        ]);

        if ($updated) {
            return redirect()->to('/editor/dashboard')->with('success', 'Link hasil foto berhasil diperbarui dan dikirim ke Customer!');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui link foto.');
        }
    }
}