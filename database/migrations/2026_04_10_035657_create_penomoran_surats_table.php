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
        Schema::create('penomoran_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori_surat')->onDelete('cascade');
            $table->integer('nomor_terakhir')->default(0);
            $table->string('format_nomor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('penomoran_surat');
}
};
