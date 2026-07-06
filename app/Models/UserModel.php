<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Khusus untuk menampung data login akun
    protected $allowedFields = [
        'username', 
        'password', 
        'nama_lengkap', 
        'no_whatsapp', 
        'role'
    ];
}