<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatStatus extends Model
{
    protected $table = 'riwayat_status';
    
    protected $fillable = [
        'id_pengajuan',
        'status',
        'keterangan',
        'diubah_oleh'
    ];
    
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'diubah_oleh');
    }
}