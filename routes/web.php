<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriSuratController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\PenomoranSuratController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\PengajuanWargaController;
use App\Http\Controllers\RiwayatWargaController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileWargaController;
use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// ==================== ROUTE ADMIN ====================
Route::prefix('admin')->middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Kategori Surat
    Route::resource('kategori', KategoriSuratController::class)->names([
        'index' => 'admin.kategori.index',
        'create' => 'admin.kategori.create',
        'store' => 'admin.kategori.store',
        'edit' => 'admin.kategori.edit',
        'update' => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);
    
    // Data Pejabat
    Route::resource('pejabat', PejabatController::class)->names([
        'index' => 'admin.pejabat.index',
        'create' => 'admin.pejabat.create',
        'store' => 'admin.pejabat.store',
        'edit' => 'admin.pejabat.edit',
        'update' => 'admin.pejabat.update',
        'destroy' => 'admin.pejabat.destroy',
    ]);
    
    // Penomoran Surat
    Route::resource('penomoran', PenomoranSuratController::class)->names([
        'index' => 'admin.penomoran.index',
        'create' => 'admin.penomoran.create',
        'store' => 'admin.penomoran.store',
        'edit' => 'admin.penomoran.edit',
        'update' => 'admin.penomoran.update',
        'destroy' => 'admin.penomoran.destroy',
    ]);
    
    // Permohonan Surat (Admin)
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan.index');
    Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('admin.pengajuan.show');
    Route::post('/pengajuan/{id}/verify', [PengajuanController::class, 'verify'])->name('admin.pengajuan.verify');
    Route::delete('/pengajuan/{id}', [PengajuanController::class, 'destroy'])->name('admin.pengajuan.destroy');
    
    // Surat Keluar
    Route::get('/surat-keluar', [SuratKeluarController::class, 'index'])->name('admin.surat-keluar.index');
    Route::get('/surat-keluar/create/{id_pengajuan}', [SuratKeluarController::class, 'create'])->name('admin.surat-keluar.create');
    Route::post('/surat-keluar', [SuratKeluarController::class, 'store'])->name('admin.surat-keluar.store');
    Route::get('/surat-keluar/preview/{id}', [SuratKeluarController::class, 'preview'])->name('admin.surat-keluar.preview');
    Route::get('/surat-keluar/download/{id}', [SuratKeluarController::class, 'download'])->name('admin.surat-keluar.download');
    Route::delete('/surat-keluar/{id}', [SuratKeluarController::class, 'destroy'])->name('admin.surat-keluar.destroy');
    
    // Profile Admin
    Route::get('/profile/edit', [ProfileAdminController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/update', [ProfileAdminController::class, 'update'])->name('admin.profile.update');
});

// ==================== ROUTE WARGA ====================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard warga
    Route::view('/warga/dashboard', 'warga.dashboard')->name('warga.dashboard');
    
    // Informasi Persyaratan
    Route::view('/warga/informasi', 'warga.informasi')->name('warga.informasi');
    
    // Download template surat pengantar RT
    Route::get('/warga/download/template-pengantar', [DownloadController::class, 'downloadTemplatePengantar'])->name('warga.download-template-pengantar');
    
    // Riwayat warga
    Route::get('/warga/riwayat', [RiwayatWargaController::class, 'index'])->name('warga.riwayat');
    
    // Pengajuan warga
    Route::get('/warga/pengajuan/create', [PengajuanWargaController::class, 'create'])->name('warga.pengajuan.create');
    Route::post('/warga/pengajuan', [PengajuanWargaController::class, 'store'])->name('warga.pengajuan.store');
    Route::get('/warga/pengajuan/{id}', [PengajuanWargaController::class, 'show'])->name('warga.pengajuan.show');
    Route::get('/warga/pengajuan/{id}/download', [PengajuanWargaController::class, 'download'])->name('warga.pengajuan.download');
    
    // Profile Warga
    Route::get('/warga/profile/edit', [ProfileWargaController::class, 'edit'])->name('warga.profile.edit');
    Route::put('/warga/profile/update', [ProfileWargaController::class, 'update'])->name('warga.profile.update');
});

// ==================== REDIRECT DASHBOARD ====================
Route::middleware(['auth'])->get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('warga.dashboard');
})->name('dashboard');

// ==================== ROUTE LOGOUT ====================
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// ==================== ROUTE AUTH BAWAAN LARAVEL ====================
require __DIR__.'/auth.php';