<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class RiwayatWargaController extends Controller
{
    public function index()
    {
        try {

            $data = Pengajuan::where(
                    'id_user',
                    Auth::id()
                )

                ->with([
                    'kategori',
                    'riwayatStatus',
                    'suratKeluar.pejabat'
                ])

                ->latest()

                ->get()

                ->map(function ($item) {

                    return [

                        'id' => $item->id,

                        'keperluan' =>
                            $item->keperluan,

                        'status_terkini' =>
                            $item->status_terkini,

                        'tgl_pengajuan' =>
                            $item->tgl_pengajuan,

                        'created_at' =>

                            $item->created_at
                                ? $item->created_at
                                    ->format(
                                        'd M Y H:i'
                                    )
                                : null,

                        'alasan_penolakan' =>
                            $item->alasan_penolakan,

                        'data_pengajuan' =>
                            $item->data_pengajuan,

                        // ================= FILE KK =================
                        'file_kk' =>

                            $item->file_kk

                            ? asset(
                                'storage/' .
                                $item->file_kk
                            )

                            : null,

                        // ================= FILE RT =================
                        'file_pengantar' =>

                            $item->file_pengantar

                            ? asset(
                                'storage/' .
                                $item->file_pengantar
                            )

                            : null,

                        // ================= KATEGORI =================
                        'kategori' => [

                            'id' =>
                                $item->kategori->id ?? null,

                            'nama_kategori' =>

                                $item->kategori
                                    ->nama_kategori ?? '-',
                        ],

                        // ================= SURAT KELUAR =================
                        'surat_keluar' =>

                            $item->suratKeluar

                            ? [

                                'id' =>
                                    $item->suratKeluar->id,

                                'nomor_surat' =>

                                    $item->suratKeluar
                                        ->nomor_surat,

                                'tgl_surat' =>

                                    $item->suratKeluar
                                        ->tgl_surat,

                                'file_url' =>

                                    $item->suratKeluar
                                        ->file_surat_path

                                    ? asset(
                                        'storage/' .

                                        $item->suratKeluar
                                            ->file_surat_path
                                    )

                                    : null,

                                'pejabat' =>

                                    $item->suratKeluar
                                        ->pejabat

                                    ? [

                                        'nama' =>

                                            $item->suratKeluar
                                                ->pejabat
                                                ->nama,

                                        'jabatan' =>

                                            $item->suratKeluar
                                                ->pejabat
                                                ->jabatan,
                                    ]

                                    : null,
                            ]

                            : null,

                        // ================= TIMELINE =================
                        'riwayat_status' =>

                            $item->riwayatStatus
                                ->map(function ($r) {

                                    return [

                                        'status' =>
                                            $r->status,

                                        'keterangan' =>
                                            $r->keterangan,

                                        'created_at' =>

                                            $r->created_at

                                            ? $r->created_at
                                                ->format(
                                                    'd M Y H:i'
                                                )

                                            : null,
                                    ];
                                }),
                    ];
                });

            return response()->json([

                'status' => 'success',

                'data' => $data,
            ]);

        } catch (\Throwable $e) {

            return response()->json([

                'status' => 'error',

                'message' =>
                    $e->getMessage(),

            ], 500);
        }
    }
}