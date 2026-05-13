<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\RiwayatStatus;
use App\Models\PenomoranSurat;
use App\Models\Pejabat;
use App\Models\SuratKeluar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;

class PengajuanController extends Controller
{
    // ================= DAFTAR PENGAJUAN =================
    public function index()
    {
        $pengajuan = Pengajuan::with([
            'user',
            'kategori'
        ])

        ->orderBy('created_at', 'desc')
        ->get();

        return view(
            'admin.pengajuan.index',
            compact('pengajuan')
        );
    }

    // ================= DETAIL =================
    public function show($id)
    {
        $pengajuan = Pengajuan::with([
            'user',
            'kategori',
            'riwayatStatus',
            'suratKeluar'
        ])

        ->findOrFail($id);

        return view(
            'admin.pengajuan.show',
            compact('pengajuan')
        );
    }

    // ================= VERIFIKASI =================
    public function verify(
        Request $request,
        $id
    ) {

        $pengajuan =
            Pengajuan::with('kategori')
            ->findOrFail($id);

        // ================= APPROVE =================
        if ($request->action === 'approve') {

            // CEK APAKAH SUDAH ADA SURAT
            if ($pengajuan->suratKeluar) {

                return redirect()

                    ->back()

                    ->with(
                        'error',
                        'Surat sudah pernah dibuat'
                    );
            }

            // ================= UPDATE STATUS =================
            $pengajuan->update([
                'status_terkini' => 'diproses'
            ]);

            // ================= RIWAYAT =================
            RiwayatStatus::create([

                'id_pengajuan' =>
                    $pengajuan->id,

                'status' =>
                    'diproses',

                'keterangan' =>
                    'Pengajuan disetujui admin dan surat sedang dibuat',

                'diubah_oleh' =>
                    Auth::id()
            ]);

            // ================= PENOMORAN =================
            $penomoran =
                PenomoranSurat::where(
                    'id_kategori',
                    $pengajuan->id_kategori
                )->first();

            if (!$penomoran) {

                return redirect()

                    ->back()

                    ->with(
                        'error',
                        'Penomoran surat belum tersedia'
                    );
            }

            // ================= PEJABAT =================
            $pejabat =
                Pejabat::first();

            if (!$pejabat) {

                return redirect()

                    ->back()

                    ->with(
                        'error',
                        'Pejabat belum tersedia'
                    );
            }

            // ================= GENERATE NOMOR =================
            $nomorBaru =
                $penomoran->nomor_terakhir + 1;

            $kodeSurat =
                $pengajuan->kategori->kode_surat;

            $nomorSurat =
                $kodeSurat . '/' .
                sprintf('%03d', $nomorBaru) .
                '/' . date('Y');

            // ================= UPDATE NOMOR =================
            $penomoran->update([
                'nomor_terakhir' => $nomorBaru
            ]);

            // ================= BUAT SURAT =================
            $suratKeluar =
                SuratKeluar::create([

                'id_pengajuan' =>
                    $pengajuan->id,

                'id_penomoran' =>
                    $penomoran->id,

                'id_pejabat' =>
                    $pejabat->id,

                'nomor_surat' =>
                    $nomorSurat,

                'tgl_surat' =>
                    now(),
            ]);

            // ================= GENERATE PDF =================
            $pdf = Pdf::loadView(

                'admin.surat-keluar.surat-pdf',

                [

                    'surat' =>

                        $suratKeluar->load([

                            'pengajuan.user',
                            'pengajuan.kategori',
                            'pejabat'
                        ]),

                    'tanggal_cetak' =>
                        now()
                ]
            );

            $pdf->setPaper(
                'a4',
                'portrait'
            );

            // ================= SIMPAN PDF =================
            $pdfPath =
                'surat_keluar/surat_' .
                $suratKeluar->id .
                '.pdf';

            Storage::disk('public')->put(
                $pdfPath,
                $pdf->output()
            );

            // ================= UPDATE FILE =================
            $suratKeluar->update([
                'file_surat_path' => $pdfPath
            ]);

            // ================= STATUS FINAL =================
            $pengajuan->update([
                'status_terkini' => 'selesai'
            ]);

            // ================= RIWAYAT FINAL =================
            RiwayatStatus::create([

                'id_pengajuan' =>
                    $pengajuan->id,

                'status' =>
                    'selesai',

                'keterangan' =>

                    'Surat berhasil dibuat dengan nomor ' .
                    $nomorSurat,

                'diubah_oleh' =>
                    Auth::id()
            ]);

            return redirect()

                ->route(
                    'admin.pengajuan.index'
                )

                ->with(
                    'success',
                    'Pengajuan disetujui & surat otomatis dibuat'
                );
        }

        // ================= REJECT =================
        elseif (
            $request->action === 'reject'
        ) {

            $request->validate([

                'alasan_penolakan' =>
                    'required'
            ]);

            $pengajuan->update([

                'status_terkini' =>
                    'ditolak',

                'alasan_penolakan' =>

                    $request->alasan_penolakan
            ]);

            RiwayatStatus::create([

                'id_pengajuan' =>
                    $pengajuan->id,

                'status' =>
                    'ditolak',

                'keterangan' =>

                    'Pengajuan ditolak. Alasan: ' .
                    $request->alasan_penolakan,

                'diubah_oleh' =>
                    Auth::id()
            ]);

            return redirect()

                ->route(
                    'admin.pengajuan.index'
                )

                ->with(
                    'success',
                    'Pengajuan ditolak'
                );
        }
    }

    // ================= HAPUS =================
    public function destroy($id)
    {
        $pengajuan =
            Pengajuan::findOrFail($id);

        // HAPUS PDF
        if (
            $pengajuan->suratKeluar &&
            $pengajuan->suratKeluar->file_surat_path
        ) {

            Storage::disk('public')->delete(
                $pengajuan
                    ->suratKeluar
                    ->file_surat_path
            );
        }

        // HAPUS SURAT
        SuratKeluar::where(
            'id_pengajuan',
            $id
        )->delete();

        // HAPUS RIWAYAT
        RiwayatStatus::where(
            'id_pengajuan',
            $id
        )->delete();

        // HAPUS PENGAJUAN
        $pengajuan->delete();

        return redirect()

            ->route(
                'admin.pengajuan.index'
            )

            ->with(
                'success',
                'Pengajuan berhasil dihapus'
            );
    }
}