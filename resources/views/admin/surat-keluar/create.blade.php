@extends('layouts.admin')

@section('title', 'Buat Surat Keluar')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-bottom: 25px; font-size: 22px;">Buat Surat Keluar</h3>

    <div style="background: #f8fafc; padding: 15px; border-radius: 12px; margin-bottom: 20px;">
        <h4 style="margin-bottom: 10px;">Informasi Pengajuan</h4>
        <p><strong>Pemohon :</strong> {{ $pengajuan->user->name }} (NIK: {{ $pengajuan->user->nik }})</p>
        <p><strong>Jenis Surat :</strong> {{ $pengajuan->kategori->nama_kategori }} ({{ $pengajuan->kategori->kode_surat }})</p>
        <p><strong>Keperluan :</strong> {{ $pengajuan->keperluan }}</p>
    </div>

    <form method="POST" action="{{ route('admin.surat-keluar.store') }}">
        @csrf

        <input type="hidden" name="id_pengajuan" value="{{ $pengajuan->id }}">
        <input type="hidden" name="id_penomoran" value="{{ $penomoran->id }}">

        <div class="form-group">
            <label class="form-label">Pejabat Penandatangan</label>
            <select name="id_pejabat" class="form-control" required>
                <option value="">Pilih Pejabat</option>
                @foreach($pejabat as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} - {{ $item->jabatan }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal Surat</label>
            <input type="date" name="tgl_surat" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div style="background: #f1f5f9; padding: 15px; border-radius: 12px; margin: 20px 0;">
            <p><strong>Format Nomor Surat :</strong></p>
            <p><code>{{ $penomoran->format_nomor ?? '{nomor}' }}</code></p>
            <p><small>Nomor terakhir: <strong>{{ $penomoran->nomor_terakhir }}</strong> → akan menjadi <strong>{{ $penomoran->nomor_terakhir + 1 }}</strong></small></p>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Buat Surat & Cetak PDF</button>
            <a href="{{ route('admin.pengajuan.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>

<style>
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1e3a5f;
        font-size: 14px;
    }
    .form-control {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .form-control:focus {
        outline: none;
        border-color: #2c7cb6;
        box-shadow: 0 0 0 3px rgba(44,124,182,0.1);
    }
    code {
        background: white;
        padding: 4px 8px;
        border-radius: 8px;
        font-size: 13px;
    }
</style>
@endsection