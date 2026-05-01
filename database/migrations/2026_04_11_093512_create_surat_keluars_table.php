<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan')->constrained('pengajuan')->onDelete('cascade');
            $table->foreignId('id_penomoran')->constrained('penomoran_surat')->onDelete('cascade');
            $table->foreignId('id_pejabat')->constrained('pejabat')->onDelete('cascade');
            $table->string('nomor_surat')->unique();
            $table->date('tgl_surat');
            $table->string('file_surat_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};
