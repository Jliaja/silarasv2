<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use App\Models\Pengajuan;
use App\Models\RiwayatStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanWargaController extends Controller
{
    public function create()
    {
        $kategori = KategoriSurat::all();
        return view('warga.pengajuan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Data tambahan JSON
        $dataPengajuan = [];
        if ($request->no_kk) {
            $dataPengajuan['no_kk'] = $request->no_kk;
        }
        if ($request->nama_usaha) {
            $dataPengajuan['nama_usaha'] = $request->nama_usaha;
        }
        if ($request->jenis_usaha) {
            $dataPengajuan['jenis_usaha'] = $request->jenis_usaha;
        }
        if ($request->alamat_usaha) {
            $dataPengajuan['alamat_usaha'] = $request->alamat_usaha;
        }
        if ($request->tahun_berdiri) {
            $dataPengajuan['tahun_berdiri'] = $request->tahun_berdiri;
        }

        // Simpan pengajuan
        $pengajuan = Pengajuan::create([
            'id_user' => Auth::id(),
            'id_kategori' => $request->id_kategori,
            'keperluan' => $request->keperluan,
            'data_pengajuan' => $dataPengajuan,
            'tgl_pengajuan' => date('Y-m-d'),
            'status_terkini' => 'menunggu'
        ]);

        // Upload file KK
        if ($request->hasFile('file_kk')) {
            $file = $request->file('file_kk');
            $filename = time() . '_kk_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengajuan', $filename, 'public');
            $pengajuan->file_kk = $path;
        }

        // Upload file pengantar RT
        if ($request->hasFile('file_pengantar')) {
            $file = $request->file('file_pengantar');
            $filename = time() . '_pengantar_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengajuan', $filename, 'public');
            $pengajuan->file_pengantar = $path;
        }

        // Upload file foto depan usaha
        if ($request->hasFile('file_foto_depan')) {
            $file = $request->file('file_foto_depan');
            $filename = time() . '_foto_depan_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengajuan', $filename, 'public');
            $pengajuan->file_foto_depan = $path;
        }

        // Upload file foto dalam usaha
        if ($request->hasFile('file_foto_dalam')) {
            $file = $request->file('file_foto_dalam');
            $filename = time() . '_foto_dalam_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengajuan', $filename, 'public');
            $pengajuan->file_foto_dalam = $path;
        }

        $pengajuan->save();

        // Update data user
        $user = Auth::user();
        if ($request->tempat_lahir) {
            $user->tempat_lahir = $request->tempat_lahir;
        }
        if ($request->tgl_lahir) {
            $user->tgl_lahir = $request->tgl_lahir;
        }
        if ($request->jenis_kelamin) {
            $user->jenis_kelamin = $request->jenis_kelamin;
        }
        if ($request->agama) {
            $user->agama = $request->agama;
        }
        if ($request->pekerjaan) {
            $user->pekerjaan = $request->pekerjaan;
        }
        if ($request->alamat) {
            $user->alamat = $request->alamat;
        }
        $user->save();

        // Riwayat status
        RiwayatStatus::create([
            'id_pengajuan' => $pengajuan->id,
            'status' => 'menunggu',
            'keterangan' => 'Pengajuan baru dibuat oleh warga',
            'diubah_oleh' => Auth::id()
        ]);

        return redirect()->route('warga.riwayat')->with('success', 'Pengajuan berhasil dikirim');
    }

    public function show($id)
    {
        $pengajuan = Pengajuan::where('id_user', Auth::id())
            ->with(['kategori', 'suratKeluar', 'riwayatStatus'])
            ->findOrFail($id);
        
        return view('warga.pengajuan.detail', compact('pengajuan'));
    }

    public function download($id)
    {
        $pengajuan = Pengajuan::where('id_user', Auth::id())
            ->with('suratKeluar')
            ->findOrFail($id);
        
        if (!$pengajuan->suratKeluar || !$pengajuan->suratKeluar->file_surat_path) {
            return redirect()->back()->with('error', 'Surat belum tersedia');
        }
        
        return response()->download(storage_path('app/public/' . $pengajuan->suratKeluar->file_surat_path));
    }
}