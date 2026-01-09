<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanTransaksiController extends Controller
{
    public function index(Request $request)
    {
        // Menampilkan data transaksi yang sudah selesai
        $queryTransaksi = \App\Models\Transaksi::with(['pelanggan', 'mobil'])
            ->where('status', 'SELESAI');

        // Filter dari tanggal
        if ($request->filled('tgl_awal')) {
            $queryTransaksi->whereDate('tgl_kembali', '>=', $request->tgl_awal);
        }

        // Filter sampai tanggal
        if ($request->filled('tgl_akhir')) {
            $queryTransaksi->whereDate('tgl_kembali', '<=', $request->tgl_akhir);
        }

        $transaksi =   $queryTransaksi->get();

        return view('laporan.index', compact('transaksi'));
    }

    public function cetakPdf(Request $request)
    {
        $queryTransaksi = Transaksi::with(['pelanggan', 'mobil'])
            ->where('status', 'SELESAI');

        if ($request->filled('tgl_awal')) {
            $queryTransaksi->whereDate('tgl_kembali', '>=', $request->tgl_awal);
        }

        if ($request->filled('tgl_akhir')) {
            $queryTransaksi->whereDate('tgl_kembali', '<=', $request->tgl_akhir);
        }

        $transaksi = $queryTransaksi->get();

        $pdf = Pdf::loadView('laporan.pdf', [
            'transaksi' => $transaksi,
            'tgl_awal' => $request->tgl_awal,
            'tgl_akhir' => $request->tgl_akhir,
        ]);

        return $pdf->download('laporan-transaksi.pdf');
    }
}
