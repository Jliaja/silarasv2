@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">NIK</label>
        <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
    </div>

    <div class="form-group">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
    </div>

    <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn-auth">Daftar</button>

    <div class="auth-footer">
        Sudah punya akun? <a href="{{ route('login') }}">Login disini</a>
    </div>
</form>
@endsection