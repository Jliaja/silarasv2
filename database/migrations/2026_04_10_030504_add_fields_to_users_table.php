<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nik', 16)->unique()->after('id');
            $table->string('no_hp', 15)->nullable()->after('email');
            $table->text('alamat')->nullable()->after('no_hp');
            $table->string('tempat_lahir')->nullable()->after('alamat');
            $table->date('tgl_lahir')->nullable()->after('tempat_lahir');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('tgl_lahir');
            $table->string('agama')->nullable()->after('jenis_kelamin');
            $table->string('pekerjaan')->nullable()->after('agama');
            $table->enum('role', ['admin', 'warga'])->default('warga')->after('pekerjaan');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'nik', 
                'no_hp', 
                'alamat', 
                'tempat_lahir', 
                'tgl_lahir', 
                'jenis_kelamin', 
                'agama', 
                'pekerjaan', 
                'role'
            ]);
        });
    }
};