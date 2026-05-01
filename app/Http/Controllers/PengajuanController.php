<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\RiwayatStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    // Daftar pengajuan untuk admin
    public function index()
    {
        $pengajuan = Pengajuan::with(['user', 'kategori'])->orderBy('created_at', 'desc')->get();
        return view('admin.pengajuan.index', compact('pengajuan'));
    }
    
    // Detail pengajuan
    public function show($id)
    {
        $pengajuan = Pengajuan::with(['user', 'kategori', 'riwayatStatus'])->findOrFail($id);
        return view('admin.pengajuan.show', compact('pengajuan'));
    }
    
    // Verifikasi pengajuan (setuju/tolak)
    public function verify(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        
        if ($request->action === 'approve') {
            $pengajuan->update(['status_terkini' => 'diverifikasi']);
            
            RiwayatStatus::create([
                'id_pengajuan' => $pengajuan->id,
                'status' => 'diverifikasi',
                'keterangan' => 'Pengajuan disetujui oleh admin',
                'diubah_oleh' => Auth::id()
            ]);
            
            return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan disetujui');
            
        } elseif ($request->action === 'reject') {
            $request->validate(['alasan_penolakan' => 'required']);
            
            $pengajuan->update([
                'status_terkini' => 'ditolak',
                'alasan_penolakan' => $request->alasan_penolakan
            ]);
            
            RiwayatStatus::create([
                'id_pengajuan' => $pengajuan->id,
                'status' => 'ditolak',
                'keterangan' => 'Pengajuan ditolak. Alasan: ' . $request->alasan_penolakan,
                'diubah_oleh' => Auth::id()
            ]);
            
            return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan ditolak');
        }
    }
    
    // Hapus pengajuan
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        
        RiwayatStatus::where('id_pengajuan', $id)->delete();
        $pengajuan->delete();
        
        return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan dihapus');
    }
}