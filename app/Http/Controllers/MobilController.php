<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobil = Mobil::all();

        return view('mobil.index', compact('mobil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'no_polisi' => ['required', 'unique:mobils,no_polisi', 'regex:/^[A-Z]{1,2}\s\d{1,4}\s[A-Z]{1,3}$/'],
                'merek' => 'required|string|max:50',
                'jenis_mobil' => 'required|in:Sedan,MPV,SUV',
                'kapasitas' => 'required|integer|min:2|max:12',
                'harga_perhari' => 'required|numeric|min:100000',
                'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'no_polisi.required' => 'Nomor polisi tidak boleh kosong!',
                'no_polisi.unique' => 'Nomor polisi ini sudah terdaftar!',
                'no_polisi.regex' => 'Format nomor polisi tidak sesuai! Gunakan format Indonesia dengan spasi (contoh: B 1234 ABC).',

                'merek.required' => 'Merek mobil tidak boleh kosong!',
                'merek.string' => 'Merek mobil harus berupa teks!',
                'merek.max' => 'Merek mobil maksimal 50 karakter!',

                'jenis_mobil.required' => 'Jenis mobil tidak boleh kosong!',

                'kapasitas.required' => 'Kapasitas mobil tidak boleh kosong!',
                'kapasitas.integer' => 'Kapasitas mobil harus berupa angka!',
                'kapasitas.min' => 'Kapasitas mobil minimal adalah 2 orang!',
                'kapasitas.max' => 'Kapasitas mobil maksimal adalah 12 orang!',

                'harga_perhari.required' => 'Harga perhari tidak boleh kosong!',
                'harga_perhari.numeric' => 'Harga perhari harus berupa angka!',
                'harga_perhari.min' => 'Harga perhari minimal adalah 100000!',

                'foto.required' => 'Foto mobil harus diunggah!',
                'foto.image' => 'File yang diunggah harus berupa gambar!',
                'foto.mimes' => 'Format foto harus jpg, jpeg, atau png!',
                'foto.max' => 'Ukuran foto maksimal adalah 2MB!'
            ]
        );

        $foto = $request->file('foto')->store('mobil', 'public');

        Mobil::create([
            'id_admin' => auth('admin')->id(),
            'no_polisi' => $request->no_polisi,
            'merek' => $request->merek,
            'jenis_mobil' => $request->jenis_mobil,
            'kapasitas' => $request->kapasitas,
            'harga_perhari' => $request->harga_perhari,
            'foto' => $foto,
            'status' => 'tersedia'
        ]);

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('mobil.edit', compact('mobil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mobil = Mobil::findOrFail($id);

        if ($mobil->status === 'disewa') {
            return redirect()->route('mobil.index')->with('error', 'Mobil sedang disewa dan tidak dapat diperbarui.');
        }

        $request->validate(
            [
                'no_polisi' => ['required', 'regex:/^[A-Z]{1,2}\s\d{1,4}\s[A-Z]{1,3}$/', 'unique:mobils,no_polisi,' . $id . ',id_mobil'],
                'merek' => 'required|string|max:50',
                'jenis_mobil' => 'required|in:Sedan,MPV,SUV',
                'kapasitas' => 'required|integer|min:2|max:12',
                'harga_perhari' => 'required|numeric|min:100000',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ],
            [
                'no_polisi.required' => 'Nomor polisi tidak boleh kosong!',
                'no_polisi.unique' => 'Nomor polisi ini sudah terdaftar!',
                'no_polisi.regex' => 'Format nomor polisi tidak sesuai! Gunakan format Indonesia dengan spasi (contoh: B 1234 ABC).',

                'merek.required' => 'Merek mobil tidak boleh kosong!',
                'merek.string' => 'Merek mobil harus berupa teks!',
                'merek.max' => 'Merek mobil maksimal 50 karakter!',

                'jenis_mobil.required' => 'Jenis mobil tidak boleh kosong!',

                'kapasitas.required' => 'Kapasitas mobil tidak boleh kosong!',
                'kapasitas.integer' => 'Kapasitas mobil harus berupa angka!',
                'kapasitas.min' => 'Kapasitas mobil minimal adalah 2 orang!',
                'kapasitas.max' => 'Kapasitas mobil maksimal adalah 12 orang!',

                'harga_perhari.required' => 'Harga perhari tidak boleh kosong!',
                'harga_perhari.numeric' => 'Harga perhari harus berupa angka!',
                'harga_perhari.min' => 'Harga perhari minimal adalah 100000!',

                'foto.image' => 'File yang diunggah harus berupa gambar!',
                'foto.mimes' => 'Format foto harus jpg, jpeg, atau png!',
                'foto.max' => 'Ukuran foto maksimal adalah 2MB!'
            ]
        );

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($mobil->foto) {
                Storage::disk('public')->delete($mobil->foto);
            }
            $data['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        $mobil->update($data);

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mobil = Mobil::findOrFail($id);

        if ($mobil->status === 'disewa') {
            return redirect()->route('mobil.index')->with('error', 'Mobil sedang disewa dan tidak dapat dihapus.');
        }

        if ($mobil->foto) {
            Storage::disk('public')->delete($mobil->foto);
        }
        $mobil->delete();

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil dihapus');
    }
}
