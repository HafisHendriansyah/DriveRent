<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class TransaksiController extends Controller
{
    public function index()
    {
        // Menampilkan hanya data transaksi yang sedang diproses
        $transaksi = \App\Models\Transaksi::with(['pelanggan', 'mobil'])
            ->where('status', 'PROSES')
            ->get();

        return view('transaksi.index', compact('transaksi'));
    }

    public function create($id_mobil)
    {
        $mobil = Mobil::findOrFail($id_mobil);
        $pelanggan = \App\Models\Pelanggan::all();

        return view('transaksi.create', compact('mobil', 'pelanggan'));
    }

    public function store(Request $request)
    {
        $messages = [
            'id_pelanggan.required' => 'Pelanggan harus dipilih.',
            'id_pelanggan.exists' => 'Pelanggan tidak valid.',
            'id_mobil.required' => 'Mobil harus dipilih.',
            'id_mobil.exists' => 'Mobil tidak valid.',
            'lama_penyewaan.required' => 'Lama penyewaan harus diisi.',
            'lama_penyewaan.integer' => 'Lama penyewaan harus berupa angka.',
            'lama_penyewaan.min' => 'Lama penyewaan minimal 1 hari.',
            'tgl_pesan.required' => 'Tanggal pesan harus diisi.',
            'tgl_pesan.date' => 'Format tanggal tidak valid.',
            'tgl_pesan.after_or_equal' => 'Tanggal pesan tidak boleh sebelum hari ini.',
        ];

        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'id_mobil' => 'required|exists:mobils,id_mobil',
            'lama_penyewaan' => 'required|integer|min:1',
            'tgl_pesan' => 'required|date|after_or_equal:today',
        ], $messages);

        $mobil = Mobil::findOrFail($request->id_mobil);

        // Validasi: Pastikan mobil tersedia
        if ($mobil->status !== 'tersedia') {
            return redirect()->back()->withInput()->with('error', 'Mobil ini sedang tidak tersedia untuk disewa (Status: ' . $mobil->status . ').');
        }

        $total_harga = $mobil->harga_perhari * $request->lama_penyewaan;

        // Hitung tanggal kembali: tgl_pesan + lama_penyewaan hari
        $tgl_presents = new \DateTime($request->tgl_pesan);
        $tgl_kembali = clone $tgl_presents;
        $tgl_kembali->modify('+' . $request->lama_penyewaan . ' days');
        $tgl_kembali_str = $tgl_kembali->format('Y-m-d');

        // Jika tombol yang ditekan adalah "Cek Perkiraan"
        if ($request->has('hitung')) {
            return redirect()->back()->withInput()->with([
                'perkiraan_total' => $total_harga,
                'perkiraan_kembali' => $tgl_kembali_str,
                'info' => 'Perkiraan biaya dan tanggal kembali telah diperbarui.'
            ]);
        }

        \App\Models\Transaksi::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_mobil' => $request->id_mobil,
            'id_admin' => auth('admin')->id(),
            'lama_penyewaan' => $request->lama_penyewaan,
            'tgl_pesan' => $request->tgl_pesan,
            'tgl_kembali' => $tgl_kembali_str,
            'total_harga' => $total_harga,
            'status' => 'PROSES', // Otomatis diproses
        ]);

        $mobil->update(['status' => 'disewa']);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat dan sedang diproses.');
    }

    public function updateStatus(Request $request, $id)
    {
        $transaksi = \App\Models\Transaksi::findOrFail($id);

        if ($transaksi->status === 'PROSES') {
            $transaksi->update(['status' => 'SELESAI']);

            // Kembalikan status mobil menjadi tersedia
            $mobil = Mobil::find($transaksi->id_mobil);
            if ($mobil) {
                $mobil->update(['status' => 'tersedia']);
            }

            return redirect()->route('transaksi.index')->with('success', 'Transaksi telah diselesaikan.');
        }

        return redirect()->back()->with('error', 'Status transaksi tidak valid.');
    }
}
