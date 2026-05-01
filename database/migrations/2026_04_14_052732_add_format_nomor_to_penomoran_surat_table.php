<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penomoran_surat', function (Blueprint $table) {
            $table->string('format_nomor')->nullable()->after('nomor_terakhir');
        });
    }

    public function down()
    {
        Schema::table('penomoran_surat', function (Blueprint $table) {
            $table->dropColumn('format_nomor');
        });
    }
};