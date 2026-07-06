<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'tbl_booking'; // <--- Sesuaikan dengan nama tabel booking-mu di MySQL
    protected $primaryKey       = 'id_booking';   // <--- Sesuaikan dengan primary key tabel booking-mu
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Memberikan izin penuh untuk memproses data transaksi dan update status lunas
   protected $allowedFields = [
        'invoice_number', 
        'nama_customer', 
        'email_customer', 
        'whatsapp_customer', // Sesuaikan dengan database kamu
        'tipe_studio', 
        'tanggal_foto', 
        'jam_foto', 
        'jumlah_orang', 
        'bawa_hewan', 
        'total_harga', 
        'bukti_transfer',
        'link_drive',        // <--- KUNCI: Samakan dengan phpMyAdmin
        'status_booking'
    ];
}