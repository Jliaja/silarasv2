<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    
    protected $fillable = [
        'id_user',
        'id_kategori',
        'data_pengajuan',
        'file_pendukung',
        'keperluan',
        'status_terkini',
        'alasan_penolakan',
        'tgl_pengajuan'
    ];
    
    protected $casts = [
        'data_pengajuan' => 'array',
        'tgl_pengajuan' => 'date'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'id_kategori');
    }
    
    public function suratKeluar()
    {
        return $this->hasOne(SuratKeluar::class, 'id_pengajuan');
    }
    
    public function riwayatStatus()
    {
        return $this->hasMany(RiwayatStatus::class, 'id_pengajuan')->orderBy('created_at', 'asc');
    }
}