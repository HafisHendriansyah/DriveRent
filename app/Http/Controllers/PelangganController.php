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
        $request->validate(
            [
                'nama_pelanggan' => 'required|string|max:100',
                'email_pelanggan' => ['required', 'email:rfc,dns', 'unique:pelanggans,email_pelanggan', 'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/'],
                'no_ktp' => 'required|digits:16|unique:pelanggans,no_ktp',
                'no_hp' => 'required|numeric|digits_between:10,13|unique:pelanggans,no_hp',
                'alamat' => 'nullable|string'
            ],
            [
                'nama_pelanggan.required' => 'Nama tidak boleh kosong!',
                'nama_pelanggan.string' => 'Nama harus berupa teks!',
                'nama_pelanggan.max' => 'Nama maksimal 100 karakter!',

                'email_pelanggan.required' => 'Email tidak boleh kosong!',
                'email_pelanggan.unique' => 'Email ini sudah terdaftar!',
                'email_pelanggan.regex' => 'Format email tidak sesuai! Hanya diperbolehkan menggunakan @gmail.com atau @yahoo.com.',

                'no_ktp.required' => 'No. KTP tidak boleh kosong!',
                'no_ktp.digits' => 'No. KTP harus 16 digit!',
                'no_ktp.unique' => 'No. KTP ini sudah terdaftar!',

                'no_hp.required' => 'No. HP tidak boleh kosong!',
                'no_hp.numeric' => 'No. HP harus berupa angka!',
                'no_hp.digits_between' => 'No. HP harus 10 sampai 13 digit!',
                'no_hp.unique' => 'No. HP ini sudah terdaftar!',
            ]
        );

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
        $request->validate(
            [
                'nama_pelanggan' => 'required|string|max:100',
                'email_pelanggan' => ['required', 'email:rfc,dns', 'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$/', 'unique:pelanggans,email_pelanggan,' . $id . ',id_pelanggan'],
                'no_ktp' => 'required|digits:16|unique:pelanggans,no_ktp,' . $id . ',id_pelanggan',
                'no_hp' => 'required|numeric|digits_between:10,13|unique:pelanggans,no_hp,' . $id . ',id_pelanggan',
                'alamat' => 'nullable|string',
            ],
            [
                'nama_pelanggan.required' => 'Nama tidak boleh kosong!',
                'nama_pelanggan.string' => 'Nama harus berupa teks!',
                'nama_pelanggan.max' => 'Nama maksimal 100 karakter!',

                'email_pelanggan.required' => 'Email tidak boleh kosong!',
                'email_pelanggan.unique' => 'Email ini sudah terdaftar!',
                'email_pelanggan.regex' => 'Format email tidak valid! Hanya diperbolehkan menggunakan @gmail.com atau @yahoo.com.',

                'no_ktp.required' => 'No. KTP tidak boleh kosong!',
                'no_ktp.digits' => 'No. KTP harus 16 digit!',
                'no_ktp.unique' => 'No. KTP ini sudah terdaftar!',

                'no_hp.required' => 'No. HP tidak boleh kosong!',
                'no_hp.numeric' => 'No. HP harus berupa angka!',
                'no_hp.digits_between' => 'No. HP harus 10 sampai 13 digit',
                'no_hp.unique' => 'No. HP ini sudah terdaftar!',
            ]
        );

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
