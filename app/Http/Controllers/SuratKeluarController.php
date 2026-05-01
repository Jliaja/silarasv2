<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\Pengajuan;
use App\Models\PenomoranSurat;
use App\Models\Pejabat;
use App\Models\RiwayatStatus;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    // Daftar surat keluar
    public function index()
    {
        $suratKeluar = SuratKeluar::with(['pengajuan.user', 'pengajuan.kategori', 'pejabat'])->orderBy('created_at', 'desc')->get();
        return view('admin.surat-keluar.index', compact('suratKeluar'));
    }
    
    // Form buat surat dari pengajuan yang sudah disetujui
    public function create($id_pengajuan)
    {
        $pengajuan = Pengajuan::with(['user', 'kategori'])->findOrFail($id_pengajuan);
        
        // Cek apakah sudah pernah dibuat suratnya
        if ($pengajuan->suratKeluar) {
            return redirect()->route('admin.surat-keluar.index')->with('error', 'Surat sudah pernah dibuat');
        }
        
        // Ambil data penomoran dan pejabat
        $penomoran = PenomoranSurat::where('id_kategori', $pengajuan->id_kategori)->first();
        $pejabat = Pejabat::all();
        
        if (!$penomoran) {
            return redirect()->route('admin.pengajuan.index')->with('error', 'Aturan penomoran belum diatur untuk kategori ini');
        }
        
        return view('admin.surat-keluar.create', compact('pengajuan', 'penomoran', 'pejabat'));
    }
    
    // Simpan surat keluar dan generate PDF
    public function store(Request $request)
    {
        $request->validate([
            'id_pengajuan' => 'required',
            'id_penomoran' => 'required',
            'id_pejabat' => 'required',
            'tgl_surat' => 'required|date',
        ]);
        
        $pengajuan = Pengajuan::findOrFail($request->id_pengajuan);
        $penomoran = PenomoranSurat::findOrFail($request->id_penomoran);
        
        // Ambil kode surat dari kategori
        $kodeSurat = $pengajuan->kategori->kode_surat;
        
        // Generate nomor surat otomatis (nomor urut baru)
        $nomorBaru = $penomoran->nomor_terakhir + 1;
        $nomorSurat = $this->generateNomorSurat($penomoran, $kodeSurat, $nomorBaru);
        
        // Update nomor terakhir
        $penomoran->update(['nomor_terakhir' => $nomorBaru]);
        
        // Simpan data surat keluar
        $suratKeluar = SuratKeluar::create([
            'id_pengajuan' => $request->id_pengajuan,
            'id_penomoran' => $request->id_penomoran,
            'id_pejabat' => $request->id_pejabat,
            'nomor_surat' => $nomorSurat,
            'tgl_surat' => $request->tgl_surat,
        ]);
        
        // Generate PDF
        $pdf = $this->generatePDF($suratKeluar);
        $pdfPath = 'surat_keluar/surat_' . $suratKeluar->id . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());
        
        $suratKeluar->update(['file_surat_path' => $pdfPath]);
        
        // Update status pengajuan menjadi selesai
        $pengajuan->update(['status_terkini' => 'selesai']);
        
        // Simpan riwayat status selesai
        RiwayatStatus::create([
            'id_pengajuan' => $pengajuan->id,
            'status' => 'selesai',
            'keterangan' => 'Surat telah selesai dibuat. Nomor surat: ' . $nomorSurat,
            'diubah_oleh' => Auth::id()
        ]);
        
        return redirect()->route('admin.surat-keluar.index')->with('success', 'Surat berhasil dibuat dan disimpan');
    }
    
    /**
     * Generate nomor surat berdasarkan format dari database
     * 
     * @param PenomoranSurat $penomoran Data penomoran dari database
     * @param string $kodeSurat Kode surat (SKTM, SKU, SKD)
     * @param int $nomorUrut Nomor urut baru
     * @return string Nomor surat lengkap
     */
    private function generateNomorSurat($penomoran, $kodeSurat, $nomorUrut)
    {
        // Ambil format dari database, jika kosong pakai default
        $format = $penomoran->format_nomor ?? '{kode_surat}/{nomor}/{tahun}';
        
        // Siapkan data pengganti
        $tahun = date('Y');
        $bulan = date('m');
        $bulanRomawi = $this->getRomanMonth(date('n'));
        $nomorFormatted = sprintf("%03d", $nomorUrut); // 3 digit: 001, 002, 003
        
        // Lakukan penggantian placeholder
        $nomorSurat = str_replace('{nomor}', $nomorFormatted, $format);
        $nomorSurat = str_replace('{tahun}', $tahun, $nomorSurat);
        $nomorSurat = str_replace('{bulan}', $bulan, $nomorSurat);
        $nomorSurat = str_replace('{bulan_romawi}', $bulanRomawi, $nomorSurat);
        $nomorSurat = str_replace('{kode_surat}', $kodeSurat, $nomorSurat);
        
        return $nomorSurat;
    }
    
    /**
     * Konversi angka bulan ke angka Romawi
     * 
     * @param int $month Angka bulan (1-12)
     * @return string Angka Romawi
     */
    private function getRomanMonth($month)
    {
        $romawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];
        return $romawi[$month];
    }
    
    // Generate PDF surat
    private function generatePDF($suratKeluar)
    {
        $data = [
            'surat' => $suratKeluar->load(['pengajuan.user', 'pengajuan.kategori', 'pejabat']),
            'tanggal_cetak' => date('d F Y')
        ];
        
        $pdf = Pdf::loadView('admin.surat-keluar.surat-pdf', $data);
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf;
    }
    
    // Preview PDF
    public function preview($id)
    {
        $suratKeluar = SuratKeluar::with(['pengajuan.user', 'pengajuan.kategori', 'pejabat'])->findOrFail($id);
        
        $data = [
            'surat' => $suratKeluar,
            'tanggal_cetak' => date('d F Y')
        ];
        
        $pdf = Pdf::loadView('admin.surat-keluar.surat-pdf', $data);
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->stream('surat_' . $suratKeluar->id . '.pdf');
    }
    
    // Download PDF
    public function download($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        
        if ($suratKeluar->file_surat_path && Storage::disk('public')->exists($suratKeluar->file_surat_path)) {
            return Storage::disk('public')->download($suratKeluar->file_surat_path);
        }
        
        return redirect()->route('admin.surat-keluar.index')->with('error', 'File surat tidak ditemukan');
    }
    
    // Hapus surat keluar
    public function destroy($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        
        // Hapus file PDF
        if ($suratKeluar->file_surat_path && Storage::disk('public')->exists($suratKeluar->file_surat_path)) {
            Storage::disk('public')->delete($suratKeluar->file_surat_path);
        }
        
        $suratKeluar->delete();
        
        return redirect()->route('admin.surat-keluar.index')->with('success', 'Surat berhasil dihapus');
    }
}