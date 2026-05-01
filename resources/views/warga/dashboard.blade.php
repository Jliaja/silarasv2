@extends('layouts.warga')

@section('content')
<div class="card" style="text-align: center;">
    <div style="margin-bottom: 20px;">
        <img src="{{ asset('images/logo-indramayu.png') }}" alt="Logo Indramayu" style="width: 80px; margin-bottom: 15px;">
        <h2 style="color: #1e3a5f;">SILARAS</h2>
        <p style="color: #64748b;">Sistem Layanan Surat Desa Rambatan Wetan</p>
    </div>

    <div class="tombol-grid">
        <a href="{{ route('warga.pengajuan.create') }}" class="tombol-kotak">
            <div class="tombol-icon">📝</div>
            <div class="tombol-text">Ajukan Surat</div>
        </a>
        <a href="{{ route('warga.riwayat') }}" class="tombol-kotak">
            <div class="tombol-icon">📋</div>
            <div class="tombol-text">Riwayat Pengajuan</div>
        </a>
        <a href="{{ route('warga.informasi') }}" class="tombol-kotak">
            <div class="tombol-icon">ℹ️</div>
            <div class="tombol-text">Informasi Persyaratan</div>
        </a>
    </div>
</div>

<style>
    .tombol-grid {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 20px;
        flex-wrap: wrap;
    }
    .tombol-kotak {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px 25px;
        text-decoration: none;
        text-align: center;
        min-width: 160px;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .tombol-kotak:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        border-color: #2c7cb6;
    }
    .tombol-icon {
        font-size: 32px;
        margin-bottom: 10px;
    }
    .tombol-text {
        font-size: 14px;
        font-weight: 600;
        color: #1e3a5f;
    }
</style>
@endsection