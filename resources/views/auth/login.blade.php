@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
        <label style="display: flex; align-items: center; gap: 8px;">
            <input type="checkbox" name="remember"> Ingat saya
        </label>
    </div>

    <button type="submit" class="btn-auth">Login</button>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>
</form>
@endsection