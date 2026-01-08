<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Mobil;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahPelanggan = Pelanggan::count();
        $jumlahMobil = Mobil::count();
        $mobil = Mobil::where('status', 'tersedia')->get();
        $jumlahLaporan = \App\Models\Transaksi::where('status', 'SELESAI')->count();

        return view('home', compact(
            'jumlahPelanggan',
            'jumlahMobil',
            'mobil',
            'jumlahLaporan'
        ));
    }
}
