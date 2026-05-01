@extends('layouts.warga')

@section('content')
<div class="card">
    <h3 style="margin-bottom: 20px;">Persyaratan Pengajuan Surat</h3>
    
    <div style="background: #f0f9ff; padding: 20px; border-radius: 16px; margin-bottom: 20px;">
        <h4 style="margin-bottom: 10px; color: #1e3a5f;">Umum (Semua Jenis Surat)</h4>
        <ul style="margin-left: 20px; color: #475569;">
            <li>Fotokopi Kartu Tanda Penduduk (KTP)</li>
            <li>Surat pengantar dari RT/RW setempat</li>
            <li>Mengisi formulir pengajuan dengan lengkap</li>
        </ul>
        <div style="margin-top: 15px;">
            <a href="{{ asset('templates/template-pengantar-rt.docx') }}" class="btn-download" download>📎 Download Template Surat Pengantar RT</a>
        </div>
    </div>

    <div style="background: #f0f9ff; padding: 20px; border-radius: 16px; margin-bottom: 20px;">
        <h4 style="margin-bottom: 10px; color: #1e3a5f;">📄 Surat Keterangan Tidak Mampu (SKTM)</h4>
        <ul style="margin-left: 20px; color: #475569;">
            <li>Fotokopi Kartu Keluarga (KK)</li>
            <li>Surat keterangan dari RT/RW</li>
        </ul>
    </div>

    <div style="background: #f0f9ff; padding: 20px; border-radius: 16px; margin-bottom: 20px;">
        <h4 style="margin-bottom: 10px; color: #1e3a5f;">🏪 Surat Keterangan Usaha (SKU)</h4>
        <ul style="margin-left: 20px; color: #475569;">
            <li>Fotokopi KTP</li>
            <li>Foto tempat usaha (depan dan dalam)</li>
            <li>Surat pengantar dari RT/RW</li>
        </ul>
    </div>

    <div style="background: #f0f9ff; padding: 20px; border-radius: 16px;">
        <h4 style="margin-bottom: 10px; color: #1e3a5f;">🏠 Surat Keterangan Domisili</h4>
        <ul style="margin-left: 20px; color: #475569;">
            <li>Fotokopi Kartu Keluarga (KK)</li>
            <li>Fotokopi KTP</li>
            <li>Surat pengantar dari RT/RW</li>
        </ul>
    </div>

    <div style="margin-top: 25px; text-align: center;">
        <a href="{{ route('warga.dashboard') }}" class="btn btn-primary">← Kembali ke Dashboard</a>
    </div>
</div>

<style>
    .btn-download {
        display: inline-block;
        background: #27ae60;
        color: white;
        padding: 8px 18px;
        border-radius: 30px;
        font-size: 13px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
    }
    .btn-download:hover {
        background: #229954;
        transform: translateY(-2px);
    }
    .btn-primary {
        background: #2c7cb6;
        color: white;
        padding: 10px 24px;
        border-radius: 40px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
    }
    .btn-primary:hover {
        background: #1e5a8a;
    }
</style>
@endsection