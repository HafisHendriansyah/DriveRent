<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class TransaksiController extends Controller
{
    public function index()
    {
        $mobils = Mobil::where('status', 'tersedia')->get();
        return view('transaksi.index', compact('mobils'));
    }
}
