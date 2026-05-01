<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:users,nik,' . $admin->id,
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'no_hp' => 'nullable|string|max:15',
            'tempat_lahir' => 'nullable|string|max:100',
            'tgl_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|string|max:20',
            'pekerjaan' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $admin->name = $request->name;
        $admin->nik = $request->nik;
        $admin->email = $request->email;
        $admin->no_hp = $request->no_hp;
        $admin->tempat_lahir = $request->tempat_lahir;
        $admin->tgl_lahir = $request->tgl_lahir;
        $admin->jenis_kelamin = $request->jenis_kelamin;
        $admin->agama = $request->agama;
        $admin->pekerjaan = $request->pekerjaan;
        $admin->alamat = $request->alamat;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui');
    }
}