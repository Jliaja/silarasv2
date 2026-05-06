<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengajuanWargaController;
use App\Http\Controllers\Api\RiwayatWargaController;
use App\Http\Controllers\Api\ProfileWargaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;


Route::post('/register', [AccountController::class, 'register']);
Route::post('/verify-email', [AccountController::class, 'verifyEmail']);
Route::post('/forgot-password', [AccountController::class, 'forgotPassword']);
Route::post('/reset-password', [AccountController::class, 'resetPassword']);
Route::post('/login', [AuthController::class, 'login']);
   Route::get('/kategori', function () {
    return \App\Models\KategoriSurat::all();
});
Route::middleware(['auth:sanctum'])->prefix('warga')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);  
    Route::post('/change-password', [AccountController::class, 'changePassword']);
    // 🔹 RIWAYAT
    Route::get('/riwayat', [RiwayatWargaController::class, 'index']);

    // 🔹 PENGAJUAN
    Route::post('/pengajuan', [PengajuanWargaController::class, 'store']);
    Route::get('/pengajuan/{id}', [PengajuanWargaController::class, 'show']);
    Route::get('/pengajuan/{id}/download', [PengajuanWargaController::class, 'download']);
 
    // 🔹 PROFILE
    Route::get('/profile', [ProfileWargaController::class, 'me']);
    Route::put('/profile', [ProfileWargaController::class, 'updateProfile']);
});