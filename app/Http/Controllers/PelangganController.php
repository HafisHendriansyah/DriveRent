<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'email_pelanggan' => 'required|email|unique:pelanggans,email_pelanggan',
            'no_ktp' => 'required|digits_between:10,20|unique:pelanggans,no_ktp',
            'no_hp' => 'required|digits_between:10,15|unique:pelanggans,no_hp',
            'alamat' => 'nullable|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'email_pelanggan' => 'required|email|unique:pelanggans,email_pelanggan,' . $id . ',id_pelanggan',
            'no_ktp' => 'required|digits_between:10,20|unique:pelanggans,no_ktp,' . $id . ',id_pelanggan',
            'no_hp' => 'required|digits_between:10,15|unique:pelanggans,no_hp,' . $id . ',id_pelanggan',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan berhasil dihapus');
    }
}
