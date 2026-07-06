<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Menampilkan halaman utama / landing page
        return view('landing_page');
    }
}