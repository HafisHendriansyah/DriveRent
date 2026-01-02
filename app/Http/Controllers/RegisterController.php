<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use App\Models\User;
use App\Models\Admin;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('register.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required',
            'email_admin' => 'required|email:rfc,dns|unique:admins,email_admin',
            'password' => 'required|min:8'
        ], [
            'nama_admin.required' => 'Nama tidak boleh kosong!',
            'email_admin.required' => 'Email tidak boleh kosong!',
            'email_admin.email' => 'Format email tidak benar!',
            'email_admin.unique' => 'Email ini sudah terdaftar!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 8 karakter!'
        ]);

        Admin::create([
            'nama_admin' => $request->nama_admin,
            'email_admin' => $request->email_admin,
            'password' => Hash::make($request->password),
        ]);
        session()->flash('success', 'Berhasil didaftarkan!');
        return redirect()->route('register');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
