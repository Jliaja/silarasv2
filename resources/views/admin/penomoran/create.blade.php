@extends('layouts.admin')

@section('title', 'Tambah Penomoran Surat')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-bottom: 25px; font-size: 22px;">Tambah Aturan Penomoran</h3>

    <form method="POST" action="{{ route('admin.penomoran.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Kategori Surat</label>
            <select name="id_kategori" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kategori }} ({{ $item->kode_surat }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Nomor Terakhir</label>
            <input type="number" name="nomor_terakhir" class="form-control" value="0" required min="0">
        </div>

        <div class="form-group">
            <label class="form-label">Format Nomor Surat</label>
            <input type="text" name="format_nomor" class="form-control" value="{{ old('format_nomor') }}">
        </div>

        <div style="display: flex; gap: 15px; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.penomoran.index') }}" class="btn btn-outline">Batal</a>
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
        background: #f1f5f9;
        padding: 2px 6px;
        border-radius: 6px;
        font-size: 12px;
    }
</style>
@endsection