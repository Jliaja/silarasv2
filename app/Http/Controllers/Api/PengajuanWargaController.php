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
        try {

            $request->validate([
                'id_kategori' => 'required|exists:kategori_surat,id',
                'keperluan' => 'required',
            ]);

            // DATA PENGAJUAN
            $dataPengajuan = [];

            if ($request->no_kk) {

                $dataPengajuan['no_kk'] =
                    $request->no_kk;
            }

            // SIMPAN PENGAJUAN
            $pengajuan = Pengajuan::create([

                'id_user' => Auth::id(),

                'id_kategori' =>
                    $request->id_kategori,

                'keperluan' =>
                    $request->keperluan,

                'data_pengajuan' =>
                    $dataPengajuan,

                'tgl_pengajuan' => now(),

                'status_terkini' =>
                    'menunggu'
            ]);

            // ================= FILE KK =================
            if ($request->hasFile('file_kk')) {

                $file =
                    $request->file('file_kk');

                $filename =
                    time() .
                    '_kk_' .
                    $file->getClientOriginalName();

                $path = $file->storeAs(
                    'pengajuan',
                    $filename,
                    'public'
                );

                $pengajuan->file_kk = $path;
            }

            // ================= FILE PENGANTAR RT =================
            if ($request->hasFile('file_pengantar')) {

                $file =
                    $request->file('file_pengantar');

                $filename =
                    time() .
                    '_pengantar_' .
                    $file->getClientOriginalName();

                $path = $file->storeAs(
                    'pengajuan',
                    $filename,
                    'public'
                );

                $pengajuan->file_pengantar =
                    $path;
            }

            // SAVE FILE
            $pengajuan->save();

            // RIWAYAT STATUS
            RiwayatStatus::create([

                'id_pengajuan' =>
                    $pengajuan->id,

                'status' =>
                    'menunggu',

                'keterangan' =>
                    'Pengajuan via mobile',

                'diubah_oleh' =>
                    Auth::id()
            ]);

            return response()->json([

                'status' => 'success',

                'message' =>
                    'Pengajuan berhasil',

                'data' => $pengajuan
            ]);

        } catch (\Throwable $e) {

            return response()->json([

                'status' => 'error',

                'message' =>
                    $e->getMessage()

            ], 500);
        }
    }
}