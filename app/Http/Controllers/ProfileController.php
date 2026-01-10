<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('profile.index', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('profile.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'nama_admin' => 'required|string|max:100',
            'email_admin' => [
                'required',
                'email',
                'max:100',
                'unique:admins,email_admin,' . $admin->id_admin . ',id_admin',
                'regex:/^.+@(gmail\.com|yahoo\.com)$/'
            ],

            'password' => 'nullable|min:8',
        ], [
            'email_admin.regex' => 'Format email tidak valid! Hanya diperbolehkan menggunakan @gmail.com atau @yahoo.com.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        $data = [
            'nama_admin' => $request->nama_admin,
            'email_admin' => $request->email_admin,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }



        $admin->update($data);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
