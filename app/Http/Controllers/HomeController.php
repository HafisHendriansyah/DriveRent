<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pelanggan;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahPelanggan = Pelanggan::count();
        return view('home', compact('jumlahPelanggan'));
    }
}
