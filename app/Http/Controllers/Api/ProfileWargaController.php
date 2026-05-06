<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileWargaController extends Controller
{
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'data' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
{
    try {
        $user = $request->user();

        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'no_hp' => [
                'required',
                'regex:/^[0-9]{10,15}$/',
            ],

            'alamat' => [
                'required',
                'string',
                'max:500',
            ],
        ], [
            // custom message biar gak generik
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'email.max' => 'Email terlalu panjang',

            'no_hp.regex' => 'Nomor HP harus angka 10-15 digit',
            'no_hp.required' => 'Nomot HP wajib diisi',

            'alamat.required' => 'Alamat wajib diisi',
            'alamat.string' => 'Alamat harus berupa teks',
            'alamat.max' => 'Alamat terlalu panjang (maks 500 karakter)',
        ]);

        $data = [];

        if ($request->filled('email')) {
            $data['email'] = $validated['email'];
        }

        if ($request->filled('no_hp')) {
            $data['no_hp'] = $validated['no_hp'];
        }

        if ($request->filled('alamat')) {
            $data['alamat'] = $validated['alamat'];
        }

        if (empty($data)) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Tidak ada data yang dikirim untuk diupdate'
            ], 400);
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diupdate',
            'data' => $user
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validasi gagal',
            'errors' => $e->errors()
        ], 422);
    }
}
}