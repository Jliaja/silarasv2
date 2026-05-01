<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class RiwayatWargaController extends Controller
{
    public function index()
    {
        $pengajuan = Pengajuan::where('id_user', Auth::id())
            ->with('kategori')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('warga.riwayat', compact('pengajuan'));
    }
}