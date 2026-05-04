<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class RiwayatWargaController extends Controller
{
    public function index()
    {
        $data = Pengajuan::where('id_user', Auth::id())
            ->with('kategori')
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}