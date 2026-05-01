@extends('layouts.admin')

@section('title', 'Edit Profil Admin')

@section('content')
<div class="card" style="max-width: 700px; margin: 0 auto;">
    <h3 style="margin-bottom: 25px; font-size: 22px; font-weight: 700;">Edit Profil Admin</h3>

    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ old('nik', Auth::user()->nik) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', Auth::user()->no_hp) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', Auth::user()->tempat_lahir) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', Auth::user()->tgl_lahir) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="">Pilih</option>
                    <option value="L" {{ Auth::user()->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ Auth::user()->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Agama</label>
                <select name="agama" class="form-control">
                    <option value="">Pilih</option>
                    <option value="Islam" {{ Auth::user()->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ Auth::user()->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ Auth::user()->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ Auth::user()->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ Auth::user()->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ Auth::user()->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', Auth::user()->pekerjaan) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', Auth::user()->alamat) }}</textarea>
            </div>
        </div>

        <div style="background: #f8fafc; padding: 20px; border-radius: 16px; margin: 20px 0;">
            <h4 style="margin-bottom: 15px; font-size: 16px;">Ubah Password (opsional)</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 10px;">
            <button type="submit" class="btn btn-primary" style="background: #2c7cb6; padding: 10px 24px;">Simpan Perubahan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline" style="padding: 10px 24px;">Batal</a>
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
    .btn-outline {
        background: #f1f5f9;
        color: #1e293b;
        border: 1px solid #cbd5e1;
    }
    .btn-outline:hover {
        background: #e2e8f0;
    }
</style>
@endsection