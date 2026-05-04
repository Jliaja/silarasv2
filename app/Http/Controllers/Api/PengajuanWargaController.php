<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use App\Models\RiwayatStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanWargaController extends Controller
{
    public function store(Request $request)
    {
        $dataPengajuan = $request->only([
            'no_kk','nama_usaha','jenis_usaha','alamat_usaha','tahun_berdiri'
        ]);

        $pengajuan = Pengajuan::create([
            'id_user' => Auth::id(),
            'id_kategori' => $request->id_kategori,
            'keperluan' => $request->keperluan,
            'data_pengajuan' => $dataPengajuan,
            'tgl_pengajuan' => now(),
            'status_terkini' => 'menunggu'
        ]);

        RiwayatStatus::create([
            'id_pengajuan' => $pengajuan->id,
            'status' => 'menunggu',
            'keterangan' => 'Pengajuan baru dibuat',
            'diubah_oleh' => Auth::id()
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $pengajuan
        ]);
    }
}