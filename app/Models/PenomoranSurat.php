<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenomoranSurat extends Model
{
    protected $table = 'penomoran_surat';
    
    protected $fillable = [
        'id_kategori',
        'nomor_terakhir',
        'format_nomor'
    ];
    
    public function kategori()
    {
        return $this->belongsTo(KategoriSurat::class, 'id_kategori');
    }
}