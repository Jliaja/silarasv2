@extends('layouts.admin')

@section('title', 'Edit Pejabat')

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-bottom: 25px; font-size: 22px;">Edit Pejabat</h3>

    <form method="POST" action="{{ route('admin.pejabat.update', $pejabat->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="{{ $pejabat->nama }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $pejabat->jabatan }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">NIP (opsional)</label>
            <input type="text" name="nip" class="form-control" value="{{ $pejabat->nip }}">
        </div>

        <div class="form-group">
            <label class="form-label">Tanda Tangan</label>
            <input type="file" name="tanda_tangan" class="form-control" accept="image/png,image/jpeg">
            @if($pejabat->tanda_tangan)
                <div style="margin-top: 10px;">
                    <small>Tanda tangan saat ini :</small><br>
                    <img src="{{ asset('storage/' . $pejabat->tanda_tangan) }}" style="max-width: 150px; border: 1px solid #ccc; padding: 5px;">
                </div>
            @endif
        </div>

        <div style="display: flex; gap: 15px; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.pejabat.index') }}" class="btn btn-outline">Batal</a>
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