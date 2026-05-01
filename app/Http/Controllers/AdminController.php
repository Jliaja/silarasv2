<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\SuratKeluar;
use App\Models\User;
use App\Models\KategoriSurat;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik kartu
        $totalPemohon = User::where('role', 'warga')->count();
        $totalSuratKeluar = SuratKeluar::count();

        // Data grafik surat keluar per bulan (6 bulan terakhir)
        $bulanLabels = [];
        $suratKeluarData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $bulanLabels[] = $bulan->translatedFormat('F');
            $jumlah = SuratKeluar::whereYear('tgl_surat', $bulan->year)
                ->whereMonth('tgl_surat', $bulan->month)
                ->count();
            $suratKeluarData[] = $jumlah;
        }

        // Data grafik kategori surat
        $kategoriLabels = KategoriSurat::pluck('nama_kategori')->toArray();
        $kategoriData = [];
        foreach (KategoriSurat::all() as $kategori) {
            $kategoriData[] = Pengajuan::where('id_kategori', $kategori->id)->count();
        }

        return view('admin.dashboard', compact(
            'totalPemohon',
            'totalSuratKeluar',
            'bulanLabels',
            'suratKeluarData',
            'kategoriLabels',
            'kategoriData'
        ));
    }
}