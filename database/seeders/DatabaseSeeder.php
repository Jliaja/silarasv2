<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pejabat;
use App\Models\KategoriSurat;
use App\Models\PenomoranSurat;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ================= ADMIN =================
        User::firstOrCreate(

            [
                'email' =>
                    'admin@example.com'
            ],

            [

                'name' =>
                    'Admin Desa',

                'nik' =>
                    '3201234567890002',

                'password' =>
                    Hash::make('12345678'),

                'role' =>
                    'admin',
            ]
        );

        // ================= WARGA =================
        User::firstOrCreate(

            [
                'email' =>
                    'warga@example.com'
            ],

            [

                'name' =>
                    'Warga Demo',

                'nik' =>
                    '3201234567890003',

                'password' =>
                    Hash::make('12345678'),

                'role' =>
                    'warga',

                'no_hp' =>
                    '081234567890',

                'alamat' =>
                    'Jl. Raya Desa Sukamaju',
            ]
        );

        // ================= PEJABAT =================
        Pejabat::firstOrCreate(

            [
                'nip' =>
                    '198812122010011001'
            ],

            [

                'nama' =>
                    'Budi Santoso',

                'jabatan' =>
                    'Kepala Desa',
            ]
        );

        Pejabat::firstOrCreate(

            [
                'nip' =>
                    '198705102011012002'
            ],

            [

                'nama' =>
                    'Siti Aminah',

                'jabatan' =>
                    'Sekretaris Desa',
            ]
        );

        // ================= KATEGORI =================
        $sku =
            KategoriSurat::firstOrCreate(

            [
                'kode_surat' =>
                    'SKU'
            ],

            [
                'nama_kategori' =>
                    'Surat Keterangan Usaha',
            ]
        );

        $domisili =
            KategoriSurat::firstOrCreate(

            [
                'kode_surat' =>
                    'SKD'
            ],

            [
                'nama_kategori' =>
                    'Surat Keterangan Domisili',
            ]
        );

        $sktm =
            KategoriSurat::firstOrCreate(

            [
                'kode_surat' =>
                    'SKTM'
            ],

            [
                'nama_kategori' =>
                    'Surat Keterangan Tidak Mampu',
            ]
        );


        // ================= PENOMORAN =================
        PenomoranSurat::firstOrCreate(

            [
                'id_kategori' =>
                    $sku->id
            ],

            [

                'nomor_terakhir' => 12,

                'format_nomor' =>
                    '470/{nomor}/SKU/{bulan}/{tahun}',
            ]
        );

        PenomoranSurat::firstOrCreate(

            [
                'id_kategori' =>
                    $domisili->id
            ],

            [

                'nomor_terakhir' => 7,

                'format_nomor' =>
                    '470/{nomor}/SKD/{bulan}/{tahun}',
            ]
        );

        PenomoranSurat::firstOrCreate(

            [
                'id_kategori' =>
                    $sktm->id
            ],

            [

                'nomor_terakhir' => 3,

                'format_nomor' =>
                    '470/{nomor}/SKTM/{bulan}/{tahun}',
            ]
        );
    }
}