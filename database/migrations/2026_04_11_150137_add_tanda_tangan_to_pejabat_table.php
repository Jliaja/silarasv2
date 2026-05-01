<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pejabat', function (Blueprint $table) {
            $table->string('tanda_tangan')->nullable()->after('nip');
        });
    }

    public function down()
    {
        Schema::table('pejabat', function (Blueprint $table) {
            $table->dropColumn('tanda_tangan');
        });
    }
};