<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Halaman Depan / Landing Page Umum
$routes->get('/', 'Home::index');


// Modul Transaksi & Booking Pelanggan Depan
$routes->get('booking', 'Booking::index');
$routes->post('booking/simpan', 'Booking::simpan');
$routes->get('booking/cek_status', 'Booking::cekStatus');
$routes->post('booking/cari_status', 'Booking::cariStatus');
$routes->get('booking/upload_bayar', 'Booking::uploadBayar');
$routes->post('booking/proses_upload', 'Booking::prosesUpload');
$routes->get('booking/download_foto', 'Booking::downloadFoto');
$routes->post('booking/cari_foto', 'Booking::cariFoto');
$routes->get('booking/aturan', 'Booking::aturan');
$routes->get('customer/upload-pembayaran/(:num)', 'Customer::upload_pembayaran/$1');
$routes->post('customer/proses-upload-pembayaran', 'Customer::proses_upload_pembayaran');

$routes->get('admin/dashboard', 'Admin::index');
$routes->post('admin/update-status/(:num)', 'Admin::updateStatus/$1');
$routes->post('admin/input_link/(:num)', 'Admin::inputLink/$1');
$routes->post('admin/verifikasi', 'Admin::verifikasi');

// 2. RUTE DASHBOARD CUSTOMER 
$routes->get('customer/output-foto', 'Customer::output_foto');
$routes->get('customer/dashboard', 'Customer::index');
// 3. RUTE DASHBOARD PEMILIK / OWNER (MONITORING OMZET)
$routes->get('owner/dashboard', 'Owner::index');

$routes->get('editor/dashboard', 'Editor::index');
$routes->post('editor/upload-link', 'Editor::uploadLink');
// RUTE OTENTIKASI USER TERPADU (SINKRON 100% DENGAN AUTH.PHP)
$routes->get('login', 'Auth::login');
$routes->post('auth/login_process', 'Auth::login_process'); // Menggunakan login_process sesuai Controller kita
$routes->get('auth/logout', 'Auth::logout');
$routes->get('buat-akun-baru', 'Auth::buatAkunOtomatis');$routes->get('register', 'Auth::register');          // Menampilkan form register
$routes->post('auth/register_process', 'Auth::register_process'); // Memproses simpan member baru