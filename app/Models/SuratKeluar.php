<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [

        'id_pengajuan',

        'id_penomoran',

        'id_pejabat',

        'nomor_surat',

        'tgl_surat',

        'file_surat_path'
    ];

    protected $appends = [
        'file_url'
    ];

    public function getFileUrlAttribute()
    {
        if (!$this->file_surat_path) {
            return null;
        }

        return asset(
            'storage/' .
            $this->file_surat_path
        );
    }

    public function pengajuan()
    {
        return $this->belongsTo(
            Pengajuan::class,
            'id_pengajuan'
        );
    }

    public function penomoran()
    {
        return $this->belongsTo(
            PenomoranSurat::class,
            'id_penomoran'
        );
    }

    public function pejabat()
    {
        return $this->belongsTo(
            Pejabat::class,
            'id_pejabat'
        );
    }
}