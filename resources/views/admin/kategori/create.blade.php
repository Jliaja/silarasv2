@extends('layouts.admin')

@section('title', 'Tambah Kategori Surat')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-bottom: 25px; font-size: 22px;">Tambah Kategori Baru</h3>

    <form method="POST" action="{{ route('admin.kategori.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control">
        </div>

        <div class="form-group">
            <label class="form-label">Kode Surat</label>
            <input type="text" name="kode_surat" class="form-control">
        </div>

        <div class="form-group">
            <label class="form-label">File Template (.doc / .docx)</label>
            <input type="file" name="template" class="form-control" accept=".doc,.docx">
            <small style="color: #64748b;">Opsional, unggah file template surat jika ada</small>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline">Batal</a>
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
</style>
@endsection