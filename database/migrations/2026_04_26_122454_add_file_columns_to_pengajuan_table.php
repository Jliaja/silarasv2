<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->string('file_kk')->nullable()->after('file_pendukung');
            $table->string('file_pengantar')->nullable()->after('file_kk');
            $table->string('file_foto_depan')->nullable()->after('file_pengantar');
            $table->string('file_foto_dalam')->nullable()->after('file_foto_depan');
        });
    }

    public function down()
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropColumn(['file_kk', 'file_pengantar', 'file_foto_depan', 'file_foto_dalam']);
        });
    }
};