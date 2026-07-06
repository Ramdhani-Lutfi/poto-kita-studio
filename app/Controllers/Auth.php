<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika user sudah login sebelumnya, langsung lempar ke dashboard yang sesuai
        if (session()->get('isLoggedIn')) {
            return $this->redirectBasedOnRole(session()->get('role'));
        }
        return view('auth_login');
    }

    public function login_process()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Mencari user berdasarkan username di tabel users
        $user = $model->where('username', $username)->first();

        if ($user) {
            // Cek kecocokan password teks biasa 'admin123' atau text hash
            if ($user['password'] === $password || password_verify($password, $user['password'])) {
                
                // Normalisasi huruf role menjadi kecil semua agar tidak sensitif huruf besar/kecil
                $userRole = strtolower($user['role']);

                $sessionData = [
                    'id_user'     => $user['id_user'],
                    'username'    => $user['username'],
                    'nama_user'   => $user['nama_lengkap'],
                    'role'        => $userRole,
                    'isLoggedIn'  => true
                ];
                
                // Menyimpan session
                $session->set($sessionData);

                return $this->redirectBasedOnRole($userRole);
            } else {
                $session->setFlashdata('error', 'Password yang Anda masukkan salah.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->to('/login');
        }
    }public function register()
    {
        // Jika sudah login, balikkan ke dashboard-nya
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/booking');
        }
        return view('auth_register');
    }

    public function register_process()
    {
        $session = session();
        $model = new \App\Models\UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $no_whatsapp = $this->request->getPost('no_whatsapp'); // Tangkap data WA

        // 1. Validasi apakah username sudah dipakai orang lain
        $cekUser = $model->where('username', $username)->first();
        if ($cekUser) {
            $session->setFlashdata('error', 'Username sudah terdaftar! Silakan gunakan username lain.');
            return redirect()->to('/register');
        }

        // 2. Simpan data member baru ke database beserta nomor WhatsApp
        $model->save([
            'username'     => $username,
            'password'     => $password, 
            'nama_lengkap' => $nama_lengkap,
            'no_whatsapp'  => $no_whatsapp, // Simpan ke database
            'role'         => 'Customer' 
        ]);

        $session->setFlashdata('success', 'Akun member berhasil dibuat! Silakan login.');
        return redirect()->to('/login');
    }

    /**
     * Mengarahkan user berdasarkan role dengan deklarasi tipe data parameter dan return type yang ketat
     */
   private function redirectBasedOnRole(string $role): \CodeIgniter\HTTP\RedirectResponse
    {
        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard')->with('success', 'Selamat Datang Admin!');
        } elseif ($role === 'pemilik' || $role === 'owner') {
            return redirect()->to('/owner/dashboard')->with('success', 'Selamat Datang Owner!');
        } elseif ($role === 'editor') { // <--- Tambahkan kondisi ini jika belum ada
            return redirect()->to('/editor/dashboard')->with('success', 'Selamat Datang Editor!');
        } else {
            return redirect()->to('/customer/dashboard');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}