<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PengajuanWargaController;
use App\Http\Controllers\Api\RiwayatWargaController;
use App\Http\Controllers\Api\ProfileWargaController;

Route::middleware(['auth:sanctum'])->prefix('warga')->group(function () {

    // 🔹 RIWAYAT
    Route::get('/riwayat', [RiwayatWargaController::class, 'index']);

    // 🔹 PENGAJUAN
    Route::post('/pengajuan', [PengajuanWargaController::class, 'store']);
    Route::get('/pengajuan/{id}', [PengajuanWargaController::class, 'show']);
    Route::get('/pengajuan/{id}/download', [PengajuanWargaController::class, 'download']);

    // 🔹 PROFILE
    Route::get('/profile', [ProfileWargaController::class, 'me']);
    Route::put('/profile', [ProfileWargaController::class, 'update']);
});